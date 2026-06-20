<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TimelineImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_admin_can_upload_jpg_image_converted_to_webp(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@suryapainting18indonesia.com',
        ]);

        $order = Order::create([
            'nomor_surat' => '123/TEST',
            'customer_name' => 'John Doe',
            'customer_phone' => '081234567890',
            'product_name' => 'Cat Body',
        ]);

        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($admin)
            ->from(route('admin.orders.show', $order->id))
            ->post(route('admin.orders.addTimeline', $order->id), [
                'title' => 'Update Progres',
                'description' => 'Sedang dalam pengerjaan',
                'status' => 'Processing',
                'image' => $file,
            ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        // Check that a timeline record was created
        $this->assertDatabaseHas('order_timeline', [
            'order_id' => $order->id,
            'title' => 'Update Progres',
        ]);

        // Retrieve the stored timeline and check that the image was converted to webp
        $timeline = $order->timeline()->latest()->first();
        $this->assertNotNull($timeline->image_path);
        $this->assertStringEndsWith('.webp', $timeline->image_path);

        Storage::disk('public')->assertExists($timeline->image_path);
    }

    public function test_admin_can_upload_heic_image_and_stores_correctly(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@suryapainting18indonesia.com',
        ]);

        $order = Order::create([
            'nomor_surat' => '124/TEST',
            'customer_name' => 'Jane Doe',
            'customer_phone' => '081234567890',
            'product_name' => 'Cat Body',
        ]);

        // Fake a HEIC file
        $file = UploadedFile::fake()->create('photo.heic', 100, 'image/heic');

        $response = $this->actingAs($admin)
            ->from(route('admin.orders.show', $order->id))
            ->post(route('admin.orders.addTimeline', $order->id), [
                'title' => 'Foto iPhone',
                'description' => 'Unggah foto dari iPhone',
                'status' => 'Processing',
                'image' => $file,
            ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $timeline = $order->timeline()->latest()->first();
        $this->assertNotNull($timeline->image_path);

        // Since GD/Imagick standard libraries typically fail to read HEIC in local tests,
        // it should hit our fallback and store it with .heic extension.
        // Let's assert it exists on public disk
        Storage::disk('public')->assertExists($timeline->image_path);
    }

    public function test_admin_cannot_upload_invalid_file_format(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@suryapainting18indonesia.com',
        ]);

        $order = Order::create([
            'nomor_surat' => '125/TEST',
            'customer_name' => 'Jack Doe',
            'customer_phone' => '081234567890',
            'product_name' => 'Cat Body',
        ]);

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->actingAs($admin)
            ->from(route('admin.orders.show', $order->id))
            ->post(route('admin.orders.addTimeline', $order->id), [
                'title' => 'Dokumen PDF',
                'description' => 'Unggah dokumen PDF',
                'status' => 'Processing',
                'image' => $file,
            ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['image']);
    }
}
