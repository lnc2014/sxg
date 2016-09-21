<?php
/**
 * Description：订单控制器
 * Author: LNC
 * Date: 2016/5/4
 * Time: 23:53
 */

include_once 'BaseController.php';

class Order extends BaseController{

    /**
     * 订单中心
     */
    public function index(){
        $this->load->model('admin/sxg_order');
        $this->load->model('admin/sxg_address');
        $repair_assign = $this->input->get("repair_assign");//分配维修人员方式
        $page = empty($this->input->get("page"))?0:$this->input->get("page");//页数
        $where = array(
            'status' => 1
        );
        if(!empty($repair_assign)){
            $where = array(
                'status' => 1,
                'repair_assign' => $repair_assign,
            );
        }
        $page_size = 30;//每页十条记录
        if(empty($page) || $page == 1){
            $page = 1;
            $limit = $page_size;
            $offset = 0;
        }else{
            $limit = $page_size;
            $offset =  ($page-1)*$page_size;
        }
        $orders = $this->sxg_order->get_list($where, '*', $limit, $offset, 'id'); //找出所有的订单
        $order_count = $this->sxg_order->get_list($where); //找出所有的订单
        $order_count = count($order_count);
        $order_count  = ceil($order_count/$page_size);
        foreach($orders as $k => $order){
            $orders[$k]['address'] = '';
            $address_info = $this->sxg_address->get_one(array(
                'address_id' => $order['address_id']
            )); //找出所有的订单
            if(!empty($address_info)){
                $orders[$k]['address'] = $address_info['province'].$address_info['city'].$address_info['area'].$address_info['street'];
            }
        }
        $this->load->view('admin/order',array(
            'orders' => $orders,
            'pages' => $order_count,
            'page' => $page,
        ));
    }

    /**
     * 订单分配列表
     */
    public function order_assign(){
        $this->load->view('admin/order_assign');
    }

    /**
     * 派单
     */
    public function order_offer(){
        $order_id = $this->input->get("order_id");//分配维修人员方式
        if(empty($order_id)){
            $this->load->view('errors/error', array('code' => 500, 'msg' => '订单编号不能为空！'));
        }
        $this->load->model('admin/sxg_repair_user');
        $repair = $this->sxg_repair_user->get_list(array('status' => 1, 'flag' => 1));
        $this->load->view('admin/order_offer',array(
            'repairs' => $repair,
            'order_id' => $order_id,
        ));
    }
    //处理分配订单的接口
    public function order_offer_data(){
        $order_id = $this->input->post("order_id", true);//分配订单ID
        $repair_user_id = $this->input->post("repair_user_id", true);//分配维修人员ID
        if(empty($order_id) || empty($repair_user_id)){
            echo $this->apiReturn('0003', new stdClass(),  $this->response_msg["0003"]);
            return;
        }
        $this->load->model('admin/sxg_order');
        $this->load->model('admin/sxg_repair_user');
        $repair_user = $this->sxg_repair_user->get_one(array('repair_user_id' => $repair_user_id));
        $order = $this->sxg_order->get_one(array('id' => $order_id));
        if(empty($order) || empty($repair_user)){
            echo $this->apiReturn('0005', new stdClass(), $this->response_msg["0005"]);
            return;
        }
        if($order['status'] != 1){
            echo $this->apiReturn('0200', new stdClass(), $this->response_msg["0200"]);
            return;
        }
        $update = $this->sxg_order->update(array(
            'status' => 2,
            'repair_user_id' => $repair_user_id
        ),array('id' => $order_id));
        if($update){
            echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
            return;
        }else{
            echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
            return;
        }
    }
    /**
     * 发票配送列表
     */
    public function send_invoice_list(){
        $this->load->view('admin/send_invoice_list');
    }
    /**
     * 通过个人的UserID找到个人的订单
     */
    public function user_order(){
        $user_id = $this->uri->segment(4);//使用ci自带方法拿到user_id
        if(empty($user_id)){
            $this->load->view('errors/error',array('code'=>500,'msg'=>'用户ID不能为空'));
        }else{
            $this->load->model('admin/sxg_order');
            $orders = $this->sxg_order->findOrdersByUserId($user_id);
            $this->load->view('admin/user_order',array(
                'orders' => $orders
            ));
        }
    }

