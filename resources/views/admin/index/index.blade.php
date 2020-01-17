@extends('admin.layouts.admin')
@section('content')
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="{{url("admin/idnex")}}">X-admin v2.2</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav left fast-add" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('最大化','{{url('/message')}}','','',true)">
                        <i class="iconfont">&#xe6a2;</i>测试</a></dd>
                <dd>
                    <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                        <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                <dd>
                    <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                        <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                <dd>
                    <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                        <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                <dd>
                    <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                        <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{$admin['name']}}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','{{url('admin/edit_admin',['id'=>$admin['id']])}}')">个人信息</a>
                </dd>
                <dd>
                    <a href="{{url('admin/exit_login')}}">退出</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="{{url("/")}}" target="_blank">前台首页</a></li>
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            @foreach($menu as $value)
                @if(!empty($value['menu']))
                    <li>
                        <a href="javascript:;">
                            <i class="layui-icon" lay-tips="{{$value['name']}}">{!! $value['icon'] !!}</i>
                            <cite>{{$value['name']}}</cite>
                            <i class="layui-icon nav_right">&#xe603;</i>
                        </a>
                        <ul class="sub-menu">
                            @foreach($value['menu'] as $val)
                                <li>
                                    <a onclick="xadmin.add_tab('{{$val['name']}}','{{url($val['method'])}}')">
                                        <i class="layui-icon">&#xe602;</i>
                                        <cite>{{$val['name']}}</cite></a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>我的桌面</li></ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd></dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{url("admin/welcome")}}' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
@endsection