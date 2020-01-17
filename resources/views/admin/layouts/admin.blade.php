<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('admin/lib/layui/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/jquery.min.js')}}"></script>
</head>
<body>
@yield('content')
</body>
</html>