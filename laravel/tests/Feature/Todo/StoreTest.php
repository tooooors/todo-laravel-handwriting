<?php

namespace Tests\Feature\Todo;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Enums\TodoStatus;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }
    
    public function test_status302を返すこと(): void
    {
        $todo = Todo::factory()->make();
        $response = $this->post('/todos', $todo->toArray());
        $response->assertStatus(302);
    }

    public function test_todoを登録すること(): void
    {
        $todo = Todo::factory()->make();
        $response = $this->post('/todos', $todo->toArray());
        $this->assertDatabaseHas('todos', [
            'title' => $todo->title,
            'status' => TodoStatus::Pending,
        ]);
    }
}
