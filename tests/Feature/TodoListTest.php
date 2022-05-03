<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    public function test_todo_list_fetch()
    {
        TodoList::create(['name' => 'test']);
        $response = $this->getJson(route('todo-list.index'));
        $this->assertEquals(1,count($response->json()));
    }
}
