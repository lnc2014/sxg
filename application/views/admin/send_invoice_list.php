<?php
/**
 * Description：订单分配列表
 * Author: LNC
 * Date: 2016/4/24
 * Time: 17:04
 */
$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'order','second'=>'send_invoice_list'));
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
                            <h5 class="widget-title lighter">用户搜索</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-search">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="input-group col-xs-5 inline">
                                                <label >分配方式</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <select class="input-large" >
                                                    <option value="AL">手动分配</option>
                                                    <option value="AK">随机分配</option>
                                                </select>
                                                &nbsp;
                                                <input type="submit" class="btn btn-primary" value="确认">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th>订单号</th>
                                        <th>下单时间</th>
                                        <th class="hidden-480">上门地址</th>
                                        <th class="hidden-480">订单类型</th>
                                        <th class="hidden-480">是否为转单</th>
                                        <th class="hidden-480">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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



