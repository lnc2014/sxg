<?php
/**
 * Description:维修端信息中心
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">
    <?php
    if(empty($orders)){
        echo '<div class="navbar">
                <div class="bd" style="height: 100%;">
                    <div class="weui_tab">
                        <div class="weui_navbar">
                            <a class="weui_navbar_item" href="/index.php/repair/repair/order_list" style="color:inherit;">
                                我的订单列表
                            </a>
                            <a class="weui_navbar_item" href="/index.php/repair/repair/repair_account">
                                个人中心
                            </a>
                        </div>
                        <div class="weui_tab_bd">

                        </div>
                    </div>
                </div>
            </div>
            <div class="hd">
                <h1 class="page_title">暂无可接订单</h1>
            </div>
            ';
    }
    foreach($orders as $order){?>
        <a href="/index.php/repair/repair/order_detail/<?php echo $order['id']?>">
            <div class="weui_panel">
                <div class="weui_panel_bd" style="font-size: 20px;color: #f4b000;">
                    <div class="weui_media_box weui_media_text">
                        <div>
                            新订单提醒
                        </div>
                        <div class="weui_media_desc" style="position: absolute;top: 24px;right: 10px;">
                            <?php echo date('Y-m-d H:i:s', $order['createtime'])?>
                        </div>
                        <div class="weui_media_desc" style="margin-top: 24px;font-size: 15px;">
                            您收到一笔新的订单，点击查看详情
                        </div>
                        <div class="weui_media_desc" style="position: absolute;top: 72px;right: 10px;font-size: 15px;color: #f4b000;">
                            查看
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <br>
    <?php }?>

</div>


<?php
$this->load->view('common/repair_footer');
?>
<script>

</script>
