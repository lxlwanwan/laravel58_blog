<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use phpDocumentor\Reflection\DocBlock;

class AdminUser extends Model
{
    //
    protected $table='admin_user';
    protected $primaryKey='id';
    protected $fillable=['name','email','password','last_ip','rule_id','create_time','update_time'];

    const _STATE_PASS_=0;
    const _STATE_TOP_=1;

    public $timestamps=false;


    /**
     * 用户登陆
     */
    public static function login($input){
        $admin = self::where('name',$input['user'])->first();
        if(empty($admin)){
            return response()->json(['err'=>201,'msg'=>'用户不存在！']);
        }
        if($input['password'] != decrypt($admin['password'])){
            return response()->json(['err'=>201,'msg'=>'密码不正确！']);
        }
        if(isset($input['box']) && $input['box']==1){
            //记住登陆状态
            $token = uniqid();
            $id=\Request::getClientIp();
            $data = $admin['id'].'|'.encrypt($token.$id);
            $cookie =Cookie('bolg_admin',$data,60*24*30);
        $admin->remember_token=$token;
        }else{
            //常用登陆
            $cookie =Cookie('bolg_admin_user',$admin,120);
        }
        $admin->update_time=time();
        $admin->save();
        AdminLog::create(['name'=>$admin['name'],'content'=>'管理员登陆','ip' =>\Request::getClientIp(),'time' =>time()]);
        return response()->json(['err'=>200,'msg'=>'登陆成功'])->withCookie($cookie);
    }



    /**
     * 列表
     */
    public static function admin_list($where=[]){
        $list = \DB::table('admin_user as a')
                ->leftJoin('group as b','a.rule_id','=','b.id')
                ->where($where)->paginate(30,['a.*','b.name as group_name']);
       return $list;
    }


    /**
     * 添加修改
     */
    public static function add_edit($input){
        $data=[];
        if(isset($input['name'])){
            $data['name']=$input['name'];
        }
        if(isset($input['email'])){
            $data['email']=$input['email'];
        }
        if(isset($input['rule_id']) && $input['rule_id']){
            $data['rule_id']=$input['rule_id'];
        }
        if(isset($input['pass'])){
            $data['password']=encrypt($input['pass']);
        }
        if(isset($input['state']) && is_numeric($input['state'])){
            $data['state']=$input['state'];
        }
        if(isset($input['id'])){
            if(isset($data['name'])){
                $name = self::where('name',$data['name'])->where('id','<>',$input['id'])->first();
                if($name){
                    return ['err'=>201,'msg'=>'管理员已经存在'];
                }
            }
            if(isset($data['email'])){
                $email = self::where('email',$data['email'])->where('id','<>',$input['id'])->first();
                if($email){
                    return ['err'=>201,'msg'=>'邮箱已经存在'];
                }
            }
            $data['update_time']=time();
            $state =self::where('id',$input['id'])->update($data);
            $test = '编辑了id为：'.$input['id'].'的管理员,数据：'.implode(',',$data);
        }else{
            $name = self::where('name',$data['name'])->first();
            if($name){
                return ['err'=>201,'msg'=>'管理员已经存在'];
            }
            $email = self::where('email',$data['email'])->first();
            if($email){
                return ['err'=>201,'msg'=>'邮箱已经存在'];
            }
            $data['create_time']=time();
            $state =self::create($data);
            $test = '添加了名为：'.$data['name'].'的管理员,数据：'.implode(',',$data);
        }
        if($state){
            AdminLog::add_log($test);
            return ['err'=>200,'msg'=>'操作成功'];
        }else{
            return ['err'=>201,'msg'=>'操作失败'];
        }

    }


    /**
     * 获取cookie
     */
    public static function get_cookie(){
        $bolg_admin_user= Cookie::get('bolg_admin_user');//常用登陆
        $bolg_admin = Cookie::get('bolg_admin');
        if($bolg_admin_user){
            $admin =json_decode($bolg_admin_user,true);
        }else{
            $bolg_admin=explode('|',$bolg_admin);
            $admin = AdminUser::where('id',$bolg_admin[0])->first();
        }
        return $admin;
    }


}
