@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center mt-4">
        <h1 class="display-4">{{$title}}</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-success btn-lg" href="#" role="button">Login</a>
        <a class="btn btn-primary btn-lg" href="#" role="button">Register</a>
    </div>
   
@endsection
