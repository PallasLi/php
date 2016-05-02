<?php
//双引号支持转义，单引号不支持
//网页换行用<br /> 程序代码输出换行用\n
$str="   a  af   \naafj";
$str1='   a  af   \naafj';
trim($str);
ltrim($str);
rtrim($str);
$str=nl2br($str);//转义符\n转换成<br />
$str=htmlspecialchars($str);//将特殊字符转换为HTML实体
echo $str;
$str1=nl2br($str1);
echo $str1;

str_pad($str, 10," ");//填充字符
str_pad($str, 10," ",STR_PAD_BOTH);//STR_PAD_BOTH：两边填充字符，STR_PAD_LEFT,STR_PAD_Right
strtolower($str);
strtoupper($str);

/**
 * 字符串函数
 * trim,ltrim,rtrim($str,$trimstr)
 * addslashes($str) 将字符串中的\转义，stripslashes怀疑
 * addcslashes($str,$addBefore) 将字符串中的\转义，stripcslashes怀疑
 * strlen($str)获取字符串长度
 * substr($str,$start,$len)截取字符串,-start为右起,-len为右侧剩余
 *
 * strcmp($str1,$str2)1>2返回>0,1<2返回<0
 * strcasecmp($str1,$str2)1>2返回>0,不区分大小写
 * strstr($str,$search) 检索首次出现$search的位置并返回包括$search至末尾的字符串
 *
 *
 * str_ireplace($search, $replace, $subject)
 * str_replace($search, $replace, $subject)
 * substr_replace($string, $replacement, $start)
 * number_format($number)
 * explode($delimiter, $string [,$limit]) 分割函数为数组
 */
echo "\n";
echo ltrim("    a  d    ");
echo "\n";
echo rtrim("    a  d    ");
echo "\n";
echo trim("    a  d    ");
echo "\n";
echo ltrim("afaf    a  d    afaf","af");
echo "\n";
echo rtrim("afaf    a  d    afaf","af");
echo "\n";
echo trim("afaf    a  d    afaf","af");
echo "\n";
$a= addslashes("j\kafdla\jfd");
echo $a;
echo "\n";
echo stripslashes($a);
echo "\n";
$a= addcslashes("jka\fdlajfd","\sss");
print $a;
echo "\n";
echo stripcslashes($a);
echo "\n";
echo strlen("adfafa");
echo "\n";
echo substr("1233456", 6,2);
echo "\n";
echo substr("1233456", -6,2);
echo "\n";
echo substr("1233456", -6,-2);
echo "\n";
?>