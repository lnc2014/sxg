<?php

class Logger {

    function __construct() {
        //$this->load->helper('file');
        require_once(SYSDIR."/helpers/file_helper.php");
    }

    function log_result($file, $word) {
        $fp = fopen($file, "w");
        flock($fp, LOCK_EX);
        fwrite($fp, "执行日期：" . strftime("%Y-%m-%d-%H:%M:%S", time()) . "\n(" . $word . ")\t\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    // 记录日志，param支持数据
    function logs_debug($params, $file='log', $interval = 'day'){
        ini_set('date.timezone','Asia/Shanghai'); //设置时区
        $log_dir = APPPATH . 'logs' .DIRECTORY_SEPARATOR . $file;

        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0777, true);
        }

        switch($interval){
            case 'day' :
                $interval_date = date("Ymd");
                break;
            case 'hour' :
                $interval_date = date("Ymd_H");
                break;
            default :
                $interval_date = date("Ymd");
                break;
        }

        $file = $log_dir . DIRECTORY_SEPARATOR . $file . "_" . $interval_date .".log";

        if (is_array($params)) {
            $params = var_export($params, true);
        }

        // 记录必要信息
        $info = "[".date("Y-m-d H:i:s")."] ";
        $info .= $params."\r\n";

        return write_file($file, $info, 'a+');
    }
}