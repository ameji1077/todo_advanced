<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'todos' => $todos,
            'user' => $user,
            'tags' => $tags
        ];
        return view('index', $param);
    }

    public function store(TodoRequest $request)
    {
        $todo = [
            'content' => $request->content,
            'tag_id' => $request->tag_id,
            'user_id' => $request->user_id
        ];
        unset($todo['_token']);
        Todo::create($todo);
        return redirect('/todo-list');
    }

    public function update(TodoRequest $request)
    {
        $todo = [
            'content' => $request->content,
            'tag_id' => $request->tag_id
        ];
        unset($todo['_token']);
        Todo::where('id', $request->id)->update($todo);
        return redirect('/todo-list');
    }

    public function destroy(Request $request)
    {
        $todo = Todo::find($request->id)->delete();
        return redirect('/todo-list')->with(compact('todo'));
    }

    public function find()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todos = [];
        $param = [
            'user' => $user,
            'tags' => $tags,
            'todos' => $todos
        ];
        return view('search',$param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todos = Todo::where('content','LIKE BINARY',"%{$request->keyword}%")->where('tag_id',$request->tag_id)->get();
        return view('search',['user' => $user, 'tags' => $tags, 'todos' => $todos]);
    }

    public function findUpdate(TodoRequest $request)
    {
        $todo = [
            'content' => $request->content,
            'tag_id' => $request->tag_id
        ];
        unset($todo['_token']);
        Todo::where('id', $request->id)->update($todo);
        return redirect('/find');
    }

    public function findDestroy(Request $request)
    {
        $todo = Todo::find($request->id)->delete();
        return redirect('/find')->with(compact('todo'));
    }
}
