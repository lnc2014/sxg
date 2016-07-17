<?php
/**
 * Description：订单模型
 * Author: LNC
 * Date: 2016/5/5
 * Time: 0:00
 */
include_once 'BaseModel.php';

class Sxg_invoice extends BaseModel{

    private $invoice_table = 'sxg_invoice';

    public function __construct()
    {
        $table_name = $this->invoice_table;
        parent::__construct($table_name);
    }
    /**
 *
 * 通过UserId找到个人的发票信息
 * @param $user_id
 * @return mixed
 */
    public function findInvoicesByUserId($user_id){

        $this->db->select()->from('sxg_invoice as a, sxg_address as b')->where('a.user_id',$user_id);
        $this->db->where(' a.`address_id` = b.`address_id`');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    /**
     *
     * 通过条件查找订单的相关的信息，返回一条数据
     * @param $user_id
     * @return mixed
     */
    public function findOrdersByCondition($condition = array(),$more = 1){

        $this->db->select()->from($this->order_table)->where($condition);
        $query = $this->db->get();

        //是返回一条数据还是多条数据
        if($more == 1){
            $result = $query->row_array();
        }else{
            $result = $query->result_array();
        }

        return $result;
    }



}