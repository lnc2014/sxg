<?php
/**
 * Author:LNC
 * Description: 前台维修用户管理
 * Date: 2016/4/26 0026
 * Time: 下午 5:05
 */

include_once 'BaseModel.php';

class Sxg_user extends BaseModel{

    private $user_table = 'sxg_user';


    /**
     * 找出所有的用户
     * @return mixed
     */
    public function findAllUsers(){

        $this->db->select()->from($this->user_table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    /**
     * 冻结或者解冻账号
     */
    public function frozen_user($user_id, $status=1){
        $data = array(
            'status' => $status
        );
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->user_table, $data);
    }
    /**
     * 冻结或者解冻账号
     */
    public function month_user($user_id, $is_month=1){
        $data = array(
            'is_month' => $is_month
        );
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->user_table, $data);
    }

}