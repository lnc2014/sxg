<?php
/**
 * Description:闪修哥订单详情页面，支付页面
 * Author: LNC
 * Date: 2016/5/30
 * Time: 23:06
 */
$this->load->view('common/wx_header',array('title'=>$title));
?>
<style>
    .btn_xl {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 50%;
        height: 2.5em;
        line-height: 2.5em;
        border-radius: 0;
    }
    .btn {
        color: #fff;
        font-size: 1.6em;
        background-color: #eb3d00;
        border-radius: 0.2em;
        height: 2.5em;
        line-height: 2.5em;
    }
    .btn_xl1 {
        position: fixed;
        bottom: 0;
        right: 0;
        width: 50%;
        height: 2.5em;
        line-height: 2.5em;
        border-radius: 0;
    }
    .btn1{
        color: #fff;
        font-size: 1.6em;
        background-color: #f48000;
        border-radius: 0.2em;
        height: 2.5em;
        line-height: 2.5em;
    }
</style>
<div class="container">
    <div class="order_detail_infos">
        <div class="order_group">
            <div class="ct_row">
                <span class="color_a8 s_title">订单状态：</span>
                <span class="s_status">
                    <?php if($order['order_status'] == 1){
                        echo '待接单';
                    }elseif($order['order_status'] == 2){
                        echo '待上门';
                    }elseif($order['order_status'] == 7){
                        echo '已结束';
                    }elseif($order['order_status'] == 8){
                        echo '已取消';
                    }else{
                        echo '维修中';
                    } ?></span>
            </div>
            <div class="ct_row">
                <span class="color_a8 s_title">下单时间：</span>
                <span class="color_base"><?php  echo date('Y-m-d H:i:s', $order['createtime'])?></span>
            </div>
            <div class="ct_row">
                <span class="color_a8 s_title">订 单 号：</span>
                <span class="color_base"><?php  echo $order['order_no']?></span>
            </div>
        </div>
<!--        只有已经结束才会出现维修单-->
        <?php if($order['order_status'] == 7){?>
            <div class="repair_group div_repair_price">
                <div class="d_row repair_price">
                    维修费用：<span class="color_price">¥<?php echo round($repair_info['parts_cost'] + $repair_info['labor_cost'], 2)?></span>
                    <img src="/static/wx/images/icon-arrow.png" class="float_right arror_r" >
                </div>
            </div>
            <div class="repair_group div_repair_project hide">
                <div class="repair_subject">
                    <div class="d_row color_base border_bottom">维修项目1</div>
                    <div class="sp_row color_a8"><span>机器品牌</span><span>机器型号</span></div>
                    <div class="sp_row sub_value">
                        <input type="text" name="input_device_name" disabled value="<?php echo $repair_info['repair_band']?>">
                        <input type="text" name="input_device_model" disabled value="<?php echo $repair_info['repair_model']?>>
                    </div>
                    <div class="sp_row color_a8"><span>故障现象</span></div>
                    <div class="sp_row">
                        <input type="text" name="input_device_fault" class="rsf_input" disabled value="<?php echo $repair_info['repair_problem']?>">
                    </div>
                    <div class="sp_row color_a8"><span>更换配件/耗材</span><span>人工费</span></div>
                    <div class="sp_row">
                        <select name="input_parts_replace" disabled>
                            <?php
                            if($repair_info['is_change_parts'] == 1){?>
                            <option value='1'>是</option>
                            <?php}else{
                            ?>
                            <option value='0'>否</option>
                            <?php }?>
                        </select>
                        <input type="text" name="input_device_labour" disabled value="<?php echo $repair_info['labor_cost']?>">
                    </div>
                    <div class="sp_row color_a8"><span>配件/耗材名称</span><span>配件/耗材价格</span></div>
                    <div class="sp_row">
                        <input type="text" name="input_parts_name" disabled value="<?php echo $repair_info['parts_name']?>">
                        <input type="text" name="input_parts_price" disabled value="<?php echo $repair_info['parts_cost']?>">
                    </div>
                </div>
            </div>
        <?php }?>
        <div class="order_group">
            <div class="ct_row">
                <span class="color_base"><?= $order['name'] ?><?php if($order['sex']==1){echo '先生';}else{echo '女士';}?></span>
                <a href="tel:<?= $order['mobile'] ?>"><img src="/static/wx/images/phone.png" class="img_phone" ><span class="phone_num"><?= $order['mobile'] ?></span></a>
            </div>
            <div class="ct_row">
                <span class="color_a8">地址：</span>
                <span class="color_base"><?php  echo $order['province'].$order['city'].$order['area'].$order['street']?></span>
            </div>
        </div>
        <div class="repair_group">
            <div class="d_row">
                <span class="color_a8 r_title">上门时间</span>
                <span class=""><?php if($order['visit_option'] == 2){ echo date('Y-m-d H:i:s',$order['visit_time']);}elseif($order['visit_option'] == 3){echo '立即上门';}else{echo'跟维修人员商定';} ?></span>
            </div>
        </div>
        <div class="repair_group">
            <div class="d_row d_title border_bottom">订单详情</div>
            <div class="d_row color_base border_bottom">维修机器1</div>
            <div class="d_row color_base border_bottom">机器品牌:<?php echo $order['print_band']?>&nbsp;&nbsp;机器型号:<?php echo $order['print_model']?></div>
            <div class="d_row color_base">故障描述:<?php echo $order['repair_info']?></div>
        </div>
        <div class="repair_group remark_gp">
            <div class="d_row color_a8">备注:<?php echo $order['remark'] ?></div>
        </div>
    </div>
    <?php if($order['order_status'] != 7){?>
    <div class="align_center">
        <a href="javascript:;" onclick="finish(<?php echo $order['id']?>)"><button class="btn btn_xl" type="button">维修结束</button></a>
        <a href="/index.php/repair/repair/fill_repair_order/<?php echo $order['id']?>"><button class="btn1 btn_xl1" type="button">调配件</button></a>
    </div>
    <?php }?>
</div>
<script type="text/javascript" src="/static/wx/js/zepto.min.js"></script>
<script type="text/javascript">
    $(".repair_price").on("click",function(){
        var rep = $(".div_repair_project");
        if(!rep.hasClass("hide")) {
            rep.addClass("hide");
            $(".repair_price .arror_r").removeClass("rx");
        } else {
            rep.removeClass("hide");
            $(".repair_price .arror_r").addClass("rx");
        }
    });
    function finish(order_id){
        if(!confirm('确定结束维修?')){
            return;
        }
        if(!order_id){
            alert('订单ID不能为空！');
            return;
        }
        $.ajax({
            type: "POST",
            url: "/index.php/repair/repair/finish_repair",
            data: {
                order_id : order_id
            },
            dataType: "json",
            success: function(json){
                if(json.result == '0000'){
                    alert(json.info);
                    window.location = '/index.php/repair/repair/order_list';
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
</body>
</html>