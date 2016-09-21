<?php
/**
 * Description：用户管理
 * Author: LNC
 * Date: 2016/5/4
 * Time: 22:53
 */

include_once 'BaseController.php';

class User extends BaseController{
    /**
     * 用户管理
     */

    public function index(){

        $this->load->model('admin/sxg_user');
        $users = $this->sxg_user->findAllUsers();

        $this->load->view('admin/user',array(
            'users' => $users
        ));

    }

    /**
     * 用户投诉
     */
    public function user_feedback(){

        $this->load->model('admin/sxg_user');
        $user_feedbacks = $this->sxg_user->findAllFeedbacks();

        $this->load->view('admin/user_feedback',array(
            'user_feedbacks' => $user_feedbacks
        ));
    }

    /**
     * 冻结账号
     */

    public function frozen_user(){
        $user_id = $this->uri->segment(4);//使用ci自带方法拿到admin_id
        $flag = $this->uri->segment(5);//使用ci自带方法拿到是否冻结还是解冻

        if(empty($user_id)){
            //跳转到错误页面
            $this->load->view('errors/error',array('code'=>500,'msg'=>'冻结账号不能为空！'));
        }else{

            $this->load->model('admin/sxg_user');
            $admin = $this->sxg_user->frozen_user($user_id, $flag);
            if($flag == 1){
                $msg = '解冻成功';
                $error_msg = '解冻失败，请联系管理员';
            }else{
                $msg = '冻结成功';
                $error_msg = '冻结失败，请联系管理员';
            }
            $url = site_url('admin/user/index');
            if($admin){
                echo "<script>
                        alert('".$msg."');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }else{
                echo "<script>
                        alert('".$error_msg."');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }
        }
    }
    /**
     * 冻结账号
     */

    public function month_user(){

        $user_id = $this->uri->segment(4);//使用ci自带方法拿到admin_id
        $flag = $this->uri->segment(5);//使用ci自带方法拿到是否冻结还是解冻

        if(empty($user_id)){
            //跳转到错误页面
            $this->load->view('errors/error',array('code'=>500,'msg'=>'设为月结账号不能为空！'));
        }else{

            $this->load->model('admin/sxg_user');
            $admin = $this->sxg_user->month_user($user_id, $flag);

            $msg = '修改成功';
            $error_msg = '修改失败，请联系管理员';
            $url = site_url('admin/user/index');
            if($admin){
                echo "<script>
                        alert('".$msg."');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }else{
                echo "<script>
                        alert('".$error_msg."');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }
        }

    }
}