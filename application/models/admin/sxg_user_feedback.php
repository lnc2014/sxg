<?php
/**
 * Description：闪修哥意见反馈数据模型
 * Author: LNC
 * Date: 2016/6/2
 * Time: 22:58
 */
include_once 'BaseModel.php';
class sxg_user_feedback extends BaseModel{

    private $table_name = 'sxg_user_feedback';
    public function __construct()
    {
        $table_name = $this->table_name;
        parent::__construct($table_name);
    }
    /**
     * 添加反馈意见
     */
    public function insert_data($data){
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

}

