<?php
/**
 * Description:微信端首页
 * Author: LNC
 * Date: 2016/5/25
 * Time: 22:51
 */
include_once "WxBaseController.php";

class Sxg extends WxBaseController{
    /**
     * 快速登录页面
     */
    public function index(){
        $this->check_user();
        redirect('sxg/quick_order');
        //获取到用户的信息
//        $this->load->model('admin/sxg_user');
//        $user = $this->sxg_user->get_one(array('wx_openid' => $_SESSION['jspayOpenId']), 'user_name,headimgurl,last_model,last_band');
//        $this->load->view('quick_order',array(
//            'title' => $title,
//            'user' => $user
//        ));
    }
    /**
     *验证码判断
     */
    public function check_code(){
        $phone = $this->input->post('phone');
        $code = $this->input->post('code');

        if (empty($phone) || empty($code)) {
            echo $this->apiReturn('0003', new stdClass(), '请求参数不能为空');
            return;
        }
        if(!$this->check_user($phone)){
            echo $this->apiReturn('0002', new stdClass(), '用户不存在');
            return;
        }
        $sms_code = empty($_SESSION['code'])?0:$_SESSION['code'];
        if($sms_code !== $code){//暂时定为验证正确
            //绑定手机
            $this->load->model('admin/sxg_user');
            $update = $this->sxg_user->update(array(
                'mobile' => $phone
            ),array(
                'user_id' => $_SESSION['user_id']
            ));
            if($update){
                $_SESSION['phone'] = $phone;
                echo $this->apiReturn('0000', new stdClass(), 'success');
                return;
            }else{
                echo $this->apiReturn('0002', new stdClass(), '绑定失败');
                return;
            }
        }else{
            echo $this->apiReturn('0001', new stdClass(), '验证码不正确');
            return;
        }
    }
    /**
     * 快速下单的首页
     */
    public function quick_order(){
        $title = "闪修哥快速下单";
        $this->load->model('admin/sxg_user');
        $this->load->library('Jssdk');
        $sign_package = $this->jssdk->getSignPackage();
        $user = $this->sxg_user->get_one(array('wx_openid' => $_SESSION['jspayOpenId']), 'user_name,headimgurl,last_model,last_band');
        $this->load->view('quick_order',array(
            'title' => $title,
            'user' => $user,
            'sign_package' => $sign_package,
        ));
    }
    /**
     * 手机号码绑定
     */
    public function band_phone(){
        $title = "手机号码绑定";
        $this->load->view('login',array(
            'title' => $title
        ));
    }

