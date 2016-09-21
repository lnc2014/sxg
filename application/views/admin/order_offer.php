<?php
/**
 * Description：订单派单
 * Author: LNC
 * Date: 2016/4/24
 * Time: 17:04
 */
$this->load->view('common/header');
$this->load->view('common/nav');
?>

<div class="main-container" id="main-container">
    <?php
    $this->load->view('common/sidebar',array('controller'=>'order','second'=>''));
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
                            <h5 class="widget-title lighter">维修人员搜索</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-search">
                                    <div class="row">
                                        <div class="col-xs-5 col-sm-5">
                                            <div class="input-group col-xs-7 inline">
                                                <label class="col-lg-reset" for="user_name">工号</label>
                                                <input type="text" class="input-large " id="user_name">&nbsp;
                                                <input type="submit" class="btn btn-primary" value="搜索">
                                            </div>
                                        </div>
                                        <div class="col-xs-5 col-sm-5">
                                            <div class="input-group col-xs-5 inline">
                                                <label >筛选</label>
                                                <select class="input-large" >
                                                    <option value="AL">离线</option>
                                                    <option value="AK">在线</option>
                                                </select>
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
                                        <th>工号</th>
                                        <th class="hidden-480">最近定位位置</th>
                                        <th class="hidden-480">距客户距离</th>
                                        <th class="hidden-480">状态</th>
                                        <th class="hidden-480">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($repairs as $repair){?>
                                        <tr>
                                            <th class="center"><?php echo $repair['repair_user_id']?></th>
                                            <th><?php echo $repair['user_name']?></th>
                                            <th><?php echo $repair['repair_num']?></th>
                                            <th class="hidden-480">深圳市南山区金融科技大厦</th>
                                            <th class="hidden-480">100KM</th>
                                            <th class="hidden-480"><?php if($repair['status'] == 1){echo "正常";}elseif($repair['status'] == 1){echo "审核中";}else{echo "冻结";}?></th>
                                            <th class="hidden-480">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a href="javascript:;" onclick="off_order(<?php echo $order_id; ?>,<?php echo $repair['repair_user_id']?>)" class="btn btn-xs btn-success">分配订单</a>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php }?>

                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div>
<!--                        <div class="row">-->
<!--                            <div class="col-xs-6">-->
<!--                                <div class="dataTables_info" id="sample-table-2_info">Showing 1 to 10 of 23 entries</div>-->
<!--                            </div>-->
<!--                            <div class="col-xs-6">-->
<!--                                <div class="dataTables_paginate paging_bootstrap">-->
<!--                                    <ul class="pagination">-->
<!--                                        <li class="prev disabled">-->
<!--                                            <a href="#">-->
<!--                                                <i class="fa fa-angle-double-left">-->
<!---->
<!--                                                </i>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="prev disabled">-->
<!--                                            <a href="#"><i class="fa fa-angle-left"></i></a>-->
<!--                                        </li>-->
<!--                                        <li class="active"><a href="#">1</a></li>-->
<!--                                        <li><a href="#">2</a></li>-->
<!--                                        <li><a href="#">3</a></li>-->
<!--                                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>-->
<!--                                        <li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
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
    function off_order(order_id, repair_user_id){
        if(!order_id){
            alert('订单信息不正确');
            return;
        }
        if(!repair_user_id){
            alert('维修人员ID不能为空');
            return;
        }
        if(!confirm('确定分配该订单给该维修人员?')){
            return;
        }
        $.ajax({
            type: "POST",
            url: "/index.php/admin/order/order_offer_data",
            data: {
                order_id : order_id,
                repair_user_id : repair_user_id,
            },
            dataType: "json",
            success: function(json){
                if(json.result == '0000'){
                    alert(json.info);
                    window.location = '/index.php/admin/order/index';
                }else {
                    alert(json.info);
                }
            },
            error: function(){
                alert("加载失败");
            }
        });
    }
</script>


