<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    public function test_fetch_all_todo_list()
    {
        // prepration /prepare
        // TodoList::create(['name' => 'test']);
        // Todolist::factory()->create();
        Todolist::factory()->count(2)->create(['name' => 'my list']);
        // action / perform
        $response = $this->getJson(route('todo-list.index'));
        // assertion /predict
        // $this->assertEquals(1,count($response->json()));
        $this->assertEquals('my list', $response->json()[0]['name']);
    }

    public function test_single_todo_list_fetch()
    {
        $todolist = TodoList::factory()->create();
        $response = $this->getJson(route('todo-list.show', $todolist->id))
                    ->assertOk()
                    ->json();
        $this->assertEquals($response['name'], $todolist->name);
    }
}
