<?php

namespace Tests\Feature\Admin;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesananStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_pesanan_statuses_and_changes_are_persisted(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $pesanan = $this->createPesanan();

        foreach (['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'] as $status) {
            $response = $this->actingAs($admin)->put(route('admin.pesanan.update', $pesanan), [
                'status' => $status,
            ]);

            $response->assertRedirect(route('admin.pesanan.detail', $pesanan));
            $response->assertSessionHas('success');
            $this->assertDatabaseHas('pesanans', [
                'id' => $pesanan->id,
                'status' => $status,
                'metode_pembayaran' => 'Transfer Bank',
            ]);
        }
    }

    public function test_admin_order_list_and_detail_show_the_current_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $pesanan = $this->createPesanan(['status' => 'dikirim']);

        $this->actingAs($admin)
            ->get(route('admin.pesanan'))
            ->assertOk()
            ->assertSee('Dikirim');

        $this->get(route('admin.pesanan.detail', $pesanan))
            ->assertOk()
            ->assertSee('Status Pesanan Saat Ini')
            ->assertSee('Dikirim');
    }

    public function test_admin_can_access_order_details_through_the_admin_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $pesanan = $this->createPesanan();

        $this->actingAs($admin)
            ->get(route('admin.pesanan.detail', $pesanan))
            ->assertOk()
            ->assertSee('Detail Pesanan #'.$pesanan->id);
    }

    public function test_admin_can_filter_orders_by_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->createPesanan(['nama_penerima' => 'Pesanan Pending']);
        $sentOrder = $this->createPesanan(['nama_penerima' => 'Pesanan Dikirim', 'status' => 'dikirim']);

        $this->actingAs($admin)
            ->get(route('admin.pesanan', ['status' => 'dikirim']))
            ->assertOk()
            ->assertSee('Pesanan Dikirim')
            ->assertDontSee('Pesanan Pending');
    }

    public function test_invalid_pesanan_status_is_rejected_without_changing_the_order(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $pesanan = $this->createPesanan();

        $response = $this->actingAs($admin)
            ->from(route('admin.pesanan.detail', $pesanan))
            ->put(route('admin.pesanan.update', $pesanan), ['status' => 'dibayar']);

        $response->assertRedirect(route('admin.pesanan.detail', $pesanan));
        $response->assertSessionHasErrors('status');
        $this->assertDatabaseHas('pesanans', [
            'id' => $pesanan->id,
            'status' => 'pending',
        ]);
    }

    public function test_buyer_cannot_update_admin_order_status(): void
    {
        $buyer = User::factory()->create(['role' => 'pembeli']);
        $pesanan = $this->createPesanan();

        $this->actingAs($buyer)
            ->put(route('admin.pesanan.update', $pesanan), ['status' => 'selesai'])
            ->assertRedirect('/');

        $this->assertDatabaseHas('pesanans', [
            'id' => $pesanan->id,
            'status' => 'pending',
        ]);
    }

    private function createPesanan(array $attributes = []): Pesanan
    {
        $buyer = User::factory()->create(['role' => 'pembeli']);

        return Pesanan::create(array_merge([
            'user_id' => $buyer->id,
            'nama_penerima' => 'Pembeli',
            'no_telepon' => '08123456789',
            'alamat' => 'Alamat pembeli',
            'metode_pembayaran' => 'Transfer Bank',
            'total_harga' => 100000,
            'status' => 'pending',
        ], $attributes));
    }
}
