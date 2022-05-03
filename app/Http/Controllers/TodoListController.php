<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index(){
        $lists = TodoList::all();
        return response($lists);
    }
    public function show(TodoList $todolist){
        return response($todolist);
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required']
        ]);
        $list = TodoList::create($request->all());
        return $list;
        // return response($list,Response::HTTP_CREATED);
    }
    public function destroy(TodoList $todolist){
        $todolist->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }
    public function update(Request $request,TodoList $todolist){
        $request->validate([
            'name' => ['required']
        ]);
        $todolist->update($request->all());
        return $todolist;
    }
}
