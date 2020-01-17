@extends('admin.layouts.admin')
@section('content')
    <div class="x-nav">
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="{{url('admin/auth_group')}}" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th>分组名称</th>
                                <th>图标</th>
                                <th>控制器</th>
                                <th>排序</th>
                                <th>状态</th>
                                <th>操作</th>
                            </thead>
                            <tbody>
                            @foreach($list as $val)
                                <tr>
                                    <td>{{$val->name}}</td>
                                    <td><i class="layui-icon">{!! $val->icon !!}</i></td>
                                    <td>{{$val->controller}}</td>
                                    <td>{{$val->order}}</td>
                                    <td class="td-status">
                                        <input type="checkbox" name="state" lay-skin="switch" value="{{$val->id}}" @if($val->state ==0) checked="checked" @endif lay-text="正常|禁用" lay-filter="stateDemo">
                                    </td>
                                    <td class="td-manage">
                                        <a  onclick="xadmin.open('分组编辑','{{url('admin/auth_group_edit',['id'=>$val->id])}}')" href="javascript:;" class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal">
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
            //监听性别操作
            form.on('switch(stateDemo)', function(obj){
                var state =obj.elem.checked == true? 0:1;
                $.ajax({
                    type:'post',
                    url:"{{url('admin/auth_group_edit')}}",
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
                    url:"{{url('admin/auth_group_drop')}}",
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