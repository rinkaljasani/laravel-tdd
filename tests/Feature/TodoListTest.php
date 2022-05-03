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

    public function test_create_new_todolist()
    {
        $data = [
            'name' => 'my first list'
        ];
        $response = $this->postJson(route('todo-list.store', $data))->assertCreated()->json();
        $this->assertEquals('my first list', $response['name']);
        $this->assertDatabaseHas('todo_lists', $data);
    }
    public function test_while_createing_todo_list_name_feild_required_validation()
    {
        $this->withExceptionHandling();
        $response = $this->postJson(route('todo-list.store'))
            ->assertJsonValidationErrors(['name'])
            ->assertUnprocessable()->json();
    }
    public function test_delete_todo_list(){
        $this->deleteJson(route('todo-list.destroy',$this->todolist->id))
            ->assertNoContent();
            $this->assertDatabaseMissing('todo_lists',['name' => $this->todolist->name]);
    }
    public function test_update_todo_list_when_data_not_given_validation(){
        $this->withExceptionHandling();
        $this->patchJson(route('todo-list.update',$this->todolist->id))
            ->assertJsonValidationErrors(['name'])
            ->assertUnprocessable()->json();
    }
    public function test_update_todo_list(){
        $this->withExceptionHandling();
        $data = [ 'name' => 'update list'];
        $this->patchJson(route('todo-list.update',$this->todolist->id),$data)
            ->assertOk();
        $this->assertDatabaseHas('todo_lists',['id'=> $this->todolist->id,'name' => $data['name']]);
    }
}
