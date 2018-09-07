@extends('layouts.app')
@section('content')
    <a class="btn btn-dark" href="/posts">Back</a>
    <br><br>
    <h1>{{ $post->title }}</h1>
        <img style="width:50%" src="/storage/images_cover/{{ $post->image_cover }}">
        <p style="float:right">{{$post->description}}</p>
        <hr><br>
        <small>Written on:{{$post->created_at->format('M j, Y')}} by {{$post->user->name}} </small>
        <hr> 
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
            <a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a>
            
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <input class="btn btn-secondary pull-right" type="submit" value="Delete"/>
            </form>
            @endif 
        @endif             
@endsection