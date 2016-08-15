@extends('layouts.admin')


@section('content')
    <h1>Posts</h1>
    @if(Session::has('any_name'))
        <p class="bg-danger">{{Session('any_name')}}</p>

    @endif
   <table class="table">
               <thead>
               <tr>


                   <th>ID</th>
                   <th>Photo</th>
                   <th>Owner</th>
                   <th>Category</th>
                   <th>Title</th>
                   <th>Body</th>
                   <th>Post Link</th>
                   <th>Comment Link</th>
                   <th>Created</th>
                   <th>Updated</th>

               </tr>
               </thead>
               <tbody>
               @if($posts)
                   @foreach($posts as $post)
               <tr>

                   <td>{{$post->id}}</td>
                   <td><img height="50" src="{{$post->photo?$post->photo->file:'http://placehold.it/400x400'}}" alt=""></td>
                   {{--<td>{{$post->user?$post->user->name:'sorry no name'}}</td>--}}
                   <td>  <a href="{{route('admin.posts.edit',$post->id)}}">{{$post->user->name}}</a></td>
                   <td>{{$post->category?$post->category->name:'UnCategorized'}}</td>
                   <td>{{$post->title}}</td>
                   {{--<td>{{str_limit($post->body,30)}}</td>--}}
                   <td>{!!$post->body!!}</td>
                   <td><a href="{{route('home.post',$post->id)}}"> View Post</a></td>
                   {{--<td><a href="{{route('home.post',$post->slug)}}"> View Post</a></td>--}}
                   <td><a href="{{route('admin.comments.show',$post->id)}}"> View Comment</a></td>
                   <td>{{$post->created_at->diffForhumans()}}</td>
                   <td>{{$post->updated_at->diffForhumans()}}</td>
               </tr>
               @endforeach
             @endif
               </tbody>
           </table>
    <div class="row">
        <div class="col-sm-5 col-sm-offset"></div>
        {{$posts->render()}}
    </div>
    @stop