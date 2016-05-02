<?php

 require_once 'memcached-client.php';
  
  $mc = new memcached(array(
               'servers' => array('127.0.0.1:11211'), //连接的memcacheip和端口
               'debug'   => false, //是否debug
               'compress_threshold' => 10240, /*最大压缩*/
               'persistant' => true)); /*是否是持久连接*/
 

  $mc->set('key1', array('some', 'array'));
 // $mc->replace('key', 'some random string');
 
  $val = $mc->get('key1');
	var_dump($val);
	//修改
	$mc->replace('key1', "北京");
	$val = $mc->get('key1');

	var_dump($val);
	//删除
	$mc->delete('key1');
  $val = $mc->get('key1');
	echo "删除后";
	var_dump($val);