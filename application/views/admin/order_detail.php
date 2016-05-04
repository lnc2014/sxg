<?php
/**
 * Description：后台订单详情页面
 * Author: LNC
 * Date: 2016/5/5
 * Time: 0:53
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
                <li class="active">订单详情</li>
            </ul><!-- /.breadcrumb -->

        </div>
        <h4 class="pink">
            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
            <a href="<?php echo site_url('admin/user/index')?>" class="btn btn-success">返回用户管理 </a>
        </h4>

        <?php

        var_dump($order);
        ?>


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

