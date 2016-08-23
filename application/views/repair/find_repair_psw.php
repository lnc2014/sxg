<?php
/**
 * Description:维修端找回密码
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" id="phone" pattern="[0-9]*" placeholder="请输入手机号">
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" id="code" placeholder="请输入验证码">
            </div>
            <div class="weui_cell_ft code">
                <a href="javascript:;" id="js_get_code" class="weui_btn weui_btn_mini  yellow" >验证码(60s)</a>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">新密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" id="psw" placeholder="请设置新登录密码">
            </div>
        </div>
    </div>
    <div class="weui_btn_area repair_input">
        <a class="weui_btn weui_btn_primary" style="background-color:#ea3e00" id="find">找回密码</a>
    </div>
</div>

<div class="bottom_footer">
        @深圳市闪修哥维修技术有限公司
</div>
<?php
$this->load->view('common/repair_footer');
?>
<script>
$(function(){
    var interValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount = 0;//当前剩余秒数

    var phone_reg = /^1[0-9]{10}$/;
    var setRemainTime = function() {
        if (curCount == 0) {
            window.clearInterval(interValObj);
            $('#js_get_code').text("重新获取");
        } else {
            curCount--;
            $("#js_get_code").text(curCount + "s");
        }
    };
    var send_code = function(phone){
        $.ajax({
            type: "POST",
            url: "/index.php/sxg/send_code",
            data: {
                phone:phone
            },
            dataType: "json",
            success: function(json){
                if (json.result == "0000" ) {
                    curCount = count;
                    $('#js_get_code').text(curCount + "s");
                    InterValObj = window.setInterval(setRemainTime, 1000);
                } else {
                    alert(json.info);
                }
            },
            error: function(){
                alert('系统错误，请联系管理员处理');
            }
        });
    };
    $('#js_get_code').on('click', function(){
        var phone = $('#phone').val();
        if(!phone_reg.test(phone)) {
            alert('手机号输入有误');
            $('#js_phone').focus();
            return false;
        }
        if (curCount > 0) {
            return false;
        }
        send_code(phone);
    });

    //提交注册
    $("#find").on('click', function(){
        var phone = $('#phone').val();
        if(!phone_reg.test(phone)) {
            alert('手机号输入有误');
            return false;
        }
        var code = $("#code").val();
        var psw = $("#psw").val();

        if(!code){
            alert('验证码不能为空！');
            return false;
        }
        if(!psw){
            alert('密码不能为空！');
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/index.php/repair/repair/find_psw",
            data: {
                phone:phone,
                psw:psw,
                code:code
            },
            dataType: "json",
            success: function(json){
                if (json.result == "0000" ) {
                    alert('修改成功！');
                } else {
                    alert(json.info);
                }
            },
            error: function(){
                alert('系统错误，请联系管理员处理');
            }
        });

    });
});
</script>
