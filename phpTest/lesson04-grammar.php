结构控制
if，elseif…else 和 switch 语句是用来根据不同的条件决定结构控制。

<?php
if (1==1)
	echo 1==1;
elseif(2==2)
	echo 2==2;
else if(2==2)
	echo 2==2;
else 
	echo 3;

echo "\n";
$variable="value";
switch ($variable) {
	case 'value':
		printf("value\n");
		break;
	
	default:
		# code...
		break;
}
?>



循环类型
for - 循环执行代码块指定的次数
while - 只要指定的条件为真，则循环执行代码块
do...while - 循环执行代码块，然后在指定的条件为真时重复这个循环
foreach - 根据数组中每个元素来循环代码块

for (initialization; condition; increment)
    {
        code to be executed;
    }
while (condition)
    {
        code to be executed;
    }
do
    {
    code to be executed;
    }
    while (condition); 
foreach (array as value)
    {
        code to be executed;
    }

