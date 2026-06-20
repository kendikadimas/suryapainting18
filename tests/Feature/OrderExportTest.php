<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Exports\OrdersExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class OrderExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_export_orders_to_excel(): void
    {
        Excel::fake();

        $admin = User::factory()->create([
            'email' => 'admin@suryapainting18indonesia.com',
        ]);

        Order::create([
            'nomor_surat' => '101/SP/2026',
            'customer_name' => 'Adimas',
            'customer_phone' => '081234567890',
            'product_name' => 'Cat Velg',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.orders.export'));

        $response->assertStatus(200);

        Excel::assertDownloaded('pesanan-suryapainting18-' . now()->format('Y-m-d') . '.xlsx', function(OrdersExport $export) {
            return true;
        });
    }

    public function test_unauthenticated_user_cannot_export_orders(): void
    {
        $response = $this->get(route('admin.orders.export'));

        $response->assertRedirect(route('login'));
    }
}
