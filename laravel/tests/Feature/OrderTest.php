<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);

//        $this->browse(function ($browser) {
//            $browser->visit('/car')
//                ->type('email', $user->email)
//                ->type('password', 'secret')
//                ->press('Login')
//                ->assertPathIs('/home');
//        });
    }
}
