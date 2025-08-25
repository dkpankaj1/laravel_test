<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::factory()->create(['name' => 'Work']);
    }

    private function createTodo(array $attributes = []): Todo
    {
        return Todo::factory()->create(array_merge([
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
            'category_id' => $this->category->id,
        ], $attributes));
    }

    public function test_todos_page_loads()
    {
        $todo = $this->createTodo();

        $response = $this->get('/todos');

        $response->assertStatus(200);
        $response->assertSee($todo->title);
    }

    public function test_create_todo()
    {
        $todoData = [
            'title' => 'New Todo',
            'description' => 'New Description',
            'category_id' => $this->category->id,
        ];

        $response = $this->post('/todos', $todoData);

        $response->assertRedirect('/todos');
        $this->assertDatabaseHas('todos', ['title' => 'New Todo']);
    }

    public function test_show_todo()
    {
        $todo = $this->createTodo([
            'title' => 'Show Me',
            'description' => 'Show Description',
        ]);

        $response = $this->get("/todos/{$todo->id}");

        $response->assertStatus(200);
        $response->assertSee('Show Me');
        $response->assertSee('Show Description');
    }

    public function test_update_todo()
    {
        $todo = $this->createTodo();
        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'completed' => true,
            'category_id' => $this->category->id,
        ];

        $response = $this->put("/todos/{$todo->id}", $updateData);

        $response->assertRedirect('/todos');
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Updated Title',
            'completed' => true,
        ]);
    }

    public function test_delete_todo()
    {
        $todo = $this->createTodo(['title' => 'Delete Me']);

        $response = $this->delete("/todos/{$todo->id}");

        $response->assertRedirect('/todos');
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
