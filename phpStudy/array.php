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

PHP Array 常量
CASE_LOWER  CASE_LOWER 用在 array_change_key_case() 中将数组键名转换成小写字母。
CASE_UPPER  用在 array_change_key_case() 中将数组键名转换成大写字母。
SORT_ASC    用在 array_multisort() 函数中，使其升序排列。
SORT_DESC   用在 array_multisort() 函数中，使其降序排列。
SORT_REGULAR    对象比较。
SORT_NUMERIC    对象数值比较。
SORT_STRING 对象字符串比较。
SORT_LOCALE_STRING  基于当前区域来对对象进行字符串比较。
COUNT_NORMAL     
COUNT_RECURSIVE  
EXTR_OVERWRITE   
EXTR_SKIP    
EXTR_PREFIX_SAME     
EXTR_PREFIX_ALL  
EXTR_PREFIX_INVALID  
EXTR_PREFIX_IF_EXISTS    
EXTR_IF_EXISTS   
EXTR_REFS   


array() 创建数组。   3
array_change_key_case() 返回其键均为大写或小写的数组。 4
array_chunk()   把一个数组分割为新的数组块。  4
array_combine() 通过合并两个数组来创建一个新数组。   5
array_count_values()    用于统计数组中所有值出现的次数。    4
array_diff()    返回两个数组的差集数组。    4
array_diff_assoc()  比较键名和键值，并返回两个数组的差集数组。   4
array_diff_key()    比较键名，并返回两个数组的差集数组。  5
array_diff_uassoc() valign="top"通过用户提供的回调函数做索引检查来计算数组的差集。   5
array_diff_ukey()   用回调函数对键名比较计算数组的差集。  5
array_fill()    用给定的值填充数组。  4
array_fill_keys()   用给定的指定键名的键值填充数组 5
array_filter()  array_filter() 用回调函数过滤数组中的元素。   4
array_flip()    交换数组中的键和值。  4
array_intersect()   计算数组的交集。    4
array_intersect_assoc() 比较键名和键值，并返回两个数组的交集数组。   4
array_intersect_key()   使用键名比较计算数组的交集。  5
array_intersect_uassoc()    带索引检查计算数组的交集，用回调函数比较索引。 5
array_intersect_ukey()  用回调函数比较键名来计算数组的交集。  5
array_key_exists()  检查给定的键名或索引是否存在于数组中。 4
array_keys()    返回数组中所有的键名。 4
array_map() 将回调函数作用到给定数组的单元上。   4
array_merge()   把一个或多个数组合并为一个数组。    4
array_merge_recursive() 递归地合并一个或多个数组。   4
array_multisort()   对多个数组或多维数组进行排序。 4
array_pad() 用值将数组填补到指定长度。   4
array_pop() 将数组最后一个单元弹出（出栈）。    4
array_product() 计算数组中所有值的乘积。    5
array_push()    array_push() 将一个或多个单元（元素）压入数组的末尾（入栈）。   4
array_rand()    从数组中随机选出一个或多个元素，并返回。    4
array_reduce()  用回调函数迭代地将数组简化为单一的值。 4
array_reverse() 将原数组中的元素顺序翻转，创建新的数组并返回。 4
array_search()  在数组中搜索给定的值，如果成功则返回相应的键名。    4
array_shift()   删除数组中的第一个元素，并返回被删除元素的值。 4
array_slice()   在数组中根据条件取出一段值，并返回。  4
array_splice()  把数组中的一部分去掉并用其它值取代。  4
array_sum() 计算数组中所有值的和。 4
array_udiff()   array_rand() 回调函数比较数据来计算数组的差集。  5
array_udiff_assoc() 带索引检查计算数组的差集，用回调函数比较数据。 5
array_udiff_uassoc()    带索引检查计算数组的差集，用回调函数比较数据和索引。  5
array_uintersect()  计算数组的交集，用回调函数比较数据。  5
array_uintersect_assoc()    带索引检查计算数组的交集，用回调函数比较数据。 5
array_uintersect_uassoc()   带索引检查计算数组的交集，用回调函数比较数据和索引。  5
array_unique()  删除数组中重复的值。  4
array_unshift() 在数组开头插入一个或多个元素。 4
array_values()  返回数组中所有的值。  4
array_walk()    对数组中的每个成员应用用户函数。    3
array_walk_recursive()  对数组中的每个成员递归地应用用户函数。 5
arsort()    对数组进行逆向排序并保持索引关系。   3
asort() 对数组进行排序并保持索引关系。 3
compact()   建立一个数组，包括变量名和它们的值。  4
count() 计算数组中的元素数目或对象中的属性个数。    3
current()   返回数组中的当前元素。 3
each()  返回数组中当前的键／值对并将数组指针向前移动一步。   3
end()   将数组的内部指针指向最后一个元素。   3
extract()   从数组中将变量导入到当前的符号表。   3
in_array()  检查数组中是否存在指定的值。  4
key()   从关联数组中取得键名。 3
krsort()    对数组按照键名逆向排序。    3
ksort() 对数组按照键名排序.  3
list()  把数组中的值赋给一些变量。   3
natcasesort()   用“自然排序”算法对数组进行不区分大小写字母的排序。  4
natsort()   用“自然排序”算法对数组排序。 4
next()  将数组中的内部指针向前移动一位。    3
pos()   current() 的别名。  3
prev()  将数组的内部指针倒回一位。   3
range() 建立一个包含指定范围的元素的数组。   3
reset() 将数组的内部指针指向第一个元素。    3
rsort() 对数组逆向排序。    3
shuffle()   把数组中的元素按随机顺序重新排列。   3
sizeof()    count() 的别名。    3
sort()  对数组排序。  3
uasort()    使用用户自定义的比较函数对数组中的值进行排序并保持索引关联。  3
uksort()    使用用户自定义的比较函数对数组中的键名进行排序。    3
usort() 使用用户自定义的比较函数对数组中的值进行排序。 3

**/