<?php
namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/24
 * Time: 11:15
 */
class IndexController extends Controller{


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('welcome');
    }


}