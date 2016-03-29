<?php

/*
checkdate($month, $day, $year)验证日期/时间有效性
date_default_timezone_get()取得时区
date_default_timezone_set($timezone_identifier)设置时区
date($format)日期格式化
getdate()获取日期/时间信息
gettimeofday()获取当前时间
localtime()获取本地时间
microtime()返回当前时间戳和微秒数
mktime()取得一个Unix时间戳
strtotime($time)字符串转Unix时间戳
time()返回当前时间戳



格式化含义：
Y 四位年 y两位 F英文月份 M英文简拼月份 m两位月份 d两位日 j自然日加S为英文日缩写
g 12小时制 无前导0 h 12小时制 两位  G H 24小时 a/A am/pm(AM/PM) i 分  s 秒  
L 是否闰年  I 星期  D 星期缩写  w W 星期数字1位2位的区别  t 本月天数 z 所在年的第几天
T 服务区的时间区域 I 是否夏令营 U 自70年的总秒数 c iso8601日期   r RFC822日期
*/
echo date("Y-m-j");
echo "\n";
echo date("y-n-j");
echo "\n";
echo date("Y-M-j");
echo "\n";
echo date("Y-m-d");
echo "\n";
echo date("Y-F-jS");
echo "\n";
echo date("g:i:s a");
echo "\n";
echo date("h:i:s A");
echo "\n";
echo date("G:i:s");
echo "\n";
echo date("L");
echo "\n";
echo date("I");
echo "\n";
echo date("D");
echo "\n";
echo date("T");
echo "\n";
echo date("t");
echo "\n";
echo date("W");
echo "\n";
echo date("z");
echo "\n";
echo date("c");
echo "\n";
echo date("r");
echo "\n";
echo date("U");
echo "\n";

?>