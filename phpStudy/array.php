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


/**
使用数组

超全局变量
PHP 中有一些数组是超级全局变量

$_GET
$_POST
$_SERVER
$_COOKIE 存储在 cookie 中保存的数据
$_SESSION 保存在 session 中的数据
$_ENV 保存环境变量
创建数组
使用 array()函数来创建数组

$list=array("1","2","3"); 索引从 0 开始
$list=array(1 => "1",2 => "2",3 =>"3"); 指定特定的索引，指定数值或者字符串
还可以使用 range()函数创建：

$ten = range(1,10);
$alphabet = range('a','z',1);
显示数组可以使用 var_dump 代替 print_r，它更详细呈现数组的结构

向数组添加项
向数组添加项使用赋值操作符 $list[3]='apple'; 注意要使用方括号
count 获取数组中元素的数量 sizeof 函数具有相同的效果
unset 删除变量并释放内存
$list=array() 重置数组(清空数组的值)
$list[] = 'apple';如果 $list 不存在，将创建数组
数组合并：

array_merge()函数可以合并两个数组，也可以使用+号

访问数组元素
如果数组被设定为以字符串作为键，那么用数值为键不指向任何值

遍历整个数值最快的方式为使用 foreach 循环：

        $alphabet=range('a','z',1);
        foreach ($alphabet as $key => $value) 
        {
            print $key . $value . "<br/>";
        }
创建多维数组
多维数组是可以使用其他数组作为它的值的数组，访问的时候，需要多层键值索引，遍历时需要多层 foreach

使用 print_r 或者 var_dump 函数可以对多维数组查看

数组排序
sort 排序值
rsort 反向排序值
asort 排序值
arsort 反向排序值
ksort 排序键
krsort 反向排序键
shuffle 随机重组值
natsort 自然排序字符串
natcasesort 自然排序字符串不区分大小写
usort 对数组使用用户自定义比较函数方向进行排序
uasort 这三个函数通常应用在多维数组中
ursort
字符串和数组之间的转换
implode 将数组转换为字符串

    $daige= array('1' =>"hello" ,'2' => "world!");
    hello=implode(",", $daige); //连接符连接数组的值
    print $hello;
explode 将字符串转换为数组

    $daige= "hello,world!";
    $hello=explode(",", $daige);//分隔符分割字符串
    print_r ($hello);
list 函数 list 用来讲数组元素的值赋给单独的变量

    $date = array('Thursday',23,'October');
    list($weekday,$day,$month) = $date;
这样，三个变量分别得到数组的值，但是这种赋值有限制：

list 函数只能对数值索引并从 0 开始的索引有效
list 必须确认接受每一个数组元素，可以通过空值来忽略元素
**/