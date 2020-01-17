@extends('admin.layouts.admin')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>用户名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" value="{{$data->name}}" lay-verify="required"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>分组名称</label>
                    <div class="layui-input-inline">
                        <select name="p_id">
                            <option value="">选择分组</option>
                            @foreach($group as $value)
                                <option value="{{$value->id}}" @if($data['p_id'] ==$value->id ) selected="selected" @endif  >{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red"></span>规则</label>
                    <div class="layui-input-inline">
                        <input type="text" value="{{$data->method}}" readonly="readonly" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red">*</span>排序</label>
                    <div class="layui-input-inline" style="width: 100px">
                        <input type="text" id="order" name="order" value="{{$data->order}}" lay-verify="number" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-submit type="button" lay-filter="edit">提交</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        layui.use(['form', 'layer'], function () {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;

                //监听提交
                form.on('submit(edit)', function (data) {
                    $.ajax({
                        type:'post',
                        url:"{{url('admin/auth_rule_edit')}}",
                        data:{id:data.field.id,name:data.field.name,_token:data.field._token,p_id:data.field.p_id,order:data.field.order},
                        dataType:'json',
                        success:function (arr) {
                            if(arr.err==200){
                                layer.msg(arr.msg, {icon: 1, time: 2000},function () {
                                    // 获得frame索引
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.layer.close(index);//关闭当前iframe
                                    window.parent.location.reload();//刷新
                                });
                            }else {
                                layer.msg(arr.msg, {icon: 5, time: 2000});return false;
                            }
                        },
                    });
                });
            });
    </script>
@endsection