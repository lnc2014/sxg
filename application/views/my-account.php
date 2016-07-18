<?php
/**
 * Description:闪修哥快速下单
 * Author: LNC
 * Date: 2016/5/30
 * Time: 23:06
 */
$this->load->view('common/wx_header',array('title'=>$title));
?>
<body>
<div class="container">
    <div class="ct"></div>
    <a href="/index.php/sxg/address"><div class="info_row border_bottom">
            <img src="/static/wx/images/icon-address.png">
            <div class="lbl">地址管理</div>
        </div></a>
    <a href="/index.php/sxg/invoice"><div class="info_row border_bottom">
            <img src="/static/wx/images/icon-red.png">
            <div class="lbl">我的发票</div>
        </div></a>
    <a href="/index.php/sxg/feedback"><div class="info_row border_bottom">
            <img src="/static/wx/images/icon-question.png">
            <div class="lbl">问题反馈</div>
        </div></a>
</div>
</body>
</html>