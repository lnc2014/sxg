<?php
/**
 * Description:维修端登录页面
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">

<!--    logo-->
    <div class="logo">
        <img src="/static/wx/images/repairs/logo.png" style="width:100%;">
    </div>
    <div class="weui_cells weui_cells_form repair_input">
        <div class="weui_cell">
            <input class="weui_input" type="number" id="phone" pattern="[0-9]*" placeholder="手机号">
        </div>
    </div>
    <div class="weui_cells weui_cells_form repair_input">
        <div class="weui_cell">
            <input class="weui_input" type="password" id="password" placeholder="密码">
        </div>
    </div>
    <div class="weui_btn_area repair_input">
        <a class="weui_btn weui_btn_primary" style="background-color:#ea3e00"  id="login">登录</a>
    </div>
    <div class="weui_btn_area repair_input">
        <a class="weui_btn weui_btn_primary" href="/index.php/repair/repair/reg" style="background-color:#f48000" id="reg">注册</a>
        <div class="weui_cells_tips show_word"><a href="/index.php/repair/repair/find_repair_psw" style="color: #f48000;"><u>找回密码</u></a></div>
    </div>
</div>
<div class="bottom_footer_login" >
     @深圳市闪修哥维修技术有限公司
</div>
<?php
$this->load->view('common/repair_footer');
?>
<script>
    $(function(){
        $('#login').click(function(){
            //手机号、密码
            var phone = $('#phone').val();
            var password = $("#password").val();

            if(!phone){
                alert('手机号码不能为空！');
                return;
            }
            if (!check_phone(phone)) {
                alert('请输入正确的手机号码');
                return false;
            }
            if(!password){
                alert('密码不能为空！');
                return;
            }
            $.ajax({
                type: "POST",
                url: "/index.php/repair/repair/login_check",
                data: {
                    phone : phone,
                    psw : password
                },
                dataType: "json",
                success: function(json){
                    if(json.result == '0000'){
                        alert('登录成功');
                        window.location = '/index.php/repair/repair/repair_info';
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
    function check_phone(number){
        var pattern = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$/;
        return pattern.test(number) ? true : false;
    }
</script>
