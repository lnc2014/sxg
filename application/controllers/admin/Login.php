<?php
/**
 * Author:LNC
 * Description: 后台登录
 * Date: 2016/4/21 0021
 * Time: 上午 11:07
 */

class login extends CI_Controller{

    /**
     *后台登录页面
     */

    public function index(){

        session_start(600);
        $admin_name = empty($_SESSION['admin_name'])?'':$_SESSION['admin_name'];
        $admin_id = empty($_SESSION['admin_id'])?'':$_SESSION['admin_id'];
        $admin_sign = empty($_SESSION['sign'])?'':$_SESSION['sign'];
//已经登录不在需要登录
        if(!empty($admin_name) && !empty($admin_sign)){
            $this->load->helper('url');
            redirect('admin/admin/index');
        }
        $this->load->helper('url');
        $this->load->view('admin/login');
    }


    public function test()
    {

        var_dump($_SESSION);exit;
    }
    /**
     * 登录验证
     */
    public function login_check(){

        $admin_name = $this->input->post('admin_name');
        $admin_psw = $this->input->post('admin_psw');

        if(empty($admin_name) || empty($admin_psw)){
            $this->load->library('common/func');
            echo $this->func->apiReturn('0001','','登录的用户名不能为空！');
            exit;
        }

        $this->load->model('admin/sxg_admin');
        $check  = $this->sxg_admin->findAdminByAdminName($admin_name,$admin_psw);

        if(empty($check)){
            $this->load->library('common/func');
            echo $this->func->apiReturn('0002','','登录的密码不正确！');
            exit;
        }else{
            //登录成功，将sign和admin_id存入数据库进行比对
            session_start(600);//设置十分钟后过期
            $_SESSION['admin_name'] = $check['username'];
            $_SESSION['admin_id'] = $check['id'];

            $this->load->library('common/sign');
            $params = array(
                'admin_name' => $check['username'],
                'admin_id' => $check['id'],
            );
            $sign = $this->sign->make_sign($params);
            $_SESSION['sign'] = $sign;
            $this->load->library('common/func');
            echo $this->func->apiReturn('0003','','登录的成功！');
            exit;
        }

    }
}