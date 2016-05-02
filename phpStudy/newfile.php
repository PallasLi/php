<?php
echo 'HELLO WORLD <br>\n';//单引号内\n不转换
echo "HELLO WORLD <br>\n";//双引号内\n转换
define("CONSTANT", "hello\n",false);//常量名区分大小写
define("CONSTANT2", "hello\n",true);//不区分大小写
define("constant3", "hello\n");//区分大小写
echo CONSTANT;
echo constant2;
Echo constant3;
Echo CONSTANT3;//常量CONSTANT3不存在时输出常量名CONSTANT3
echo "\nend";

$A=1;
$B=2;

function  testFun(){
	global $D;//声明全局变量
	$D=4;
	$GLOBALS["C"]=$GLOBALS["A"]+$GLOBALS["B"];	//用$GLOBALS来定义一组全局变量
	return $C;
}
echo $D;
 

print_r($ARR);
print_r($ARR2);

echo date("D");//日期函数
testFun();
echo "\$C is $C";
$hasfile=file_exists("/Users/lyt1987/Desktop/GitHub/php/phpStudy/newfile.php");
echo "\n";
echo $hasfile; //判断文件是否存在
echo "\n";
readfile("/Users/lyt1987/Desktop/GitHub/php/phpStudy/newfile.php");//读取文件


$F="G";
$$F="K";//将变量的值作为变量名定义变量
echo $G;
echo "\$K=$K is null";

while ($flag):
	;
	continue;
endwhile;
switch (date("D")){
	case "Mon":echo "周一";break;
	case "Sat":echo "周六";break;
	default:break;
}






?>