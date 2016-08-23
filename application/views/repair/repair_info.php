<?php
/**
 * Description:维修端信息补充页面
 * Author: LNC
 * Date: 2016/8/4
 * Time: 21:02
 */
$this->load->view('common/repair_header',array('title'=>$title));
?>
<div class="container" id = "container">
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text"  id="user_name" placeholder="请输入姓名">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">地址</label></div>
            <div class="addr_city"><select class="prov"></select><select class="city"></select><select class="dist"></select></div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" id="street" type="text"  placeholder="街道，小区，楼号/门牌号，楼层">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">身份证号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" id="id_card" pattern="[0-9]*" placeholder="请输入您的身份证号码">
            </div>
        </div>
        <input type="hidden" id="id_card_pic_face">
        <div class="weui_cell">
            <div class="upload_div" id="img1">
                <div class="upload_first_word">
                    上传您的身份证正面照
                </div>
                <div class="upload_second_word">
                    （上传的证照需清晰、完整）
                </div>
                <div class="weui_uploader_input" id="upload_card_pic_face"></div>
            </div>
        </div>
        <input type="hidden" id="id_card_pic_fan">
        <div class="weui_cell">
            <div class="upload_div" id="img2">
                <div class="upload_first_word">
                    上传您的身份证反面照
                </div>
                <div class="upload_second_word">
                    （上传的证照需清晰、完整）
                </div>
                <div class="weui_uploader_input" type="text" id="upload_card_pic_fan"></div>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">银行卡号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" id="bank_card_no" pattern="[0-9]*" placeholder="请输入您的银行卡号">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">银行名称</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" id="bank_name"  placeholder="例如 中国银行">
            </div>
        </div>

        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">开户行</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" id="bank_type"  placeholder="例如 中国银行高新园支行">
            </div>
        </div>
    </div>
    <input type="hidden" id="qualification_pic">
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell"><label class="weui_label">资历证明</label></div>
        <div class="weui_cell">
            <div  class="upload_div" id="img3">
                <div class="upload_first_word">
                    上传您的资历证明
                </div>
                <div class="upload_second_word">
                    （培训证明，等级证书等）
                </div>
                <div class="weui_uploader_input" id="upload_qua_pic"></div>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">擅长维修的品牌</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" pattern="[0-9]*" id="good_print_band" placeholder="品牌">
            </div>
        </div>
    </div>

</div>
<div class="weui_btn_area repair_input">
    <a class="weui_btn weui_btn_primary"  style="background-color:#ea3e00" id="fill">下一步</a>
</div>
<?php
$this->load->view('common/repair_footer');
?>
<script type="text/javascript" src="/static/wx/js/citySelect.js"></script>
<script>
    $(function(){
        $(".addr_city").citySelect({ url:'/static/wx/js/city.json', prov:'广东', city:'深圳', dist:'', required:false, nodata:'none' });
    });
    $(function(){
        $("#fill").on('click', function(){
            var user_name = $("#user_name").val();
            var prov = $(".prov").val();//省份
            var city = $(".city").val();//城市
            var dist = $(".dist").val();//地区
            var street = $("#street").val();//街道
            var id_card = $("#id_card").val();//身份证号码
            var id_card_pic_face = $("#id_card_pic_face").val();
            var id_card_pic_fan = $("#id_card_pic_fan").val();
            var bank_card_no = $("#bank_card_no").val();
            var bank_name = $("#bank_name").val();
            var bank_type = $("#bank_type").val();
            var qualification_pic = $("#qualification_pic").val();
            var good_print_band = $("#good_print_band").val();
            if(!user_name){
                alert('姓名不能为空');
                return;
            }
            if(!prov || !city || !dist || !street){
                alert('地区不能为空');
                return;
            }
            if(!id_card){
                alert('身份证号码不能为空！');
                return;
            }
            //身份证校验
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            if(reg.test(id_card) === false)
            {
                alert("身份证输入不合法");
                return;
            }
            if(!id_card_pic_face){
                alert('要上传身份证正面照片');
                return;
            }
            if(!id_card_pic_fan){
                alert('要上传身份证反面照片');
                return;
            }
            if(!bank_card_no){
                alert('银行卡号不能为空');
                return;
            }
            if(!bank_name){
                alert('银行名字不能为空');
                return;
            }
            if(!qualification_pic){
                alert('资质证明不能为空');
                return;
            }
            $.ajax({
                type: "POST",
                url: "/index.php/repair/repair/fill_repair_info",
                data: {
                    user_name:user_name,
                    province:prov,
                    city:city,
                    area:dist,
                    street:street,
                    id_card:id_card,
                    id_card_pic_face:id_card_pic_face,
                    id_card_pic_fan:id_card_pic_fan,
                    bank_card_no:bank_card_no,
                    bank_name:bank_name,
                    bank_type:bank_type,
                    qualification_pic:qualification_pic,
                    good_print_band:good_print_band
                },
                dataType: "json",
                success: function(json){
                    if (json.result == "0000" ) {
                        alert('添加成功');
                        window.location = '/index.php/repair/repair/repair_status';
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
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?php echo $sign_package['appId']?>', // 必填，公众号的唯一标识
        timestamp:<?php echo $sign_package['timestamp']?> , // 必填，生成签名的时间戳
        nonceStr: '<?php echo $sign_package['nonceStr']?>', // 必填，生成签名的随机串
        signature: '<?php echo $sign_package['signature']?>',// 必填，签名，见附录1
        jsApiList: [
            "chooseImage",
            "previewImage",
            "uploadImage",
            "downloadImage"
        ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    //上传身份证正面
    $('#upload_card_pic_face').on('click', function () {
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                if(!localIds){
                    alert('上传失败');
                    return;
                }
                var localId = localIds.toString();
                wx.uploadImage({
                    localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
                        var html = "<img src="+localIds+" style='width:100%;height:140px'>";
                        $("#img1").html(html);
                        $("#id_card_pic_face").val(serverId);
                    }
                });
            }
        });
    });
    //上传身份证反面
    $('#upload_card_pic_fan').on('click', function () {
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                if(!localIds){
                    alert('上传失败');
                    return;
                }
                var localId = localIds.toString();
                wx.uploadImage({
                    localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
                        var html = "<img src="+localIds+" style='width:100%;height:140px'>";
                        $("#img2").html(html);
                        $("#id_card_pic_fan").val(serverId);
                    }
                });
            }
        });
    });
    //上传资质证明
    $('#upload_qua_pic').on('click', function () {
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                if(!localIds){
                    alert('上传失败');
                    return;
                }
                var localId = localIds.toString();
                wx.uploadImage({
                    localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
                        var html = "<img src="+localIds+" style='width:100%;height:140px'>";
                        $("#img3").html(html);
                        $("#qualification_pic").val(serverId);
                    }
                });
            }
        });
    });


</script>
