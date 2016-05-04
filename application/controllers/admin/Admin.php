<?php
/**
 * Author:LNC
 * Description: 后台管理后台控制器
 * Date: 2016/4/20 0020
 * Time: 下午 3:54
 */
include_once 'BaseController.php';

class Admin extends BaseController{

    /**
     * 后台登录首页
     */

    public function index(){

        $this->load->view('admin/index');

    }

    /**
     * 账号管理
     */
    public function account(){

        $this->load->model('admin/sxg_admin');
        $admins = $this->sxg_admin->findAdminByAdminId($_SESSION['admin_id']);

        $this->load->view('admin/account',array(
            'admins' => $admins
        ));

    }

    /**
     * 冻结账号
     */

    public function frozen_account(){

        $admin_id = $this->uri->segment(4);//使用ci自带方法拿到admin_id
        $flag = $this->uri->segment(5);//使用ci自带方法拿到是否冻结还是解冻

        if(empty($admin_id)){
            //跳转到错误页面
            $this->load->view('errors/error',array('code'=>500,'msg'=>'冻结账号不能为空！'));
        }else{

            $this->load->model('admin/sxg_admin');
            $admin = $this->sxg_admin->frozen_account($admin_id, $flag);
            if($flag == 1){
                $msg = '解冻成功';
                $error_msg = '解冻失败，请联系管理员';
            }else{
                $msg = '冻结成功';
                $error_msg = '冻结失败，请联系管理员';
            }
            $url = site_url('admin/admin/account');
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
     * 删除子帐号
     */

    public function delete_account(){
        $admin_id = $this->uri->segment(4);//使用ci自带方法拿到admin_id


        if(empty($admin_id)){
            //跳转到错误页面
            $this->load->view('errors/error',array('code'=>500,'msg'=>'冻结账号不能为空！'));
        }else{

            $this->load->model('admin/sxg_admin');
            $admin = $this->sxg_admin->delete_account($admin_id);

            $url = site_url('admin/admin/account');
            if($admin){
                echo "<script>
                        alert('删除子帐号成功！');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }else{
                echo "<script>
                        alert('删除子帐号失败，请联系管理员！');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }
        }
    }

    //后台错误页面
    public function error(){
        $this->load->view('errors/error');
    }

    /**
     * 增加子帐号
     */
    public function add_account(){

        if(!empty($_POST)){

            $admin_name = empty($_POST['admin_name'])?'':$_POST['admin_name'];
            $admin_psw = empty($_POST['admin_psw'])?'':$_POST['admin_psw'];
            $admin_group = empty($_POST['admin_group'])?array():$_POST['admin_group'];
            $group = '';

            $count = count($admin_group);
            foreach($admin_group as $k=>$value){

                if($k == $count -1){
                    $group .= $value;
                }else{
                    $group .= $value.',';
                }
            }
            $this->load->model('admin/sxg_admin');
            $result = $this->sxg_admin->add_admin_account($admin_name, $admin_psw, $group, $_SESSION['admin_id']);
            $url = site_url('admin/admin/account');
            if($result){

                echo "<script>
                        alert('添加成功！');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }else{
                echo "<script>
                        alert('添加失败，请联系管理员！');
                        window.location.href='".$url."';
                      </script>";
                exit;

            }
        }


        $this->load->view('admin/add_account');

    }


    /**
     * 退出登录
     */
    public function login_out(){
        if(session_destroy()){
            redirect('admin/login');
        }
    }
}