<?php

namespace App\Http\Middleware;

use App\Auth;
use App\Model\Admin\AdminUser;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use tests\Mockery\Adapter\Phpunit\EmptyTestCase;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $admin = Cookie::get('bolg_admin');
        $bolg_admin = Cookie::get('bolg_admin_user');//常用登陆
        if(empty($admin) && empty($bolg_admin)){
            return  redirect()->route('login');
        }
        $check = $this->auth_check(Request::route()->uri(),$bolg_admin,$admin);
        if(!$check){
            if(Request::ajax()){
                return response()->json(['err'=>201,'msg'=>'没有该权限']);
            }else{
                return redirect()->route('message',['data'=>['code'=>201,'msg'=>'没有该权限','url'=>url()->previous(),'time'=>7200]]);
            }
        }
        return $next($request);
    }


    public function auth_check($route,$bolg_admin=[],$admin=''){
        if(empty($admin) && empty($bolg_admin)){
            return  redirect()->route('login');
        }
        if($bolg_admin){
            $uid=json_decode($bolg_admin,true)['id'];
            $u_id = AdminUser::where('id',$uid)->where('state',AdminUser::_STATE_PASS_)->first();
        }else if($admin){
            $ip=\Request::getClientIp();
            $admin=explode('|',$admin);
            $blog_token = str_replace($ip,'',decrypt($admin[1]));
            $u_id = AdminUser::where('remember_token',$blog_token)->where('state',AdminUser::_STATE_PASS_)->first();
            if(empty($u_id) || $admin[0] != $u_id['id']){
                return  redirect()->route('login');
            }
        }
        $auth = new Auth();
        $state = $auth->check($u_id,$route);
        return $state;
    }



}
