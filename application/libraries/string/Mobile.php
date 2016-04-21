<?php
/**
*  手机号码
*/
class Mobile {
    private $_preg = "/^1[34578]\d{9}$/";
    
    // 检测手机号码有效性
    public function check_valid($phone_number) {
        if (!is_numeric($phone_number) || strlen($phone_number) < 11) {
            return false;
        }
        
        $rep = preg_match($this->_preg, $phone_number);
        
        return $rep == 1 ? true : false;
    }
}