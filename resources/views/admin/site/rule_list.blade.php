@extends('admin.layouts.admin')
@section('content')
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a><cite>管理员管理</cite></a>
            <a><cite>规则列表</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="{{url('admin/rule_list')}}" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5">
                        <div class="layui-input-inline layui-show-xs-block">
                            <select name="group_id">
                                <option value="">选择分组</option>
                                @foreach($group as $value)
                                    <option value="{{$value->id}}" @if($data['group_id']==$value->id) selected="selected" @endif  >{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="rule_name"  placeholder="规则名" value="{{$data['rule_name']}}" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>--}}
                    <a class="layui-btn" href="{{url('admin/add_rule')}}"><i class="layui-icon"></i>添加规则</a>
                    <a class="layui-btn" onclick="xadmin.open('分组列表','{{url('admin/auth_group')}}')">分组列表</a>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>规则名称</th>
                            <th>路由</th>
                            <th>分组名称</th>
                            <th>排序</th>
                            <th>显示状态</th>
                            <th>状态</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        @foreach($list as $val)
                            <tr>
                                <td>{{$val->name}}</td>
                                <td>{{$val->method}}</td>
                                <td>{{$val->pname}}</td>
                                <td>{{$val->order}}</td>
                                <td class="td-status">
                                    <input type="checkbox" name="status" lay-skin="switch" value="{{$val->id}}" @if($val->status ==0) checked="checked" @endif lay-text="显示|隐藏" lay-filter="statusDemo">
                                    {{--<span class="layui-btn layui-btn-normal layui-btn-mini">{{$val->status}}</span>--}}
                                </td>
                                <td class="td-status">
                                    <input type="checkbox" name="state" lay-skin="switch" value="{{$val->id}}" @if($val->state ==0) checked="checked" @endif lay-text="正常|禁用" lay-filter="stateDemo">
                                </td>
                                <td class="td-manage">
                                    <a  onclick="xadmin.open('规则编辑','{{url('admin/auth_rule_edit',['id'=>$val->id])}}')" href="javascript:;" class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal">
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
        //监听性别操作
        form.on('switch(statusDemo)', function(obj){
            var status =obj.elem.checked == true? 0:1;
            $.ajax({
                type:'post',
                url:"{{url('admin/auth_rule_edit')}}",
                data:{id:obj.value,status:status,_token:'{{csrf_token()}}'},
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
        form.on('switch(stateDemo)', function(obj){
            var state =obj.elem.checked == true? 0:1;
            $.ajax({
                type:'post',
                url:"{{url('admin/auth_rule_edit')}}",
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

    /*规则-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type:'get',
                url:"{{url('admin/auth_rule_drop')}}",
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