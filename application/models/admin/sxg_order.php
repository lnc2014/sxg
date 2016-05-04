<?php
/**
 * Description：订单模型
 * Author: LNC
 * Date: 2016/5/5
 * Time: 0:00
 */
include_once 'BaseModel.php';

class Sxg_order extends BaseModel{

    private $order_table = 'sxg_order';


    /**
 *
 * 通过UserId找到个人的订单
 * @param $user_id
 * @return mixed
 */
    public function findOrdersByUserId($user_id){

        $array = array(
            'user_id' => $user_id
        );

        $this->db->select()->from($this->order_table)->where($array);
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

    /**
     * 结款
     */
    public function order_pay($order_id, $is_pay = 0){
        $data = array(
            'is_pay' => $is_pay
        );
        $this->db->where('id', $order_id);
        return $this->db->update($this->order_table, $data);
    }

}