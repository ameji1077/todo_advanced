@extends('layouts.default')

@section('container')
@section('title','Todo List')
@section('content')
<div class="user_form">
  <p class="user_name">「{{$user->name}}」でログイン中</p>
  <form action="/logout" method="POST">
    @csrf
    <button class="logout_button">ログアウト</button>
  </form>
</div>
<a href="/find" class="find_button">タスク検索</a>
<form action="/create" method="POST" class="todo_add_form">
  @csrf
  <input type="text" class="todo_content" name="content">
  <select name="tag_id" class="todo_tag">
    @foreach ($tags as $tag)
    <option value="{{$tag->id}}">{{$tag->name}}</option>
    @endforeach
  </select>
  <input type="hidden" name="user_id" value="{{$user->id}}">
  <button class="todo_add_button">追加</button>
</form>
@error('content')
<p class="content_error">{{$message}}</p>
@enderror
<table class="todos_table">
  <tr>
    <th width="25%">作成日</th>
    <th width="30%">タスク名</th>
    <th width="10%">タグ</th>
    <th width="15%">更新</th>
    <th width="15%">削除</th>
  </tr>
  @foreach ($todos as $todo)
  @if ($todo->user_id === $user->id)
  <tr>
    
    <form action="/update" method="POST" class="todo_update_form">
      @csrf
      <td>{{$todo->updated_at}}</td>
      <td>
        <input type="text" class="todo_update" name="content" value="{{$todo->content}}">
      </td>
      <td>
        <select name="tag_id" class="todo_tag">
          @foreach ($tags as $tag)
          <option value="{{$tag->id}}" @if ($tag->id === $todo->tag_id) selected @endif>{{$tag->name}}</option>
          @endforeach
        </select>
      </td>
      <td>
        <input type="hidden" name="id" value="{{$todo->id}}">
        <button class="todo_update_button">更新</button>
      </td>
    </form>
    <td>
      <form action="/delete" method="POST" class="todo_delete_form">
        @csrf
        <input type="hidden" name="id" value="{{$todo->id}}">
        <button class="todo_delete_button">削除</button>
      </form>
    </td>
  </tr>
  @endif
  @endforeach
</table>
@endsection
@endsection