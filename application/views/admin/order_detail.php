<?php
/**
 * Description：后台订单详情页面
 * Author: LNC
 * Date: 2016/5/5
 * Time: 0:53
 */
$static_url = $this->config->item('static_url');
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


        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">

                        <div class="pricing-box col-sm-6 col-sm-offset-3">
                            <div class="widget-box widget-color-blue">
                                <div class="widget-header">
                                    <h5 class="widget-title bigger lighter">订单详情页面</h5>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="price">
                                            <b>机器品牌：</b>打印机 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>机器型号：</b>xxxx
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>问题描述：</b>xxxx
                                        </div><br>

                                        <div class="col-xs-12">
                                            <!-- PAGE CONTENT BEGINS -->
                                            <div style="text-align: center;">
                                                <ul class="ace-thumbnails clearfix">

                                                    <li>
                                                        <a href="<?php echo $static_url;?>/images/gallery/image-3.jpg"   target="_blank" class="cboxElement">
                                                            <img alt="150x150" src="<?php echo $static_url;?>/images/gallery/thumb-3.jpg">
                                                            <div class="text">
                                                                <div class="inner">查看大图</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $static_url;?>/images/gallery/image-3.jpg"   target="_blank" class="cboxElement">
                                                            <img alt="150x150" src="<?php echo $static_url;?>/images/gallery/thumb-3.jpg">
                                                            <div class="text">
                                                                <div class="inner">查看大图</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $static_url;?>/images/gallery/image-3.jpg"   target="_blank" class="cboxElement">
                                                            <img alt="150x150" src="<?php echo $static_url;?>/images/gallery/thumb-3.jpg">
                                                            <div class="text">
                                                                <div class="inner">查看大图</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $static_url;?>/images/gallery/image-3.jpg"   target="_blank" class="cboxElement">
                                                            <img alt="150x150" src="<?php echo $static_url;?>/images/gallery/thumb-3.jpg">
                                                            <div class="text">
                                                                <div class="inner">查看大图</div>
                                                            </div>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div><!-- PAGE CONTENT ENDS -->
                                        </div>
                                        <br><br><br><br><br><br><br>
                                        <hr>
                                        <div class="price">
                                            <b>上门耗时：</b>31分钟 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>调配件耗时：</b>76小时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>维修耗时：</b>76小时

                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>报修人：</b>打印机 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>联系电话：</b>xxxx
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>上门地址：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>
                                        <div class="well">
                                            <div class="price">
                                                <b>维修费用：</b>￥100
                                            </div>
                                            <div class="hr hr5 hr-double hr-dotted"></div>
                                            <h3>费用明细</h3><br>
                                            <div>
                                                维修项目一&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="right">删除</a><br><br>
                                                <span style="font-size: large;color: black">故障现象：这个就是故障</span><br>
                                                <span style="font-size: large;color: black">更换配件/耗材：是</span><br>
                                                <span style="font-size: large;color: black">配件/耗材价格：￥200</span><br>
                                                <span style="font-size: large;color: black">人工费：￥200</span><br>
                                            </div>
                                            <div class="hr hr5 hr-double hr-dotted"></div>
                                            <div>
                                                维修项目一&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="right">删除</a><br><br>
                                                <span style="font-size: large;color: black">故障现象：这个就是故障</span><br>
                                                <span style="font-size: large;color: black">更换配件/耗材：是</span><br>
                                                <span style="font-size: large;color: black">配件/耗材价格：￥200</span><br>
                                                <span style="font-size: large;color: black">人工费：￥200</span><br>
                                            </div>
                                            <div class="hr hr5 hr-double hr-dotted"></div>
                                            <div>
                                                维修项目一&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="right">删除</a><br><br>
                                                <span style="font-size: large;color: black">故障现象：这个就是故障</span><br>
                                                <span style="font-size: large;color: black">更换配件/耗材：是</span><br>
                                                <span style="font-size: large;color: black">配件/耗材价格：￥200</span><br>
                                                <span style="font-size: large;color: black">人工费：￥200</span><br>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <b>红包抵现：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>实际支付金额：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>成本：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>佣金：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>
                                            <b style="font-size: 24px">用户评价：</b><br><br>
                                            <span style="font-size: 16px">服务态度：</span>
                                        <img src="<?php echo $static_url?>/images/wjj.png" width="15px" height="15px">
                                        <img src="<?php echo $static_url?>/images/wjj.png" width="15px" height="15px">
                                        <img src="<?php echo $static_url?>/images/wjj.png" width="15px" height="15px">
                                        <br><br>
                                        <span style="font-size: 16px">技术能力：</span><img src="<?php echo $static_url?>/images/wjj.png" width="15px" height="15px">
                                        <hr>
                                        <div class="price">
                                            <b>用户投诉：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <b>取消原因：</b>深圳市南山区科信科技园
                                        </div>
                                        <hr>


                                    </div>

                                    <div>
                                        <a href="#" class="btn btn-block btn-success">
                                            <i class="ace-icon fa fa-bar-chart-o bigger-110"></i>
                                            <span>确认</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /section:pages/pricing.large -->
                    </div>

                    <div class="space-24"></div>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>

    </div>
    <?php
    $this->load->view('common/footer');
    ?>
</div><!-- /.main-container -->


<?php
$this->load->view('common/footer_js');
?>


