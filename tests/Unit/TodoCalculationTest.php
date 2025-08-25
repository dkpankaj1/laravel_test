<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Todo;
use PHPUnit\Framework\TestCase;

class TodoCalculationTest extends TestCase
{
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category(['id' => 1, 'name' => 'Work']);
    }

    public function test_mark_as_completed()
    {
        $todo = new Todo([
            'id' => 1,
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
            'category_id' => $this->category->id,
        ]);

        $todo->markAsCompleted();

        $this->assertTrue($todo->completed);
    }

    public function test_mark_as_incomplete()
    {
        $todo = new Todo([
            'id' => 1,
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => true,
            'category_id' => $this->category->id,
        ]);

        $todo->markAsIncomplete();

        $this->assertFalse($todo->completed);
    }
}
