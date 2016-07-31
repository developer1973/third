<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();

        return view('Admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::lists('name','id')->all();
        return view('Admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //return $request->all();
//        User::create($request->all());
//        return redirect('/admin/users');


//        if($request->file('photo_id')){
//
//            return "photo exist!";
//        }


           $input=$request->all();
        if($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);//
            $input['photo_id']=$photo->id;

        }
            $input['password']=bcrypt($request->password);
            User::create($input);
            return redirect('/admin/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        $roles=Role::lists('name','id')->all();
        return view('Admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
// return $request->all();

        $user=User::findOrFail($id);
        if(trim($request->password)==''){
            $input=$request->except('password');
        }
        else {
            $input = $request->all();
            $input['password']=bcrypt($request->password);
        }




            if($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);//
            $input['photo_id']=$photo->id;
        }


        $user->update($input);
        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return "User Is Deleted!!";
       $user= User::findOrFail($id);

       if($user->photo){
            $y=$user->photo->file;
           //to delete /images/ is 8 character
            $value = substr("$y",8);
            unlink(public_path().$user->photo->file);
            Photo::where('file',$value)->delete();
       }

        $user->delete();
        Session::flash('any_name','The user has been deleted');
       return redirect('/admin/users');
    }
}
