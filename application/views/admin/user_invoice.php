<?php
/**
 * Description：用户个人发票信息
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
                <li class="active">发票管理</li>
                <li class="active">我的发票列表</li>
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
                                        <th class="center">申请人账号</th>
                                        <th class="center">申请时间</th>
                                        <th class="center">发票金额</th>
                                        <th class="center">发票抬头</th>
                                        <th class="center">收件人</th>
                                        <th class="center">配送地址</th>
                                        <th class="center">联系电话</th>
                                        <th class="center">配送状态</th>
                                        <th class="center">配送方式</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach($invoices as $invoice){?>
                                        <tr>
                                            <td class="center"><?php echo $invoice['invoice_id'] ?></td>
                                            <td class="center"><?php echo $invoice['user_id'] ?></td>
                                            <td class="center"><?php echo date('Y-m-d H:i:s',time())?></td>
                                            <td class="center"><?php echo $invoice['invoice_money'] ?></td>
                                            <td class="center"><?php echo $invoice['invoice_header'] ?></td>
                                            <td class="center"><?php echo $invoice['name'] ?></td>
                                            <td class="center"><?php echo $invoice['province']. $invoice['city']. $invoice['area'].$invoice['street'] ?></td>
                                            <td class="center"><?php echo $invoice['mobile'] ?></td>
                                            <td class="center"><?php echo $invoice['delivery_way'] ?></td>
                                            <td class="center"><?php echo $invoice['delivery_way'] ?></td>

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


