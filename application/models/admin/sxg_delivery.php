<?php
/**
 * Description：闪修哥配送数据模型
 * Author: LNC
 * Date: 2016/6/2
 * Time: 22:58
 */
include_once 'BaseModel.php';
class sxg_delivery extends BaseModel{

    private $table_name = 'sxg_delivery';
    public function __construct()
    {
        $table_name = $this->table_name;
        parent::__construct($table_name);
    }

    /**
     * 获取配送详情
     */
    public function get_delivery_id_detail($delivery_id){
        $this->db->select()->from($this->table_name)->where('delivery_id', $delivery_id);
        $query = $this->db->get();
        return $query->row_array();
    }
}

