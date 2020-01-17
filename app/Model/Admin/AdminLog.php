<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class AdminLog extends Model
{
    //
    protected $table='admin_log';
    protected $primaryKey='id';
    protected $fillable=['name','type','content','ip','time'];

    public $timestamps=false;

    /**
     * 插入数据
    */
    public static function add_log($content=''){
        if(empty($content)){
            return false;
        }
        $name=AdminUser::get_cookie();
        $data=[];
        $data['name']=$name['name'];
        $data['content'] = $content;
        $data['ip'] = \Request::getClientIp();
        $data['time'] =time();
        $state = self::create($data);
        return $state;
    }



    /**
     * 获取列表
     */
    public static function get_list($where=[],$start,$end){
        $list = self::where($where)->whereBetween('time',[$start,$end])->orderBy('time','desc')->paginate(30);

        return $list;
    }


}
