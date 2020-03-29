
@extends('layouts.app')

@section('content')
      <div class="container m-5">
      <a href="{{route('posts.create')}}" class="btn btn-success mb-5">Create Post</a>
      <!-- <input type="hidden" name="_method" value="DELETE"> -->
      
          <table class="table table-dark">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Slug<th>
                  <th scope="col">Description</th>
                  <th scope="col">User Name</th>
                  <th scope="col">Created At</th>
                  <th colspan=3 style="text-align:center;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                <th scope="row">{{ $post->id }}</th>
                  <td>{{ $post->title }}</td>
                  <td>{{$post->slug}}</td>
                  <td>{{ $post->description }}</td>

                  <td>{{ $post->user? $post->user->name : 'not exist'}}</td>
                  <td>{{ $post->created_at->format('m-d-Y') }}</td>

                <td ><a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-primary btn-sm">View Details</a></td>
                <td style="text-align:center"><a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-warning btn-sm">Edit</a></td>
                <td style="text-align:center"><a onclick="return confirm('Are you sure?')" href="{{route('posts.destroy',['post' => $post->id])}}" class="btn btn-danger btn-sm">Delete</a></td>
                
                </tr>
              @endforeach
              </tbody>
            </table>
            </form>
            {{ $posts->links() }}
      </div>

@endsection

