<?php
/**
 * Description：数据模型基础
 * Author: LNC
 * Date: 2016/5/4
 * Time: 23:01
 */

class BaseModel extends CI_Model{


    public function __construct()
    {

        $this->load->database();
    }
}