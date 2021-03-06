@extends('layouts.app')
@section('content')
<div class="span9">
    <div class="row-fluid">
        <div class="page-header">
            <h1>订单 <small>列表</small></h1>
            <div style="float: left; margin-top: 10px;">
                <form name="search_form" method="post" action="/order/find/all">
                    订单ID：<input type="text" name="id" class="input-mini"/> &nbsp;&nbsp;
                    广告名称：<input type="text" name="name" class="input-small" />&nbsp;&nbsp;
                    时间范围：
                    <input type="datetime" name="start-date" class="input-small"/>
                    -
                    <input type="datetime" name="end-date" class="input-small"/>
                    <input type="submit" name="searchbtn" value="开始查询" />
                </form>
            </div>
        </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>订单ID</th>
                <th>广告名称</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>点击需求量</th>
                <th>曝光需求量</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr class="list-users">
                <td>{{$order->id}}</td>
                <td>{{$order->title}}</td>
                <td>{{$order->start}}</td>
                <td>{{$order->end}}</td>
                <td>{{$order->click}}</td>
                <td>{{$order->flow}}</td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">操作<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="nav-header">编辑</li>
                            <li><a href="/order/edit/{{$order->id}}"><i class="icon-pencil"></i> 编辑<strong>订单详情</strong></a></li>
                            <!--                                        <li><a href="/order/delete/{{$order->id}}"><i class="icon-trash"></i> 删除</a></li>-->
                            <li class="nav-header">统计</li>
                            <li><a href="/hour/{{$order->id}}"><i class="icon-eye-open"></i>小时需求量<strong>统计图表</strong></a></li>
                            <li><a href="/hour-static/{{$order->id}}"><i class="icon-eye-open"></i>小时数据<strong>统计图表</strong></a></li>
                            <li><a href="/day-static/{{$order->id}}"><i class="icon-eye-open"></i>每日数据<strong>统计图表</strong></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="pagination">
        </div>
    </div>
</div>
</div>

<hr>
</div>

<script src="/../resources/js/jquery.js"></script>
<script src="/../resources/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropdown-menu li a').hover(
            function() {
                $(this).children('i').addClass('icon-white');
            },
            function() {
                $(this).children('i').removeClass('icon-white');
            });

        if($(window).width() > 760)
        {
            $('tr.list-users td div ul').addClass('pull-right');
        }
    });
</script>
</body>
</html>
@endsection
