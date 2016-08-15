@extends('layouts.blog-home')


@section('content')

    <h1 class="page-header">
        My Blogger
        <small>Mohamed</small>
    </h1>

    <!-- First Blog Post -->
    @if($posts)
        @foreach($posts as$post)
            <h2>
                <a href="{{route('home.post',$post->id)}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                {{--by <a href="index.php">{{$post->user->name}}</a>--}}
                by <a href="{{route('home.post2',$post->user->id)}}">{{$post->user->name}}</a>

            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img-responsive" src="{{$post->photo->file}}" alt="">
            <p>No. approved comments={{$post->comments()->whereIsActive(1)->count()}}</p>
            {{--<p>No. approved replies={{$post->comments()->replies()->whereIsActive(1)->count()}}</p>--}}
            <p>No. all posts={{$post->count()}}</p>
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


@section('mohamed')
    <h4>Blog Categories</h4>
    @if($categories)
        @foreach($categories as$category)
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href="{{route('home.post7',$category->id)}}">{{$category->name}}</a>
                        </li>

                    </ul>
                </div>
            </div>
        @endforeach
    @endif
@stop

@section('ahmed')
    <h4>Blog Search</h4>

    {!! Form::open(['method'=>'GET','action'=>'AdminPostsController@searchmulti']) !!}

             <div class="form-group">
                 {{--{!! Form::label('name','Title:') !!}--}}
                 {!! Form::text('title',null,['class'=>'form-control']) !!}
             </div>

              <div class="form-group">
                {!! Form::submit('search Post',['class'=>'btn btn-primary']) !!}
              </div>
            {!! Form::close() !!}

    @stop







{{--<div class="input-group">--}}
    {{--<input type="text" class="form-control">--}}
                        {{--<span class="input-group-btn">--}}
                            {{--<button class="btn btn-default" type="button">--}}
                                {{--<span class="glyphicon glyphicon-search"></span>--}}
                        {{--</button>--}}
                        {{--</span>--}}
{{--</div>--}}

