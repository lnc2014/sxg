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

    <div class="weui_btn_area repair_input">
        <a class="weui_btn weui_btn_primary" style="background-color:#ea3e00"  id="upload">登录</a>
    </div>

</div>
<div class="bottom_footer">
     @深圳市闪修哥维修技术有限公司
</div>
<?php
$this->load->view('common/repair_footer');
?>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
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
    wx.ready(function(){
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
    });

    $('#upload').on('click', function () {
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            }
        });
    });
</script>
