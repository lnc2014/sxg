<?php
/**
 * Author:LNC
 * Description: 后台登录模型
 * Date: 2016/4/21 0021
 * Time: 下午 4:48
 */

class Sxg_admin extends CI_Model{

    private $admin_table = 'sxg_admin';

    public function __construct(){

        $this->load->database();
    }


    /**
     *
     * 后台登录验证
     * @param $admin_name
     * @param $admin_psw
     * @return mixed
     */
    public function findAdminByAdminName($admin_name, $admin_psw){

        $array = array(
            'username' => $admin_name,
            'psw' => md5($admin_psw),
        );

        $this->db->select()->from($this->admin_table)->where($array);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

}