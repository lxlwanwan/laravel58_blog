<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Admin\AdminUser;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{

    /**
     * 登陆
     */
    public function login(){
        if(Request::isMethod('get')){
            return view('admin.login.login');
        }
        $input = Request::only(['user','password','box']);
        $state = AdminUser::login($input);
        return $state;
    }



}
