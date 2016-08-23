<?php
/**
 * Description：数据模型基础
 * 定义几个基础的方法，包括查询一条记录，查询多条记录，增加一条记录，删除记录
 * Author: LNC
 * Date: 2016/5/4
 * Time: 23:01
 */

class BaseModel extends CI_Model{

    private $_tablename;

    public function __construct($table_name)
    {
        $this->_tablename = $table_name;
        parent::__construct();
        $this->load->database();
    }
    /**
     * 查询单条记录
     * @param array  $where
     * @param string $fields
     */
    public function get_one($where, $fields='*')
    {
        return $this->db->select($fields)->where($where)->get($this->_tablename)->row_array();
    }

    /**
     * 新增
     * @param array $data	新增数据
     * @return int $res     返回成功插入记录对应的ID
     */
    public function add($data)
    {
        $this->db->insert($this->_tablename, $data);
        return $this->db->insert_id();
    }

    /**
     * 更新
     * @param array $data   更新字段
     * @param array $where  判定条件
     */
    public function update($data, $where)
    {
        return $this->db->update($this->_tablename, $data, $where);
    }

    /**
     * 删除
     */
    public function del($where){
        if (empty($where)) {
            return false;
        }
        $this->db->where($where);
        $this->db->delete($this->_tablename);
        return $this->db->affected_rows();
    }
    /**
     * 获取客户单位列表
     * @param array  $where
     * @param string $fields
     * @param int 	 $limit
     * @param int 	 $offset
     * @return array
     */
    public function get_list($where = NULL, $fields='*', $limit=NULL, $offset=NULL)
    {
        $this->db->select($fields);
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->_tablename, $limit, $offset);
        return $query->result_array();
    }

    /**
     * 公用方法 联查
     * @param array  $where
     * @param string $fields
     * @param int 	 $limit
     * @param int 	 $offset
     * @param array  $join
     *          |- string  table
     *          |- string  cond  关联条件
     *          |- string  type  联查方式 ep:'left, right inner'
     * @param order
     * @param group
     * @param $alias 为主表设置别名
     * @return array
     */
    public function get_list_by_join($where=NULL, $fields='*',$limit=NULL, $offset=NULL, $join = NULL, $order=NULL, $group=NUll, $alias=NULL)
    {
        $this->db->select($fields);
        $table = $this->_tablename;
        if(!empty($where))
            $this->db->where($where);
        if($join !== NULL)
            $this->db->join($join['table'], $join['cond'], $join['type']);
        $this->db->order_by($order);
        $this->db->group_by($group);
        $this->db->limit($limit, $offset);

        if (!empty($alias)) {
            $table .= ' as '.$alias;
        }
        $query = $this->db->get($table);
        // var_dump($this->db->last_query());
        return $query->result_array();
    }

    /**
     * 公用方法， 多表联查
     * @param array  $where
     * @param string $fields
     * @param int 	 $limit
     * @param int 	 $offset
     * @param array  $join 二维关联数组
     *         array
     *          |- string  table
     *          |- string  cond  关联条件
     *          |- string  type  联查方式 ep:'left, right inner'
     * @return array
     */
    public function get_list_by_multi_join($where=NULL, $fields='*',$limit=NULL, $offset=NULL, $join = NULL, $order=NULL, $group=NUll, $alias=NULL)
    {
        $this->db->select($fields);
        $table = $this->_tablename;

        if(!empty($where))
            $this->db->where($where);

        if($join !== NULL) {
            foreach ($join as $val) {
                $this->db->join($val['table'], $val['cond'], $val['type']);
            }
        }
        if (!empty($alias)) {
            $table .= ' as '.$alias;
        }
        $this->db->order_by($order);
        $this->db->group_by($group);
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table);
//        var_dump($this->db->last_query());
        return $query->result_array();
    }
}