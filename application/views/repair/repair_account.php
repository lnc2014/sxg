<?php
/**
 * Description:维修端个人中心
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">

    <div class="repair_info">
        <div class="head_img">
            <img src="/static/wx/images/repairs/audit.png" style="width:100%;">
        </div>
        <div class="repair_name">
            <?php echo $repair['user_name'];?>
        </div>
        <div class="repair_number">
            工号：<?php echo $repair['repair_num'];?>
        </div>
    </div>

    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="/index.php/repair/repair/order_list" style="font-size: 20px">
            <div class="weui_cell_hd"><img src="/static/wx/images/repairs/my_order.png" alt="" style="width:35px;margin-right:5px;display:block"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的订单</p>
            </div>
        </a>
        <a class="weui_cell" href="javascript:;" style="font-size: 20px">
            <div class="weui_cell_hd"><img src="/static/wx/images/repairs/personal_data.png" alt="" style="width:35px;margin-right:5px;display:block"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>个人资料</p>
            </div>
        </a>
        <a class="weui_cell" href="javascript:;" style="font-size: 20px">
            <div class="weui_cell_hd"><img src="/static/wx/images/repairs/my_commission.png" alt="" style="width:35px;margin-right:5px;display:block"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的佣金</p>
            </div>
        </a>
        <a class="weui_cell" href="/index.php/repair/repair/repair_msg" style="font-size: 20px">
            <div class="weui_cell_hd"><img src="/static/wx/images/repairs/xiaoxi.png" alt="" style="width:35px;margin-right:5px;display:block"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>新消息通知</p>
            </div>
        </a>
    </div>
    <div class="weui_btn_area repair_input">
        <a class="weui_btn weui_btn_primary" href="/index.php/repair/repair/login_out" style="background-color:#ea3e00" id="reg">退出登录</a>
    </div>

</div>
<?php
$this->load->view('common/repair_footer');
?>