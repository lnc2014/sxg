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
    public function test(){
        echo  222;
    }
}