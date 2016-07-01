PHP 一共有八种数据类型可以供我们用来构造变量:
整型: 是整数,没有小数点,像 4195。
浮点型: 浮点数,如 3.14159 或 49.1。
布尔值: 只有两个可能值或真或假。TRUE 和 FALSE
空: 是一种特殊的类型只有一个值:空。
字符串类型: 字符序列,像'PHP 支持字符串操作'
数组: 有命名和索引所有值的集合。
对象: 是程序员定义类的实例化，可以打包其他类型的值和属于这个类的函数。
资源: 特殊变量持有引用外部资源到 PHP(如数据库连接)。
前五个是简单类型，接下来的两个(数组和对象)是复合类型，这种复合类型可以打包其他任意类型的值，而不能是简单类型。我们将解释这章数据类型。数组和对象将分别解释。

所有变量在 PHP 标有一个美元符号($)。


如果该值是一个数字，如果完全等于零那么它为假，否则为真。
如果该值是一个字符串，如果字符串是空的(为零个字符)或字符串“0” 那么它为假，否则为真。
空类型的值 NULL 总为假。
如果该值是一个数组,如果它不包含其他值那么它是假的，否则为真。做为一个对象，包含一个值意味着一个成员变量被分配给一个值。
有效资源为真时(尽管一些函数，成功返回资源时返回真不成功时将返回假)。
不要使用双精度值作为布尔值。
下面的每一个变量的真实值嵌入到它的名字时在下面的布尔上下文环境中运行。

<?php

	$int8=0765;
	$int10=987;
	$int16=0xABC;

	$float1=2.23450;
	$float2=3.87550;
	$float3=$float1+$float2;

	$bool_t=TRUE;
	$bool_f=FALSE;
	$true_num = 3 + 0.14159;
	$true_str = "Tried and true";
	$true_array[49] = "An array element";
	$false_array = array();
	$false_null = NULL;
	$false_num = 999 - 999;
	$false_str = "";

	$my_var = NULL;

	print_r($my_var);
	$my_var = null;

	print_r($my_var);

	printf($bool_f.$bool_t."\n");
	printf("$float1 + $float2 = $float3 \n");
	printf($float1." + ".$float2." = ".$float3."\n");
	printf("$int8 $int10 $int16 \n");

		

	$F="G";
	$$F="K";//将变量的值作为变量名定义变量
	echo $G;
	echo "\$K=$K is null";
?>


单引号字符串处理非常随便，而双引号字符串替换变量
<?php
    $string_1 = "This is a string in double quotes";
    $string_2 = "This is a somewhat longer, singly quoted string";
    $string_39 = "This string has thirty-nine characters";
    $string_0 = ""; // a string with zero characters

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
?>

局部变量只在定义的范围内有效，与Java不同
全局变量
<?php
	$g1=100;
	printf("\$g1 outer is $g1.\n");
	GLOBAL $g1;
	printf("\$g1 outer after GLOBAL is $g1.\n");
    function addit() {
		printf("\$g1 inner is $g1.\n");
   		GLOBAL $g1;
		printf("\$g1 outer after GLOBAL is $g1.\n");
		$g1++;
    }
    addit();
	printf("\$g1 outer after GLOBAL is $g1.\n");

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
 
	testFun();
	echo "\$C is $C\n";

?>


静态变量在函数内保持值的共享
<?php
    function keep_track() {
       STATIC $count = 0;
       $count++;
       print $count;
       print "\n";
    }
    keep_track();
    keep_track();
    keep_track();
?>


系统常量
<?php
	printf("__LINE__ is ".__LINE__."\n");	//文件中的当前行号。
	printf("__FILE__ is ".__FILE__."\n");	//文件的完整路径和文件名。如果用在被包含文件中，则返回被包含的文件名。自 PHP 4.0.2 起，__FILE__总是包含一个绝对路径（如果是符号连接，则是解析后的绝对路径），而在此之前的版本有时会包含一个相对路径。
	printf("__FUNCTION__ is ".__FUNCTION__."\n");//	T函数名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该函数被定义时的名字（区分大小写）。在 PHP 4 中该值总是小写字母的。
	printf("__CLASS__ is ".__CLASS__."\n");	//类的名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该类被定义时的名字（区分大小写）。在 PHP 4 中该值总是小写字母的。
	printf("__METHOD__ is ".__METHOD__."\n");	//类的方法名（PHP 5.0.0 新加）。返回该方法被定义时的名字（区分大小写）。


    define("ONE",     "first thing");
    printf(ONE."\n");
    echo ONE."\n";
    echo constant("ONE")."\n";
    printf(constant("ONE")."\n");
?>

