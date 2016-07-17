<?php
/**
 * Description：订单中心
 * Author: LNC
 * Date: 2016/4/24
 * Time: 17:04
 */
$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'order','second'=>'order'));
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
                            <h5 class="widget-title lighter">订单搜索</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="input-group col-xs-5 inline">
                                            <label >分配方式</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <select class="input-large" id="repair_assign">
                                                <option value="2">手动分配</option>
                                                <option value="1">随机分配</option>
                                            </select>
                                            &nbsp;
                                            <button class="btn btn-primary" onclick="search()">确认</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th class="center">订单号</th>
                                        <th class="center">下单时间</th>
                                        <th class="hidden-480">上门地址</th>
                                        <th class="hidden-480">订单类型</th>
                                        <th class="hidden-480">是否为转单</th>
                                        <th class="hidden-480">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($orders as $order){?>
                                        <tr>
                                            <td class="center"><?php echo $order['id']; ?></td>
                                            <td class="center"><?php echo $order['order_no']; ?></td>
                                            <td class="hidden-480 center"><?php echo date("Y-m-d H:i:s", $order['createtime']); ?></td>
                                            <td><?php echo $order['address']; ?></td>
                                            <td class="hidden-480"><?php if($order['visit_option'] == 3) echo '立即上门';else echo '预约上门'; ?></td>
                                            <td class="hidden-480"><?php if($order['is_transfer'] == 1) echo '转单';else echo '不转单'; ?></td>
                                            <td class="hidden-480">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a href="#" onclick="" class="btn btn-xs btn-info">分配</a>
                                                </div>
                                            </td>
                                        </tr>
                                  <?php }?>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
<!--                                <div class="dataTables_info" id="sample-table-2_info">Showing 1 to 10 of 23 entries</div>-->
                            </div>
                            <div class="col-xs-6">
                                <div class="dataTables_paginate paging_bootstrap">
                                    <ul class="pagination">
                                        <li class="prev <?php if($page == 1){ echo 'disable';} ?>">
                                            <a href="/index.php/admin/order/index?page=1"><i class="fa fa-angle-left"></i></a>
                                        </li>
                                        <?php
                                        for($i=1;$i<=$pages;$i++){?>
                                            <li <?php if($i == $page){ echo 'class = active';} ?>><a href="/index.php/admin/order/index?page=<?php echo $i; ?>"><?php echo $i?></a></li>
                                        <?php } ?>
                                        <li class="next"><a href="/index.php/admin/order/index?page=<?php echo $pages?>"><i class="fa fa-angle-right"></i></a></li>
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
<script>
 function search(){
     var repair_assign = $('#repair_assign').val();
     window.location.href = '/index.php/admin/order/index?page=<?php echo $page?>&repair_assign='+repair_assign;
 }
</script>