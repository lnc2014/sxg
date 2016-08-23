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
    <a href="/">
    <div class="weui_panel">
        <div class="weui_panel_bd" style="font-size: 20px;color: #f4b000;">
            <div class="weui_media_box weui_media_text">
                <div>
                    新订单提醒
                </div>
                <div class="weui_media_desc" style="position: absolute;top: 24px;right: 10px;">
                    2012-12-31 12:32:45
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
    <a href="/">
        <div class="weui_panel">
            <div class="weui_panel_bd" style="font-size: 20px;color: #f4b000;">
                <div class="weui_media_box weui_media_text">
                    <div>
                        订单结束提醒
                    </div>
                    <div class="weui_media_desc" style="position: absolute;top: 24px;right: 10px;">
                        2012-12-31 12:32:45
                    </div>
                    <div class="weui_media_desc" style="margin-top: 24px;font-size: 15px;">
                       顾客已经确认订单结束并支付，点击查看详情
                    </div>
                    <div class="weui_media_desc" style="position: absolute;top: 72px;right: 10px;font-size: 15px;color: #f4b000;">
                        查看
                    </div>
                </div>
            </div>
        </div>
    </a>
    <br>
    <a href="/">
        <div class="weui_panel">
            <div class="weui_panel_bd" style="font-size: 20px;color: #f4b000;">
                <div class="weui_media_box weui_media_text">
                    <div>
                        价格变动提醒
                    </div>
                    <div class="weui_media_desc" style="position: absolute;top: 24px;right: 10px;">
                        2012-12-31 12:32:45
                    </div>
                    <div class="weui_media_desc" style="margin-top: 24px;font-size: 15px;">
                        维修费用发生变动，点击查看详情
                    </div>
                    <div class="weui_media_desc" style="position: absolute;top: 72px;right: 10px;font-size: 15px;color: #f4b000;">
                        查看
                    </div>
                </div>
            </div>
        </div>
    </a>
    <br>
    <a href="/">
        <div class="weui_panel">
            <div class="weui_panel_bd" style="font-size: 20px;color: #f4b000;">
                <div class="weui_media_box weui_media_text">
                    <div>
                        订单取消提醒
                    </div>
                    <div class="weui_media_desc" style="position: absolute;top: 24px;right: 10px;">
                        2012-12-31 12:32:45
                    </div>
                    <div class="weui_media_desc" style="margin-top: 24px;font-size: 15px;">
                        有笔订单已被取消，点击查看详情
                    </div>
                    <div class="weui_media_desc" style="position: absolute;top: 72px;right: 10px;font-size: 15px;color: #f4b000;">
                        查看
                    </div>
                </div>
            </div>
        </div>
    </a>
    <br>
</div>


<?php
$this->load->view('common/repair_footer');
?>
<script>

</script>
