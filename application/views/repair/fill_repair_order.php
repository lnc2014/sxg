<?php
/**
 * Description:维修端维修单
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">
    <div class="repair_pro">
        <div class="weui_cells weui_cells_form" style="margin-top: 0">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">维修项目1</label></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">机器品牌</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" placeholder="请输入要维修的机器品牌">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">机器型号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text"  placeholder="请输入要维修的机器型号">
                </div>
            </div>
            <div class="weui_cell"><label class="weui_label">故障现象</label></div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <textarea class="weui_textarea" placeholder="故障现象" id="user_remark" rows="3"></textarea>
                </div>
            </div>
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">更换配件/耗材</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="select2">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">人工费</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="number" placeholder="请输入人工费">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">配件/耗材名称</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" placeholder="请输入配件/耗材名称">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">配件/耗材价格</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="number" placeholder="请输入配件/耗材价格">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="repair_pro">
        <div class="weui_cells weui_cells_form" style="margin-top: 0">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">维修项目2</label></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">机器品牌</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" placeholder="请输入要维修的机器品牌">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">机器型号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text"  placeholder="请输入要维修的机器型号">
                </div>
            </div>
            <div class="weui_cell"><label class="weui_label">故障现象</label></div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <textarea class="weui_textarea" placeholder="故障现象" id="user_remark" rows="3"></textarea>
                </div>
            </div>
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">更换配件/耗材</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="select2">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">人工费</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="number" placeholder="请输入人工费">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">配件/耗材名称</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" placeholder="请输入配件/耗材名称">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">配件/耗材价格</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="number" placeholder="请输入配件/耗材价格">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="addDevice_row">
        <button type="button" class="btn_addDevice btn-lnc" onclick="addDevice()">增加维修项目</button>
    </div>
    <div class="inv_next">
        <div class="total float_left">
            <div style="margin: 22px;">费用总计：<span class="color_orange" id="money">￥0</span></div>
        </div>
        <a href="/index.php/repair/repair/" id="next_url">
            <button type="button" style="background-color: #f48000;" class="btn full_height btn_next">确认</button>
        </a>
    </div>
</div>
<?php
$this->load->view('common/repair_footer');
?>