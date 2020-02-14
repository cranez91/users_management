<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserUpdateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
    	$userId = 100;
        $response = $this->json('PATCH',"/api/users/{$userId}", [
       		'name' => 'userTest',
       		'last_name' => 'testUser',
       		'age' => '28',
       		'phone' => '1234525890',
       		'photo' => 'no-photo.jpg',
       		'admission_date' => '2020-02-01 02:02:05'
       ]);
        $response->assertStatus(200);
    }
}
