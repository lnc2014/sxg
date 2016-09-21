<?php
/**
 * Description：订单中心
 * Author: LNC
 * Date: 2016/4/24
 * Time: 17:04
 */
$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'order','second'=>'order'));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li class="active">用户管理</li>
            </ul><!-- /.breadcrumb -->

        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">

            <div class="row">

                <div class="col-sm-12">

                    <div class="space-6"></div>

                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="widget-title lighter">订单搜索</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="input-group col-xs-5 inline">
                                            <label >分配方式</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <select class="input-large" id="repair_assign">
                                                <option value="2">手动分配</option>
                                                <option value="1">随机分配</option>
                                            </select>
                                            &nbsp;
                                            <button class="btn btn-primary" onclick="search()">确认</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="center">订单号</th>
                                        <th class="center">下单时间</th>
                                        <th class="hidden-480">上门地址</th>
                                        <th class="hidden-480">订单类型</th>
                                        <th class="hidden-480">是否为转单</th>
                                        <th class="hidden-480">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($orders as $order){?>
                                        <tr>
                                            <td class="center"><?php echo $order['id']; ?></td>
                                            <td class="center"><a onclick="order_detail(<?php echo $order['id']; ?>)"><?php echo $order['order_no']; ?></a></td>
                                            <td class="hidden-480 center"><?php echo date("Y-m-d H:i:s", $order['createtime']); ?></td>
                                            <td><?php echo $order['address']; ?></td>
                                            <td class="hidden-480"><?php if($order['visit_option'] == 3) echo '立即上门';else echo '预约上门'; ?></td>
                                            <td class="hidden-480"><?php if($order['is_transfer'] == 1) echo '转单';else echo '不转单'; ?></td>
                                            <td class="hidden-480">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a href="/index.php/admin/order/order_offer?order_id=<?php echo $order['id'];?>" onclick="" class="btn btn-xs btn-info">分配</a>
                                                </div>
                                            </td>
                                        </tr>
                                  <?php }?>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
<!--                                <div class="dataTables_info" id="sample-table-2_info">Showing 1 to 10 of 23 entries</div>-->
                            </div>
                            <div class="col-xs-6">
                                <div class="dataTables_paginate paging_bootstrap">
                                    <ul class="pagination">
                                        <li class="prev <?php if($page == 1){ echo 'disable';} ?>">
                                            <a href="/index.php/admin/order/index?page=1"><i class="fa fa-angle-left"></i></a>
                                        </li>
                                        <?php
                                        for($i=1;$i<=$pages;$i++){?>
                                            <li <?php if($i == $page){ echo 'class = active';} ?>><a href="/index.php/admin/order/index?page=<?php echo $i; ?>"><?php echo $i?></a></li>
                                        <?php } ?>
                                        <li class="next"><a href="/index.php/admin/order/index?page=<?php echo $pages?>"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
    <style>
        .ui-widget-overlay {
            background: rgba(0,0,0,0.25);
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
            z-index: 1040 !important;
        }
        .ui-widget-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .ui-dialog .ui-dialog-buttonpane {
            text-align: left;
            border-width: 1px 0 0 0;
            background-image: none;
            margin-top: .5em;
            padding: .3em 1em .5em .4em;
        }
    </style>
    <div class="ui-widget-overlay ui-front" style="display: none" id="all_hidden"></div>
    <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable ui-resizable" id="order_detail"
         style="position: absolute; display: none; height: auto; width: 500px; top: 100px; left: 600px;" id="show_detail">
        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                <div class="widget-header widget-header-small">
                    <h4 class="smaller">
                        <i class="ace-icon fa fa-check"></i>订单详情
                    </h4>
                </div>
        </div>
        <div class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 28px; max-height: none; height: auto;">
            <div style="margin: 15px 15px 15px 15px">
            <span style="font-size: 14px" >
                 机器品牌:&nbsp;&nbsp;<b id="band">爱普生</b>
             </span>
              <span style="font-size: 14px" >
                 机器型号:&nbsp;&nbsp;<b id="model">爱普生</b>
             </span>
                <br><br>
            <span style="font-size: 14px" >
                 问题描述:&nbsp;&nbsp;<b id="problem">爱普生</b>
            </span>
                <br>
            <span>
                <div id="pics">

                </div>

            </span><br><br>
              <span style="font-size: 14px">
                 上门时间:&nbsp;&nbsp;<b id="time">爱普生</b>
             </span>
                <br><br>
             <span style="font-size: 14px">
                 报修人:&nbsp;&nbsp;<b id="name">爱普生</b>
             </span>
             <span style="font-size: 14px">
                 联系电话:&nbsp;&nbsp;<b id="phone">爱普生</b>
             </span>
                <br><br>
              <span style="font-size: 14px">
                 上门地址:&nbsp;&nbsp;<b id="address">爱普生</b>
             </span>
            </div>
            <div class="hr hr-12 hr-double"></div>
        </div>
        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
            <div class="ui-dialog-buttonset">
                    <span class="btn btn-primary" onclick="hidden_order_detail()" ">确认</span>
            </div>
        </div>
    </div><?php
    $this->load->view('common/footer');
    ?>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->
<?php
$this->load->view('common/footer_js');
?>
<script>
 function search(){
     var repair_assign = $('#repair_assign').val();
     window.location.href = '/index.php/admin/order/index?page=<?php echo $page?>&repair_assign='+repair_assign;
 }
$(function(){
    $("#test").live('click',function(){
        alert(222);
    });
    $("#test").imgbox({
        'speedIn'		: 0,
        'speedOut'		: 0,
        'alignment'		: 'center',
        'overlayShow'	: true,
        'allowMultiple'	: false,
        'autoScale'	: true
    });
});
function order_detail(order_id){
        $.ajax({
            type: "POST",
            url: "/index.php/admin/order/get_order_detail",
            data: {
                order_id: order_id
            },
            dataType: "json",
            success: function(json){
                if(json.result ==  '0000'){
                    var data = json.data;
                    $("#band").text(data.band);
                    $("#model").text(data.model);
                    $("#problem").text(data.problem);
                    $("#time").text(data.time);
                    $("#name").text(data.name);
                    $("#phone").text(data.phone);
                    $("#address").text(data.address);
                    $.each(data.pics, function(item, value){
                        var html = '<a id="test" href="'+value+'" title="" ><img  src="'+value+'" width="150px" height="300px"></a>';
                        $('#pics').append(html);
                    });
                    $("#all_hidden").css('display','block');
                    $("#order_detail").css('display','block');
                    $(function(){
                        $("#test").click(function(){
                            alert(222);
                        });
                        $("#test").imgbox({
                            'speedIn'		: 0,
                            'speedOut'		: 0,
                            'alignment'		: 'center',
                            'overlayShow'	: true,
                            'allowMultiple'	: false,
                            'autoScale'	: true
                        });
                    });

                }else {
                    alert(json.info);
                }
            },
            error: function(){
                alert('加载失败');
            }
        });
}
 function hidden_order_detail(){
     $("#all_hidden").css('display','none');
     $("#order_detail").css('display','none');
     $('#pics').html('');
 }
</script>