<?php

	//我的电脑上有两个memcahced服务.

	$mem=new Memcache;

	$mem->addServer('127.0.0.1',11211);
	$mem->addServer('127.0.0.1',9999);
	$mem->addServer('127.0.0.1',9998);
	$mem->addServer('127.0.0.1',9997);
	$mem->addServer('127.0.0.1',9996);

	//这里注意，把key1,放入到 11211端口的mem还是
	//9999 端口的mem就不要我们操心，有$mem对象本身维护.
	if($mem->set('key1','hello',MEMCACHE_COMPRESSED,300)){
		echo 'add ok!';
	}
	if($mem->set('key2','hello2',MEMCACHE_COMPRESSED,300)){
		echo 'add ok!';
	}
	if($mem->set('key3','hello3',MEMCACHE_COMPRESSED,300)){
		echo 'add ok!';
	}


	

