<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_superadmin_by_email_can_access_admin_management(): void
    {
        $superadmin = User::factory()->create([
            'email' => 'admin@suryapainting18indonesia.com',
        ]);

        $response = $this->actingAs($superadmin)->get(route('admin.add-admin'));
        $response->assertStatus(200);

        $response = $this->actingAs($superadmin)->get(route('admin.list-admin'));
        $response->assertStatus(200);
    }

    public function test_first_registered_admin_can_access_admin_management(): void
    {
        $firstAdmin = User::factory()->create([
            'email' => 'any_other_email@example.com',
        ]);

        $response = $this->actingAs($firstAdmin)->get(route('admin.add-admin'));
        $response->assertStatus(200);

        $response = $this->actingAs($firstAdmin)->get(route('admin.list-admin'));
        $response->assertStatus(200);
    }

    public function test_subsequent_created_admin_cannot_access_admin_management(): void
    {
        $firstAdmin = User::factory()->create([
            'email' => 'first@example.com',
        ]);

        $subsequentAdmin = User::factory()->create([
            'email' => 'subsequent@example.com',
        ]);

        $response = $this->actingAs($subsequentAdmin)->get(route('admin.add-admin'));
        $response->assertStatus(403);

        $response = $this->actingAs($subsequentAdmin)->post(route('admin.add-admin.store'), [
            'name' => 'New Admin',
            'email' => 'newadmin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(403);

        $response = $this->actingAs($subsequentAdmin)->get(route('admin.list-admin'));
        $response->assertStatus(403);

        $response = $this->actingAs($subsequentAdmin)->delete(route('admin.delete-admin', $firstAdmin->id));
        $response->assertStatus(403);
    }
}
