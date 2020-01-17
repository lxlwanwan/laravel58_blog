@extends('admin.layouts.admin')
@section('content')
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            @csrf
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>角色名</label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            @foreach($list as $value)
                <div class="layui-form-item" style="width: 97%;float: right">
                    <div class="layui-form-label" style="width: 100px;">
                        <input type="checkbox" name="like[]" lay-skin="primary"  lay-filter="group"  value="{{$value['id']}}" title="{{$value['name']}}">
                    </div>
                    <div class="layui-input-block" style="padding-top: 8px;">
                        @foreach($value['rule'] as $val)
                            <input type="checkbox" name="like2" lay-skin="primary" class="a{{$value['id']}}" value="{{$val['id']}}" title="{{$val['name']}}">
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-submit type="button" lay-filter="edit">提交</button>
            </div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //监听提交
            form.on('submit(edit)', function (data) {
                var rule = new Array();
                $("input[name='like2']:checked").each(function(i){
                    rule.push($(this).val());
                });
                $.ajax({
                    type:'post',
                    url:"{{url('admin/add_group')}}",
                    data:{name:data.field.name,rule:rule,_token:data.field._token},
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


            //监听checkbox
            form.on('checkbox(group)', function(data) {
                // console.log(data);
                // console.log(data.elem.checked); //开关是否开启，true或者false
                // console.log(data.value); //开关value值，也可以通过data.elem.value得到
                $("."+"a"+data.value).prop("checked", data.elem.checked);
                form.render();
            });

        });
</script>
@endsection