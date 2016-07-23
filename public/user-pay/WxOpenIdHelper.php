<?php
require_once "lib/WxPayException.php";
require_once "lib/WxPayApi.php";
require_once "lib/WxPayConfig.php";
require_once "lib/WxPayJsApiPay.class.php";

class WxOpenIdHelper{
    function getOpenId(){
        $tools = new JsApiPay();
        $data  = $tools->GetOpenid();
        return $data;
    }
}

