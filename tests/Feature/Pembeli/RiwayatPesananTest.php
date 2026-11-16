<?php

namespace Tests\Feature\Pembeli;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RiwayatPesananTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_open_order_history_or_details(): void
    {
        $pesanan = $this->createPesanan(User::factory()->create(['role' => 'pembeli']));

        $this->get(route('pesanan.riwayat'))->assertRedirect(route('login'));
        $this->get(route('pesanan.detail', $pesanan))->assertRedirect(route('login'));
    }

    public function test_buyer_can_view_only_their_own_order_history(): void
    {
        $buyer = User::factory()->create(['role' => 'pembeli']);
        $ownOrder = $this->createPesanan($buyer, ['status' => 'diproses']);
        $otherOrder = $this->createPesanan(User::factory()->create(['role' => 'pembeli']), [
            'nama_penerima' => 'Pesanan Rahasia',
        ]);

        $this->actingAs($buyer)
            ->get(route('pesanan.riwayat'))
            ->assertOk()
            ->assertSee('Pesanan #'.$ownOrder->id)
            ->assertSee('Diproses')
            ->assertDontSee('Pesanan #'.$otherOrder->id)
            ->assertDontSee('Pesanan Rahasia');
    }

    public function test_buyer_can_view_order_details_with_shipping_and_item_totals(): void
    {
        $buyer = User::factory()->create(['role' => 'pembeli']);
        $pesanan = $this->createPesanan($buyer, ['status' => 'dikirim']);
        $produk = Produk::create([
            'nama' => 'Kabel USB',
            'harga' => 50000,
        ]);
        DetailPesanan::create([
            'pesanan_id' => $pesanan->id,
            'produk_id' => $produk->id,
            'nama_produk' => 'Kabel USB',
            'harga' => 50000,
            'quantity' => 2,
        ]);

        $this->actingAs($buyer)
            ->get(route('pesanan.detail', $pesanan))
            ->assertOk()
            ->assertSee('Dikirim')
            ->assertSee('Alamat pengiriman uji')
            ->assertSee('Transfer Bank')
            ->assertSee('Kabel USB')
            ->assertSee('Subtotal Kabel USB: Rp 100.000')
            ->assertSee('Total Pembayaran')
            ->assertSee('Rp 100.000')
            ->assertSee('Status Pembayaran');
    }

    public function test_buyers_receive_404_for_each_others_order_details(): void
    {
        $buyerA = User::factory()->create(['role' => 'pembeli']);
        $buyerB = User::factory()->create(['role' => 'pembeli']);
        $orderA = $this->createPesanan($buyerA);
        $orderB = $this->createPesanan($buyerB);

        $this->actingAs($buyerA)
            ->get(route('pesanan.detail', $orderB))
            ->assertNotFound();

        $this->actingAs($buyerB)
            ->get(route('pesanan.detail', $orderA))
            ->assertNotFound();
    }

    public function test_admin_does_not_get_buyer_order_history_access_or_navigation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('pesanan.riwayat'))
            ->assertForbidden();

        $this->get('/')
            ->assertOk()
            ->assertDontSee('href="'.route('pesanan.riwayat').'"');
    }

    public function test_only_logged_in_buyers_see_order_history_navigation(): void
    {
        $buyer = User::factory()->create(['role' => 'pembeli']);

        $this->get('/')
            ->assertDontSee('href="'.route('pesanan.riwayat').'"');

        $response = $this->actingAs($buyer)
            ->get('/');

        $response
            ->assertOk()
            ->assertSee(route('pesanan.riwayat'));
        $this->assertSame(2, substr_count($response->getContent(), route('pesanan.riwayat')));
    }

    private function createPesanan(User $buyer, array $attributes = []): Pesanan
    {
        return Pesanan::create(array_merge([
            'user_id' => $buyer->id,
            'nama_penerima' => 'Pembeli Uji',
            'no_telepon' => '08123456789',
            'alamat' => 'Alamat pengiriman uji',
            'metode_pembayaran' => 'Transfer Bank',
            'total_harga' => 100000,
            'status' => 'pending',
        ], $attributes));
    }
}
