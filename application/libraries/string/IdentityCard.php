<?php
/**
*  身份证验证
*/
class IdentityCard {
    // 检测身份证有效性
    public function check_valid($Identity_card, $checkSex='') {
        // 不是15位或不是18位都是无效身份证号
        if (strlen($Identity_card) != 15 && strlen($Identity_card) != 18) {
            return false;
        }
        
        if (strlen($Identity_card) == 15 && !is_numeric($Identity_card)) {
            // 15位是纯数字
            return false;
        }
        
        // 如果是15位身份证号
        if (strlen($Identity_card) == 15) {
            // 省市县（6位）
            $areaNum = substr($Identity_card, 0, 6);
            // 出生年月（6位）
            $dateNum = substr($Identity_card, 6, 6);
            // 性别（3位）
            $sexNum = substr($Identity_card, 12, 3);
        }
        else {
        // 如果是18位身份证号
            // 省市县（6位）
            $areaNum = substr($Identity_card, 0, 6);
            // 出生年月（8位）
            $dateNum = substr($Identity_card, 6, 8);
            // 性别（3位）
            $sexNum = substr($Identity_card, 14, 3);
            // 校验码（1位）
            $endNum = substr($Identity_card, 17, 1);
        }
        
        if (!is_numeric($Identity_card) && $endNum != 'x' && $endNum != 'X') {
            // 18位 "X"或"Y"
            return false;
        }
        
        // 省市县
        if (isset($areaNum) && !$this->checkArea($areaNum)) {
            return false;
        }
        
        // 出生年月
        if (isset($dateNum) && !$this->checkDate($dateNum)) {
            return false;
        }
        
        // 性别1为男，2为女
        if ($checkSex == 1 && isset($sexNum) && !$this->checkSex($sexNum)) {
            return false;
        }
        else if($checkSex == 2 && isset($sexNum) && $this->checkSex($sexNum)){
            return false;
        }
 
        if(isset($endNum) && !$this->checkEnd($endNum, $Identity_card)) {
            return false;
        }
        
        return true;
    }
    
    // 验证城市
    private function checkArea($area) {
        $num1 = substr($area, 0, 2);
        $num2 = substr($area, 2, 2);
        $num3 = substr($area, 4, 2);
        
        // 根据GB/T2260—999，省市代码11到65
        return (10 < $num1 && $num1 < 66) ? true : false;
        
        //============
        // 对市 区进行验证
        //============
    }
    
    // 验证出生日期
    private function checkDate($date) {
        if (strlen($date) == 6) {
            $date1 = substr($date, 0, 2);
            $date2 = substr($date, 2, 2);
            $date3 = substr($date, 4, 2);
            $statusY = $this->checkY('19'.$date1);
        }
        else {
            $date1 = substr($date, 0, 4);
            $date2 = substr($date, 4, 2);
            $date3 = substr($date, 6, 2);
            $nowY = date("Y",time());
            if (1900 < $date1 && $date1 <= $nowY) {
                $statusY = $this->checkY($date1);
            }
            else {
                return false;
            }
        }
        
        if (0<$date2 && $date2 <13) {
            if ($date2 == 2) {
                // 润年
                if ($statusY) {
                    return (0 < $date3 && $date3 <= 29) ? true : false;
                }
                else{
                // 平年
                    return (0 < $date3 && $date3 <= 28) ? true : false;
                }
            }
            else {
                $maxDateNum = $this->getDateNum($date2);
                return (0<$date3 && $date3 <=$maxDateNum) ? true : false;
            }
        }
        
        return false;   
    }
 
    // 验证平年润年，参数年份,返回 true为润年  false为平年
    private function checkY($Y) {
        if (getType($Y) == 'string') {
            $Y = (int)$Y;
        }
        
        return (($Y % 4 == 0 && $Y % 100 != 0) || ($Y % 400 == 0)) ? true : false;  // 四年一闰，百年不闰，四百年再闰
    }
 
    // 当月天数 参数月份（不包括2月）  返回天数
    private function getDateNum($month) {
        if (in_array($month, array(1, 3, 5, 7, 8, 10, 12))) {
            return 31;
        }
        else if($month == 2) {
            return 28;
        }
        else {
            return 30;
        }
    }
    
    // 验证性别
    private function checkSex($sex) {
        return ($sex % 2 == 0) ? false : true;
    }
 
    // 验证18位身份证最后一位
    private function checkEnd($end, $num) {
        $checkHou = array(1,0,'x',9,8,7,6,5,4,3,2);
        $checkGu = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
        $sum = 0;
        for ($i = 0;$i < 17; $i++) {
            $sum += (int)$checkGu[$i] * (int)$num[$i];
        }
        
        $checkHouParameter= $sum % 11;
        return ($checkHou[$checkHouParameter] != $num[17]) ? false : true;
    }
}