<?php
namespace App;
use App\Model\Admin\AuthGroupRule;
use Illuminate\Support\Facades\Route;

/**
 * 获取控制器添加规则的类
 */
class Refle{

    public static $cache1='../app/Http/Controllers/Admin/';


    public static $route= 'App\Http\Controllers\Admin\\';

    /**
     * 需要过滤的控制器
     *
     */
    protected $filter=[
        'App\Http\Controllers\Admin\CommonController',
        'App\Http\Controllers\Admin\LoginController',
        'Illuminate\Routing\Controller',
        'App\Http\Controllers\Controller',
        ];

    /**
     * 需要过滤的方法
     * 样式：app\http\controllers\admin\indexcontroller@index
     */
    protected $means=[];




    /**
     * 获取规则
     */
    public function get_rule(){
        $controller = $this->get_controller();
        if(empty($controller)){
            return false;
        }
        $ids=[];
        $routes =$this->get_route();
        //获取控制器
        $data=[];
        foreach ($controller as $key=>$con){
            $ks=[];
            $ks['name']='控制器'.$key;
            $ks['controller'] = $this->method_name($con);
            //添加控制器
            $state=AuthGroupRule::where('controller',$ks['controller'])->first();
            if(empty($state)){
                $state=AuthGroupRule::create($ks);
            }
            $arr1=$this->get_method($ks['controller']);
            if($arr1){
                foreach ($arr1 as $value){
                    if(!in_array($value['method'], $this->means) && isset($routes[$value['method']]['uri'])){
                        $mm=[];
                        $mm['name']=$value['name'];
                        $mm['method']=$routes[$value['method']]['uri'];
                        $mm['p_id'] =$state['id'];
                        $data[]=$mm;
                    }
                }

            }
        }
        if($data){
            foreach ($data as $a){
                //判断规则是否存在
                $rule = \DB::table('auth_rule')->where('method',$a['method'])->first();
                if(empty($rule)){
                    //添加规则
                    $ids[] = \DB::table('auth_rule')->insertGetId($a);
                }
            }
        }else{
            return ['code'=>201,'msg'=>'没有需要添加','url'=>'admin/rule_list','data'=>'','time'=>2];
        }
        if($ids){
           return ['code'=>200,'msg'=>'添加成功','url'=>'admin/rule_list','data'=>implode(',',$ids),'time'=>2];
        }else{
            return ['code'=>201,'msg'=>'没有需要添加','url'=>'admin/rule_list','data'=>'','time'=>2];
        }
    }


    /**
     * 获取路由规则
     */
    protected function get_route(){
        $routes=Route::getRoutes();
        $path=[];
        foreach ($routes as $k=>$value){
            if(isset($value->action['controller'])){
                $path[strtolower($value->action['controller'])]['uri'] = $value->uri;
            }
        }
        return $path;
    }


    /**
     * 获取控制器
     */
    protected function get_controller(){
        $data = [];
        if (file_exists(self::$cache1)) {
            if ($dh = opendir(self::$cache1)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        if (file_exists(self::$cache1 . '/' . $file) && !is_dir(self::$cache1 . '/' . $file)) {
                            $file =self::$route.str_replace('.php', '', $file);
                            if (!in_array($file,$this->filter)) {
                                $data[] =$file;
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $data;
    }

    /**
     * 获取控制器方法
     */
    public function get_method($path){
        $met = new \ReflectionClass($path);
        $methods = $met->getMethods(\ReflectionMethod::IS_PUBLIC );
        if(empty($methods)){
            return false;
        }
        $method=$this->filter($methods);
        return $method;
    }


    /**
     * 过滤不需要的控制器
     */
    protected function filter($methods){
        $method=[];
        foreach ($methods as $key=>$v){
            if(!in_array($v->class, $this->filter)){
                $key =$this->regroup($v,$v->getDocComment(),$key);
                $method[]=$key;
            }
        }
        return $method;
    }


    /**
     * 重新组装获取控制器方法/方法名
     */
    protected function regroup($name,$annotation,$key){
        $data=[];
        preg_match_all('/[\x{4e00}-\x{9fa5}]+/u', $annotation, $r);
        $data['name']=isset($r[0][0])?$r[0][0]:'方法'.$key;
//        $data['method']=strtolower(str_replace(self::$route,'',$name->class).'@'.$name->name);
        $data['method']=strtolower($name->class.'@'.$name->name);
        return $data;
    }


    /**
     * 获取控制器名
     */
    protected function method_name($path){
        $met = new \ReflectionClass($path);
        $method=strtolower($met->getName());
        return $method;
    }



}