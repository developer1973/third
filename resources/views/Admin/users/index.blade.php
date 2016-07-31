@extends('layouts.admin')

@section('content')

    <h1>Users</h1>
@if(Session::has('any_name'))
<p class="bg-danger">{{Session('any_name')}}</p>

@endif

        <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
            @if($users)
                    <tbody>

@foreach($users as $user)

                    <tr>
                        <td>{{$user->id}}</td>
                      <td><img  height="50" src="{{$user->photo?$user->photo->file:'http://placehold.it/400x400'}}" alt="" ></td>
                        {{--<td><img height="50" src="{{$user->photo?$user->photo->file:'No user photo'}}" alt=""></td>--}}
                        {{--@if (Auth::user()->isAdmin())--}}
                          <td>  <a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
                          {{--<td>  <a href="{{url('/admin/users',$user->id).'/edit'}}">{{$user->name}}</a></td>--}}

                        {{--<td>  <a href="{{\Illuminate\Support\Facades\URL::to('admin/users/'.$user->id.'/edit')}}">{{$user->name}}</a></td>--}}
                           {{--@else--}}
                          {{--<td>{{$user->name}}</td>--}}

                        {{--@endif--}}
                        <td>{{$user->email}}</td>
                        <td>{{$user->role ?$user->role->name :'User has no role'}}</td>
                        <td>{{$user->is_active==1 ?'Active' : 'No Active'}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>

                    </tbody>
                @endforeach
                @endif
                </table>

@endsection