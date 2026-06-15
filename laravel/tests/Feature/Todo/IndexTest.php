<?php

namespace Tests\Feature\Todo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Todo;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * status 200を返すこと
     */
    public function test_status200を返すこと(): void
    {
        $response = $this->get('/todos');
        $response->assertStatus(200);
    }

    /**
     * Todoをviewに渡すこと
     */
    public function test_todoをviewに渡すこと(): void
    {
        $todo = Todo::factory()->create();
        $response = $this->get('/todos');
        $response->assertViewHas('todos', function ($todos) use ($todo) {
            return $todos->contains($todo);
        });
    }
}
