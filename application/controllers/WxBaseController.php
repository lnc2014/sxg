<?php
/**
 * Description:微信端基础类
 * Author: LNC
 * Date: 2016/5/25
 * Time: 22:51
 */

class WxBaseController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        session_start();
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
     * 检测用户是否有已授权
     */
    public function check_user()
    {
        $_SESSION['user_id'] = 1;
        $_SESSION['jspayOpenId'] = 'ohoNsuGpFYcqe6AWeJ9plmVAir5A';
        //检测用户是否已经登录授权过
        if(isset($_SESSION['user_id']) && isset($_SESSION['jspayOpenId'])){
            return true;
        }
        $this->load->model('admin/sxg_user');
        $data = $this->get_user_openid();//用户无登录入口，必须微信自动登录
        $user = $this->sxg_user->get_one(array('wx_openid' => $data['openid']), 'user_id');

        if(!empty($user)){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['jspayOpenId'] = $data['openid'];
            return true;
        }else{
            $user_info = $this->get_user_info_by_snsapi($data['openid'], $data['access_token']);
            $data = array(
                'wx_openid' => $data['openid'],
                'user_name' => empty($user_info['nick_name'])?'':$user_info['nick_name'],
                'headimgurl' => empty($user_info['head_url'])?'':$user_info['head_url'],
                'create_time' => time(),
            );
            $user_id = $this->sxg_user->add($data);
            if($user_id > 0 ){
                $_SESSION['user_id'] = $user_id;
                $_SESSION['jspayOpenId'] = $data['openid'];
                return true;
            }else{
                return false;
            }
        }
    }

    /**
     * 检测用户是否已经绑定手机
     */
    public function check_phone($user_id){
        if(empty($user_id)){
            return false;
        }
        $this->load->model('admin/sxg_user');
        $user = $this->sxg_user->get_one(array('user_id' => $user_id), 'mobile');
        if(empty($user)){
            return false;
        }
        return true;
    }
    /**
     * 发送验证码
     */
    public function get_code($mobile, $code){
        //发送短信
        $this->load->library('sms');
        return $this->sms->send_register($mobile, $code);
    }

}
