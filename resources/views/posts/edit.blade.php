@extends('layouts.app')

@section('content')
<div class="contain-fluid m-4">
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}">
<input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="form-group">
      <label >Title</label>
      <input name="title" value="{{$post->title}}" type="text" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Description</label>
      <textarea name="description"  class="form-control">
      {{$post->description}}
      </textarea>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Users</label>
      <select name="user_id" class="form-control">
      <!-- <option value="{{$user->id}}"selected="selected">{{$user->name}}</option> -->
        @foreach($users as $user)  
           @if($user->id == $post->user_id)
           <option value="{{$post->user_id}}" selected>{{$user->name}}</option>
          @else
           <option value="{{$user->id}}">{{$user->name}}</option>
          @endif
        @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
  </form>
  </div>
@endsection