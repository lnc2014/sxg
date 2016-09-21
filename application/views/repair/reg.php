<?php
/**
 * Description:维修端注册页面
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
                <a href="javascript:;" id="js_get_code" class="weui_btn weui_btn_mini yellow">验证码(60s)</a>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" id="psw" type="password" placeholder="请输入密码">
            </div>
        </div>

    </div>
    <div class="weui_btn_area repair_input">
        <a class="weui_btn weui_btn_primary"  style="background-color:#ea3e00" id="reg">下一步</a>
    </div>
    <div class="bottom_footer">
        <div class="next_word">
            <div style="display:inline">
                <input type="checkbox" checked id="is_agree" style="height:20px;width:20px;" />
            </div>
            <div style="color:#aba8a8;display:inline">
                点击下一步，即表示您已经仔细阅读并同意
            </div>
            <div style="color:#f48000;display:inline">《闪修哥免责声明》</div>
            <br>
            <br>
            <br>
            @深圳市闪修哥维修技术有限公司
        </div>

    </div>
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
    $("#reg").on('click', function(){
        var phone = $('#phone').val();
        if(!phone_reg.test(phone)) {
            alert('手机号输入有误');
            return false;
        }
        var code = $("#code").val();
        var psw = $("#psw").val();
        if($("#is_agree").attr('checked') == false){
            alert('需要同意闪修哥免责声明');
            return;
        }
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
            url: "/index.php/repair/repair/reg_user",
            data: {
                phone:phone,
                psw:psw,
                code:code
            },
            dataType: "json",
            success: function(json){
                if (json.result == "0000" ) {
                    alert('注册成功！');
                    window.location = '/index.php/repair/repair/repair_info';
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
