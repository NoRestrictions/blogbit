@extends('layouts.app')
@section('content')
        <h1>Posts</h1>
        <br>
        @if(count($posts)> 0)
            @foreach($posts as $post)
               <div class="card mb-3">
                   <h3><a href="/posts/{{$post->id}}">{{ $post->title }}</a></h3>
                  <p>{{$post->description}}</p>
                   <hr>
                   <small>Written on:{{$post->created_at}} </small>  
               </div>
               
            @endforeach
            {{$posts->links()}}
        @else
            <p>{{ 'No Posts Available!'}}</p>
        @endif
        
@endsection
    