    /**
     * 订单详情
     */
    public function order_detail(){
        $order_id = $this->uri->segment(4);//使用ci自带方法拿到order_id
        if(empty($order_id)) {
            //跳转到错误页面
            $this->load->view('errors/error', array('code' => 500, 'msg' => '订单编号不能为空！'));
        }else{
            $this->load->model('admin/sxg_order');
            $order = $this->sxg_order->findOrdersByCondition(array('id'=>$order_id),1);
            $this->load->view('admin/order_detail',array(
                'order' => $order
            ));
        }
    }

    /**
     * 订单详情接口
     */
    public function get_order_detail(){
        $order_id = $this->input->post("order_id");
        if(empty($order_id)){
            echo $this->apiReturn('0003', new stdClass(), '订单ID不能空！');
            return;
        }
        $this->load->model('admin/sxg_order');
        $order = $this->sxg_order->get_order_detail($order_id);

        $data['band'] = $order['print_band'];
        $data['model'] = $order['print_model'];
        $data['problem'] = '';
        //维修内容特殊处理0001加粉（加墨）;0002打印质量差（需要拍照上传质量差页）;0003不能开机;0004卡纸
        if(is_numeric(strpos($order['repair_option'],'0001'))){
            $data['problem'] = $data['problem'].';加粉（加墨）';
        }
        if(is_numeric(strpos($order['repair_option'],'0002'))){
            $data['problem'] = $data['problem'].';打印质量差（需要拍照上传质量差页）';
        }
        if(is_numeric(strpos($order['repair_option'],'0003'))){
            $data['problem'] = $data['problem'].';不能开机';
        }
        if(is_numeric(strpos($order['repair_option'],'0004'))){
            $data['problem'] = $data['problem'].';卡纸';
        }
        $data['problem'] = trim($data['problem'], ';').';'.$order['repair_problem'];
        $data['time'] =  $order['visit_option'];
        if($order['visit_option'] == 2){
            $data['time'] =  date('m月d日 H时i分s秒', $order['visit_time']);
        }
        $data['name'] = $order['user_name'];
        $data['phone'] = $order['mobile'];
        $data['address'] = $order['province'].$order['city'].$order['area'].$order['street'];
        $pic = array();
        $data['pics'] = $pic;
        if(!empty($order['repair_pic'])){
            $pics = explode(';', $order['repair_pic']);
            foreach($pics as $value){
                $pic[] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$value;
            }
            $data['pics'] = $pic;
        }
        echo $this->apiReturn('0000', $data, 'success！');
        return;
    }
    /**
     * 结款
     */

    public function order_pay(){ 
        $order_id = $this->uri->segment(4);//使用ci自带方法拿到order_id
        $flag = $this->uri->segment(5);//使用ci自带方法拿到是否结款
        $user_id = $this->uri->segment(6);//使用ci自带方法拿到是否结款

        if(empty($order_id)){
            //跳转到错误页面
            $this->load->view('errors/error',array('code'=>500,'msg'=>'结款账号不能为空！'));
        }else{

            $this->load->model('admin/sxg_order');
            $admin = $this->sxg_order->order_pay($order_id, $flag);
            if($flag == 1){
                $msg = '设为已结款成功';
                $error_msg = '设为已结款失败，请联系管理员';
            }else{
                $msg = '恢复为未结款成功';
                $error_msg = '恢复为未结款失败，请联系管理员';
            }
            $url = site_url("admin/order/user_order/{$user_id}");
            if($admin){
                echo "<script>
                        alert('".$msg."');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }else{
                echo "<script>
                        alert('".$error_msg."');
                        window.location.href='".$url."';
                      </script>";
                exit;
            }
        }

    }
}