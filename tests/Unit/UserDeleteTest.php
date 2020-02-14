<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserDeleteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $userId = 94;
        $response = $this->delete("/api/users/{$userId}");
        $response->assertStatus(204);
    }
}
