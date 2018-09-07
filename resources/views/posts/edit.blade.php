@extends('layouts.app')
@section('content')

    <h1>Edit Post</h1>
         <form class="form-group" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
         {{csrf_field()}}
         {{method_field('PUT')}}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" >{{$post->description}}</textarea>
            </div>
            <div class="form-group">
                <input type="file" name="image_cover">
            </div>
            
            <input type="submit" class="btn btn-primary" value="Edit Post">
        </form>     
                    
@endsection