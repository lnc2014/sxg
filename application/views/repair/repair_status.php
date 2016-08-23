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
        <img src="/static/wx/images/repairs/audit.png" style="width:100%;">
    </div>

    <div class="weui_btn_area" style="font-size: 30px;text-align: center;color: red;">
        账号审核中
    </div>
    <div class="weui_btn_area" style="font-size: 16px;text-align: center;">
        请耐心等待，审核通过会通过闪修哥维修端公众号通知。
    </div>

</div>
<div class="bottom_footer">
     @深圳市闪修哥维修技术有限公司
</div>
<?php
$this->load->view('common/repair_footer');
?>