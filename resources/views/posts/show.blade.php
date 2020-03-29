
@extends('layouts.app')

@section('content')
<div class ="container m-5">
<div class="row">
 <div class="col-12">
    <div class="card m-5" >
    <div class="card-header">
    <div><h3>Post</h3></div>
    </div>
        <div class="card-body">
        Title:<h5 class="card-title">{{$post->title}}</h5>
         description: <p class="card-text">{{$post->description}}</p>
         Date: <p class ="card-text">{{$post->created_at->format('l jS \of F Y h:i:s A')}}</p>
        </div>
      </div>
      </div>
      <!-- owner -->
      <div class="col-12">
      <div class="card m-5" >
    <div class="card-header">
    <div><h3>Owner</h3></div>
    </div>
        <div class="card-body">
        Name:<h5 class="card-title">{{$owner->name}}</h5>
          E-mail:<p class="card-text">{{$owner->email}}</p>
          <!-- <p class ="card-text">{{$post->created_at->format('l jS \of F Y h:i:s A')}}</p> -->
        </div>
      </div>
      </div>
      </div>
      </div>
@endsection


