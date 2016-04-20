<?php
/**
 * Author:LNC
 * Description: 后台权限判断以及登录
 * Date: 2016/4/20 0020
 * Time: 下午 3:56
 */

class BaseController extends CI_Controller{

    public $admin_name='';
    public $admin_group;
    public $admin_id;
    public $sign;


    public function __construct(){
        parent::__construct();

        session_start();
        $this->admin_name = $_SESSION['admin_name'];
        $this->admin_id = $_SESSION['admin_id'];
        $this->sign = $_SESSION['sign'];
        if(!$this->check_login()){
            $this->load->view('login/login');
        }


    }

    /**
     *
     * 登录验证
     * @return bool
     */
    public function check_login(){

        $this->sign = $_SESSION['sign'];

        if(isset($this->sign) && !empty($this->sign)){

            $params = array(
                'admin_name' =>$this->admin_name,
                'admin_id' =>$this->admin_id,
            );
            $this->load->library('common/sign');
            $check = $this->sign->check_sign($params,$this->sign);
            //签名是不是成功，作为登录验证的一个标准
            if($check){
                //TODO 账号密码验证
                return true;

            }else{
                return false;
            }

        }
        return false;
    }


}