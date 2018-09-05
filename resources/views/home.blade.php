@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--  You are logged in!  --}}
                    <a class="btn btn-primary mb-2" href="/posts/create">Create Post</a>
                    
                    <h3>Your Posts</h3>

                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                    <td>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <input class="btn btn-secondary pull-right" type="submit" value="Delete"/>
                                        </form>  
                                    </td>
                                </tr>
                            @endforeach
                    
                    @else
                        <p>You have no posts yet!</p>
                        
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
