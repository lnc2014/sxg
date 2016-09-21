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
//        $_SESSION['user_id'] = 1;
//        $_SESSION['jspayOpenId'] = 'ohoNsuGpFYcqe6AWeJ9plmVAir5A';
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
        if(empty($user['mobile'])){
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
    /**
     * 获取微信用户openid
     * @return string
     */
    public function get_user_openid(){
        include_once(FCPATH . "public/user-pay/WxOpenIdHelper.php");
        $wxopenidhelper = new WxOpenIdHelper();
        $data = $wxopenidhelper->getOpenId();
        $_SESSION['jspayOpenId'] = $data['openid'];
        return $data;
    }
    /**
     * 通过授权拿到用户的openid和access_token
     */
    public function get_user_snaspi(){
        include_once(FCPATH . "public/user-pay/WxOpenIdHelper.php");
        $wxopenidhelper = new WxOpenIdHelper();
        $data = $wxopenidhelper->getOpenId();
        //获取到授权之后，将授权存入session中
        $_SESSION['access_token'] = $data['access_token'];
        $_SESSION['jspayOpenId'] = $data['openid'];
        return $data;
    }
    /**
     * 获取用户的头像
     * @param $open_id
     * @param $token
     * @return mixed
     */
    public function get_user_info_by_snsapi($open_id, $token){
        $url="https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$open_id&lang=zh_CN";
        $result=  file_get_contents($url);

        $result=  explode(",", $result);
        $nick_name=  explode(":",$result[1]);
        $head_url=  explode(":", $result[7]);
        $data["nick_name"]= str_replace('"',"",$nick_name[1]);
        $data["head_url"]=$head_url[1].":".$head_url[2];
        $data['head_url'] = str_replace('"',"",$data['head_url']);
        $data['head_url'] = stripslashes($data['head_url']);
        return $data;
    }

}
