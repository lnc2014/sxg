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

    public function test(){
        echo  222;
    }
}