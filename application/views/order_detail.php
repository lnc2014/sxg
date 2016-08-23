<?php
/**
 * Description:闪修哥快速下单
 * Author: LNC
 * Date: 2016/5/30
 * Time: 23:06
 */
$this->load->view('common/wx_header',array('title'=>$title));

?>
<style>
    .div_address { background: url(/static/wx/images/bg_address.png) no-repeat; background-size: 100% 100%;}
    input[type='radio'] { margin-right: 0.3em; margin-top: -0.1em; background: url(/static/wx/images/radio.png) no-repeat; background-size: 100% 100%; }
    input[type='radio']:checked { background: url(/static/wx/images/radio_checked.png) no-repeat; background-size: 100% 100%; }

</style>
<body>
<div class="container">
    <?php if(empty($address)){?>
        <div class="div_address no_addr" onclick="location.href='/index.php/sxg/address/<?php echo $order_id?>'">
            <div class="default">请填写地址</div>
            <span class="arrow"></span>
            <input type="hidden" value="<?= $address['address_id'] ?>" id="address">
        </div>
        <?php }else{ ?>
        <div class="div_address no_addr" onclick="location.href='/index.php/sxg/address/<?php echo $order_id?>'">
            <div class="contact"><?= $address['name'] ?><?php if($address['sex']==1){echo '先生';}else{echo '女士';}?> &nbsp;&nbsp; <?= $address['mobile'] ?></div>
            <div class="address color_base">地址：<?php  echo $address['province'].$address['city'].$address['area'].$address['street']?></div>
            <span class="arrow"></span>
            <input type="hidden" value="<?= $address['address_id'] ?>" id="address">
        </div>
    <?php }?>

    <div class="div_maintenance">
        <div class="main_n border_bottom">
            <div class="main_l float_left">维修员</div>
            <div class="main_r float_left color_base">
                <div class="main_option border_bottom"><label><input name="maintenance_man" type="radio" checked value="1" id="rand_point">随机指派<label></div>
                <div class="main_option">
                    <label><input type="radio" id="stable_point" name="maintenance_man" value="2">指定维修人员</label><br>
                    <input type="text" placeholder="请输入维修员工号" id="repair_id" class="input_designated">
                </div>
            </div>
        </div>
        <div class="main_t border_bottom">
            <div class="main_l float_left">上门时间</div>
            <div class="main_r float_left color_base">
                <select class="select_visit">
                    <option value="1">立即上门（快马加鞭）</option>
                    <option value="2">指定时间</option>
                </select>
                <i></i>
                <div class="uncertain">上门时间请于指定维修员协商</div>
            </div>
        </div>
        <div class="main_t border_bottom" id="is_point_time" style="display: none;">
            <div class="main_l float_left">指定时间</div>
            <div class="main_r float_left color_base">
<!--                <input style="margin-top: 10px"  type="datetime-local" value="" placeholder="">-->
                <input class="weui_input" style="margin-top: 10px"  id="point_time" type="datetime-local" name="start_time" id="start_time" value="" placeholder="请选择出发时间">
            </div>
        </div>
    </div>
    <div class="div_order_detail">
        <div class="d_row d_title border_bottom">订单详情</div>
        <div class="d_row color_base border_bottom">维修机器1</div>
        <div class="d_row color_base border_bottom">机器品牌:<?php echo $repair_detail['print_band']?>&nbsp;&nbsp;机器型号:<?php echo $repair_detail['print_model']?></div>
        <div class="d_row color_base">故障描述:<?php echo $repair_detail['repair_info']?></div>
    </div>

    <div class="remarks">
        <textarea class="textarea_remark" placeholder="备注" id="remark"></textarea>
    </div>
    <div class="align_center">
        <button class="btn btn_l" type="button" id="submit">信息无误，立即报修</button>
    </div>
</div>

