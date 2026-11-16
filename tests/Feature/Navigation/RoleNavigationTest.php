<?php

namespace Tests\Feature\Navigation;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_admin_links_but_not_buyer_cart_or_order_history(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/');

        $response
            ->assertOk()
            ->assertSee('Dashboard Admin')
            ->assertSee('Manajemen Produk')
            ->assertSee('Manajemen Pesanan')
            ->assertDontSee('Keranjang')
            ->assertDontSee('Riwayat Pesanan');

        $html = $response->getContent();
        $this->assertSame(2, substr_count($html, 'Dashboard Admin'));
        $this->assertSame(2, substr_count($html, 'Manajemen Produk'));
        $this->assertSame(2, substr_count($html, 'Manajemen Pesanan'));
        $this->assertSame(0, substr_count($html, 'href="'.route('keranjang.index').'"'));
        $this->assertSame(0, substr_count($html, 'href="'.route('pesanan.riwayat').'"'));
        $this->assertSame(2, substr_count($html, 'href="'.route('profile.edit').'"'));
        $this->assertSame(2, substr_count($html, 'action="'.route('logout').'"'));
    }

    public function test_buyer_sees_cart_and_order_history_but_not_admin_links(): void
    {
        $buyer = User::factory()->create(['role' => 'pembeli']);

        $response = $this->actingAs($buyer)->get('/');

        $response
            ->assertOk()
            ->assertSee('Keranjang')
            ->assertSee('Riwayat Pesanan')
            ->assertDontSee('Dashboard Admin')
            ->assertDontSee('Manajemen Produk')
            ->assertDontSee('Manajemen Pesanan');

        $html = $response->getContent();
        $this->assertSame(2, substr_count($html, 'href="'.route('keranjang.index').'"'));
        $this->assertSame(2, substr_count($html, 'href="'.route('pesanan.riwayat').'"'));
        $this->assertSame(2, substr_count($html, 'href="'.route('profile.edit').'"'));
        $this->assertSame(2, substr_count($html, 'action="'.route('logout').'"'));
    }

    public function test_guest_keeps_public_cart_and_login_links_without_role_specific_links(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Keranjang')
            ->assertSee('Login')
            ->assertDontSee('Dashboard Admin')
            ->assertDontSee('Riwayat Pesanan')
            ->assertDontSee('Profil')
            ->assertDontSee('Logout');

        $html = $response->getContent();
        $this->assertSame(2, substr_count($html, 'href="'.route('keranjang.index').'"'));
        $this->assertSame(0, substr_count($html, 'href="'.route('profile.edit').'"'));
        $this->assertSame(0, substr_count($html, 'action="'.route('logout').'"'));
    }
}
