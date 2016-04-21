<?php
/**
 * Author:LNC
 * Description: 公共方法库
 * Date: 2016/4/21 0021
 * Time: 下午 4:29
 */

class func{

    /**
     *
     * 接口数据JSON格式返回
     * @param $code
     * @param $data
     * @param $msg
     * @return string
     */

    function apiReturn($code, $data, $msg){
        $arr['code'] = $code;
        $arr['data'] = empty($data)?'':$data;
        $arr['msg'] = $msg;
        return json_encode($arr);

    }
}