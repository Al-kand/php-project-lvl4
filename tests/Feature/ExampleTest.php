<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $response = $this->get('/');

        $response->assertOK();
    }

    public function testNotFound()
    {
        $response = $this->get('empty-page');

        $response->assertStatus(404);
    }
}
