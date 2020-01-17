<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock;

class AuthRule extends Model
{
    protected $table='auth_rule';
    protected $primaryKey='id';
    protected $fillable=['name','method','type','p_id','order','status'];

    const _STATUS_=0;
    const _STATUS_TOP_=1;

    public $timestamps=false;


    public function group_name(){

        return $this->hasOne('App\Model\Admin\AuthGroupRule','p_id');

    }


    /**
     * 获取列表
     */
    public static function get_list($where=[]){
        $list = \DB::table('auth_rule as a')
                ->leftJoin('auth_group_rule as b','a.p_id','=','b.id')
                ->where($where)
                ->orderBy('order')
                ->paginate(30,['a.*','b.name as pname']);
        return $list;
    }


    /**
     * 编辑规则
     */
    public static function edit_rule($input){
        $data=[];
        if(isset($input['status'])){
            $data['status'] = $input['status'];
        }
        if(isset($input['name']) && $input['name']){
            $data['name'] = $input['name'];
        }
        if (isset($input['p_id']) && is_numeric($input['p_id'])){
            $data['p_id'] = $input['p_id'];
        }
        if (isset($input['order']) && is_numeric($input['order'])){
            $data['order'] = $input['order'];
        }
        if (isset($input['state']) && is_numeric($input['state'])){
            $data['state'] = $input['state'];
        }
        if(isset($input['id']) && $input['id']>0 && $data){
            $state = self::where('id',$input['id'])->update($data);
            if($state){
                AdminLog::add_log('编辑了id为'.$input['id'].'的规则，数据：'.implode(',',$data));
                return ['err'=>200,'msg'=>'操作成功'];
            }else{
                return ['err'=>201,'msg'=>'操作失败'];
            }
        }else{
            return ['err'=>201,'msg'=>'没有需要修改的'];
        }

    }


    /**
     * 分组归类
     */
    public static function classify($rules){
        $data=[];
        $rules=explode(',',$rules);
        $rule = self::whereIn('id',$rules)->where('status',AuthRule::_STATUS_)->orderBy('order')->get(['name','method','p_id']);
        if($rule){
            foreach ($rule as $value){
                $group = AuthGroupRule::where('id',$value['p_id'])->first(['id','name','icon']);
                $data[$group['id']]['id']=$group['id'];
                $data[$group['id']]['name']=$group['name'];
                $data[$group['id']]['icon']=$group['icon'];
                $data[$group['id']]['menu'][]=$value;
            }
        }
        return $data;
    }




}
