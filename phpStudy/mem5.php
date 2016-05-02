<?php

	//如何从多个mem中取出你的key?

	$mem=new Memcache;

	$mem->addServer('127.0.0.1',11211);
	$mem->addServer('127.0.0.1',9999);

	$val=$mem->get('key1');
	
	echo '程序中取出分布的值='.$val;