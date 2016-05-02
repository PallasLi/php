<?php

$ARR=array("1","2","3");//数组
$ARR2=array("first"=>1,"second"=>"2","third"=>"3");//键值对数组
foreach ($ARR as $value){//遍历数组
	echo $value;
}
foreach ($ARR2 as $key=>$value){//遍历键值对数组
	echo "$key=$value";
}
while (list($key,$value)=each($ARR2)){
	echo $key;
	echo $value;
}


$userArray=array("liyong"=>23,"libo"=>20);
print_r($userArray);
list($name,$age)=$userArray;
echo "list 只获取键为数字的值<br/>\n";
echo $name;
print $name;


// 每执行一次each，移动一条数据
$a = each($userArray);
list($name,$age)=$a;
echo $name;
list($name,$age)=each($userArray);
echo $name;

?>