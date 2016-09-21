<?php
/**
 * Description:维修端订单列表
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">
<!--    顶部导航-->
    <div class="navbar" style="margin-bottom:66px ">
        <div class="bd" style="height: 100%;">
            <div class="weui_tab">
                <div class="weui_navbar">
                    <div class="weui_navbar_item <?php if(empty($status)){ echo 'weui_bar_item_on';}?>">
                        <a href="/index.php/repair/repair/order_list" style="text-decoration:none;color:#171616;">全部</a>
                    </div>
                    <div class="weui_navbar_item <?php if($status == 2){ echo 'weui_bar_item_on';}?>">
                        <a href="/index.php/repair/repair/order_list/2" style="text-decoration:none;color:#171616;">待上门</a>
                    </div>
                    <div class="weui_navbar_item <?php if($status == 3){ echo 'weui_bar_item_on';}?>">
                        <a href="/index.php/repair/repair/order_list/3" style="text-decoration:none;color:#171616;">维修中</a>
                    </div>
                    <div class="weui_navbar_item <?php if($status == 7){ echo 'weui_bar_item_on';}?>">
                        <a href="/index.php/repair/repair/order_list/7" style="text-decoration:none;color:#171616;">已结束</a>
                    </div>
                    <div class="weui_navbar_item <?php if($status == 8){ echo 'weui_bar_item_on';}?>">
                        <a href="/index.php/repair/repair/order_list/8" style="text-decoration:none;color:#171616;">已取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    列表-->
    <?php
    foreach($orders as $order){?>
        <div class="panel">
            <div class="bd">
                <div class="weui_panel weui_panel_access">
                    <a class="weui_panel_bd" href="/index.php/repair/repair/order_detail/<?php echo $order['id']; ?>" style="color: black;">
                        <div class="weui_media_box weui_media_small_appmsg">
                            <div class="weui_cells weui_cells_access">
                                <div class="weui_cell" >
                                    <div class="weui_cell_bd weui_cell_primary">
                                        <p style="margin-left: 10px;color: #f48000" ><b>
<!--                                               1,待接单2，待上门3,检测中4,调配件5,维修中6,待点评7,已结束8,已取消---->
                                        <?php
                                            if($order['status'] == 1){
                                                echo '待接单';
                                            }elseif($order['status'] == 2){
                                                echo '待上门';
                                            }elseif($order['status'] == 7){
                                                echo '已结束';
                                            }else{
                                                echo '维修中';
                                            }
                                            ?> </b></p>
                                    </div>
                                </div>
                                <div class="weui_cell" >
                                    <?php echo $order['user_name']?>&nbsp;&nbsp;<?php if($order['sex'] == 1){echo'先生';}else{echo'女士';}?>
                                    <img src="/static/wx/images/phone.png" alt="" style="width:20px;display:block">
                                    <?php echo $order['mobile']?>
                                </div>
                            </div>
                            <div class="weui_cell_hd">
                                <div class="weui_cell">
                                    <div class="weui_cell_hd">地址:</div>
                                    <div class="weui_cell_bd weui_cell_primary">
                                        <p style="margin-left: 10px;"><?php echo $order['province'].$order['city'].$order['area'].$order['street']?></p>
                                    </div>
                                </div>
                                <div class="weui_cell" style="color: #A5A1A1;">
                                    <div class="weui_cell_hd">上门时间:</div>
                                    <div class="weui_cell_bd weui_cell_primary">
                                        <p style="margin-left: 10px;"><?php
                                            if($order['visit_option'] == 1){//1为跟维修人员商定，2为指定时间,3为立即上门
                                                echo '跟维修人员商定';
                                            }else if($order['visit_option'] == 3){
                                                echo '立即上门';
                                            }else{
                                                echo date("Y-m-d H:i:s", $order['visit_time']);
                                            }
                                            ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                    <div class="weui_cell_hd">
                        <div class="weui_cell">
                            <a class="weui_btn" href="tel:<?php echo $order['mobile']?>" style="width:<?php if($order['status'] == 7 || $order['status'] == 8){echo '100%';}else{echo '50%'; }?>;background-color:#ea3e00" id="login">联系顾客</a>
                            &nbsp;&nbsp;
                            <?php
                            if($order['status'] == 1 || $order['status'] == 2){?>
                                <a class="weui_btn" style="width:50%;margin-top: 0;background-color:#f48000" id="reg">我已到达</a>
                            <?php }else if($order['status'] == 5 || $order['status'] == 3 || $order['status'] == 4){?>
                                <a href="/index.php/repair/repair/fill_repair_order/<?php echo $order['id']?>" class="weui_btn" style="width:50%;margin-top: 0;background-color:#f48000" id="reg">调配件</a>
                            <?php }elseif($order['status'] == 6) {?>
                                <a class="weui_btn" style="width:50%;margin-top: 0;background-color:#f48000" id="reg">待点评</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
$this->load->view('common/repair_footer');
?>