<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_it_displays_the_supplier_list()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        Supplier::factory()->count(3)->create();
        $response = $this->get(route('admin.supplier.index'));

        $response->assertStatus(200);
        $response->assertSee('Manage Suppliers');
    }
    public function test_it_can_create_a_supplier()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $response = $this->post(route('admin.supplier.store'), [
            'raison_sociale' => 'Adil Ouslimane',
            'adresse' => 'Bloc 07 Lamzar Ait Melloul',
            'tele' => '0611178323',
            'email' => 'abdelilah.ouslimane23@gmail.com',
            'description' => 'Funny Raison Sociale'
        ]);
        $this->assertDatabaseHas('suppliers', ['raison_sociale' => 'Adil Ouslimane']);
        $response->assertRedirect(route('admin.supplier.index'));
    }
   
    public function test_it_can_update_a_supplier()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $supplier = Supplier::factory()->create();
        $response = $this->put(route('admin.supplier.update', $supplier->id), [
        'raison_sociale' => 'Abdelilah Ouslimane',
        'adresse' => 'Bloc 07 Lamzar Ait Melloul',
        'tele' => '0611178323',
        'email' => 'abdelilah.ouslimane23@gmail.com',
        'description' => 'Funny Raison Sociale'
        ]);
        $this->assertDatabaseHas('suppliers', ['raison_sociale' => 'Abdelilah Ouslimane']);
        $response->assertRedirect(route('admin.supplier.index'));
    }
    public function test_it_can_delete_a_supplier()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $supplier = Supplier::factory()->create();
        $response = $this->delete(route('admin.supplier.destroy', $supplier->id));
        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
        $response->assertRedirect(route('admin.supplier.index'));
    }

}
