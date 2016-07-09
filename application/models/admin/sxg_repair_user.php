<?php
/**
 * Description：订单模型
 * Author: LNC
 * Date: 2016/5/5
 * Time: 0:00
 */
include_once 'BaseModel.php';

class Sxg_repair_user extends BaseModel{

    private $repair_table = 'sxg_repair_user';

    /**
     * 查询单条用户记录
     *
     * @param array  $where
     * @param string $fields
     *
     * PS : 可根据业务场景扩展
     */
    public function get_one($where, $fields='*')
    {
        return $this->db->select($fields)->where($where)->get($this->repair_table)->row_array();
    }

    /**
     * 查询多条用户记录
     * @param array  $where
     * @param string $fields
     */
    public function get_list($where, $fields='*')
    {
        return $this->db->select($fields)->where($where)->get($this->repair_table)->result_array();
    }

    /**
     * 新增
     *
     * @param array $data	更新字段
     *
     * @return int $res     返回成功插入记录对应的ID
     */
    public function add($data)
    {
        $this->db->insert($this->repair_table, $data);
        return $this->db->insert_id();
    }
    /**
     * 更新
     *
     * @param array $data   更新字段
     * @param array $where  判定条件
     */
    public function update($data, $where)
    {
        return $this->db->update($this->_tablename, $data, $where);
    }
    /**
     * 找出所有的维修人员
     * @return mixed
     */
    public function findAllRepairs(){

        $this->db->select()->from($this->repair_table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
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
     * 通过条件查找维修人员的信息
     * @param $user_id
     * @return mixed
     */
    public function get_data($condition, $more = 1){
        $this->db->select()->from($this->repair_table)->where($condition);
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