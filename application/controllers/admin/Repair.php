<?php
/**
 * Description：维修人员管理控制器
 * Author: LNC
 * Date: 2016/5/4
 * Time: 23:53
 */

include_once 'BaseController.php';

class Repair extends BaseController{

    /**
     * 维修人员管理列表
     */
    public function index(){
        $this->load->model('admin/sxg_repair_user');
        $repairs = $this->sxg_repair_user->findAllRepairs();
        $this->load->view('admin/repair',array(
            'repairs' => $repairs
        ));
    }

    /**
     * 维修人员审核
     */
    public function repair_check(){
        $this->load->model('admin/sxg_repair_user');
        $where = "status = 2";
        $repairs = $this->sxg_repair_user->findAllRepairs($where);
        $this->load->view('admin/repair_check',array(
            'repairs' => $repairs
        ));
    }
    /**
     * 维修人员通过审核
     */
    public function pass_check(){
        $repair_user_id = $this->uri->segment(4);//使用ci自带方法拿到admin_id
        $status = $this->uri->segment(5);//使用ci自带方法拿到admin_id
        if(empty($repair_user_id)){
            //跳转到错误页面
            $this->load->view('errors/error',array('code'=>500,'msg'=>'维修人员ID不能为空！'));
        }else{
            $this->load->model('admin/sxg_repair_user');
            $repair_user = $this->sxg_repair_user->get_one(array('repair_user_id' => $repair_user_id));
            if(empty($repair_user)){
                $this->load->view('errors/error',array('code'=>500,'msg'=>'维修信息不正确！'));
            }
            if(empty($status)){
                $update_data = array(
                    'status' => 1,
                    'update_time' => time()
                );
                $msg = '审核通过';
                $error_msg = '审核失败，请联系管理员';
            }
            if($status == 3){
                $update_data = array(
                    'status' => 0,
                    'update_time' => time()
                );
                $msg = '冻结账户成功';
                $error_msg = '冻结账户失败，请联系管理员';
            }
            $update = $this->sxg_repair_user->update($update_data, array('repair_user_id' => $repair_user_id));

            $url = site_url('admin/repair/index');
            if($update){
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