<?php
/**
 * Description:维修端订单详情
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">
    <div class="tk_wrap" style="margin-top: 0;">
        <div class="tk_it" style="font-size: 20px;">订单信息</div>
        <hr>
        <div class="tk_it"><span class="tk_it_title">订单状态：</span><span style="color:#f48000">待上门</span></div>
        <div class="tk_it"><span class="tk_it_title">订单时间：</span><span>2016-06-08 15:32:12</span></div>
        <div class="tk_it"><span class="tk_it_title">订单号：</span><span>sxg201605085323</span></div>
    </div>
    <div class="repair_group div_repair_project">
        <div class="repair_subject">
            <div class="d_row color_base border_bottom">维修项目1</div>
            <div class="sp_row color_a8"><span>机器品牌</span><span>机器型号</span></div>
            <div class="sp_row sub_value">
                <input type="text" name="input_device_name" value="爱普生">
                <input type="text" name="input_device_model" value="vs212312">
            </div>
            <div class="sp_row color_a8"><span>故障现象</span></div>
            <div class="sp_row"><input type="text" name="input_device_fault" class="rsf_input" value="辅导解放军抵抗力"></div>
            <div class="sp_row color_a8"><span>更换配件/耗材</span><span>人工费</span></div>
            <div class="sp_row">
                <select name="input_parts_replace"><option value="1">是</option><option value="0">否</option></select>
                <input type="text" name="input_device_labour" value="100">
            </div>
            <div class="sp_row color_a8"><span>配件/耗材名称</span><span>配件/耗材价格</span></div>
            <div class="sp_row">
                <input type="text" name="input_parts_name" value="墨盒">
                <input type="text" name="input_parts_price" value="100">
            </div>
        </div>
    </div>

    <div class="tk_wrap">
        <div class="tk_it" style="font-size: 20px;">用户信息</div>
        <hr>
        <div class="tk_it"> 张三&nbsp;&nbsp;先生
            <img src="/static/wx/images/phone.png" alt="" style="width:20px;display:block">
            <a href="tel:15899872592">15899872592</a>
        </div>
        <div class="tk_it"><span class="tk_it_title">地址：</span><span>深圳市南山区金融科技大厦15</span></div>
        <div class="tk_it"><span class="tk_it_title">上门时间：</span><span>2016-08-09 15:15:44</span></div>
    </div>
    <div class="tk_wrap">
        <div class="tk_it" style="font-size: 20px;">订单详情</div>
        <hr>
        <div class="tk_it">
        机器型号：联想&nbsp;&nbsp;机器型号：联系12344
        </div>
        <div class="tk_it"><span class="tk_it_title">故障描述：</span><span>我的打印机坏了</span></div>
        <div class="tk_it"><span class="tk_it_title">备注信息：</span><span>能不能快点</span></div>
    </div>
    <div class="weui_cell_hd">
        <div class="weui_cell">
            <a class="weui_btn" href="/index.php/repair/repair/" style="width:50%;background-color:#ea3e00" id="login">转单</a>
            &nbsp;&nbsp;
            <a class="weui_btn" style="width:50%;margin-top: 0;background-color:#f48000" href="/index.php/repair/repair/fill_repair_order">我已到达</a>
        </div>
    </div>

</div>
<?php
$this->load->view('common/repair_footer');
?>