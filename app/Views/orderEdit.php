@extends('layouts.app')
@section('content')
<style>
    .span9 ul{overflow:hidden;width:100%;}
    .span9 ul li{width:8.333%;float:left;}
</style>
<div class="span9">
    <div class="row-fluid">
        <div class="page-header">
            <h1>订单 <small>修改</small></h1>
        </div>
        <form class="form-horizontal" method="post" action="/order/edit/complete">
            <fieldset>
                <input name="id" type="hidden" value="{{$order[0]->id}}">
                <div class="control-group">
                    <label class="control-label" for="name">广告名称</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="name" name="title" value="{{$order[0]->title}}"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="start">开始时间</label>
                    <div id="datetimepicker1" class="input-append date form_datetime" style="margin-left: 20px">
                        <input type="text" class="input-xlarge" id="start" name="start"  value="{{$order[0]->start}}"/>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="end">结束时间</label>
                    <div id="datetimepicker2" class="input-append date form_datetime" style="margin-left: 20px">
                        <input type="text" class="input-xlarge" id="end" name="end" value="{{$order[0]->end}}"/>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="click">总点击需求量</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="click" name="click" value="{{$order[0]->click}}"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="clickUrl">点击链接</label>
                    <div class="controls">
                        @if($order[0]->click == 0)
                        <input type="text" class="input-xlarge" id="clickUrl" name="clickUrl" value=""/>
                        @else
                        <input type="text" class="input-xlarge" id="clickUrl" name="clickUrl" value="{{$order[1][0]['url']}}"/>
                        @endif
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="flow">总曝光需求量</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="flow" name="flow" value="{{$order[0]->flow}}"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="flowUrl">曝光链接</label>
                    <div class="controls">
                        @if($order[0]->flow == 0)
                        <input type="text" class="input-xlarge" id="flowUrl" name="flowUrl" value="" />
                        @else
                        <input type="text" class="input-xlarge" id="flowUrl" name="flowUrl" value="{{$order[1][1]['url']}}" />
                        @endif
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">点击</label>
                    <br>
                    <div class="click_hour_class">
                        <ul>
                            @for($i = 0;$i<24;$i++)
                            <li style="list-style-type: none;">
                                <input type="text" class="input-mini" id="hour_click" name="click_hour[]" value="{{$order[0]->orderHour[$i]['click']}}"/>
                                <br>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">曝光</label>
                    <br>
                    <div class="flow_hour_class">
                        <ul>
                            @for($i = 0;$i<24;$i++)
                            <li style="list-style-type: none;">
                                 <input type="text" class="input-mini-flow" id="hour_flow" name="flow_hour[]" value="{{$order[0]->orderHour[$i]['flow']}}"/>
                                <br>
                            </li>
                            @endfor
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary" onclick="average()" type="button" name="init" id="init">均分设置</button>
                <input name="init" id="init" type="hidden"/>
                <hr>
                <div class="control-group">
                    <label class="control-label" for="active">类型</label>
                    <div class="controls">
                        <label style="float: left">
                            <input type="radio" name="type" value="0" checked> 不替换(默认)
                        </label>
                        <label style="float: left">
                            <input type="radio" name="type" value="1"> 替换
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="remark">其他说明</label>
                    <div class="controls">
                        <textarea name="remark">{!! $order[0]->remark !!}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-success" value="修改" /> <a class="btn" href="/order">取消</a>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</div>

<hr>
</div>

