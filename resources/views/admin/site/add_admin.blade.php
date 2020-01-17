@extends('admin.layouts.admin')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row">
            <form class="layui-form">
                @csrf
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>管理名称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" lay-verify="required|username" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" id="email" name="email" lay-verify="email" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>选择角色</label>
                    <div class="layui-input-inline">
                        <select name="rule_id" lay-verify="required">
                            <option value="">选择分组</option>
                            @foreach($group as $value)
                                <option value="{{$value->id}}" >{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="password" name="password" lay-verify="required|pass" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="pass" name="pass" lay-verify="required|pass|check" autocomplete="off" class="layui-input">
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
                form.verify({
                    username: function(value, item){ //value：表单的值、item：表单的DOM对象
                        if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                            return '用户名不能有特殊字符';
                        }
                        if(/(^\_)|(\__)|(\_+$)/.test(value)){
                            return '用户名首尾不能出现下划线\'_\'';
                        }
                        if(/^\d+\d+\d$/.test(value)){
                            return '用户名不能全为数字';
                        }
                    },
                    pass: [
                        /^[\S]{6,12}$/
                        ,'密码必须6到12位，且不能出现空格'
                    ],
                    check: function (value,item) {
                        if(value != data.field.password){
                            return '2次输入密码不一致';
                        }
                    }

                });
                $.ajax({
                    type:'post',
                    url:"{{url('admin/add_admin')}}",
                    data:{name:data.field.name,email:data.field.email,_token:data.field._token,rule_id:data.field.rule_id,pass:data.field.pass},
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