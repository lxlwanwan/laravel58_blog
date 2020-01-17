@extends('admin.layouts.admin')
@section('content')
    <div class="x-nav">
          <span class="layui-breadcrumb">
            <a><cite>网站管理</cite></a>
            <a><cite>管理日志</cite></a>
          </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="{{url('admin/log_list')}}" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5">
                            <div class="layui-input-inline layui-show-xs-block">
                                <input class="layui-input" placeholder="开始日" name="start" value="{{$data['start']}}" id="start">
                            </div>
                            <div class="layui-input-inline layui-show-xs-block">
                                <input class="layui-input" placeholder="截止日" name="end" value="{{$data['end']}}" id="end">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="name"  placeholder="管理员名称" value="{{$data['name']}}" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="content"  placeholder="内容关键字" value="{{$data['content']}}" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>清空日志</button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th>管理名称</th>
                                <th>内容</th>
                                <th>IP地址</th>
                                <th>时间</th>
                            </thead>
                            <tbody>
                            @foreach($list as $val)
                                <tr>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->content}}</td>
                                    <td>{{$val->ip}}</td>
                                    <td>{{date('Y-m-d H:i:s',$val->time)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-card-body ">
                        <div class="page">
                            {{ $list->appends($data)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(['laydate','form'], function(){
            var laydate = layui.laydate;
            var form = layui.form;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });

        /*规则-删除*/
        function delAll(){
            layer.confirm('确认要清空日志吗？',function(index){
                $.ajax({
                    type:'get',
                    url:"{{url('admin/log_drop')}}",
                    data:{type:1},
                    dataType:'json',
                    success:function (data) {
                        if(data.err==200){
                            layer.msg(data.msg, {icon: 1, time: 2000},function () {
                                window.location.href = window.location.href;
                            });return false;
                        }else {
                            layer.msg(data.msg, {icon: 5, time: 2000});return false;
                        }
                    },
                });
            });
        }


    </script>
@endsection