<?php
/**
 * Description:闪修哥快速下单
 * Author: LNC
 * Date: 2016/5/30
 * Time: 23:06
 */
$this->load->view('common/wx_header',array('title'=>$title));
?>
<style>
    input[type='checkbox'] { margin-right: -0.3em; margin-top: -0.1em; background: url(/static/wx/images/unchecked.png) no-repeat; background-size: 100% 100%; }
    input[type='checkbox']:checked { background: url(/static/wx/images/checked.png) no-repeat; background-size: 100% 100%; }
    .div_images .img_li.add_li {
        background: url(/static/wx/images/add.png) no-repeat;
        background-size: 100% 100%;
    }
</style>
<body>
<div class="container cw">
    <div class="select_row border_bottom">
        <div class="city float_left">
            <select class="color_base select_city">
                <option value="2">广州</option>
                <option value="3" selected>北京</option>
                <option value="4" selected>上海</option>
                <option value="1" selected>深圳</option>
            </select>
            <span class="arrow"></span>
        </div>
        <div class="head float_right">
            <img src="<?php echo $user['headimgurl'] ?>" >
        </div>
    </div>
    <div class="repair_devices full_width " id="repair" >
        <div class="repair_row border_bottom" >
            <div class="device">
                <div class="color_base float_left name">报修机器</div>
                <img src="/static/wx/images/icon-arrow.png" class="float_right expend_mark">
            </div>
            <div class="device_detail">
                <div style=" margin-left: 15px; margin-bottom: -3px;color: red;">品牌和型号是必填项*</div>
                <div class="detail_row border_bottom">
                    <input type="text" placeholder="机器品牌" value="<?php if(!empty($user['last_band'])){echo $user['last_band'];}?>" name="brand"  id='brand1' class="color_base input">
                    <input type="text" placeholder="机器型号" value="<?php if(!empty($user['last_model'])){echo $user['last_model'];}?>" name="model"  id='model1' class="color_base input input2">
                </div>

                <div class="detail_row">
                    <div style="color: red;">请对机器故障进行描述:</div><br>
                    <textarea class="description" id="description"  placeholder="例如：打印文字迹偏淡"></textarea>
                    <p  style="color: red;">请拍照上传故障打印页:</p>
                    <div class="div_images">
                        <div class="img_li add_li float_left">
                            <div class="file" id="file_upload">选择图片</div>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 10px;margin-bottom:0px;" id="is_upload"></div>
            </div>
        </div>
    </div>
    <input type="hidden" id="is_problem1" value="0">
    <input type="hidden" id="is_problem2" value="0">
    <input type="hidden" id="is_problem3" value="0">
    <input type="hidden" id="is_problem4" value="0">
    <input type="hidden" id="img1" value="">
    <input type="hidden" id="img2" value="">
    <input type="hidden" id="img3" value="">
    <input type="hidden" id="imgshow1" value="">
    <input type="hidden" id="imgshow2" value="">
    <input type="hidden" id="imgshow3" value="">
    <div class="align_center" style="margin-top: 56px;">
        <button class="btn btn_l" type="button" id="submit_order">下一步</button>
    </div>
