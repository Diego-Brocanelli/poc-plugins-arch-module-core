<?php

declare(strict_types=1);

namespace Tests\Module\Feature;

use Tests\Module\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function basicOne()
    {
        $response = $this->get('/core/test');
        $response->assertStatus(200);
    }

    /** @test */
    public function basicTwo()
    {
        $response = $this->get('/core/test/two');
        $response->assertStatus(200);
    }

    /** @test */
    public function apiCommon()
    {
        $response = $this->withSession(['foo' => 'bar'])
                    ->get('/api/core/call-test');
        $response->assertStatus(200);
    }

    /** @test */
    // public function apiAuth()
    // {
    //     $user = factory(App\User::class)->create();

    //     $response = $this->actingAs($user)
    //                 ->withSession(['foo' => 'bar'])
    //                 ->get('/api/user-test');
                         
    //      $response->assertStatus(200);
    // }
}
