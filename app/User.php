<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo_id','role_id','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function posts1(){
        return $this->hasMany('App\Post');
    }

//    public function setPasswordAttribute ($password){
//    if(!empty($password)){
//        $this->attributes['password']=bcrypt($password);
//    }
//    }

    public function isAdmin(){

        if($this->role->name=="administrator" &&$this->is_active==1){
           return true;
        }
        return false;
    }


//    public function isAuthor(){
//
//        if($this->role->name=="author"){
//            return true;
//        }
//        return false;
//    }



//this test for author only and not follow edwin project:

    public function hasRole7($role1){

        if($this->role->name==$role1 && $this->is_active==1)
//        if($this->role->where('name',$role1)->first()&&$this->is_active==1)
        {
            return true;
        }

        return false;

    }

    public function hasAnyRole8($roles2)
    {
        if(is_array($roles2)) {
            foreach ($roles2 as $role3) {
                if ($this->hasRole7($role3)) {
                    return true;
                }
            }
        }
         else{
            if ($this->hasRole7($roles2)){
                return true;
            }
        }
        return false;
    }


}
