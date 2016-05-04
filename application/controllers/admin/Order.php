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