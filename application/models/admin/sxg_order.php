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

    public function __construct()
    {
        $table_name = $this->order_table;
        parent::__construct($table_name);
    }

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
    public function findOrdersByCondition($condition = array(), $more = 1){
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
     * 通过维修人员ID查找所有的订单
     * @param $repair_user_id
     * @param string $status
     */
    public function get_orders_by_repair_user_id($repair_user_id, $field = '*', $status = ''){

        $this->db->select($field)->from($this->order_table);
        $this->db->where('repair_user_id', $repair_user_id);
        if(!empty($status)){
            $this->db->where('status', $status);
        }
        $this->db->order_by('createtime DESC');
        $query = $this->db->get();
        $result = $query->result_array();
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

    /**
     * 通过订单ＩＤ获得订单详情
     * @param $order_id
     * @param string $field
     * @return mixed
     */
    public function get_order_detail($order_id, $field = '*'){
        $this->db->select($field)->from('sxg_order AS o , sxg_user AS u ,sxg_address AS a ');
        $this->db->where('o.`id`', $order_id);
        $this->db->where('o.`user_id` = u.`user_id`');
        $this->db->where(' a.`address_id` = o.`address_id`');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    /**
     * 添加订单
     */
    public function insert_data($data){
        $this->db->insert($this->order_table, $data);
        return $this->db->insert_id();
    }

    /**
     * 通过订单ID查找订单的信息
     * @param $order_id
     * @return mixed
     */
    public function find_order_by_id($order_id){
        $this->db->select();
        $this->db->where("id", $order_id);
        $this->db->from($this->order_table);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     *  通过条件来修改订单信息
     *
     */
    public function update_order_by_condition($data, $where){
        return $this->db->update($this->order_table, $data, $where);
    }

    /**
     * 通过用户ID查找用户的所有的订单
     * @param $user_id
     * @return mixed
     */

    public function find_all_order_by_user_id($user_id, $status = 0){
//        1,待接单2，待上门3,检测中4,调配件5,维修中6,待点评7,已结束8,已取消
        if($status != 0){
            $this->db->where("status", $status);
        }
        $this->db->select();
        $this->db->where("user_id", $user_id);
        $this->db->from($this->order_table);
        $this->db->order_by('updatetime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * 通过维修人员ID找到该维修人员的所有订单
     * @param $repair_user_id
     */
    public function get_repair_order_list($repair_user_id, $status = ''){
        $this->db->select('o.`id`,o.`status`,u.`user_name`,u.`mobile`,a.`province`,a.`city`,a.`area`,a.`sex`,a.`street`,o.`visit_option`,o.`visit_time`');
        $this->db->from('sxg_order AS o , sxg_user AS u , sxg_address AS a');
        $this->db->where("o.`repair_user_id`", $repair_user_id);
        $this->db->where('u.`user_id` = o.`user_id`');
        $this->db->where('a.`address_id` = o.`address_id`');
        if(!empty($status)){
            if($status == 3){
                $this->db->where('o.`status` in (3,4,5)');
            }else{
                $this->db->where('o.`status`', $status);
            }
        }
        $this->db->order_by('o.`id`', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * 通过订单ID找到维修订单的详细信息
     * @param $order_id
     * @return mixed
     */
    public function get_repair_order_detail($order_id){
        $this->db->select('a.*,o.*,u.*,o.status as order_status');
        $this->db->from('sxg_address AS a, sxg_order AS o, sxg_user AS u');
        $this->db->where("o.`id`", $order_id);
        $this->db->where('u.`user_id` = o.`user_id`');
        $this->db->where('o.`address_id`  = a.`address_id`');
        $query = $this->db->get();
        return $query->row_array();
    }
}