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
            echo $this->apiReturn('0003',$data, $this->response_msg['0003']);
            exit();
        }
        $this->load->model('admin/sxg_repair_user');
        $repair_user = $this->sxg_repair_user->get_data(array(
            'mobile' => $mobile,
            'psw' => $psw
        ));
        if(empty($repair_user)){
            echo $this->apiReturn('0005', $data, $this->response_msg['0005']);
            exit();
        }else{
            echo $this->apiReturn('0000', $data, $this->response_msg['0000']);
            exit();
        }
    }

    /**
     * 注册接口
     */
    public function reg_repair(){
        $mobile = $this->input->post("mobile");
        $psw = $this->input->post("psw");
        $code = $this->input->post("code");
        if(empty($mobile) || empty($psw) || empty($code)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg['0003']);
            exit();
        }
        if($code != '8888'){
            echo $this->apiReturn('0012', new stdClass(), $this->response_msg['0012']);
            exit();
        }
        $this->load->model('admin/sxg_repair_user');
        $repair_user = $this->sxg_repair_user->get_data(array(
            'mobile' => $mobile
        ));
        if(!empty($repair_user)){
            echo $this->apiReturn('0008', new stdClass(), $this->response_msg['0008']);
            exit();
        }else{
            $id = $this->sxg_repair_user->add(array(
                'mobile' => $mobile,
                'account' => $mobile,
                'psw' => $psw
            ));
            if($id >0 ){
                echo $this->apiReturn('0000', new stdClass(), $this->response_msg['0000']);
                exit();
            }else{
                echo $this->apiReturn('0002', new stdClass(), $this->response_msg['0002']);
                exit();
            }
        }
    }

    /**
     * 发送验证码接口
     */
    public function send_code(){
        $mobile = intval($this->input->post("mobile"));
        if(empty($mobile)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg['0003']);
            exit();
        }
        $code = rand(1000, 9999);
        $_SESSION["code"] = $code;
        $data = array(
            'code' => $code
        );
        echo $this->apiReturn('0000', $data, $this->response_msg['0000']);
    }

}