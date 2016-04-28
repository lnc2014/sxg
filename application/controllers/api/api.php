<?php
/**
 * Author:LNC
 * Description: 接口控制器
 * Date: 2016/4/28 0028
 * Time: 下午 3:58
 */
include_once 'ApiBaseController.php';
class api extends ApiBaseController{

    /**
     * 登录接口
     */

    public function login(){

        $data = new stdClass();

        $mobile = intval($this->input->post("mobile"));
        $psw = $this->input->post("psw");

        if(empty($mobile) || empty($psw)){

            echo $this->apiReturn('0003',$data,$this->response_msg['0003']);
            exit();

        }


    }

}