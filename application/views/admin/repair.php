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
    $this->load->view('common/sidebar',array('controller'=>'repair','second'=>'user'));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li class="active">维修人员管理</li>
            </ul><!-- /.breadcrumb -->

        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">

            <div class="row">

                <div class="col-sm-12">

                    <div class="space-6"></div>

                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="widget-title lighter">维修人员搜索</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-search">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">

                                            <div class="input-group col-xs-6 inline">
                                                <label class="col-lg-reset" for="user_name">维修人员账号</label>
                                                <input type="text" class="input-small " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                                <label class="col-lg-reset" for="user_name">工号</label>
                                                <input type="text" class="input-small " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                                <label class="col-lg-reset" for="user_name">姓名</label>
                                                <input type="text" class="input-small " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                                <input type="submit" class="btn btn-primary" value="查看全部">
                                            </div>
                                            <div class="input-group col-xs-2 inline">
                                            <label>账号状态</label>
                                            <select >
                                                <option value="AL">冻结</option>
                                                <option value="AK">正常</option>
                                            </select>
                                            </div>
                                            <div class="space-6"></div>
                                            <div class="input-group col-xs-5 inline">
                                                <label >排序</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                        <th>姓名</th>
                                        <th>账号</th>
                                        <th class="hidden-480">接单数量</th>
                                        <th class="hidden-480">账号状态</th>
                                        <th class="hidden-480">个人评分</th>
                                        <th class="hidden-480">累计总佣金</th>
                                        <th class="hidden-480">转单数</th>
                                        <th class="hidden-480">操作</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach($repairs as $repair){?>
                                        <tr>
                                            <td class="center"><?php echo $repair['repair_user_id'] ?></td>
                                            <td class="center"><?php echo $repair['user_name'] ?></td>
                                            <td class="center"><?php echo $repair['account'] ?></td>
                                            <td class="center"><?php echo $repair['order_num'] ?></td>
                                            <td class="center"><?php if($repair['status'] == 1){ echo '正常';}elseif($repair['status'] == 2){echo'待审核';}else{echo'冻结';}?></td>
                                            <td class="center"><?php echo $repair['score'] ?></td>
                                            <td class="center"><?php echo $repair['commission'] ?></td>
                                            <td class="center"><?php echo $repair['trans_num'] ?></td>
                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <?php
                                                    if($repair['status'] == 1){
                                                        $repair_url = site_url("admin/user/frozen_user/{$repair['repair_user_id']}/0");
                                                        echo '<a href="'.$repair_url.'" onclick="return confirm(\'确认冻结该账号吗？\')" class="btn btn-xs btn-danger">冻结该账户</a>';
                                                    }else{
                                                        $repair_url = site_url("admin/user/frozen_user/{$repair['repair_user_id']}/1");
                                                        echo '<a href="'.$repair_url.'" onclick="return confirm(\'确认恢复该账号吗？\')" class="btn btn-xs btn-info">恢复该账户</a>';
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



