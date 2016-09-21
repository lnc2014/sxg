<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//用于处理常用的状态
$config['response']['0000'] = "success";             // 成功
$config['response']['0001'] = "unknown error";      // 未知错误
$config['response']['0002'] = "internal error";     // 内部错误
$config['response']['0003'] = "illegal params";     // 非法参数
$config['response']['0004'] = "illegal request";     // 非法请求
$config['response']['0005'] = "no data";     // 非法请求


//user response
$config['response']['0010'] = "用户不存在";
$config['response']['0011'] = "不存在该用户手机";
$config['response']['0012'] = "验证码错误";
$config['response']['0013'] = "验证码已过期";
$config['response']['0015'] = "发送短信失败";
//订单错误码 0200-0299
$config['response']['0200'] = "订单状态不正确";

