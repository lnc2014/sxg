<?php
/**
 * Author:LNC
 * Description: 测试方法
 * Date: 2016/4/20 0020
 * Time: 下午 4:52
 */

class Test extends CI_Controller{


    public function nihao(){

        $params = array(
            'admin_name'=>'lnc',
            'admin_id' => 2526
        );
        $this->load->library('common/sign');
        $sign = $this->sign->make_sign($params);
        var_dump($sign);

        $sign = 'HSKNSKJKDSJLKDJLK';
        $check = $this->sign->check_sign($params,$sign);
        var_dump($check);

    }

    public function index(){
        echo 222;
    }
}