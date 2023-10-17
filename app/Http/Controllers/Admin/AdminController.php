<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\models\Admin;
use validator;
use Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
       // echo "<pre>"; print_r(Auth::guard('admin')->user());die;
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if($request->ismethod('post'))
        {
            $data=$request->all();
             //echo "<pre>"; print_r($data);die;

            $rules=[
                'email'=>'required|email|max:255',
                'password'=>'required|max:40'
            ];

            $customMessages=[
                'email.required'=>'Email is required',
                'email.email'=>'Email is invalid',
                'password.required'=>'password is required'
            ];

           $this->validate($request,$rules,$customMessages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']]))
            {
                return redirect('admin/dashboard');
            }
            else
            {
                return redirect()->back()->with("error_message","Invalid email or password");
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatepassword(Request $request)
    {
       if($request->ismethod('post'))
       {
            $data = $request->all();
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password))
            {
                //new and confirm are match
                if($data['new_password']==$data['confirm_password'])
                {
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('sucess_message','password updated suceessfully');
                }
                else
                {
                    return redirect()->back()->with('error_message','New & confirm password missmatch');
                }
            }
            else
            {
                
                return redirect()->back()->with('error_message','Invalid cureent password');
            }
       }
      
       return view('admin.update_password');
    }

    public function checkcurrentpassword(Request $request)
    {
        
        $data = $request->all();
         
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password))
        {
            return "true";
        }
        else
        {
            
            return "false";
        }
    }

    public function updatedetails(Request $request)
    {
        if($request->ismethod('post'))
        {
            $data=$request->all();
             //echo "<pre>"; print_r($data);die;

            $rules=[
                'name'=>'required|max:255',
                'mobile'=>'required|numeric|max:10'
            ];

            $customMessages=[
                'name.required'=>'name is required',
                'mobile.required'=>'mobile is required',
                'mobile.numeric'=>'mobile is invalid',
                'mobile.max'=>'mobile is invalid',
            ];

           $this->validate($request,$rules,$customMessages);

            ///update admin details
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['mobile']]);
            return redirect()->back()->with('sucess_message','admin details updated suceessfully');
        }

        return view('admin.update_details');
    }



    
}
