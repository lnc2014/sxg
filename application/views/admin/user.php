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
                                        <th class="center">
                                            ID
                                        </th>
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
                                    <tr>
                                        <td class="center">
                                            3                                </td>

                                        <td>22</td>
                                        <td class="hidden-480">22</td>

                                        <td class="hidden-480">
                                    <span class="label label-sm label-success">
                                        正常                                    </span>
                                        </td>
                                        <td>
                                            订单中心;用户管理;运营方案;
                                        </td>
                                        <td>
                                            订单中心;用户管理;运营方案;
                                        </td>
                                        <td>
                                            订单中心;用户管理;运营方案;
                                        </td>
                                        <td>
                                            订单中心;用户管理;运营方案;
                                        </td>
                                        <td>
                                            订单中心;用户管理;运营方案;
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group"> 
                                                <a href="http://127.0.0.1/sxg/index.php/admin/admin/frozen_account/3/0" onclick="return confirm('确认冻结该账号吗？')" class="btn btn-xs btn-info">冻结</a>
                                                <a href="http://127.0.0.1/sxg/index.php/admin/admin/delete_account/3" onclick="return confirm('确认删除该账号吗，该操作为不可恢复操作？')" class="btn btn-xs btn-danger">删除</a>
                                            </div>


                                        </td>
                                    </tr>

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