<style>
    .weui_mask {
        position: fixed;
        z-index: 1000;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.6);
    }
    .weui_dialog {
        position: fixed;
        z-index: 5000;
        width: 85%;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background-color: #FAFAFC;
        text-align: center;
        border-radius: 3px;
        overflow: hidden;
    }
    .weui_dialog_hd {
        padding: 1.2em 0 .5em;
    }
    .weui_dialog_bd {
        padding: 0 20px;
        font-size: 15px;
        color: #888;
        word-wrap: break-word;
        word-break: break-all;
    }
    .weui_dialog_ft {
        position: relative;
        line-height: 42px;
        margin-top: 20px;
        font-size: 17px;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
    }
    .weui_dialog_ft a {
        display: block;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        flex: 1;
        color: #eb3d00;
        text-decoration: none;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
</style>
<div class="weui_dialog_alert" id="show_order_detail" style="display: none">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">报修成功</strong></div>
        <div class="weui_dialog_bd">恭喜您，报修成功！请保持电话畅通，维修工程师会尽快跟您联系！</div>
        <div class="weui_dialog_ft">
            <a href="/index.php/sxg/my_order_list" class="weui_btn_dialog primary">确定</a>
        </div>
    </div>
</div>
<input type="hidden" id="is_rand_point" value="1">
<input type="hidden" id="is_stable_point" value="0">
<input type="hidden" id="" value="1">
<script type="text/javascript" src="/static/wx/js/zepto.min.js"></script>
<script type="text/javascript">
    $("[name='maintenance_man']").on("click",function(){
        if($(this).is(":checked") && $(this).val() == "2") {
            $(".div_maintenance").addClass("designated");
        } else {
            $(".div_maintenance").removeClass("designated");
        }
    });
</script>
<script>
    $(function(){
        $('#rand_point').click(function(){
            $('#is_rand_point').val(1);
            $('#is_stable_point').val(0);
        });
        $('#stable_point').click(function(){
            $('#is_stable_point').val(1);
            $('#is_rand_point').val(0);
        });
        //上门时间
        var visit_time = $('.select_visit').val();
        $('.select_visit').change(function(){
            visit_time = $('.select_visit').val();
            if(visit_time == 2){
                $('#is_point_time').css('display','block');
            }else {
                $('#is_point_time').css('display','none');
            }
        });

        $('#submit').click(function(){
            var address_id = $('#address').val();
            var remark = $('#remark').val();
            if(!address_id){
                alert('地址信息不能为空！');
                return;
            }
            //指派维修人员
            var is_rand_point = $('#is_rand_point').val();
            var is_stable_point = $('#is_stable_point').val();
            var repair_assign = 1;
            var repair_user_id = 0;

            if(is_rand_point == 1){
                repair_assign = 1;
            }else if(is_stable_point == 1){
                repair_assign = 2;
                var repair_user_id = $('#repair_id').val();
                if(!repair_user_id){
                    alert('指定维修人员的员工号不能为空！');
                    return;
                }
            }
            var point_time = 0;
            if(visit_time == 2){
                point_time = $('#point_time').val();
                if(!point_time){
                    alert('指定时间不能为空！');
                    return;
                }
            }

            $.ajax({
                type: "POST",
                url: "/index.php/sxg/update_order",
                data: {
                    repair_assign : repair_assign,
                    order_id : '<?php echo $order_id;?>',
                    address_id : address_id,
                    visit_time : point_time,
                    repair_user_id : repair_user_id,
                    remark : remark
                },
                dataType: "json",
                success: function(json){
                    if(json.result == '0000'){
                        //
                        $("#show_order_detail").css('display', 'block');
//                        alert('恭喜您，报修成功！请保持电话畅通，维修工程师会尽快跟您联系！');
//                        window.location = '/index.php/sxg/my_order_list';
                    }else {
                        alert(json.info);
                    }
                },
                error: function(){
                    alert("加载失败");
                }
            });

        });
    });
</script>
</body>
</html>