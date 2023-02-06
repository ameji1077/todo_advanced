@extends('layouts.default')

@section('container')
@section('title','タスク検索')
@section('content')
<div class="user_form">
  <p class="user_name">「{{$user->name}}」でログイン中</p>
  <form action="/logout" method="POST">
    @csrf
    <button class="logout_button">ログアウト</button>
  </form>
</div>
<form action="/find" method="POST" class="todo_search_form">
  @csrf
  <input type="text" class="todo_content" name="keyword">
  <select name="tag_id" class="todo_tag">
    <option selected value="@foreach ($tags as $tag) {{$tag->id}} @endforeach"></option>
    @foreach ($tags as $tag)
    <option value="{{$tag->id}}">{{$tag->name}}</option>
    @endforeach
  </select>
  <button class="todo_search_button">検索</button>
</form>
<table class="todos_table">
  <tr>
    <th width="25%">作成日</th>
    <th width="30%">タスク名</th>
    <th width="10%">タグ</th>
    <th width="15%">更新</th>
    <th width="15%">削除</th>
  </tr>
  @foreach ($todos as $todo)
  @if ($user->id === $todo->user_id)
  <tr>
    <td>{{$todo->updated_at}}</td>
    <form action="/find/update" method="POST" class="todo_update_form">
      @csrf
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
        @csrf
        <input type="hidden" name="id" value="{{$todo->id}}">
        <button class="todo_update_button">更新</button>
      </td>
    </form>
    <td>
      <form action="/find/delete" method="POST" class="todo_delete_form">
        @csrf
        <input type="hidden" name="id" value="{{$todo->id}}">
        <button class="todo_delete_button">削除</button>
      </form>
    </td>
  </tr>
  @endif
  @endforeach
</table>
<a href="/todo-list" class="back_button">戻る</a>
@endsection
@endsection