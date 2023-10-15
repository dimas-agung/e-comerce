<?php

namespace Tests\Feature;

use App\Models\Expedition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpeditionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testIndexPage()
    {
        $user = User::find(1);
        $Expedition = Expedition::latest()->limit(1)->get();
        // masukkan session user untuk login
        // $this->actingAs($user)
        //     ->get('expedition')
        //     ->assertStatus(200)
        //     ->assertSeeText($Expedition[0]->name);
        $this->actingAs($user)
            ->get('expedition')
            ->assertStatus(200);
            // ->assertSeeText($Expedition[0]->name);
    }
    public function testCreatePage()
    {
        $user = User::find(1);
        // masukkan session user untuk login
        $this->actingAs($user)
            ->get(route('expedition.create'))
            ->assertStatus(200);
            // ->assertSeeText('Expedition Create');
    }
    // public function testEditPage()
    // {
    //     $user = User::find(1);
    //     $Expedition = Expedition::latest()->limit(1)->get();
    //     // masukkan session user untuk login
    //     $this->actingAs($user)
    //         ->get(route('expedition.edit', $Expedition[0]->id))
    //         ->assertStatus(200)
    //         ->assertSeeText('Expedition Edit');
    //     // ->assertSeeText($Expedition[0]->name);
    // }
    public function testStoreProduct()
    {
        $user = User::find(1);
        $this->actingAs($user)->post('/expedition', [
            "name" => "jnt"
        ])->assertRedirect("/expedition")
            ->assertSessionHas("success", "Data Expedition has been created!");
    }
    public function testUpdateProduct()
    {
        $user = User::find(1);
        $Expedition = Expedition::factory()->create();
        // masukkan session user untuk login
        $this->actingAs($user);
        $this->put(
            route('expedition.update', $Expedition->id),
            [
                "name" => "expedition_edit",
            ],
        )->assertRedirect("/expedition")
            ->assertSessionHas("success", "Data Expedition has been updated!");
    }
    public function testDeleteProduct()
    {
        $user = User::find(1);
        $Expedition = Expedition::factory()->create();
        $this->actingAs($user);
        $this->delete(route('expedition.destroy', $Expedition->id))
            ->assertRedirect("/expedition")
            ->assertSessionHas("success", "Data Expedition has been deleted!");
        // cek apakah data sudah kosong setelah dihapus
        $this->assertEmpty(Expedition::find($Expedition->id));
    }
}