    /**
     * 发送验证码
     */
    public function send_code(){
        $phone = $this->input->post('phone');
        if(empty($phone)){
            echo $this->apiReturn('0003', new stdClass(), '参数不正确');
            return;
        }
        $code = rand(100000, 999999);
        $code = 888888;
        $_SESSION['code'] = $code;//存入session中用于校验
//        $is_get = $this->get_code($phone, $code);
        $is_get = true;
        if($is_get){
            echo $this->apiReturn('0000', new stdClass(), '获取验证码成功！');
            return;
        }else{
            echo $this->apiReturn('0002', new stdClass(), '获取验证码失败！');
            return;
        }
    }
    /**
     * 用户快速下单
     */
    public function add_order(){
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $post = $this->input->post(NULL, TRUE);
        $post['repair_pic'] = trim($post['img'], ';');
        unset($post['img']);
        $post['repair_option'] = trim($post['repair_option'],',');
        $post['user_id'] = $_SESSION['user_id'];
        $post['order_no'] = 'SXG'.date('YmdHis').rand(10000,99999);
        $post['createtime'] = time();
        $post['updatetime'] = time();
        $this->load->model("admin/sxg_order");
        $this->load->model("admin/sxg_user");
        //更新常用的机器品牌型号信息
        $user_data = array(
            'last_model' => $post['print_model'],
            'last_band' => $post['print_band'],
        );
        $this->sxg_user->update($user_data,array(
            'user_id' => $_SESSION['user_id']
        ));
        $order_id = $this->sxg_order->insert_data($post);
        if($order_id > 0 ){
            $data['order_id'] =  $order_id;
            //检车用户是不是已经绑定手机
            $check_phone = $this->check_phone($_SESSION['user_id']);
            if($check_phone){
                echo $this->apiReturn('0000', $data, 'success');
                exit();
            }else{
                echo $this->apiReturn('0001', $data, '该账号尚未绑定手机,请进行绑定手机操作！');
                exit();
            }
        }
    }
    /**
     * 订单详情
     */
    public function order_detail($order_id = '', $address_id = ''){
        $this->load->model("admin/sxg_order");
        if(empty($order_id)){
            //先去order表中查找订单
            $order = $this->sxg_order->get_one(array(
                'user_id' => $_SESSION['user_id']
            ),'id');
            if(empty($order)){
                exit("<script>alert('非法请求!');location.href='/index.php/sxg/index';</script>");
            }else{
                $order_id = $order['id'];
            }
        }
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $user_id  = $_SESSION['user_id'];
        $this->load->model("admin/sxg_address");
        $order = $this->sxg_order->find_order_by_id($order_id);
        if(empty($order)){
            exit("<script>alert('订单信息不存在!');location.href='/index.php/sxg/index';</script>");
        }
        if(empty($address_id)){
            //地址信息
            $address = $this->sxg_address->find_address_by_condition(array(
                'user_id' => $user_id,
                'is_default' => 1
            ));
        }else{
            $address = $this->sxg_address->find_address_by_condition(array(
                'address_id' => $address_id
            ));
        }
        $repair_detail['print_band'] = empty($order['print_band'])?'':$order['print_band'];
        $repair_detail['print_model'] = empty($order['print_model'])?'':$order['print_model'];
        $repair_option = explode(',', $order['repair_option']);
        $repair_info = '';
        foreach($repair_option as $value){
            if(is_numeric(strpos($value,'0001'))){
                $repair_info = $repair_info.';'.'加粉';
            }
            if(is_numeric(strpos($value,'0002'))){
                $repair_info = $repair_info.';'.'打印质量差';
            }
            if(is_numeric(strpos($value,'0003'))){
                $repair_info = $repair_info.';'.'不能开机';
            }
            if(is_numeric(strpos($value,'0004'))){
                $repair_info = $repair_info.';'.'卡纸';
            }
        }
        $repair_info = trim($repair_info, ';');
        $repair_detail['repair_info'] = $repair_info.';'.$order['repair_problem'];
        $title = "订单填写";
        $this->load->view('order_detail',array(
            'title' => $title,
            'repair_detail' => $repair_detail,
            'address'   =>  $address,
            'order_id' => $order_id
        ));
    }

