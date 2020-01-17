<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>提示页</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{asset('admin/lib/layui/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>
</head>
<body>
<div class="layui-container">
    <div class="fly-panel">
        <div class="fly-none">
            @if($data['code'] ==200)
                <h2><i class="layui-icon layui-icon-face-smile"></i></h2>
             @else
                <h2><i class="layui-icon layui-icon-face-cry"></i></h2>
            @endif
            <p>{{$data['msg']}}<a id="href" href="{{url($data['url'])}}"> 手动跳转 </a>跳转时间：<span id="wait">{{$data['time']}}</span></p>
        </div>
    </div>
</div>
<script>
    (function(){
        var wait = document.getElementById('wait'),
            href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>