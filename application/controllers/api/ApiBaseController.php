<?php

/**
 * Author:LNC
 * Description: api接口基本控制器
 * Date: 2016/4/28 0028
 * Time: 下午 3:59
 */
class ApiBaseController extends CI_Controller{


    protected $response_msg = array();//api接口返回的数据

    public function __construct(){

        parent::__construct();
        $this->config->load('common/config_response', TRUE);
        $this->response_msg = $this->config->item('response', 'common/config_response');


    }

    /**
     *
     * 接口返回公共解析方法
     * @param $code
     * @param $data
     * @param $msg
     * @return string
     */

    public function apiReturn($code, $data, $msg){
        $arr['code'] = $code;
        $arr['data'] = empty($data)?'':$data;
        $arr['msg'] = $msg;
        return json_encode($arr);

    }

}