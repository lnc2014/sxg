<?php
/**
 * Description：维修人审核页面
 * Author: LNC
 * Date: 2016/4/24
 * Time: 17:04
 */
$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'repair','second'=>'repair_check'));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li class="active">维修人员审核</li>
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
                                                <label class="col-lg-reset" for="user_name">申请人姓名</label>
                                                <input type="text" class="input-small " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                                <label class="col-lg-reset" for="user_name">申请人手机号</label>
                                                <input type="text" class="input-small " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                                <input type="submit" class="btn btn-primary" value="查看全部">
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
                                        <th  class="center">申请人姓名</th>
                                        <th  class="center">申请人手机号</th>
                                        <th  class="center">申请时间</th>
                                        <th  class="center">操作</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach($repairs as $repair){?>
                                        <tr>
                                            <td class="center"><?php echo $repair['repair_user_id'] ?></td>
                                            <td class="center"><?php echo $repair['user_name'] ?></td>
                                            <td class="center"><?php echo $repair['mobile'] ?></td>
                                            <td class="center"><?php echo date('Y-m-d H:i:s',time())?></td>
                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <?php
                                                    if($repair['status'] == 2){
                                                        $repair_url = site_url("admin/repair/pass_check/{$repair['repair_user_id']}");
                                                        echo '<a href="'.$repair_url.'" onclick="return confirm(\'通过审核吗？\')" class="btn btn-xs btn-warning">通过审核</a>';
                                                    }else{
                                                        echo '正常';
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



