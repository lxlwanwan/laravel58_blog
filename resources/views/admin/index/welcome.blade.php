@extends('admin.layouts.admin')
@section('content')
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">数据统计</div>
                <div class="layui-card-body ">
                    <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:;" class="x-admin-backlog-body">
                                <h3>文章数</h3>
                                <p>
                                    <cite>66</cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:;" class="x-admin-backlog-body">
                                <h3>会员数</h3>
                                <p>
                                    <cite>12</cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:;" class="x-admin-backlog-body">
                                <h3>回复数</h3>
                                <p>
                                    <cite>99</cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:;" class="x-admin-backlog-body">
                                <h3>商品数</h3>
                                <p>
                                    <cite>67</cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6">
                            <a href="javascript:;" class="x-admin-backlog-body">
                                <h3>文章数</h3>
                                <p>
                                    <cite>67</cite></p>
                            </a>
                        </li>
                        <li class="layui-col-md2 layui-col-xs6 ">
                            <a href="javascript:;" class="x-admin-backlog-body">
                                <h3>文章数</h3>
                                <p>
                                    <cite>6766</cite></p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">下载
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                <div class="layui-card-body  ">
                    <p class="layuiadmin-big-font">33,555</p>
                    <p>新下载
                        <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">下载
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                <div class="layui-card-body ">
                    <p class="layuiadmin-big-font">33,555</p>
                    <p>新下载
                        <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">下载
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                <div class="layui-card-body ">
                    <p class="layuiadmin-big-font">33,555</p>
                    <p>新下载
                        <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">下载
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                <div class="layui-card-body ">
                    <p class="layuiadmin-big-font">33,555</p>
                    <p>新下载
                        <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>


        <div class="layui-col-sm12 layui-col-md6">
            <div class="layui-card">
                <div class="layui-card-header">最新一周新增用户</div>
                <div class="layui-card-body" style="min-height: 280px;">
                    <div id="main1" class="layui-col-sm12" style="height: 300px;"></div>

                </div>
            </div>
        </div>
        <div class="layui-col-sm12 layui-col-md6">
            <div class="layui-card">
                <div class="layui-card-header">最新一周PV/UV量</div>
                <div class="layui-card-body" style="min-height: 280px;">
                    <div id="main2" class="layui-col-sm12" style="height: 300px;"></div>

                </div>
            </div>
        </div>
        <div class="layui-col-sm12 layui-col-md6">
            <div class="layui-card">
                <div class="layui-card-header">用户来源</div>
                <div class="layui-card-body" style="min-height: 280px;">
                    <div id="main3" class="layui-col-sm12" style="height: 300px;"></div>

                </div>
            </div>
        </div>
        <div class="layui-col-sm12 layui-col-md6">
            <div class="layui-card">
                <div class="layui-card-header">硬盘使用量</div>
                <div class="layui-card-body" style="min-height: 280px;">
                    <div id="main4" class="layui-col-sm12" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/echarts/4.2.1-rc1/echarts.min.js"></script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main1'));

    // 指定图表的配置项和数据
    var option = {
        grid: {
            top: '5%',
            right: '1%',
            left: '1%',
            bottom: '10%',
            containLabel: true
        },
        tooltip: {
            trigger: 'axis'
        },
        xAxis: {
            type: 'category',
            data: ['周一','周二','周三','周四','周五','周六','周日']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            name:'用户量',
            data: [820, 932, 901, 934, 1290, 1330, 1320],
            type: 'line',
            smooth: true
        }]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main2'));

    // 指定图表的配置项和数据
    var option = {
        tooltip : {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        grid: {
            top: '5%',
            right: '2%',
            left: '1%',
            bottom: '10%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : ['周一','周二','周三','周四','周五','周六','周日']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'PV',
                type:'line',
                areaStyle: {normal: {}},
                data:[120, 132, 101, 134, 90, 230, 210],
                smooth: true
            },
            {
                name:'UV',
                type:'line',
                areaStyle: {normal: {}},
                data:[45, 182, 191, 234, 290, 330, 310],
                smooth: true,

            }
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);


    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main3'));

    // 指定图表的配置项和数据
    var option = {
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
        },
        series : [
            {
                name: '访问来源',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:335, name:'直接访问'},
                    {value:310, name:'邮件营销'},
                    {value:234, name:'联盟广告'},
                    {value:135, name:'视频广告'},
                    {value:1548, name:'搜索引擎'}
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };



    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main4'));

    // 指定图表的配置项和数据
    var option = {
        tooltip : {
            formatter: "{a} <br/>{b} : {c}%"
        },
        series: [
            {
                name: '硬盘使用量',
                type: 'gauge',
                detail: {formatter:'{value}%'},
                data: [{value: 88, name: '已使用'}]
            }
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
@endsection
