@extends('layouts.blog-home')


@section('content')

    <h1 class="page-header">
        My Blogger
        <small>Mohamedking</small>
    </h1>

    <!-- First Blog Post -->
    @if($posts)
        @foreach($posts as$post)
            <h2>
                <a href="{{route('home.post',$post->id)}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                by <a href="index.php">{{$post->user->name}}</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img-responsive" src="{{$post->photo->file}}" alt="">
            <hr>
            {!! str_limit($post->body,35 )!!}
            <a class="btn btn-primary" href="{{route('home.post',$post->id)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
        @endforeach
    @endif
    <!-- Pager -->
    <ul class="pager">
        <li class="previous">
            <a href="#">&larr; Older</a>
        </li>
        <li class="next">
            <a href="#">Newer &rarr;</a>
        </li>
    </ul>
@stop