<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressControllerTest extends TestCase
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
        $Address = Address::latest()->limit(1)->get();
        // masukkan session user untuk login
        // $this->actingAs($user)
        //     ->get('address')
        //     ->assertStatus(200)
        //     ->assertSeeText($Address[0]->name);
        $this->actingAs($user)
            ->get('address')
            ->assertStatus(200);
            // ->assertSeeText($Address[0]->name);
    }
    public function testCreatePage()
    {
        $user = User::find(1);
        // masukkan session user untuk login
        $this->actingAs($user)
            ->get(route('address.create'))
            ->assertStatus(200);
            // ->assertSeeText('Address Create');
    }
    // public function testEditPage()
    // {
    //     $user = User::find(1);
    //     $Address = Address::latest()->limit(1)->get();
    //     // masukkan session user untuk login
    //     $this->actingAs($user)
    //         ->get(route('address.edit', $Address[0]->id))
    //         ->assertStatus(200)
    //         ->assertSeeText('Address Edit');
    //     // ->assertSeeText($Address[0]->name);
    // }
    public function testStoreAddress()
    {
        $user = User::find(1);
        $this->actingAs($user)->post('/address', [
            'users_id' => 1,
            'provinces_id' => 1,
            'cities_id' => 1,
            'districts_id' => 1,
            'villages_id' => 1,
            'fullname' => 'DIMAS',
            'address' => 'Jln Kenangan no 12',
            'postal_code' => 2131223524523,
            'phone_number' => 1234,
        ])->assertRedirect("/address")
            ->assertSessionHas("success", "Data Address has been created!");
    }
    public function testUpdateAddress()
    {
        $user = User::find(1);
        $Address = Address::factory()->create();
        // masukkan session user untuk login
        $this->actingAs($user);
        $this->put(
            route('address.update', $Address->id),
            [
                'users_id' => 1,
            'provinces_id' => 1,
            'cities_id' => 1,
            'districts_id' => 1,
            'villages_id' => 1,
            'fullname' => 'DIMAS_EDIT',
            'address' => 'Jln Kenangan no 12',
            'postal_code' => 1234,
            'phone_number' => 1234,
            ],
        )->assertRedirect("/address")
            ->assertSessionHas("success", "Data Address has been updated!");
    }
    public function testDeleteAddress()
    {
        $user = User::find(1);
        $Address = Address::factory()->create();
        $this->actingAs($user);
        $this->delete(route('address.destroy', $Address->id))
            ->assertRedirect("/address")
            ->assertSessionHas("success", "Data Address has been deleted!");
        // cek apakah data sudah kosong setelah dihapus
        $this->assertEmpty(Address::find($Address->id));
    }
    public function testActivatedAddress()
    {
        $user = User::find(1);
        $Address = Address::factory()->create();
        $this->actingAs($user);
        $this->post(route('address.activated', $Address->id))
            ->assertRedirect("/address")
            ->assertSessionHas("success", "Data Address has been Activated!");
        // cek apakah status active
        $this->assertEquals(Address::find($Address->id)->is_active,1);
    }
    public function testNonactivAddress()
    {
        $user = User::find(1);
        $Address = Address::factory()->create();
        $this->actingAs($user);
        $this->post(route('address.nonactive', $Address->id))
            ->assertRedirect("/address")
            ->assertSessionHas("success", "Data Address has been nonactive!");
        // cek apakah status active
        $this->assertEquals(Address::find($Address->id)->is_active,0);
    }
}