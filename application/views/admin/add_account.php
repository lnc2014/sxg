<?php
/**
 * Description：后台账号管理
 * Author: LNC
 * Date: 2016/4/21
 * Time: 23:00
 */

$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php

    $this->load->view('common/sidebar',array('controller'=>'account'));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li >子帐号管理</li>
                <li class="active">
                    添加子帐号
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="<?php echo site_url('admin/admin/add_account')?>" class="btn btn-success">添加子帐号</a>
            </h4>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('admin/admin/add_account')?>">
                        <!-- #section:elements.form -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">账号：</label>

                            <div class="col-sm-9">
                                <input type="text" name="admin_name" placeholder="账号" class="col-xs-10 col-sm-5">
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">密码：</label>

                            <div class="col-sm-9">
                                <input type="text" name="admin_psw" placeholder="密码" class="col-xs-10 col-sm-5">
                            </div>
                        </div>


                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">密码：</label>

                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input name="admin_group[]" class="ace ace-checkbox-2" type="checkbox" value="1">
                                            <span class="lbl">订单中心</span>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="admin_group[]" class="ace ace-checkbox-2" type="checkbox" value="2">
                                            <span class="lbl">用户管理</span>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="admin_group[]" class="ace ace-checkbox-2" type="checkbox" value="3">
                                            <span class="lbl">运营方案</span>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="admin_group[]" class="ace ace-checkbox-2" type="checkbox" value="4">
                                            <span class="lbl">数据统计</span>
                                        </label>
                                    </div>
                                </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <input class="btn btn-info" type="submit" value=" 提交" />
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    重置
                                </button>
                            </div>
                        </div>


                    </form>
                </div><!-- /.col -->
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


