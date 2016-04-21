<?php
/**
 * Author:LNC
 * Description: 后台登录模型
 * Date: 2016/4/21 0021
 * Time: 下午 4:48
 */

class Sxg_admin extends CI_Model{

    private $admin_table = 'sxg_admin';
    private $admin_group_table = 'sxg_admin_group';

    public function __construct(){

        $this->load->database();
    }


    /**
     * 通过子帐号ID找到该账号所有的子帐号
     * @param $admin_id
     * @return mixed
     */
    public function findAdminByAdminId($admin_id){
        $array = array(
            'parent_id' => $admin_id
        );

        $this->db->select()->from($this->admin_table)->where($array);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    /**
     * 通过后台账号Id找到后台组的名字
     * @param $id
     * @return mixed
     */
    public function findGroupName($group){

        $sql = 'SELECT group_name FROM sxg_admin_group WHERE id IN('.$group.') and status_is = "Y"';
        $query = $this->db->query($sql);
        return $query->result_array();
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

    /**
     *
     * 添加子帐号
     * @param $admin_name
     * @param $admin_psw
     * @param $admin_group
     * @param $parent_id
     * @return mixed
     */
    public function add_admin_account($admin_name, $admin_psw, $admin_group, $parent_id){
        $array = array(
            'username' => $admin_name,
            'psw' => md5($admin_psw),
            'parent_id' => $parent_id,
            'group_id' => $admin_group,
            'createtime'=> time()
        );
        $result = $this->db->insert($this->admin_table, $array);
        return $result;

    }

}