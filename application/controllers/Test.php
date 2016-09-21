<?php
/**
 * Author:LNC
 * Description: 测试方法
 * Date: 2016/4/20 0020
 * Time: 下午 4:52
 */

class Test extends CI_Controller{


    // 模拟端口
    public function simulation_port() {
        $data = $this->input->get();
        $t1 = time();

        if (empty($data) || empty($data['uri'])) {
            exit("empty");
        }

        $this->load->helper('url');
        if (strpos($data['uri'], 'alipay') === 0 || strpos($data['uri'], 'wx-pay') === 0) {
            $uri = base_url($data['uri']);
        }
        else {
            $uri = site_url($data['uri']);
        }
        unset($data['uri']);

        $curl = curl_init();                    // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $uri);  // 要访问的地址
        curl_setopt($curl, CURLOPT_POST, 1);    // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);        // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0);          // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
        $result = curl_exec($curl);                     // 执行操作
        if (curl_errno($curl)) {
            $result = array(
                "success" => false,
                "error_code" => -1,
                "data" => curl_error($curl)
            );
        }
        curl_close($curl); // 关闭CURL会话

        echo "总耗时：".(time() - $t1)."s<br />";

        print_r($result);
    }

    /**
     * 测试时间
     */
    public function time(){
        $this->load->view('time');
    }

    public function get_pic(){
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=ZecazWfPeN5DO_pWX0hTLjKZSVBDIrGJhYenuX9yFpXfzsUXlS4dS4F_-8W7rR3GBIa9_dzPmiqYmofS4RFzumA8jygKTsrovoysRv0713OTTYciRIxXrlrDodLfahs1WUJjCIAOMB&media_id=o55HpWRtkWHb6YKM5ZxpyrlQr4K1ZDBoZAXuqJ2XMcFErPER2HWMRlzVPzCzzoHL";
        $check_name = file_get_contents($url);
        $photoname = date("YmdHis").".jpg";
        $db_path = "static/upload/".date('Ymd').'/'.$photoname;
        $path = ROOTPATH."static/upload/".date('Ymd').'/'.$photoname;
        $r = file_put_contents($path, $check_name);
        var_dump($r);
    }
}