<?php
		
    //创建一个mem对象实例
	$mem=new Memcache;
     
	if(!$mem->connect("127.0.0.1",11211)){
		die('连接失败!');
	}

	//增加

	//1.增加一个字串
/*	if($mem->set('key1',"beijing",MEMCACHE_COMPRESSED,60)){
		
		echo '添加ok';
	}*/
	
	//2.添加数值
/*	if($mem->set('key1',100,MEMCACHE_COMPRESSED,60)){
		
		echo '添加ok';
	}*/

	//3.添加数组
	//在添加数组是，根据需要. 希望序列号放入  ,
	//serialize<=>unserialize， 如果根据需要，也可以json_encode <=> json_decode
	$arr=array("bj",'tj');
	if($mem->set('key1',$arr,MEMCACHE_COMPRESSED,time()+31*3600*24)){
		
		echo '添加数组ok99111';
	}
	//4.添加对象
/*	class Dog{
		public $name;
		public $age;
		public function __construct($name,$age){
			$this->name=$name;
			$this->age=$age;
		}
	}

	$dog1=new Dog('小狗',50);
	if($mem->set('key1',$dog1,MEMCACHE_COMPRESSED,60)){
		
		echo '添加对象ok';
	}*/

	//5.添加null 布尔值
/*	if($mem->set('key1',false,MEMCACHE_COMPRESSED,60)){
		
		echo '添加布尔ok';
	}*/

	//6. 资源类型放入.
/*	$con=mysql_connect("127.0.0.1","root","root");
	if(!$con){
		die('连接数据库失败');
	}
	var_dump($con);
	echo "<br/>";
	if($mem->set('key1',$con,MEMCACHE_COMPRESSED,60)){
		
		echo '添加资源ok';
	}*/


	//查询

	$val=$mem->get('key1');

	var_dump($val);

	//修改
	//可以使用replace
	if($mem->replace("key11",'hello',MEMCACHE_COMPRESSED,60)){
		echo 'replace ok';
	}else{
		echo 'replace no ok';
	}



	//删除
	echo "<br/>";
	if($mem->delete('key14')){
		echo 'key14 删除';
	}else{
		echo 'key14不存在';
	}



