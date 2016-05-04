<?php
/**
 * Description：用户个人订单列表
 * Author: LNC
 * Date: 2016/5/4
 * Time: 23:56
 */

$this->load->view('common/header');
$this->load->view('common/nav');

?>
<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'user','second'=>'user'));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li class="active">订单管理</li>
                <li class="active">我的订单列表</li>
            </ul><!-- /.breadcrumb -->

        </div>
        <h4 class="pink">
            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
            <a href="<?php echo site_url('admin/user/index')?>" class="btn btn-success">返回用户管理 </a>
        </h4>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">

            <div class="row">

                <div class="col-sm-12">

                    <div class="space-6"></div>

                    <div class="widget-box">

                        <div class="row">
                            <div class="col-xs-12">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="center">订单号</th>
                                        <th class="center">订单状态</th>
                                        <th class="center">维修员工编号</th>
                                        <th class="center">下单时间</th>
                                        <th class="center">结束时间</th>
                                        <th class="center">分配类型</th>
                                        <th class="center">订单类型</th>
                                        <th class="center">订单金额</th>
                                        <th class="center">结款状态</th>
                                        <th class="center">操作</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach($orders as $order){?>
                                        <tr>
                                            <td class="center"><?php echo $order['id'] ?></td>
                                            <td class="center"><a href="<?php  echo site_url("admin/order/order_detail/{$order['id']}")?>"><?php echo $order['order_no'] ?></a></td>
                                            <td class="center"><?php
                                                if($order['status'] == 1){
                                                    echo '待上门';
                                                }elseif($order['status'] == 2){
                                                    echo '检测中';
                                                }elseif($order['status'] == 3){
                                                    echo '调配件';
                                                }elseif($order['status'] == 4){
                                                    echo '维修中';
                                                }elseif($order['status'] == 5){
                                                    echo '待点评';
                                                }elseif($order['status'] == 6){
                                                    echo '已结束';
                                                }elseif($order['status'] == 7){
                                                    echo '已取消';
                                                }?></td>
                                            <td class="center"><?php echo $order['repair_user_id'] ?></td>
                                            <td class="center"><?php echo date('Y-m-d H:i:s',$order['createtime']) ?></td>
                                            <td class="center"><?php echo date('Y-m-d H:i:s',$order['updatetime']) ?></td>
                                            <td class="center"><?php
                                                if($order['repair_assign'] == 1){
                                                    echo '随机指派';
                                                }elseif($order['repair_assign'] == 2){
                                                    echo '指定维修人员';
                                                } ?></td>
                                            <td class="center"><?php
                                                if($order['visit_option'] == 1){
                                                    echo '跟维修人员商定';
                                                }elseif($order['visit_option'] == 2){
                                                    echo '指定时间';
                                                }elseif($order['visit_option'] == 3){
                                                    echo '立即上门';
                                                }  ?></td>

                                            <td class="center"><?php echo $order['repair_money']  ?></td>

                                            <td class="center"><?php
                                                if($order['is_pay'] == 1){
                                                    echo '已经结款';
                                                }else{
                                                    echo '未结款';
                                                }  ?></td>

                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <?php

                                                    if($order['is_pay'] == 1){
                                                        $month_url = site_url("admin/order/order_pay/{$order['id']}/0/{$order['user_id']}");
                                                        echo '<a href="'.$month_url.'" onclick="return confirm(\'确认恢复为未结款吗？\')" class="btn btn-xs btn-primary">恢复为未结款</a>';
                                                    }else{
                                                        $month_url = site_url("admin/order/order_pay/{$order['id']}/1/{$order['user_id']}");
                                                        echo '<a href="'.$month_url.'" onclick="return confirm(\'确认设为已结款吗？\')" class="btn btn-xs btn-warning">设为已结款</a>';
                                                    }?>

                                                </div>


                                            </td>
                                        </tr>
                                    <?php } ?>


                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="dataTables_info" id="sample-table-2_info">Showing 1 to 10 of 23 entries</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="dataTables_paginate paging_bootstrap">
                                    <ul class="pagination">
                                        <li class="prev disabled">
                                            <a href="#">
                                                <i class="fa fa-angle-double-left">

                                                </i>
                                            </a>
                                        </li>
                                        <li class="prev disabled">
                                            <a href="#"><i class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        <li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div><!-- /.page-content -->
    </div><!-- /.main-content -->


    <?php

    $this->load->view('common/footer');
    ?>


    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->


<?php

$this->load->view('common/footer_js');
?>


