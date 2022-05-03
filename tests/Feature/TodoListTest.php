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
        // prepration /prepare
        // TodoList::create(['name' => 'test']);
        Todolist::factory()->create();
        // Todolist::factory()->count(2)->create(['name' => 'my list']);
        

        // action / perform
        $response = $this->getJson(route('todo-list.index'));   

        // assertion /predict
        $this->assertEquals(1,count($response->json()));
        // $this->assertEquals('my list',$response->json()[0]['name']);
    }
}
