<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200)
		  ->assertJsonStructure([
		  		[
		  			'id',
		  			'name',
		  			'last_name',
		  			'age',
		  			'phone',
		  			'photo',
		  			'admission_date'
		  		]
		  ]);
    }
}
