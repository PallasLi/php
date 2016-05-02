<?php


/*	class Dog{
		public $name;
		public $age;
		public function __construct($name,$age){
			$this->name=$name;
			$this->age=$age;
		}
	}
	$dog2=new Dog('小黄',40);
	//我希望把这个对象保存到磁盘. ->serilize

	file_put_contents("d:/my.log",serialize($dog2));
	echo 'save ok!';
	$dog=unserialize(file_get_contents("d:/my.log"));
	echo "<br/>";
	echo $dog->name;

	$arr=array('city1'=>"bj",'city'=>"tj");

	file_put_contents("d:/my2.log",json_encode($arr));*/

	$host="127.0.0.1:1134";
	 list ($ip, $port) = explode (":", $host);

	 echo $ip."===".$port;
