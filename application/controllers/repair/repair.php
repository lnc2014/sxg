<?php
/**
 * Description：维修端控制器
 * Author: LNC
 * Date: 2016/8/4
 * Time: 20:53
 */
include_once "repairBaseController.php";
class repair extends repairBaseController{

    private $data = array();
    /**
     * 维修端首页
     */
    public function index(){
        if(!$this->check_is_login()){
            redirect('/repair/repair/login');
        };
    }
    /**
     * 登录
     */
    public function login(){
        $this->data['title'] = '登录';
        $this->load->view('repair/login', $this->data);
    }
    //登录验证
    public function login_check(){
        $phone = $this->input->post('phone');
        $psw = $this->input->post('psw');

        if(empty($phone) || empty($psw)){
            echo $this->apiReturn('0003', new stdClass(), '用户手机号码或者密码不能为空');
            return;
        }
        $this->load->model('admin/Sxg_repair_user');
        $repair_user = $this->Sxg_repair_user->get_one(array(
            'mobile' => $phone,
            'psw' => md5($psw)
        ));
        if(empty($repair_user)){
            echo $this->apiReturn('0004', new stdClass(), '用户不存在或者密码不正确');
            return;
        }
        //登录成功将id存入session
        $_SESSION['repair_user_id'] = $repair_user['repair_user_id'];
        $_SESSION['repair_mobile'] = $repair_user['mobile'];
        echo $this->apiReturn('0000', new stdClass(), '登录成功');
        return;
    }
    /**
     * 注册
     */
    public function reg(){
        $this->data['title'] = '注册';
        $this->load->view('repair/reg', $this->data);
    }
    //注册维修端
    public function reg_user(){
        $phone = $this->input->post('phone');
        $psw = $this->input->post('psw');
        $code = $this->input->post('code');
        if(empty($phone) || empty($psw) || empty($code)){
            echo $this->apiReturn('0003', new stdClass(), '用户手机号码或者密码不能为空');
            return;
        }
        $_SESSION['code'] = 888888;
        if($code != $_SESSION['code']){
            echo $this->apiReturn('0003', new stdClass(), '验证码错误');
            return;
        }
        //检查电话号码是不是已经注册
        $this->load->model('admin/Sxg_repair_user');
        $is_reg = $this->Sxg_repair_user->get_one(array('mobile'=>$phone));
        if(!empty($is_reg)){
            echo $this->apiReturn('0003', new stdClass(), '该手机号码已经注册');
            return;
        }
        $repair_user_info = array(
            'account' => $phone,
            'mobile' => $phone,
            'psw' => md5($psw),
        );
        $repair_user_id = $this->Sxg_repair_user->add($repair_user_info);
        if($repair_user_id > 0){
            //登录成功将id存入session
            $_SESSION['repair_user_id'] = $repair_user_id;
            $_SESSION['repair_mobile'] = $phone;
            echo $this->apiReturn('0000', new stdClass(), '注册成功');
            return;
        }
        echo $this->apiReturn('0002', new stdClass(), '系统错误');
        return;
    }
    /**
     * 信息补充
     */
    public function repair_info(){
        $this->data['title'] = '信息补充';
        if(!$this->check_is_login()){
            redirect('repair/repair/login');
        }
        $this->load->library('Jssdk');
        $this->data['sign_package'] = $this->jssdk->getSignPackage();
        $this->load->view('repair/repair_info', $this->data);
    }
    //信息补充接口
    public function fill_repair_info(){
        if(!$this->check_is_login()){
            echo $this->apiReturn('0005', new stdClass(), '你尚未登录，请先登录！');
            return;
        }
        $repair_info = $this->input->post();
        if(empty($repair_info)){
            echo $this->apiReturn('0003', new stdClass(), '个人信息不能为空');
            return;
        }
        $this->load->model('admin/sxg_repair_user');
        $this->load->model('admin/sxg_address');
        $repair = $this->sxg_repair_user->get_one(array('repair_user_id' => $_SESSION['repair_user_id']));
        if(empty($repair)){
            echo $this->apiReturn('0005', new stdClass(), '你尚未登录，请先登录！');
            return;
        }
        $address_info = array(
            'province' => $repair_info['province'],
            'city' => $repair_info['city'],
            'area' => $repair_info['area'],
            'street' => $repair_info['street'],
            'create_time' => time(),
            'update_time' => time(),
        );
        $address_id = $this->sxg_address->add($address_info);
        unset($repair_info['province']);
        unset($repair_info['city']);
        unset($repair_info['area']);
        unset($repair_info['street']);
        $repair_info['address_id'] = $address_id;
        $repair = $this->sxg_repair_user->update($repair_info, array('repair_user_id' => $_SESSION['repair_user_id']));
        if($repair){
            echo $this->apiReturn('0000', new stdClass(), '添加成功');
            return;
        }else{
            echo $this->apiReturn('0002', new stdClass(), '系统错误');
            return;
        }
    }
    /**
     * 维修工状态
     */
    public function repair_status(){
        $this->data['title'] = '账号状态';
        $this->load->view('repair/repair_status', $this->data);
    }
    /**
     * 个人中心
     */
    public function repair_account(){
        $this->data['title'] = '个人中心';
        if(!$this->check_is_login()){
            redirect('repair/repair/login');
        }
        $this->load->model('admin/sxg_repair_user');
        $repair = $this->sxg_repair_user->get_one(array('repair_user_id' => $_SESSION['repair_user_id']));
        if(empty($repair)){
            redirect('repair/repair/login');
        }
        $this->data['repair'] = $repair;
        $this->load->view('repair/repair_account', $this->data);
    }
    /**
     * 找回密码
     */
    public function find_repair_psw(){
        $this->data['title'] = '找回密码';
        $this->load->view('repair/find_repair_psw', $this->data);
    }
    //找回密码
    public function find_psw(){
        $phone = $this->input->post('phone');
        $psw = $this->input->post('psw');
        $code = $this->input->post('code');
        if(empty($phone) || empty($psw) || empty($code)){
            echo $this->apiReturn('0003', new stdClass(), '用户手机号码或者密码不能为空');
            return;
        }
        if($code != $_SESSION['code']){
            echo $this->apiReturn('0003', new stdClass(), '验证码错误');
            return;
        }
        //检查电话号码是不是已经注册
        $this->load->model('admin/Sxg_repair_user');
        $is_reg = $this->Sxg_repair_user->get_one(array('mobile'=>$phone));
        if(empty($is_reg)){
            echo $this->apiReturn('0003', new stdClass(), '手机号码不存在');
            return;
        }
        $repair_user_info = array(
            'psw' => md5($psw),
        );
        $update = $this->Sxg_repair_user->update($repair_user_info, array('mobile'=>$phone));
        if($update){
            echo $this->apiReturn('0000', new stdClass(), '修改成功');
            return;
        }
        echo $this->apiReturn('0002', new stdClass(), '修改失败');
        return;
    }
    /**
     * 找回密码
     */
    public function repair_msg(){
        $this->data['title'] = '信息中心';
        $this->load->view('repair/repair_msg', $this->data);
    }

