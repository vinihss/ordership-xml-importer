<?php

namespace Tests\Feature;

use App\Models\People;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleTest extends TestCase

{
    use RefreshDatabase;

    public function testPeopleAreListedCorrectly()
    {

        $user = User::create([
                'name' => 'test',
                'email' => 'teste1@test.com',
                'password' => '123456',
            ]
        );

        $token = $user->createToken('token')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        People::create([
            'person_id' => 1,
            'name' => 'test1'
        ]);

        People::create([
            'person_id' => 2,
            'name' => 'test2'
        ]);

        $this->json('GET', '/api/person', [], $headers)
            ->assertStatus(200)
            ->assertJson(['data' => [
                ['personid' => 1, 'personname' => 'test1', 'phones' => []],
                ['personid' => 2, 'personname' => 'test2', 'phones' => []],
            ]])
            ->assertJsonStructure([
                'data' => ['*' => ['personid', 'personname', 'phones']]]);
    }
}

