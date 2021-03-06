<?php
/**
 * Description：维修端基本控制器
 * Author: LNC
 * Date: 2016/8/4
 * Time: 20:53
 */

class repairBaseController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
    }

    /**
     * 检测维修人员是不是已经通过审核
     */
    public function check_is_used(){
        if(!$this->check_is_login()){
            redirect('/repair/repair/login');
        };
        $this->load->model('admin/Sxg_repair_user');
        $is_used = $this->Sxg_repair_user->get_one(array('repair_user_id'=>$_SESSION['repair_user_id']));
        if($is_used['status'] != 1){
            return false;
        }
        return true;
    }
    /**
     * 接口api统一结果处理
     * @param $result
     * @param $data
     * @param $info
     * @return string
     */
    public function apiReturn($result, $data, $info)
    {
        $arr["result"] = $result;
        $arr["data"] = $data === null ? '' : $data;
        $arr["info"] = $info;
        $res = json_encode($arr);
        return $res;
    }

    /**
     * 检测是不是已经登录
     */
    public function check_is_login(){
        //检测用户是否已经登录授权过
        if(isset($_SESSION['repair_user_id']) && isset($_SESSION['repair_mobile'])){
            return true;
        }
        return false;
    }
}