<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
<script>
    function average()
    {
        var click = $("#click").val();
        var flow  = $("#flow").val();
        var click_avg = Math.floor(click/24);
        var flow_avg  = Math.floor(flow/24);
        $('.click_hour_class ul li .input-mini').each(function(i,item) {
            $(this).attr('value',click_avg);
        });
        $('.flow_hour_class ul li .input-mini-flow').each(function(i,item) {
            $(this).attr('value',flow_avg);
        });
    }
    $().ready(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss',
            language: 'ch',
            autoclose:true,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss',
            language: 'ch',
            autoclose:true,
        });
        $.validator.addMethod("compareDate",function(value,element){
            var assigntime = $("#start").val();
            var deadlinetime = $("#end").val();
            var reg = new RegExp('-','g');
            assigntime = assigntime.replace(reg,'/');//正则替换
            deadlinetime = deadlinetime.replace(reg,'/');
            assigntime = new Date(parseInt(Date.parse(assigntime),10));
            deadlinetime = new Date(parseInt(Date.parse(deadlinetime),10));
            console.log(1);
            if(assigntime>deadlinetime){
                return false;
            }else{
                return true;
            }
        });
        $.validator.addMethod("isProper",function(value,element){
            var click = $("#click").val();
            var flow = $("#flow").val();
            var clickUrl = $("#clickUrl").val();
            var flowUrl = $("#flowUrl").val();

            if(click == 0 && flow == 0 || clickUrl == '' && flowUrl == '') {
                return false;
            } else {
                return true;
            }
        });
        $.validator.addMethod("hasClickLink",function(value,element){
            var click = $("#click").val();
            var clickUrl = $("#clickUrl").val();

            if(click != 0 && clickUrl == '') {
                return false;
            }
            return true;
        });
        $.validator.addMethod("hasFlowLink",function(value,element){
            var flow = $("#flow").val();
            var flowUrl = $("#flowUrl").val();

            if( flow != 0 && flowUrl == '') {
                return false;
            }
            return true;
        });
        $.validator.addMethod("hasClickLink2",function(value,element){
            var click = $("#click").val();
            var clickUrl = $("#clickUrl").val();

            if(click == 0 && clickUrl != '') {
                return false;
            }
            return true;
        });
        $.validator.addMethod("hasFlowLink2",function(value,element){
            var flow = $("#flow").val();
            var flowUrl = $("#flowUrl").val();

            if( flow == 0 && flowUrl != '') {
                return false;
            }
            return true;
        });
        $.validator.addMethod("initClick",function(value,element){
            var click = $("#click").val();
            $('.click_hour_class ul li .input-mini').each(function(i,item) {
                if(item.value == 0) {
                    $flag = 0;
                }
            });
            if( click != 0 && !$flag) {
                return false;
            } else {
                return true;
            }
        });
        $.validator.addMethod("initFlow",function(value,element){
            var flow = $("#flow").val();
            $('.flow_hour_class ul li .input-mini-flow').each(function(i,item) {
                if(item.value == 0) {
                    $flag = 0;
                }
            });
            if( flow != 0 && !$flag) {
                return false;
            } else {
                return true;
            }
        });
// 在键盘按下并释放及提交后验证提交表单
        $("#order").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 1,
                    maxlength: 50
                },
                start: {
                    required: true,
                    date: true
                },
                end: {
                    required:true,
                    date: true,
                    compareDate: true
                },
                clickUrl: {
                    url: true,
                    hasClickLink: true,
                    hasClickLink2: true
                },
                flowUrl: {
                    url: true,
                    isProper: true,
                    hasFlowLink: true,
                    hasFlowLink2: true
                },
                click: {
                    required:true,
                    min: 0,
                    initClick: true
                },
                flow: {
                    required:true,
                    min: 0,
                    initFlow: true
                },

            },
            messages: {
                title: {
                    required: "请输入您的广告名",
                    maxlength: "最多能输入50个字"
                },
                start: {
                    required: "请输入开始时间",
                    date: "开始时间格式不正确"
                },
                end: {
                    required: "请输入结束时间",
                    date: "结束时间格式不正确",
                    compareDate: "结束时间不能小于开始时间"
                },
                clickUrl: {
                    url: "您所输入的链接格式不正确",
                    hasClickLink: "当曝光量不为0时，链接不能为空",
                    hasClickLink2: "当曝光量为0时，链接应该为空"
                },
                flowUrl: {
                    url: "您所输入的链接格式不正确",
                    isProper: "点击链接以及曝光链接不能同时为空",
                    hasFlowLink: "当曝光量不为0时，链接不能为空",
                    hasFlowLink2: "当曝光量为0时，链接应该为空"
                },
                click: {
                    required: "请输入点击量",
                    max: "不能为负数",
                    initClick: "请注意初始化每小时率"
                },
                flow: {
                    required: "请输入曝光量",
                    max: "不能为负数",
                    initFlow: "请注意初始化每小时率"
                }
            }
        });
    });
</script>
<style>
    .error{
        color:red;
    }
</style>
</body>
</html>
@endsection