    /**
     * 支付订单详情，取消订单详情
     */
    public function pay_order_detail($order_id){
        if(empty($order_id)){
            exit("<script>alert('非法请求!');location.href='/index.php/sxg/my_order_list';</script>");
        }
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        //微信支付需要的openid
        if(empty($_SESSION['jspayOpenId'])){
            $data = $this->get_user_openid();
            $open_id = $data['openid'];
            $_SESSION['jspayOpenId'] = $open_id;
        }
        $user_id  = $_SESSION['user_id'];
        $this->load->model("admin/sxg_order");
        $this->load->model("admin/sxg_address");

        $order = $this->sxg_order->find_order_by_id($order_id);

        $repair_option = explode(',', $order['repair_option']);
        $repair_info = '';
        foreach($repair_option as $value){
            if(is_numeric(strpos($value,'0001'))){
                $repair_info = $repair_info.';'.'加粉';
            }elseif(is_numeric(strpos($value,'0002'))){
                $repair_info = $repair_info.';'.'打印质量差';
            }elseif(is_numeric(strpos($value,'0003'))){
                $repair_info = $repair_info.';'.'不能开机';
            }elseif(is_numeric(strpos($value,'0004'))){
                $repair_info = $repair_info.';'.'卡纸';
            }
        }
        $repair_info = trim($repair_info, ';');
        $order['repair_info'] = $repair_info.';'.$order['repair_problem'];
        $order['status'] = $this->status_info($order['status']);
        $address = $this->sxg_address->find_address_by_condition(array(
            'address_id' => $order['address_id']
        ));

        $this->load->model('admin/sxg_repair_info');
        $this->load->model('admin/sxg_repair_user');
        $repair_info = $this->sxg_repair_info->get_one(array(
            'order_id' => $order_id
        ));
        $repair_user = $this->sxg_repair_user->get_one(array(
            'repair_user_id' => $order['repair_user_id']
        ),'mobile,user_name,repair_num');
        $title = '订单详情';
        $this->load->view('pay_order_detail',array(
            'title' => $title,
            'order' => $order,
            'address' => $address,
            'repair_info' => $repair_info,
            'repair_user' => $repair_user
        ));

    }
    /**
     * 订单的修改
     */
    public function update_order(){
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $data = $this->input->post();
        if(empty($data)){
            echo $this->apiReturn('0003', new stdClass(), '参数不正确！');
            exit();
        }
        $order_id = intval($data['order_id']);
        if($order_id < 0){
            echo $this->apiReturn('0003', new stdClass(), '参数不正确！');
            exit();
        }
        unset($data['order_id']);
        $data['visit_time'] = strtotime($data['visit_time']);
        $data['updatetime'] = time();
        $this->load->model("admin/sxg_order");
        $update_order = $this->sxg_order->update_order_by_condition($data,array(
            'id' => $order_id
        ));
        if($update_order){
            echo $this->apiReturn('0000', new stdClass(), 'success');
            exit();
        }else{
            echo $this->apiReturn('0002', new stdClass(), '内部错误！');
            exit();
        }

    }
    /**
     * 选择地址
     */
    public function address($order_id){
        if(empty($order_id)){
            exit("<script>alert('非法请求!');location.href='/index.php/sxg/index';</script>");
        }
        $title = "选择地址";
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $this->load->model("admin/sxg_address");
        $address = $this->sxg_address->find_address_by_user_id($_SESSION['user_id']);
        $this->load->view('address',array(
            'title' => $title,
            'address' => $address,
            'order_id' => $order_id
        ));
    }
    public function add_address($order_id = '', $address_id = ''){
        $address = array();
        if(empty($address_id)){
            $title = "新增地址";
        }else{
            $title = "修改地址";
            $this->load->model("admin/sxg_address");
            $address = $this->sxg_address->get_one(array(
                'address_id' => $address_id
            ));
        }
        $this->load->view('add-address',array(
            'title' => $title,
            'order_id' => $order_id,
            'address' => $address
        ));
    }
    /**
     * 用户添加地址接口
     */
    public function add_user_address(){
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $post = $this->input->post(NULL, TRUE);
        $this->load->model("admin/sxg_address");
        if(!empty($post['address_id'])){
            $address_id = $post['address_id'];
            unset($post['address_id']);
            $update = $this->sxg_address->update($post,array('address_id' => $address_id));
            if($update){
                $data['address_id'] =  $address_id;
                echo $this->apiReturn('0000', $data, 'success');
                exit();
            }
        }else{
            unset($post['address_id']);
            $post['user_id'] = $_SESSION['user_id'];
            $post['create_time'] = time();
            $post['update_time'] = time();
            $address_id = $this->sxg_address->insert_data($post);
            if($address_id > 0 ){
                $data['address_id'] =  $address_id;
                echo $this->apiReturn('0000', $data, 'success');
                exit();
            }
        }
    }
    public function address_map(){
        $title = "新增地址";
        $this->load->view('address-map',array(
            'title' => $title
        ));
    }
    /**
     * 发票管理
     */
    public function invoice(){
        $title = "发票管理";
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $this->load->model("admin/sxg_invoice");
        $invoice_list = $this->sxg_invoice->get_invoice_list($_SESSION['user_id']);
//        1、受理中2、已开票（配送中）3、已完成 发票的状态
        $this->load->view('invoice_list',array(
            'title' => $title,
            'invoice_list' => $invoice_list,
        ));
    }
    /**
     * 开票
     */
    public function add_invoice(){
        $title = "发票申请";
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $this->load->model("admin/sxg_order");
        $order_list = $this->sxg_order->find_all_order_by_user_id($_SESSION['user_id'], 7);

        $this->load->view('add_invoice',array(
            'title' => $title,
            'order_list' => $order_list,
        ));
    }
    /**
     * 开票第二步骤
     */
    public function add_invoice_next($money){
        if(empty($money)){
            exit("<script>alert('非法请求!');location.href='/index.php/sxg/my_account';</script>");
        }
        $title = "发票申请";
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $user_id = $_SESSION['user_id'];
        $this->load->model("admin/sxg_address");
        if(empty($address_id)){
            //地址信息
            $address = $this->sxg_address->find_address_by_condition(array(
                'user_id' => $user_id,
                'is_default' => 1
            ));
        }else{
            $address = $this->sxg_address->find_address_by_condition(array(
                'address_id' => $address_id
            ));
        }
        $this->load->view('add_invoice_next',array(
            'title' => $title,
            'address' => $address,
            'money' => $money,
        ));
    }
    /**
     * 获取发票详情
     * @param $invoice_id
     */
    public function invoice_detail($invoice_id){
        if(empty($invoice_id)){
            exit("<script>alert('非法请求!');location.href='/index.php/sxg/my_account';</script>");
        }
        $this->load->model("admin/sxg_invoice");
        $this->load->model("admin/sxg_address");
        $this->load->model("admin/sxg_delivery");
        $invoice = $this->sxg_invoice->get_invoice_detail($invoice_id);
        $delivery = $this->sxg_delivery->get_delivery_id_detail($invoice['delivery_id']);
        $address = $this->sxg_address->find_address_by_condition(array(
            'address_id' => $invoice['address_id']
        ));
        $title = "发票详情";
        $this->load->view('invoice_detail',array(
            'title' => $title,
            'invoice' => $invoice,
            'address' => $address,
            'delivery' => $delivery
        ));
    }
    /**
     * 发票添加成功
     */
    public function invoice_success(){
        $title = "发票成功提交";
        $this->load->view('invoice_success',array(
            'title' => $title
        ));
    }
    /**
     * 添加数据
     */
    public function add_invoice_data(){
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $post = $this->input->post(NULL, TRUE);
        if(empty($post)){
            echo $this->apiReturn('0003', new stdClass(), '参数不正确');
            exit();
        }
        $post['user_id'] = $_SESSION['user_id'];
        $post['createtime'] = time();
        $post['updatetime'] = time();
        $this->load->model("admin/sxg_invoice");
        $order_id = $this->sxg_invoice->insert_data($post);
        if($order_id > 0){
            echo $this->apiReturn('0000', new stdClass(), 'success');
            exit();
        }else{
            echo $this->apiReturn('0002', new stdClass(), '内部错误');
            exit();

        }
    }
    /**
     * 我的账户
     */
    public function my_account(){
        $title = "我的账户";

        $this->load->view('my-account',array(
            'title' => $title
        ));
    }
    /**
     * 意见反馈
     */
    public function feedback(){
        $title = "投诉与建议";
        $this->load->view('feed-back',array(
            'title' => $title
        ));
    }
    /**
     *反馈与意见
     */
    public function add_feedback(){
        $feedback = $this->input->post('feedback');
        if (empty($feedback)) {
            echo $this->apiReturn('0003', new stdClass(), '请求参数不能为空');
            return;
        }
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $this->load->model("admin/sxg_user_feedback");
        $data = array(
            'user_id' => $_SESSION['user_id'],
            'mobile' => empty($_SESSION['phone'])?'':$_SESSION['phone'],
            'content' => trim($feedback),
            'feedback_time' => time(),
        );
        $feedback_id = $this->sxg_user_feedback->insert_data($data);
        if($feedback_id > 0){
            echo $this->apiReturn('0000', '', 'success');
            return;
        }else{
            echo $this->apiReturn('0002', '', '内部错误');
            return;
        }
    }
    /**
     * 上传
     */
    public function upload(){
        $this->load->library('upload_image');
        $ret = $this->upload_image->upload('file');
        if($ret['is_success']){
            $ret['path2'] = str_replace(ROOTPATH, '', $ret['path']);//将路径换成相对路径
            $ret['path'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$ret['path2'];//将路径换成相对路径
            echo $this->apiReturn('0000', $ret, 'success');
            return;
        }
        echo $this->apiReturn('0002', $ret, '上传失败');
        return;
    }
    public function test(){
        $this->load->view('test');
    }
    /**
     * 我的订单列表
     */
    public function my_order_list($status = 0){
        if(!$this->check_user()){
            echo $this->apiReturn('0004', new stdClass(), '用户尚未登录');
            exit();
        };
        $user_id = $_SESSION['user_id'];
        $this->load->model("admin/sxg_order");
        $this->load->model("admin/sxg_address");
        $this->load->model("admin/sxg_user");
        $order = $this->sxg_order->find_all_order_by_user_id($user_id, $status);
        $order_list = array();
        foreach($order as $k => $val){
            $order_list[$k]['status'] = $this->status_info($val['status']);
            $order_list[$k]['createtime'] = date('Y-m-d H:i:s', $val['createtime']);
            $order_list[$k]['order_id'] = $val['id'];
            $order_list[$k]['print_band'] = $val['print_band'];
            $order_list[$k]['print_model'] = $val['print_model'];
            $repair_info = '';
            if(is_numeric(strpos($val['repair_option'],'0001'))){
                $repair_info = $repair_info.';'.'加粉';
            }
            if(is_numeric(strpos($val['repair_option'],'0002'))){
                $repair_info = $repair_info.';'.'打印质量差';
            }
            if(is_numeric(strpos($val['repair_option'],'0003'))){
                $repair_info = $repair_info.';'.'不能开机';
            }
            if(is_numeric(strpos($val['repair_option'],'0004'))){
                $repair_info = $repair_info.';'.'卡纸';
            }
            $repair_info = trim($repair_info, ';');
            $order_list[$k]['repair_info'] = $repair_info.';'.$order['repair_problem'];
            $address = $this->sxg_address->find_address_by_condition(array(
                'address_id' => $val['address_id']
            ));
            $user = $this->sxg_user->get_one(array(
                'user_id' => $val['user_id']
            ),'user_name, mobile');
            $order_list[$k]['address'] = $address['area'].$address['street'];
            $order_list[$k]['user_name'] = $user['user_name'];
            $order_list[$k]['mobile'] = $user['mobile'];
        }
        $status_info = $this->status_info($status);
        $title = "我的订单列表";
        $this->load->view('my_order_list',array(
            'title' => $title,
            'order' => $order_list,
            'status_info' => $status_info,
        ));
    }

    /**
     * 订单状态信息转化
     * @param $status
     * 1,待接单2，待上门3,检测中4,调配件5,维修中6,待点评7,已结束8,已取消
     */
    private function status_info($status){
        switch ($status)
        {
            case 0:
                return "全部";
                break;
            case 1:
                return "待接单";
                break;
            case 2:
                return "待上门";
                break;
            case 3:
                return "检测中";
                break;
            case 4:
                return "调配件";
                break;
            case 5:
                return "维修中";
                break;
            case 6:
                return "待点评";
                break;
            case 7:
                return "已结束";
                break;
            case 8:
                return "已取消";
                break;
        }
    }


    /**
     * 微信支付参数拼接
     */
    public function wxpay_params(){
        $attach = '';//附加数据，支付用户ID和订单编号和司机id
        $pay_all_money = $this->input->post('pay_all_money', true);
        $order_no = $this->input->post('order_no', true);
        $total_fee = empty($pay_all_money) ? 1 : $pay_all_money;
        $openid = $_SESSION['jspayOpenId'];
        include_once(FCPATH . 'public/user-pay/lib/WxPayException.php');
        include_once(FCPATH . 'public/user-pay/lib/WxPayApi.php');
        include_once(FCPATH . 'public/user-pay/lib/WxPayConfig.production.php');
        include_once(FCPATH . 'public/user-pay/lib/WxPayJsApiPay.class.php');
        include_once(FCPATH . 'public/user-pay/lib/WxPayData.php');
        $tools = new JsApiPay();
        $input = new WxPayUnifiedOrder();
        $input->SetBody('闪修哥维修费用支付');
        $input->SetAttach($attach);
        $input->SetOut_trade_no($order_no);    //订单号
        $input->SetTotal_fee($total_fee * 100);   //总费用
//        $input->SetTotal_fee($total_fee);   //总费用
        $input->SetTime_start(date("YmdHis"));
        //$input->SetTime_expire(date("YmdHis", time() + 1200));
        $input->SetNotify_url(WxPayConfig::NOTIFY_URL);   //支付回调地址，这里改成你自己的回调地址。
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openid);
        $order = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        echo $jsApiParameters;
    }

