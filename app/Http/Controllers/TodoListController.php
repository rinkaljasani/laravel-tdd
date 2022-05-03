<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index(){
        $lists = TodoList::all();
        dd($lists);
        return response($lists);
    }
}
