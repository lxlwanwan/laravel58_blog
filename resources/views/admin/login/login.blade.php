<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/lib/layui/layui.js')}}"></script>
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">管理登录</div>
    <div id="darkbannerwrap"></div>
    <form method="post" class="layui-form" >
        @csrf
        <input name="user" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="pwd" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15" id="box">
        <input type="checkbox" name="box" value="1" lay-skin="primary" lay-filter="box" title="记住密码">
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button">
        <hr class="hr20" >
    </form>
</div>

<script>
    $(function  () {
        layui.use('form', function () {
            var form = layui.form,
                layer = layui.layer;
            $ = layui.jquery;
            form.on('submit(login)', function (data) {
                // if(data.field.user == ''){
                //     layer.msg('用户名不能为空', {icon: 5, time: 2000});return false;
                // }
                // if(data.field.pwd == ''){
                //     layer.msg('密码不能为空', {icon: 5, time: 2000});return false;
                // }
                var tips =layer.load({shade: 5, time: 0,});
                $.ajax({
                    type:'Post',
                    url:'{{url("admin/login")}}',
                    data:{user:data.field.user,password:data.field.pwd,_token:data.field._token,box:data.field.box},
                    dataType:'json',
                    success:function (arr) {
                        if(arr.err==200){
                            layer.close(tips);
                            layer.msg(arr.msg, {icon: 1, time: 2000},function () {
                                window.location.href ='{{url("admin/index")}}';
                            });
                        }else {
                            layer.close(tips);
                            layer.msg(arr.msg, {icon: 5, time: 2000});return false;
                        }
                    }
                });
                {{--$.post('{{url("admin/login")}}',{user:data.field.user,password:data.field.pwd,_token:data.field._token,box:data.field.box},function (arr) {--}}
                    {{--if(arr.err==200){--}}
                        {{--layer.close(tips);--}}
                        {{--layer.msg(arr.msg, {icon: 1, time: 2000},function () {--}}
                            {{--window.location.href ='{{url("admin/index")}}';--}}
                        {{--});--}}
                    {{--}else {--}}
                        {{--layer.close(tips);--}}
                        {{--layer.msg(arr.msg, {icon: 5, time: 2000});return false;--}}
                    {{--}--}}
                {{--});--}}
            });
            form.on('checkbox(box)',function (data) {
                if(this.checked ==true){
                    layer.tips('请勿在公共电脑上勾选此项！', '#box', {
                        tips: [3, '#333'],
                        time: 2000
                    });
                }
            })
        });
    })
</script>
</body>
</html>