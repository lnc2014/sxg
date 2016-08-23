<?php
/**
 * Description：维修订单详情
 * Author: LNC
 * Date: 2016/5/5
 * Time: 0:00
 */
include_once 'BaseModel.php';
class Sxg_repair_info extends BaseModel{

    private $order_table = 'sxg_repair_info';
    public function __construct()
    {
        $table_name = $this->order_table;
        parent::__construct($table_name);
    }
}