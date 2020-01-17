@extends('admin.layouts.admin')
@section('content')
    <div class="x-nav">
          <span class="layui-breadcrumb">
            <a><cite>管理员管理</cite></a>
            <a><cite>管理列表</cite></a>
          </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="{{url('admin/admin_list')}}" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5">
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="name"  placeholder="管理名称" value="{{$data['name']}}" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="email"  placeholder="邮箱" value="{{$data['email']}}" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <a class="layui-btn"  onclick="xadmin.open('添加管理','{{url('admin/add_admin')}}')" href="javascript:;"><i class="layui-icon"></i>添加管理</a>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th>管理名称</th>
                                <th>邮箱</th>
                                <th>角色</th>
                                <th>IP</th>
                                <th>注册时间</th>
                                <th>最近操作</th>
                                <th>状态</th>
                                <th>操作</th>
                            </thead>
                            <tbody>
                            @foreach($list as $val)
                                <tr>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->email}}</td>
                                    <td>{{$val->group_name}}</td>
                                    <td>{{$val->last_ip}}</td>
                                    <td>{{date('Y-m-d H:i:s',$val->create_time)}}</td>
                                    <td>@if($val->update_time){{date('Y-m-d H:i:s',$val->update_time)}} @endif</td>
                                    <td class="td-status">
                                        <input type="checkbox" name="state" lay-skin="switch" value="{{$val->id}}" @if($val->state ==0) checked="checked" @endif lay-text="正常|禁用" lay-filter="stateDemo">
                                    </td>
                                    <td class="td-manage">
                                        <a  onclick="xadmin.open('管理编辑','{{url('admin/edit_admin',['id'=>$val->id])}}')" href="javascript:;" class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal">
                                            编辑
                                        </a>
                                        <a  onclick="member_del(this,{{$val->id}})" href="javascript:;" class="layui-btn layui-btn-xs layui-btn-radius layui-btn-danger">
                                            删除
                                        </a>
                                    </td>
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

            // //执行一个laydate实例
            // laydate.render({
            //     elem: '#start' //指定元素
            // });
            //
            // //执行一个laydate实例
            // laydate.render({
            //     elem: '#end' //指定元素
            // });
            //监听状态操作
            form.on('switch(stateDemo)', function(obj){
                var state =obj.elem.checked == true? 0:1;
                $.ajax({
                    type:'post',
                    url:"{{url('admin/edit_admin')}}",
                    data:{id:obj.value,state:state,_token:'{{csrf_token()}}'},
                    dataType:'json',
                    success:function (data) {
                        if(data.err==200){
                            layer.msg(data.msg, {icon: 1, time: 2000});return false;
                        }else {
                            layer.msg(data.msg, {icon: 5, time: 2000});return false;
                        }
                    },
                });
            });
        });

        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    type:'get',
                    url:"{{url('admin/drop_admin')}}",
                    data:{id:id},
                    dataType:'json',
                    success:function (data) {
                        if(data.err==200){
                            $(obj).parents("tr").remove();
                            layer.msg(data.msg, {icon: 1, time: 2000});return false;
                        }else {
                            layer.msg(data.msg, {icon: 5, time: 2000});return false;
                        }
                    },
                });
            });
        }


    </script>
@endsection