<?php

namespace Tests\Feature;

use App\Models\People;
use App\Models\ShipOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipOrderTest extends TestCase
{
    use RefreshDatabase;

    public function testShipOrderAreListedCorrectly()
    {


        People::create([
            'person_id' => 1,
            'name' => 'test1'
        ]);

        $user = User::create([
                'name' => 'test',
                'email' => 'teste1@test.com',
                'password' => '123456',
            ]
        );

        $token = $user->createToken('token')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];
        ShipOrder::create([
            'order_id' => 1,
            'person_id' => 1,
            'name' => 'test1',
            'address' => 'test address',
            'city' => 'test city',
            'country' => 'test country',
        ]);

        $this->json('GET', '/api/ship-order', [], $headers)
            ->assertStatus(200)
            ->assertJson(['data' => [
                ['orderid' => 1, 'items' => [], 'shipto' => ['name' => 'test1', 'address' => 'test address', 'city' => 'test city', 'country' => 'test country']]
            ]])
            ->assertJsonStructure([
                'data' => ['*' => ['orderid', 'items', 'shipto' => ['name', 'address', 'city', 'country']]]]);
    }
}