    /**
     * 订单列表
     */
    public function order_list(){
        $this->data['title'] = '订单列表';
        if(!$this->check_is_login()){
            redirect('repair/repair/login');
        }
        $this->load->model('admin/sxg_order');
        $orders = $this->sxg_order->get_repair_order_list($_SESSION['repair_user_id']);
        $this->data['orders'] = $orders;
        $this->load->view('repair/order_list', $this->data);
    }

    /**
     * 订单详情
     */
    public function order_detail($order_id){
        if(!$this->check_is_login()){
            redirect('repair/repair/login');
        }
        if(empty($order_id)){
            echo '<script>alert("订单信息不存在");history.go(-1);</script>';
            exit;
        }
        $this->data['title'] = '订单详情';
        $this->load->model('admin/sxg_order');
        $order = $this->sxg_order->get_repair_order_detail($order_id);
        if(empty($order)){
            echo '<script>alert("订单信息不存在");history.go(-1);</script>';
            exit;
        }
        if($order['repair_user_id'] != $_SESSION['repair_user_id']){
            echo '<script>alert("订单信息不存在");history.go(-1);</script>';
            exit;
        }
        $repair_info = array();
        if(!empty($order['repair_info_id']) && $order['order_status'] == 7){
            $this->load->model('admin/sxg_repair_info');
            $repair_info = $this->sxg_repair_info->get_one(array(
                'repair_info_id' => $order['repair_info_id']
            ));
        }
        $this->data['order'] = $order;
        $this->data['repair_info'] = $repair_info;
        $this->load->view('repair/order_detail', $this->data);
    }

    /**
     * 填写维修订单
     */
    public function fill_repair_order($order_id){
        if(!$this->check_is_login()){
            redirect('repair/repair/login');
        }
        if(empty($order_id)){
            echo '<script>alert("订单信息不存在");history.go(-1);</script>';
            exit;
        }
        $this->load->model('admin/sxg_order');
        $order = $this->sxg_order->get_repair_order_detail($order_id);
        if(empty($order)){
            echo '<script>alert("订单信息不存在");history.go(-1);</script>';
            exit;
        }
        if($order['repair_user_id'] != $_SESSION['repair_user_id']){
            echo '<script>alert("订单信息不存在");history.go(-1);</script>';
            exit;
        }

        $this->data['title'] = '填写维修订单';
        $this->load->view('repair/fill_repair_order', $this->data);
    }
    //结束维修的接口
    public function finish_repair(){
        $order_id = $this->input->post('order_id', true);
        if(!$this->check_is_login()){
            echo $this->apiReturn('0005', new stdClass(), '你尚未登录，请先登录！');
            return;
        }
        if(empty($order_id)){
            echo $this->apiReturn('0003', new stdClass(), '订单ID不能为空');
            return;
        }
        $this->load->model('admin/sxg_order');
        $order = $this->sxg_order->get_repair_order_detail($order_id);
        if(empty($order)){
            echo $this->apiReturn('0004', new stdClass(), '订单信息不存在');
            return;
        }
        $update = $this->sxg_order->update(array(
            'status' => 7
        ),array('id' => $order_id));
        if($update){
            echo $this->apiReturn('0000', new stdClass(), '修改成功');
            return;
        }else{
            echo $this->apiReturn('0002', new stdClass(), '修改失败');
            return;
        }
    }
    /**
     * 评价
     */
    public function rate_repair(){
        $this->data['title'] = '评价';
        $this->load->view('repair/rate_repair', $this->data);
    }

    /**
     * 退出登录
     */
    public function login_out(){
        if(session_destroy()){
            redirect('repair/repair/login');
        }
    }
    public function test(){
        $this->load->library('Jssdk');
        $this->data['sign_package'] = $this->jssdk->getSignPackage();
        $this->data['title'] = '测试';
        $this->load->view('repair/test', $this->data);
    }
}
