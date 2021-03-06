<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title>全量曲线图</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../resources/css/bootstrap.css" rel="stylesheet">
    <link href="/../resources/css/site.css" rel="stylesheet">
    <link href="/../resources/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="https://img.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
    <script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>
    <script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>
    <script src="https://img.hcharts.cn/highcharts/modules/data.js"></script>
    <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="/">主页</a>
            <div class="btn-group pull-right">
                <a class="btn" href="#"><i class="icon-user"></i> </a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                    <li class="nav-header"><i class="icon-wrench"></i>订单管理</li>
                    <li><a href="/order/add">新增订单</a></li>
                    <li><a href="/order">订单列表</a></li>
                    <!--                <li><a href="/order/hour/list">订单小时需求量</a></li>
                                    <li><a href="/url-manage">订单链接管理</a></li>-->
                    <li class="nav-header"><i class="icon-signal"></i>数据统计</li>
                    <li><a href="/orderStaticList">订单统计</a></li>
                    <li><a href="/all-statistic">全量数据统计</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="page-header">
                <h1>全量图表</h1>
                <div style="float: left; margin-top: 30px;">
                    <form name="search_form" method="post" action="/all-statistic/total/find">
                        时间范围：
                        <input type="datetime" name="start-date" class="input-small"/>
                        -
                        <input type="datetime" name="end-date" class="input-small"/>
                        <input type="submit" name="searchbtn" value="开始查询" />
                    </form>
                </div>
            </div>
            <div id="container" style="min-width: 400px;height: 400px;"></div>
            <div class="message"></div>
        </div>
    </div>
</div>
<script>
    var chart = new Highcharts.Chart('container', {
        title: {
            text: "全量统计",
            x: -20
        },
        subtitle: {
            text: '数据来源: 后台数据库',
            x: -20
        },
        xAxis: {
            tickInterval: 5 * 24 * 3600 * 1000,
            type:'datetime',
            /*dateTimeLabelFormats: {
             millisecond: '%H:%M:%S.%L',
             second: '%H:%M:%S',
             minute: '%H:%M',
             hour: '%H:%M',
             day: '%m-%d',
             week: '%m-%d',
             month: '%Y-%m',
             year: '%Y'
             },*/
//            categories: <?php //echo $xdata;?>//,
            title: {
                enabled:true,
                text:'日期'
            }
        },
        /*tooltip: {
         dateTimeLabelFormats: {
         millisecond: '%H:%M:%S.%L',
         second: '%H:%M:%S',
         minute: '%H:%M',
         hour: '%H:%M',
         day: '%Y-%m-%d',
         week: '%m-%d',
         month: '%Y-%m',
         year: '%Y'
         }
         },*/
        yAxis: {
            title: {
                text: '数量'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '数量'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
            <?php echo $ydata;?>,
            <?php echo $ydata2;?>,
            <?php echo $ydata3;?>,
            <?php echo $ydata4;?>,
            <?php echo $ydata5;?>,
            <?php echo $ydata6;?>,
            <?php echo $ydata7;?>,
            <?php echo $ydata8;?>,
        ]
    });
</script>
</body>
</html>
