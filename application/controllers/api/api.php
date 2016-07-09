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

        $mobile = intval($this->input->post("mobile"));
        $psw = $this->input->post("psw");
        if(empty($mobile) || empty($psw)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg['0003']);
            exit();
        }
        $this->load->model('admin/sxg_repair_user');
        $repair_user = $this->sxg_repair_user->get_data(array(
            'mobile' => $mobile,
            'psw' => $psw
        ));
        $data = array(
            'user_id' => $repair_user['repair_user_id'],
            'mobile' => $mobile,
        );
        if(empty($repair_user)){
            echo $this->apiReturn('0005', '', $this->response_msg['0005']);
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
            $data = array(
                'user_id' => $id,
                'mobile' => $mobile,
            );
            if($id >0 ){
                echo $this->apiReturn('0000', $data, $this->response_msg['0000']);
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
        $mobile = $this->input->post("mobile");
        if(empty($mobile)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg['0003']);
            exit();
        }
        $code = rand(1000, 9999);

        $lifetime = 60;//保存1分钟
        setcookie(session_name(),session_id(),time()+$lifetime,"/");
        if(!isset( $_SESSION["{$mobile}code"])){
            $_SESSION["{$mobile}code"] = $code;
        }else{
            $code = $_SESSION["{$mobile}code"];
        }
        $data = array(
            'code' => $code
        );
        echo $this->apiReturn('0000', $data, $this->response_msg['0000']);
    }

    /**
     * 增加用户的信息
     */
    public function add_repair_info(){
        $name = $this->input->post("name");
        $repair_user_id = $this->input->post("repair_user_id");
        $province = $this->input->post("province");
        $city = $this->input->post("city");
        $area = $this->input->post("area");
        $street = $this->input->post("street");
        $id_card_no = $this->input->post("id_card_no");
        $id_card_pic = $this->input->post("id_card_pic");
        $bank_num = $this->input->post("bank_num");
        $bank_name = $this->input->post("bank_name");
        $bank_address = $this->input->post("bank_address");
        $qualification_pic  = $this->input->post("qualification_pic");
        $repair_bank  = $this->input->post("repair_bank");//字符串，多条

        if(empty($name) || empty($id_card_no) || empty($qualification_pic)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg['0003']);
            exit();
        }
        $this->load->model('admin/sxg_address');
        $this->load->model('admin/sxg_repair_user');
        $repair_address = $this->sxg_address->find_address_by_condition(array(
            'repair_user_id' => $repair_user_id
        ), 1);
        $address_id = $repair_address['address_id'];
        if(empty($repair_address)){
            $add_adress = array(
                'name' => $name,
                'repair_user_id' => $repair_user_id,
                'province' => $province,
                'city' => $city,
                'area' => $area,
                'street' => $street
            );
            $address_id = $this->sxg_address->insert_data($add_adress);
        }
        $data = array(
            'address_id' => $address_id,
            'user_name' => $name,
            'bank_card_no' => $bank_num,
            'bank_name' => $bank_name,
            'bank_type' => $bank_address,
            'id_card_pic' => $id_card_pic,
            'id_card' => $id_card_no,
            'qualification_pic' => $qualification_pic,
            'good_print_band' => $repair_bank,
        );
        $update = $this->sxg_repair_user->update($data, array(
            'repair_user_id' => $repair_user_id
        ));
        if($update){
            echo $this->apiReturn('0000', new stdClass(), $this->response_msg['0000']);
            exit();
        }else{
            echo $this->apiReturn('0002', new stdClass(), $this->response_msg['0002']);
            exit();
        }

    }
    public function check_code(){
        $mobile = $this->input->post("mobile");
        $code = $this->input->post("code");
        if(empty($mobile) || empty($code)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg['0003']);
            exit();
        }

        if(!isset( $_SESSION["{$mobile}code"])){
            echo $this->apiReturn('0012', new stdClass(), $this->response_msg['0012']);
            exit();
        }else{
            $server_code = $_SESSION["{$mobile}code"];
        }
        if($server_code == $code){
            echo $this->apiReturn('0000', new stdClass(), $this->response_msg['0000']);
            exit();
        }else{
            echo $this->apiReturn('0012', new stdClass(), $this->response_msg['0012']);
            exit();
        }
    }
    //测试
    public function test(){
        var_dump($_SESSION);
        echo json_encode('sss');
    }
    /**
     * 上传
     */
    public function upload(){
        $this->load->library('upload_image');
        $ret = $this->upload_image->upload('file');
        if($ret['is_success']){
            $ret['path2'] = str_replace(ROOTPATH, '', $ret['path']);//将路径换成相对路径
            $ret['path'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$ret['path2'];//将路径换成相对路径
            echo $this->apiReturn('0000', $ret, 'success');
            return;
        }
        echo $this->apiReturn('0002', $ret, '上传失败');
        return;
    }
}