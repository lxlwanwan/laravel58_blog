<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\AdminLog;
use App\Model\Admin\AdminUser;
use App\Model\Admin\AuthGroupRule;
use App\Model\Admin\AuthRule;
use App\Model\Admin\Group;
use App\Refle;
use Illuminate\Support\Facades\Request;
use phpDocumentor\Reflection\DocBlock;

class SiteController extends CommonController
{


    /**
     * 管理列表
     */
    public function admin_list(){
        if(Request::isMethod('get')){
            $where=[];
            $data['name']=Request::input('name','');
            $data['email']=Request::input('email','');
            return view('admin.site.admin_list',['list'=>AdminUser::admin_list($where),'data'=>$data]);
        }
    }


    /**
     * 添加管理
     */
    public function add_admin(){
        if(Request::isMethod('get')){
            return view('admin.site.add_admin',['group'=>Group::where('state',0)->get()]);
        }
        $state = AdminUser::add_edit(Request::all());

        return response()->json($state);
    }


    /**
     * 编辑管理
     */
    public function edit_admin($id=0){
        if(Request::isMethod('get')){
            return view('admin.site.edit_admin',['group'=>Group::where('state',0)->get(),'data'=>AdminUser::find($id)]);
        }
        $state = AdminUser::add_edit(Request::all());

        return response()->json($state);
    }


    /**
     * 删除管理
     */
    public function drop_admin(){
        $state = AdminUser::destroy(Request::input('id',0));
        if($state){
            AdminLog::add_log('删除了id为'.Request::input('id',0).'的管理员');
            return response()->json(['err'=>200,'msg'=>'操作成功']);
        }else{
            return response()->json(['err'=>201,'msg'=>'操作失败']);
        }
    }


    /**
     * 规则列表
     * rule_list
     */
    public function rule_list(){
        $where=[];
        $data['group_id']=Request::input('group_id',null);
        $data['rule_name']=Request::input('rule_name',null);
        if(Request::filled('group_id')){
            $where[]=['a.p_id','=',Request::input('group_id')];
        }
        if(Request::filled('rule_name')){
            $where[]=['a.name','=',Request::input('rule_name')];
        }
        $group = AuthGroupRule::all();
        return view('admin.site.rule_list',['group'=>$group,'list'=>AuthRule::get_list($where),'data'=>$data]);
    }


    /**
     * 添加规则
     * add_rule
     */
    public function add_rule(){
        $ref= new Refle();
        $state =$ref->get_rule();
        return view('message',['data'=>$state]);
    }


    /**
     * 编辑规则
     */
    public function auth_rule_edit($id=''){
        if(Request::isMethod('get')){
            $group = AuthGroupRule::all();
            $data= AuthRule::find($id);
            return view('admin.site.auth_rule_edit',['data'=>$data,'group'=>$group]);
        }
        $state = AuthRule::edit_rule(Request::all());
        return response()->json($state);
    }




    /**
     * 删除规则
     */
    public function auth_rule_drop(){
        $state = AuthRule::destroy(Request::input('id'));
        if($state){
            Group::up_rule([Request::input('id')]);
            AdminLog::add_log('删除了id为'.Request::input('id').'的规则');
            return response()->json(['err'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['err'=>201,'msg'=>'删除失败']);
        }

    }


    /**
     * 分组列表
     */
    public function auth_group(){

        return view('admin.site.auth_group',['list'=>AuthGroupRule::all()]);
    }


    /**
     * 分组编辑
     */
    public function auth_group_edit($id=''){
        if(Request::isMethod('get')){
            return view('admin.site.auth_group_edit',['data'=>AuthGroupRule::find($id)]);
        }
        $state = AuthGroupRule::edit_group(Request::all());
        return response()->json($state);

    }



    /**
     * 删除分组
     */
    public function auth_group_drop(){
        $state = AuthGroupRule::group_drop(Request::input('id'));

         return response()->json($state);
    }


    /**
     * 角色列表
     */
    public function group_list(){

        return view('admin.site.group_list',['list'=>Group::all()]);
    }


    /**
     * 添加角色
     */
    public function add_group(){
        if(Request::isMethod('get')){
            return view('admin.site.add_group',['list'=>AuthGroupRule::get_list()]);
        }
        $state = Group::add_edit(Request::all());
        return response()->json($state);
    }


    /**
     * 编辑角色
     */
    public function edit_group($id=0){
        if(Request::isMethod('get')){
            $group =Group::find($id);
            if(!empty($group['rules'])){
                $group['rules']=explode(',',$group['rules']);
                foreach ($group['rules'] as $v){
                    $ks[]=AuthRule::where('id',$v)->value('p_id');
                }
                $group['p_id']=array_unique($ks);
            }else{
                $group['rules']=[];
                $group['p_id']=[];
            }
            return view('admin.site.edit_group',['data'=>$group,'list'=>AuthGroupRule::get_list()]);
        }
        $state = Group::add_edit(Request::all());
        return response()->json($state);

    }


    /**
     * 删除角色
     */
    public function drop_group(){
        $id=Request::input('id',0);
        if($id ==0){
            return response()->json(['err'=>201,'msg'=>'id不存在']);
        }
        $state = Group::destroy($id);
        if($state){
            AdminUser::where('rule_id',$id)->update(['rule_id'=>0]);
            AdminLog::add_log('删除了id为：'.$id.'角色');
            return response()->json(['err'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['err'=>201,'msg'=>'删除失败']);
        }


    }



}
