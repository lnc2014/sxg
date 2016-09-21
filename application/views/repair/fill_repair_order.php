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
                    <input id="order_id" type="hidden" value="<?php echo $order_id?>">
                    <input class="weui_input"  id="repair_band" type="text" placeholder="请输入要维修的机器品牌">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">机器型号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" id="repair_model" type="text"  placeholder="请输入要维修的机器型号">
                </div>
            </div>
            <div class="weui_cell"><label class="weui_label">故障现象</label></div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <textarea class="weui_textarea"  id="repair_problem" placeholder="故障现象" rows="3"></textarea>
                </div>
            </div>
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">更换配件/耗材</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select"  id="is_change_parts" name="select2">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">人工费</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" id="labor_cost"  type="number" placeholder="请输入人工费">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">配件/耗材名称</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input"  id="parts_name" type="text" placeholder="请输入配件/耗材名称">
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">配件/耗材价格</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input"  id="parts_cost" type="number" placeholder="请输入配件/耗材价格">
                </div>
            </div>
        </div>
    </div>
    <br>
<!--    TODO 暂时只允许增加一个维修项目-->
<!--    <div class="addDevice_row">-->
<!--        <button type="button" class="btn_addDevice btn-lnc" onclick="addDevice()">增加维修项目</button>-->
<!--    </div>-->
    <div class="inv_next">
        <div class="total float_left">
            <div style="margin: 22px;">费用总计：<span class="color_orange" id="money">￥0</span></div>
        </div>
        <a id="confirm">
            <button type="button" style="background-color: #f48000;" class="btn full_height btn_next">确认</button>
        </a>
    </div>
</div>
<?php
$this->load->view('common/repair_footer');
?>
<script>
    $(function(){
        $("#confirm").on('click',function(){
            var repair_band = $("#repair_band").val();
            var order_id = $("#order_id").val();
            var repair_model = $("#repair_model").val();
            var repair_problem = $("#repair_problem").val();
            var is_change_parts = $("#is_change_parts").val();
            var labor_cost = $("#labor_cost").val();
            var parts_name = $("#parts_name").val();
            var parts_cost = $("#parts_cost").val();

            if(!repair_band){
                alert("机器的品牌不能为空");
                return;
            }
            if(!repair_model){
                alert("机器的型号不能为空");
                return;
            }
            if(!labor_cost){
                alert("人工费不能为空");
                return;
            }
            if(is_change_parts == 1){
                if(!parts_name){
                    alert("配件名字不能为空");
                    return;
                }
                if(!parts_cost){
                    alert("配件价格不能为空");
                    return;
                }
            }
            var money = parseFloat(labor_cost) + parseFloat(parts_cost);
            money = '￥'+ money;
            $("#money").text(money);
            $.ajax({
                type: "POST",
                url: "/index.php/repair/repair/fill_repair_order_data",
                data: {
                    repair_band : repair_band,
                    repair_model : repair_model,
                    repair_problem : repair_problem,
                    is_change_parts : is_change_parts,
                    order_id : order_id,
                    labor_cost : labor_cost,
                    parts_name : parts_name,
                    parts_cost : parts_cost
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

        });

    });

</script>
