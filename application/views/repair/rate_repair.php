
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <meta http-equiv="Expires" content="0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi">
    <title>点评</title>
    <link rel="stylesheet" type="text/css" href="/static/wx/css/main.css?v=1.0" />
</head>
<body>
<div class="container">
    <div class="color_a8 div_descri">请对本维修员的此次服务进行评价</div>
    <div class="div_rating">
        <div class="color_base rate services_rate" data-rate="1">
            <span class="rate_type">服务态度</span>
            <span class="star" data-v='1'></span>
            <span class="star" data-v='2'></span>
            <span class="star" data-v='3'></span>
            <span class="star" data-v='4'></span>
            <span class="star" data-v='5'></span>
        </div>
        <div class="color_base rate skills_rate" data-rate="3">
            <span class="rate_type">技术能力</span>
            <span class="star" data-v='1'></span>
            <span class="star" data-v='2'></span>
            <span class="star" data-v='3'></span>
            <span class="star" data-v='4'></span>
            <span class="star" data-v='5'></span>
        </div>
        <div class="div_write_someting">
            <div class="color_a8 da_t">写点什么</div>
            <textarea class="ta_rating" placeholder="来点评一下吧"></textarea>
        </div>
    </div>
    <div class="btn_oprs align_center">
        <button class="btn btn_l" type="button">提 交</button>
    </div>
</div>
<script type="text/javascript" src="/static/wx/js/zepto.min.js"></script>
<script type="text/javascript">
    $(".star").on("click",function(){
        $(this).parent().attr("data-rate", $(this).attr('data-v'));
    });
</script>
</body>
</html>