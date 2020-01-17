<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class AuthGroupRule extends Model
{
    protected $table='auth_group_rule';
    protected $primaryKey='id';
    protected $fillable=['name','controller','icon','order','type'];

    const _STATE_=0;

    public $timestamps=false;


    /**
     *
     */
    public static function get_list($all=0){
        if($all == 0){
            $state =[0];
        }elseif ($all==1){
            $state=[1];
        }else{
            $state=[0,1];
        }
        $list = self::whereIn('state',$state)->get(['id','name']);
        foreach ($list as $value){
            $value['rule'] = AuthRule::where('p_id',$value['id'])->whereIn('state',$state)->get(['id','name']);
        }
        return $list;
    }


    /**
     * 编辑分组
     */
    public static function edit_group($input){
        $data=[];
        if(isset($input['name']) && $input['name']){
            $data['name'] = $input['name'];
        }
        if(isset($input['icon']) && $input['icon']){
            $data['icon'] = $input['icon'];
        }
        if(isset($input['order']) && is_numeric($input['order'])){
            $data['order'] = $input['order'];
        }
        if(isset($input['state']) && is_numeric($input['state'])){
            $data['state'] = $input['state'];
        }
        if(isset($input['id']) && $data){
            $state = self::where('id',$input['id'])->update($data);
            if($state){
                if(isset($input['state']) && is_numeric($input['state'])){
                    AuthRule::where('p_id',$input['id'])->update(['state'=>$input['state']]);
                }
                AdminLog::add_log('编辑了id为'.$input['id'].'的分组，数据：'.implode(',',$data));
                return ['err'=>200,'msg'=>'操作成功'];
            }else{
                return ['err'=>201,'msg'=>'操作失败'];
            }
        }else{
            return ['err'=>201,'msg'=>'没有需要修改的'];
        }

    }



    /**
     * 删除分组
     */
    public static function group_drop($id=''){
        if(empty($id)){
            return ['err'=>201,'msg'=>'操作失败'];
        }
        $state = self::destroy($id);
        if($state){
            $list=AuthRule::where('p_id',$id)->pluck('id');
            Group::up_rule($list);
            AuthRule::where('p_id',$id)->delete();
            AdminLog::add_log('删除了id为'.$id.'的分组');
            return ['err'=>200,'msg'=>'操作成功'];
        }else{
            return ['err'=>201,'msg'=>'操作失败'];
        }

    }


    /**
     * 菜单栏
     */
    public static function menu(){
        $list = self::where('state',self::_STATE_)->orderBy('order')->get(['id','name','icon']);
        foreach ($list as $v){
            $v['menu'] = AuthRule::where('p_id',$v['id'])->where('status',AuthRule::_STATUS_)->orderBy('order')->get(['name','method']);
            if($v['menu']){
                foreach ($v['menu'] as $k){
                    $link =explode('/',$k['method']);
                    $k['method']=$link[0].'/'.$link[1];
                }
            }
        }
        return $list;
    }



}
