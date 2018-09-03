@extends('layouts.app')
@section('content')
    <a class="btn btn-dark" href="/posts">Back</a>
    <br><br>
    <h1>{{ $post->title }}</h1>
        <p>{{$post->description}}</p>
        <hr><br>
        <small>Written on:{{$post->created_at}} </small>
        <hr>
        <a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a>

        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input class="btn btn-secondary pull-right" type="submit" value="Delete"/>
        </form> 
        

            
                    
@endsection