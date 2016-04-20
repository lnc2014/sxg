<?php
/**
 * Author:LNC
 * Description: 签名算法的生成
 *================================
 *      签名算法生成的规则
 *
 *
 * ===============================
 *
 * Date: 2016/4/20 0020
 * Time: 下午 4:35
 */

class sign {

    public $sign_str = 'lnc';

    /**
     *
     * 签名算法
     * @param $params
     * @return bool|string
     */
    function make_sign($params){

        if (!is_array($params)  || count($params) < 1) {
            return '';
        }
        if (isset($params['sign'])) {
            unset($params['sign']);
        }

        ksort($params); //key按照首字母排序
        $sign_str = $this->sign_str;
        foreach ($params as $key => $value) {
            if("key" === $key){
                $sign_str .= $key . "=" . stripslashes(urldecode(($value)));
            }else{
                $sign_str .= $key . "=" . stripslashes($value);
            }
        }
        $sign_str .= $this->sign_str;
        $sign = strtoupper(md5(trim($sign_str)));
        return $sign;
    }

    /**
     *
     * 签名验证
     * @param $params
     * @param $sign
     * @return bool
     */
    function check_sign($params,$sign){

        $servce_sign = $this->make_sign($params);

        if($servce_sign == $sign){
            return true;
        }else{
            return false;
        }
    }
}