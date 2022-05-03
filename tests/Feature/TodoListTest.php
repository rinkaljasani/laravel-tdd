<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    private $todolist;
    public function setUp(): void
    {
        parent::setUp();
        $this->todolist = TodoList::factory()->create(['name' => 'my list']);
    }
    public function test_fetch_all_todo_list()
    {
        // prepration /prepare
        Todolist::factory()->count(2)->create(['name' => 'my list']);
        // action / perform
        $response = $this->getJson(route('todo-list.index'));
        // assertion /predict
        $this->assertEquals('my list', $response->json()[0]['name']);
    }

    public function test_single_todo_list_fetch()
    {
        $response = $this->getJson(route('todo-list.show', $this->todolist->id))
                    ->assertOk()
                    ->json();
        $this->assertEquals($response['name'], $this->todolist->name);
    }

    public function test_create_new_todolist(){
        $data = [
            'name' => 'my first list'
        ];
        $response = $this->postJson(route('todo-list.store',$data))->assertCreated()->json();
        $this->assertEquals('my first list',$response['name']);
        $this->assertDatabaseHas('todo_lists',$data);
    }
}
