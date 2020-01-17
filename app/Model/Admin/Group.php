<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='group';
    protected $primaryKey='id';
    protected $fillable=['name','rules','state'];


    public $timestamps=false;



    /**
     * 添加/更新
     */
    public static function add_edit($input=[]){
        if(empty($input)){
            return ['err'=>201,'msg'=>'操作失败'];
        }
        $data=[];
        if (isset($input['name']) && $input['name']){
            $data['name']=$input['name'];
        }
        if (isset($input['rule']) && $input['rule']){
            $data['rules']=implode(',',$input['rule']);
        }
        if (isset($input['state']) && is_numeric($input['state'])){
            $data['state']=$input['state'];
        }
        if(isset($input['id']) && $input['id']){
            $state = self::where('id',$input['id'])->update($data);
            $test='编辑了id为：'.$input['id'].'的角色，数据：'.implode(',',$data);
        }else{
            $state = self::create($data);
            $test='添加了：'.implode(',',$data).'的角色';
        }
        if($state){
            AdminLog::add_log($test);
            return ['err'=>200,'msg'=>'操作成功'];
        }else{
            return ['err'=>201,'msg'=>'操作失败'];
        }
    }


    /**
     * 更新角色规则
     */
    public static function up_rule($rule=[]){
        if(empty($rule)){
            return false;
        }
        $list = self::all();
        foreach ($list as $v){
            if($v['rules']){
                $rules=explode(',',$v['rules']);;
                $v->rules=implode(',',array_diff($rules,$rule));
                $v->save();
            }
        }
        return true;
    }


    /**
     * 获取菜单栏
     */
    public static function get_menu(){
        $admin = AdminUser::get_cookie();
        if($admin['rule_id']){
            $group = self::where('id',$admin['rule_id'])->where('state',0)->first('rules');
            if($group){
                if($group['rules']){
                    $list =AuthRule::classify($group['rules']);
                }else{
                    $list = AuthGroupRule::menu();
                }
                return $list;
            }
        }
        return [];
    }




}
