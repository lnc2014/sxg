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
    public $admin_sign;


    public function __construct(){
        parent::__construct();
        session_start(600);
        $this->load->helper('url');

        header("Content-type:text/html;charset=utf-8");
        date_default_timezone_set('PRC'); //设置中国时区
        $this->config->load('common/config_response', TRUE); //统一返回状态码loading
        $this->response_msg = $this->config->item('response', 'common/config_response');
        $this->admin_name = empty($_SESSION['admin_name'])?'':$_SESSION['admin_name'];
        $this->admin_id = empty($_SESSION['admin_id'])?'':$_SESSION['admin_id'];
        $this->admin_sign = empty($_SESSION['sign'])?'':$_SESSION['sign'];
        $this->data = array();
        if(!$this->check_login()){
            redirect('/admin/login');
        }
    }

    /**
     *
     * 登录验证
     * @return bool
     */
    public function check_login(){
        if(isset($this->admin_sign) && !empty($this->admin_sign)){
            $params = array(
                'admin_name' =>$this->admin_name,
                'admin_id' =>$this->admin_id,
            );
            $this->load->library('common/sign');
            $check = $this->sign->check_sign($params,$this->admin_sign);
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
    /**
     * 接口api统一结果处理
     * @param $result
     * @param $data
     * @param $info
     * @return string
     */
    public function apiReturn($result, $data, $info) {
        $arr["result"] = $result;
        $arr["data"] = $data === null ? '' : $data;
        $arr["info"] = $info;
        return json_encode($arr);
    }
    //检测订单是不是有效订单
    public function check_order($order_id){
        if(empty($order_id)){
            return false;
        }
        $this->load->model('admin/sxg_order');
        $order = $this->sxg_order->get_one(array('id'=>$order_id));
        if(empty($order)){
            return false;
        }
        return $order;
    }
}