<?php

	
	

	//这个文件去操作memcached服务

	 //创建一个mem对象实例
	$mem=new Memcache;
     
	if(!$mem->connect("127.0.0.1",11211)){
		die('连接失败!');
	}

	//在另外文件中取出对象时，有个注意的地方,对应php5.2这个版本会提示错误,
	//对php5.3这个版本会提示 incomplete 信息, 解决方法是声明类定义即可

	class Dog{
		public $name;
		public $age;
		public function __construct($name,$age){
			$this->name=$name;
			$this->age=$age;
		}
	}

	$dog=$mem->get('key1');

	var_dump($dog);