</div>
<script type="text/javascript" src="/static/wx/js/zepto.min.js"></script>
<script type="text/javascript" src="/static/wx/js/jquery.1.71.js"></script>
<script type="text/javascript">
    var i = 1;
    $(".repair_devices").on("click",'.device',function(){
        var _self = $(this);
        $(".device").not(_self).parent().addClass("shrink");
        var rep = _self.parent();
        if(!rep.hasClass("shrink")) {
            rep.addClass("shrink");
        } else {
            rep.removeClass("shrink");
        }
    }).on("click",'.close',function(){
        $(this).parent().hide();
    });
    $(function(){
        $("#repair2").live("click",function(){
            if(!$("#repair2").hasClass("shrink")) {
                $("#repair2").addClass("shrink");
            } else {
                $("#repair2").removeClass("shrink");
            }
        });
        $("#repair3").live("click",function(){
            if(!$("#repair3").hasClass("shrink")) {
                $("#repair3").addClass("shrink");
            } else {
                $("#repair3").removeClass("shrink");
            }
        });
        $("#problem1").click(function () {
            var is_problem1 = $("#is_problem1").val();
            if(is_problem1 == 0){
                $("#is_problem1").val(1);
            }else if(is_problem1 == 1){
                $("#is_problem1").val(0);
            }
        });
        $("#problem2").click(function () {
            var is_problem2 = $("#is_problem2").val();
            if(is_problem2 == 0){
                $("#is_problem2").val(1);
            }else if(is_problem2 == 1){
                $("#is_problem2").val(0);
            }
        });
        $("#problem3").click(function () {
            var is_problem3 = $("#is_problem3").val();
            if(is_problem3 == 0){
                $("#is_problem3").val(1);
            }else if(is_problem3 == 1){
                $("#is_problem3").val(0);
            }
        });
        $("#problem4").click(function () {
            var is_problem4 = $("#is_problem4").val();
            if(is_problem4 == 0){
                $("#is_problem4").val(1);
            }else if(is_problem4 == 1){
                $("#is_problem4").val(0);
            }
        });
        //提交表单
        $("#submit_order").click(function(){
            var problem1 = $("#is_problem1").val();
            var problem2 = $("#is_problem2").val();
            var problem3 = $("#is_problem3").val();
            var problem4 = $("#is_problem4").val();
            var brand1 = $("#brand1").val();
            var model1 = $("#model1").val();
            var description1 = $("#description").val();
            if(!brand1){
                alert('机器名牌不能为空');
                return;
            }
            if(!model1){
                alert('机器型号不能为空');
                return;
            }
            if(!description1 && (problem1 == 0) && (problem2 == 0)&& (problem3 == 0)&& (problem4 == 0) ){
                alert('需要维修的问题不能为空');
                return;
            }
            sub_problem1 = '';
            sub_problem2 = '';
            sub_problem3 = '';
            sub_problem4 = '';
            if(problem1 == 1){
                var sub_problem1 = '0001' + ',';
            }
            if(problem2 == 1){
                var sub_problem2 = '0002' + ',';
            }
            if(problem3 == 1){
                var sub_problem3 = '0003' + ',';
            }
            if(problem4 == 1){
                var sub_problem4 = '0004' + ',';
            }

            var img1 = $('#imgshow1').val();
            var img2 = $('#imgshow2').val();
            var img3 = $('#imgshow3').val();
            if(img1){
                img1 = img1 + ';';
            }
            if(img2){
                img2 = img2 + ';';
            }
            if(img3){
                img3 = img3 + ';';
            }
            var img = img1 + img2 + img3;
            var repair_option = sub_problem1 +   sub_problem2 +  sub_problem3 + sub_problem4;//附加规则
            $.ajax({
                type: "POST",
                url: "/index.php/sxg/add_order",
                data: {
                    print_band : brand1,
                    print_model : model1,
                    repair_option : repair_option,
                    repair_problem : description1,
                    img:img
                },
                dataType: "json",
                success: function(json){
                    if(json.result == '0000'){
                        window.location = '/index.php/sxg/order_detail/'+json.data.order_id;
                    }else if(json.result == '0001'){
                        alert(json.info);
                        window.location = '/index.php/sxg/band_phone';
                    }else{
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
<!--上次图片-->
<script type="text/javascript" src="/static/wx/js/jweixin-1.0.0.js"></script>
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
            "uploadImage"
        ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    //上传身份证正面
    var img = 0;
    $('#file_upload').on('click', function () {
        wx.chooseImage({
            count: 3, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                if(!localIds){
                    alert('上传失败');
                    return;
                }
                var i = 0; var length = localIds.length;
                var upload = function() {
                    if(img >= 3 ){
                        alert('最多只能上传三张图片');
                        return;
                    }
                    wx.uploadImage({
                        localId:localIds[i],
                        success: function(res) {
                            //如果还有照片，继续上传
                            var serverId = res.serverId; // 返回图片的服务器端ID
                            $.ajax({
                                type: "POST",
                                url: "/index.php/sxg/save_pic_to_server",
                                data: {
                                    media_id : serverId
                                },
                                dataType: "json",
                                success: function(json){
                                    if(json.result == '0000'){
                                        $('#imgshow'+img).val(json.data);
                                        $('#img'+img).val(json.data);
                                    }else{
                                        alert(json.info);
                                    }
                                },
                                error: function(){
                                    alert("加载失败");
                                }
                            });
                            img = img + 1;
                            var html = '<div class="img_li float_left"  id="show_img'+img+'">'+
                                '<img src="'+localIds[i]+'" class="full_width full_height" id="img_show'+img+'">'+
                                '<img src="/static/wx/images/close.png" class="close1" id="del_img'+img+'">'+
                                '</div>';
                            $('.div_images').append(html);
                            $('#upload_pics').css('display', 'none');
                            i++;
                            if (i < length) {
                                upload();
                            }
                        }
                    });
                };
                upload();
            }
        });
    });

    $(function(){
        $("#del_img1").live("click",function(){
            $('#show_img1').remove();
            var img3 = $('#img3').val();
            var imgshow3 = $('#imgshow3').val();
            $('#img1').val(img3);
            $('#imgshow1').val(imgshow3);
            $('#img3').val('');
            $('#imgshow3').val('');
            img = img - 1;
        });
        $("#del_img2").live("click",function(){
            $('#show_img2').remove();
            var img3 = $('#img3').val();
            var imgshow3 = $('#imgshow3').val();
            $('#img2').val(img3);
            $('#imgshow2').val(imgshow3);
            $('#img3').val('');
            $('#imgshow3').val('');
            img = img - 1;
        });
        $("#del_img3").live("click",function(){
            $('#show_img3').remove();
            $('#img3').val('');
            $('#imgshow3').val('');
            img = img - 1;
        });

        $("#img_show1").live("click",function(){
            var img_url1 = 'http://wx.shanxiuge.com/'+ $('#imgshow1').val();
            var img_url2 = 'http://wx.shanxiuge.com/'+ $('#imgshow2').val();
            var img_url3 = 'http://wx.shanxiuge.com/'+ $('#imgshow3').val();
            wx.previewImage({
                current: img_url1, // 当前显示图片的http链接
                urls: [
                    img_url1,
                    img_url2,
                    img_url3
                ] // 需要预览的图片http链接列表
            });
        });
        $("#img_show2").live("click",function(){
            var img_url1 = 'http://wx.shanxiuge.com/'+ $('#imgshow1').val();
            var img_url2 = 'http://wx.shanxiuge.com/'+ $('#imgshow2').val();
            var img_url3 = 'http://wx.shanxiuge.com/'+ $('#imgshow3').val();
            wx.previewImage({
                current: img_url2, // 当前显示图片的http链接
                urls: [
                    img_url1,
                    img_url2,
                    img_url3
                ] // 需要预览的图片http链接列表
            });
        });
        $("#img_show3").live("click",function(){
            var img_url1 = 'http://wx.shanxiuge.com/'+ $('#imgshow1').val();
            var img_url2 = 'http://wx.shanxiuge.com/'+ $('#imgshow2').val();
            var img_url3 = 'http://wx.shanxiuge.com/'+ $('#imgshow3').val();
            wx.previewImage({
                current: img_url3, // 当前显示图片的http链接
                urls: [
                    img_url1,
                    img_url2,
                    img_url3
                ] // 需要预览的图片http链接列表
            });
        });
    });
</script>
</body>
</html>