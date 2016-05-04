<?php
/**
 * Description：用户管理页面
 * Author: LNC
 * Date: 2016/4/24
 * Time: 17:04
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
                                                <label class="col-lg-reset" for="user_name">用户账号（手机号）</label>
                                                <input type="text" class="input-large " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                            </div>
                                            <div class="input-group col-xs-3 inline">
                                            <label>状态</label>
                                            <select >
                                                <option value="AL">冻结</option>
                                                <option value="AK">正常</option>
                                            </select>
                                            </div>
                                            <div class="input-group col-xs-3 inline">
                                                <label>结算类型</label>
                                                <select >
                                                    <option value="AL">月结</option>
                                                    <option value="AK">非月结</option>
                                                </select>
                                            </div>
                                            <div class="space-6"></div>
                                            <div class="input-group col-xs-5 inline">
                                                <label >距上次下单</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <select class="input-large" >
                                                    <option value="AL">月结</option>
                                                    <option value="AK">非月结</option>
                                                </select>
                                                &nbsp;
                                                <input type="submit" class="btn btn-primary" value="导出">
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
                                        <th>用户账号</th>
                                        <th>所下订单</th>
                                        <th class="hidden-480">申请发票记录</th>
                                        <th class="hidden-480">结算类型</th>
                                        <th class="hidden-480">上次下单时间</th>
                                        <th class="hidden-480">状态</th>
                                        <th class="hidden-480">消费金额</th>
                                        <th class="hidden-480">距离上次下单</th>
                                        <th class="hidden-480">操作</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach($users as $user){?>
                                        <tr>
                                            <td class="center"><?php echo $user['user_id'] ?></td>
                                            <td><?php echo $user['user_name'] ?></td>
                                            <td class="hidden-480"><a href="<?php echo site_url("admin/order/user_order/{$user['user_id']}")?>" class="btn-primary">点击查看</a></td>

                                            <td class="hidden-480"><a href="<?php echo site_url("admin/invoice/user_invoice/{$user['user_id']}")?>" class="btn-success">点击查看</a></td>
                                            <td><?php if($user['is_month'] == 1){ echo '月结';}else{echo'非月结';}?></td>
                                            <td><?php echo date('Y-m-d H:i:s',time())?></td>
                                            <td><?php if($user['status'] == 1){ echo '正常';}else{echo'冻结';}?></td>
                                            <td>$562</td>
                                            <td>10天</td>
                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <?php

                                                    if($user['is_month'] == 1){
                                                        $month_url = site_url("admin/user/month_user/{$user['user_id']}/0");
                                                        echo '<a href="'.$month_url.'" onclick="return confirm(\'确认设为非月结账户吗？\')" class="btn btn-xs btn-info">设为非月结账户</a>';
                                                    }else{
                                                        $month_url = site_url("admin/user/month_user/{$user['user_id']}/1");
                                                        echo '<a href="'.$month_url.'" onclick="return confirm(\'确认设为月结账户吗？\')" class="btn btn-xs btn-success">设为月结账户</a>';
                                                    }?>


                                                    <?php
                                                    if($user['status'] == 1){
                                                        $user_url = site_url("admin/user/frozen_user/{$user['user_id']}/0");
                                                        echo '<a href="'.$user_url.'" onclick="return confirm(\'确认冻结该账号吗？\')" class="btn btn-xs btn-danger">冻结该账户</a>';
                                                    }else{
                                                        $user_url = site_url("admin/user/frozen_user/{$user['user_id']}/1");
                                                        echo '<a href="'.$user_url.'" onclick="return confirm(\'确认恢复该账号吗？\')" class="btn btn-xs btn-info">恢复该账户</a>';
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



