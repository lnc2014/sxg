<?php

/* * *************************************************************************
 * 
  author liujicai
  date   2015-07-13
 * 
 * ************************************************************************ */

class StringUtils {

    // convert unicode chinese to utf8
    /**
     * 用utf8的编码格式，显示中文正常
     * 
     * @param type $data
     * @return type
     */
    public function jsonEncodeWithCN($data) {
        return preg_replace("/\\\u([0-9a-f]{4})/ie", "iconv('UCS-2BE','UTF-8',PACK('H4','$1'))", $data);
    }

    public function is_string_all_number($str) {
        if (preg_match("/^\d*$/", $str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function str_chinese_num($str) {
        $encode = 'UTF-8';
        $str_num = mb_strlen($str, $encode);
//        echo "'$str' 字符串长度:" . $str_num, "<br/>";
        $j = 0;
        for ($i = 0; $i < $str_num; $i++) {//echo $i;
            if (ord(mb_substr($str, $i, 1, $encode)) > 0xa0) {//在ascii中，0xa1刚好为中文的开始
                $j++;
            }
        }
//        echo "'$str' 字符串中文个数为：", $j;
        return $j;
    }

    public function security_filter($str) {
        if (empty($str))
            return;
        if ($str == "")
            return $str;
        $str = str_replace("&", "&amp;", $str);
        $str = str_replace(">", "&gt;", $str);
        $str = str_replace("<", "&lt;", $str);
        $str = str_replace(chr(32), "&nbsp;", $str);
        $str = str_replace(chr(9), "&nbsp;", $str);
        // $str=str_replace("&#160;&#160;&#160;&#160;",chr(9),$str);
        $str = str_replace(chr(34), "&", $str);
        $str = str_replace(chr(39), "&#39;", $str);
        $str = str_replace(chr(13), "<br />", $str);
        $str = str_replace("'", "''", $str);
        $str = str_replace("select", "sel&#101;ct", $str);
        $str = str_replace("join", "jo&#105;n", $str);
        $str = str_replace("union", "un&#105;on", $str);
        $str = str_replace("where", "wh&#101;re", $str);
        $str = str_replace("insert", "ins&#101;rt", $str);
        $str = str_replace("delete", "del&#101;te", $str);
        $str = str_replace("update", "up&#100;ate", $str);
        $str = str_replace("like", "lik&#101;", $str);
        $str = str_replace("drop", "dro&#112;", $str);
        $str = str_replace("create", "cr&#101;ate", $str);
        $str = str_replace("modify", "mod&#105;fy", $str);
        $str = str_replace("rename", "ren&#097;me", $str);
        $str = str_replace("alter", "alt&#101;r", $str);
        $str = str_replace("cast", "ca&#115;", $str);
        return $str;
    }

    public function get_rand_str($length = 24) {
        $base = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $base_len = strlen($base);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $base[mt_rand(0, $base_len - 1)];
        }
        return $str;
    }

}

?>
