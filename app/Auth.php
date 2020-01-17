<?php
namespace App;
use App\Model\Admin\AuthGroupRule;
use App\Model\Admin\AuthRule;
use App\Model\Admin\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/**
 * 权限类
 */
class Auth{

    const _NAME_='auth';
    const _CHECK_=true; //true 开 ,false关
    const  _AUTH_TYPE_ = 1; // 认证方式，1为实时认证；2为登录认证。

    /**
     * 鉴权
     * @param int $uid 管理ID
     * @param string $route  路由
     */

    public function check($user,$route,$type=1){
            if(!self::_CHECK_){
                return true;
            }
            if(empty($user) || $user['rule_id']==0){
                return false;
            }
            $auth_list= $this->getAuthList($user['id'],$type,$user['rule_id']);
            if(!is_array($auth_list)){
                $list=[];
                foreach ($auth_list as $v){
                    $list[]=$v;
                }
                $auth_list=$list;
            }
            if(in_array($route,$auth_list)){
                return true;
            }
            return false;
    }


    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type
     */
    protected function getAuthList($uid,$type,$rule_id)
    {
        static $_authList = array(); //保存用户验证通过的权限列表
        $t = implode(',', (array)$type);
        if (isset($_authList[$uid . $t])) {
            return $_authList[$uid . $t];
        }
        if (2 == self::_AUTH_TYPE_ && session()->has('_AUTH_LIST_' . $uid . $t)) {
            $list_rule = Session::get('_AUTH_LIST_' . $uid . $t);
            return $list_rule;
        }
        $group = Group::where('id', $rule_id)->value('rules');
        if (empty($group)) {
            $rules = DB::table('auth_rule')->where('state', AuthRule::_STATUS_)->pluck('method');
        } else {
            $list = AuthRule::whereIn('id', explode(',', $group))->where('state', AuthRule::_STATUS_)->get(['method'])->toarray();
            $rules = array_column($list, 'method');
        }
        $_authList[$uid . $t] = $rules;
        if (2 == self::_AUTH_TYPE_) {
            //规则列表结果保存到session
            session(['_AUTH_LIST_' . $uid . $t => $rules]);
        }
        return $rules;
    }












}