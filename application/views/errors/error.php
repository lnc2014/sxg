<?php
/**
 * Description：后台错误页面
 * Author: LNC
 * Date: 2016/4/24
 * Time: 14:54
 */
$this->load->view('common/header');
$this->load->view('common/nav');
?>
<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'','second' => ''));
    ?>
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo site_url('admin/admin/index')?>">主页</a>
                </li>
                <li class="active">子帐号管理</li>
            </ul><!-- /.breadcrumb -->

        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <!-- #section:pages/error -->
                    <div class="error-container">
                        <div class="well">
                            <h1 class="grey lighter smaller">
										<span class="blue bigger-125">
											<i class="ace-icon fa fa-random"></i>
											错误代码:<?php if(!empty($code)){echo $code;}else{echo'500';} ?>
										</span>
                                <?php if(!empty($msg)){echo $msg;}else{echo'未知错误！请联系管理员！';} ?>

                            </h1>

                <hr>
                <h3 class="lighter smaller">
                    But we are working
                    <i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125"></i>
                    on it!
                </h3>

                <div class="space"></div>

                <div>
                    <h4 class="lighter smaller">Meanwhile, try one of the following:</h4>

                    <ul class="list-unstyled spaced inline bigger-110 margin-15">
                        <li>
                            <i class="ace-icon fa fa-hand-o-right blue"></i>
                            Read the faq
                        </li>

                        <li>
                            <i class="ace-icon fa fa-hand-o-right blue"></i>
                            Give us more info on how this specific error occurred!
                        </li>
                    </ul>
                </div>

                <hr>
                <div class="space"></div>

                <div class="center">
                    <a href="javascript:history.back()" class="btn btn-grey">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Go Back
                    </a>

                    <a href="<?php echo site_url('admin/admin')?>" class="btn btn-primary">
                        <i class="ace-icon fa fa-tachometer"></i>
                        返回主页
                    </a>
                </div>
            </div>
        </div>

        <!-- /section:pages/error -->

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>
        </div>
    </div>
</div>