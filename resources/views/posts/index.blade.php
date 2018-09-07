@extends('layouts.app')
@section('content')
        <h1>Posts</h1>
        <br>
        @if(count($posts)> 0)
            @foreach($posts as $post)
               <div class="card mb-3">
                    <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <img class="img-thumbnail" src="/storage/images_cover/{{ $post->image_cover }}">
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <h3><a href="/posts/{{$post->id}}">{{ $post->title }}</a></h3>
                                <p>{{str_limit($post->description)}}</p>
                                <hr>
                                <small>Written on: {{$post->created_at->format('M j, Y')}} by {{$post->user->name}} </small> 
                            </div>
                    </div>  
               </div>
               
            @endforeach
            {{$posts->links()}}
        @else
            <p>{{ 'No Posts Available!'}}</p>
        @endif
        
@endsection
    
