<?php

namespace Tests\Feature\Todo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \Illuminate\Foundation\Http\Middleware\PreventRequestForgery;

class StoreValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void
    {
        parent::setUp();
        $this->withoutMiddleware(PreventRequestForgery::class);
    }
    
    public function test_titleがない場合エラーとなること(): void
    {
        $response = $this->post('/todos', []);
        $response->assertInvalid(['title']);
    }

    public function test_titleが空文字の場合エラーとなること(): void
    {
        $response = $this->post('/todos', ['title' => '']);
        $response->assertInvalid(['title']);
    }

    public function test_titleが256文字の場合エラーとなること(): void
    {
        $response = $this->post('/todos', ['title' => str_repeat('a', 256)]);
        $response->assertInvalid(['title']);
    }

    public function test_titleが255文字の場合エラーがないこと(): void
    {
        $response = $this->post('/todos', ['title' => str_repeat('a', 255)]);
        $response->assertValid(['title']);
    }
}
