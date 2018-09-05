@extends('layouts.app')
@section('content')

    <h1>Create Post</h1>
         <form class="form-group" action="{{ url('/posts')}}" method="POST">
         {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" rows="5" placeholder="Enter Description"></textarea>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Create Post">
        </form> 
        
        
        
        
            
                    
@endsection