<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts=Post::all();
        $posts=Post::paginate(2);
        
        return view('Admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::lists('name','id')->all();
        
        return view('Admin.posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //return $request->all();

        $input=$request->all();
       
        $user=Auth::user();
        if($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);//
            $input['photo_id']=$photo->id;
        }
//        $input['password']=bcrypt($request->password);
          $user->posts1()->create($input);
          return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $categories=Category::lists('name','id')->all();
        return view('Admin.posts.edit',compact('post','categories'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input=$request->all();
       // $post=Post::findOrFail($id);
        if($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);//
            $input['photo_id']=$photo->id;
        }
        //$post->update($input);
        if (Auth::user()->posts1()->whereId($id)->first()) {
            Auth::user()->posts1()->whereId($id)->first()->update($input);
            return redirect('/admin/posts');
        }
        else
            return view('adminmessage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::findOrFail($id);

        if($post->photo){
            unlink(public_path().$post->photo->file);
            $y=$post->photo->file;
            //to delete /images/ is 8 character
            $value = substr("$y",8);
            Photo::where('file',$value)->delete();
        }

        $post->delete();
        Session::flash('any_name','The post has been deleted');
        return redirect('/admin/posts');
    }
    public function post($id){
        $post=Post::findOrFail($id);
        $comments=$post->comments()->whereIsActive(1)->get();
        return view('post',compact('post','comments'));
        //        return view('post',compact('post'));
    }

//    public function post($slug){
//        $post = Post::findBySlugOrFail($slug);
//        $comments=$post->comments()->whereIsActive(1)->get();
//        return view('post',compact('post','comments'));
//        //        return view('post',compact('post'));
//    }

    public function post_all(){
        $posts=Post::all();
        $categories=Category::all();
        return view('homepost',compact('posts','categories'));

    }

    public function post_author($id){
        $user=User::findOrFail($id);
        $posts=$user->posts1;
//        return view('Admin.comments.postsauthor',compact('posts'));
//        return"Fox is very bad";
        return view('Admin.comments.postsauthor',compact('posts'));
    }
    public function searchmulti(){
        $name=Input::get('title');
        $posts=Post::where('title','like',"%$name%")
                  ->orwhere('body','like',"%$name%")->get();
        return view('Admin.comments.postsauthor',compact('posts'));
    }
//    public function searchmulti($id){
//        $post=Post::findOrFail($id);
//        $name=$post->user->id;
//        $posts=Post::where('user_id','like',"%$name%");
////        $name=Input::get('title');
////        $user1=$name->user->id;
////        $user=User::findOrFail($id);
////        $posts=$user->posts1;
////        $name=$user->name;
//        return view('Admin.comments.postsauthor',compact('posts'));
////        Task::where('column_name', '=' ,'column_data')->firstOrFail();
//    }
    

}
