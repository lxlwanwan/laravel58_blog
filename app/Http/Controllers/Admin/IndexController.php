<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\AdminLog;
use App\Model\Admin\AdminUser;
use App\Model\Admin\Group;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;


class IndexController extends CommonController
{

    /**
     * @return string首页
     */
    public function index(){
//        $admin =AdminUser::find(1);
//        event(new \App\Events\AdminLog($admin));
        return view('admin.index.index',['menu'=>Group::get_menu(),'admin'=>AdminUser::get_cookie()]);
    }

    /**
     * 退出登录
     */
    public function exit_login(){
        $cookie='';
        $admin = Cookie::get('bolg_admin');
        if($admin){
            $cookie =Cookie::forget('bolg_admin');
        }
        $admin_user =Cookie::get('bolg_admin_user');
        if($admin_user){
            $cookie =Cookie::forget('bolg_admin_user');
        }
        AdminLog::add_log('退出了管理系统');
        return redirect()->route('login')->withCookie($cookie);
    }

    /**
     * 子页
     */
    public function welcome(){
        return view('admin.index.welcome');
    }


    /**
     * 管理日志
     */
    public function log_list(){
        $where=[];
        $data['start']= Request::input('start');
        $data['end']= Request::input('end');
        $data['name']= Request::input('name');
        $data['content']= Request::input('content');
        $start=Request::input('start')?strtotime(Request::input('start')):strtotime('last month');
        $end=Request::input('end')?strtotime(Request::input('end'))+86400:time();
        if(Request::filled('name')){
            $where[]=['name','=',Request::input('name')];
        }
        if(Request::filled('content')){
            $where[]=['content','like','%'.Request::input('content').'%'];
        }
        $list = AdminLog::get_list($where,$start,$end);
        return view('admin.index.log_list',['list'=>$list,'data'=>$data]);
    }


    /**
     * 删除日志
     */
    public function log_drop(){
        if(Request::input('type') ==1){
            $state = AdminLog::truncate();
            if($state){
                AdminLog::add_log('清空了管理日志');
                return response()->json(['err'=>200,'msg'=>'操作成功']);
            }else{
                return response()->json(['err'=>201,'msg'=>'操作失败']);
            }
        }else{
            return response()->json(['err'=>201,'msg'=>'请求错误']);
        }

    }




}
