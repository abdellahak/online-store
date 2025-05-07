<?php

namespace Tests\Feature;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_it_can_create_a_Supplier()
    {
        $supplier = Supplier::create([
        'raison_sociale' => 'Abdelilah Ouslimane',
        'adresse' => 'Bloc 07 Lamzar Ait Melloul',
        'tele' => '0611178305',
        'email' => 'abdelilah.ouslimane@gmail.com',
        'description' => 'Funny Raison Sociale'
        ]);
        $this->assertDatabaseHas('suppliers', [
            'raison_sociale' => 'Abdelilah Ouslimane'
            ]);
            
    }

    public function test_it_can_update_a_supplier()
    {
    $supplier = Supplier::factory()->create();
    $supplier->update(['raison_sociale' => 'Abdelilah Ouslimane']);
    $this->assertDatabaseHas('suppliers', ['raison_sociale' => 'Abdelilah Ouslimane']);
    }


    public function test_it_can_delete_a_supplier()
    {
    $supplier = Supplier::factory()->create();
    $supplier->delete();
    $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    }


}
