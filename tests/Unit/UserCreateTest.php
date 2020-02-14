<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserCreateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
       $response = $this->json('POST','/api/users', [
       		'name' => 'user',
       		'last_name' => 'test',
       		'age' => '24',
       		'phone' => '1234567890',
       		'photo' => 'no-photo.jpg',
       		'admission_date' => '2020-02-01 02:02:05'
       ]);
        $response->assertStatus(201)
		  ->assertJsonStructure([
	  			'id',
	  			'name',
	  			'last_name',
	  			'age',
	  			'phone',
	  			'photo',
	  			'admission_date'
		  ]);
    }
}