    /**
     * 处理微信支付回调
     */
    public function notify(){
        $wx_order_str =  $this->input->post("wx_order_str");
        $order_no =  $this->input->post("order_no");
        $real_pay =  $this->input->post("total_fee");
        $real_pay =  round($real_pay/100, 2);//微信回调是以分为单位
        $log_data['post_data'] = $_POST;
        if($real_pay < 0 || empty($order_num) || empty($wx_order_str)){
            $log_data['title'] = '回调参数为空';
            $this->logs_debug($log_data, "wx_notify_error");
            return;
        }
        $this->load->model('admin/sxg_order');
        $order = $this->sxg_order->get_one(array('order_no'=>$order_no));
        if(empty($order)){
            $log_data['title'] = '回调订单不存在';
            $this->logs_debug($log_data, "wx_notify_error");
            return;
        }

        $update_data = array();
        if($update > 0){
            if ($income_type == 1) {
                $this->send_prepay_msg($orders, $motorcade_id);
            } elseif ($income_type == 2) {
                $orders['real_pay'] = $income;
                $this->send_afterpay_msg($orders);
            }
            echo $this->api_return("0000", '', $this->response_msg["0000"]);
            return;
        }else{
            echo $this->api_return("0002", '', $this->response_msg["0002"]);
            return;
        }
    }
    //将前台传递过来的图片上传到服务器
    public function save_pic_to_server(){
        $media_id =  $this->input->post("media_id", true);
        if(empty($media_id)){
            echo $this->apiReturn("0000", '', '上传失败');
            return;
        }
        //处理一步，将上传到微信服务器的图片下载到本地服务器
        $path = APPPATH."cache/sxg_access_token.json";
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path));
            $access_token = $data->access_token;
        } else {
            $access_token = 0;
        }
        $image_url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$media_id}";
        $image = file_get_contents($image_url);
        if(empty($image)){
            echo $this->apiReturn("0000", '', '上传失败');
            return;
        }
        $savename = ROOTPATH."static/upload/".date('Ymd').'/';
        if(!file_exists($savename))
        {
            mkdir($savename);
            chmod($savename,0777);
        }
        $image_name = date("YmdHis").rand(1000,9999).".jpg";
        $db_path = "static/upload/".date('Ymd').'/'.$image_name;
        $path = ROOTPATH."static/upload/".date('Ymd').'/'.$image_name;
        file_put_contents($path, $image);
        echo $this->apiReturn("0000", $db_path, '上传成功');
    }
}
