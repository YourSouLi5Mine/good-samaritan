<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @test
     */
    public function testUserIndex()
    {
      $user = factory('App\User')->create();

      $this->get('/api/v1/users');

      $username = json_decode($this->response->getContent(), true)[0]["username"];

      $this->assertEquals(
        $user["username"], $username);
    }
}
