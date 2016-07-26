<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //unique:table name,column name in DB.
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required',
//            'email'=>'required|unique:users,email',
            'role_id'=>'required',
            'is_active'=>'required',
            'password'=>'required'
//            'password'=>'required|min:6'
        ];
    }

//    public function messages()
//    {
//        return [
//            'email.required' => 'Please enter your email!',
//            'email.unique' => 'Please enter another email ,Boy!!!',
//            'password.required'  => 'please enter your password!',
//            'password.min'  => 'your password is very short!!',
//        ];
//    }

}
