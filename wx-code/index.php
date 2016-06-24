<?php

//>>1.接收来自于微信服务器发送过来的原始内容
$requestContent = file_get_contents('php://input'); //接收到的是一个xml字符串
file_put_contents('./request.txt', $requestContent);

//>>2.解析接收的xml中的数据
$requestContent = simplexml_load_string($requestContent);

$toUserName = $requestContent->ToUserName; //公众号
$FromUserName = $requestContent->FromUserName; //微信号(谁发送过来的)
$CreateTime = $requestContent->CreateTime; //发送时间
$msgType = $requestContent->MsgType; //接收的内容类型
if($msgType=='location'){
    //>>说明用户发送过来的信息为位置信息
    $x = $requestContent->Location_X;//地理位置维度
    $y = $requestContent->Location_Y;//地理位置经度
    $Scale = $requestContent->Scale;//地图缩放大小
    $Label = $requestContent->Label;//地理位置信息

    //>>将位置信息保存到数据表中
    $db = initDB();
    $db->query("insert into location values(null,'$FromUserName',$x,$y,$Scale,'$Label',$CreateTime)");

    //>>返回文本信息给微信
    $content = "你的位置[$Label]已经收到,请输入关键字在这个位置搜索!";
    require './text.xml';
}elseif($msgType=='text'){
//    ob_start();
    //>>接收用户发送过来的搜索关键字
    $keyword = $requestContent->Content;
    //>>得到用户上次发送的位置信息
    $db = initDB();
    $row = $db->fetchRow("select * from location where username='$FromUserName' order by createtime desc limit 0,1");
    if($row){
        //>>使用位置和关键字让百度地图帮我搜索!
        $url = "http://api.map.baidu.com/place/v2/search?ak=86EUgVBlgdGuCxeQQ6iaXjNu&output=json&query={$keyword}&page_size=10&page_num=0&scope=1&location={$row['x']},{$row['y']}&radius=2000";
        $jsonStr = file_get_contents($url);
        $jsonObj = json_decode($jsonStr);
        $results = $jsonObj->results;
        require './news.xml';
    }else{
        $content = "请先发送位置信息!,然后再发送关键字进行搜索!";
        require './text.xml';
    }
//    file_put_contents('./response.txt',ob_get_clean());

}

function initDB(){
    require './DB.class.php';
    $db = DB::getInstance(array('dbname'=>'test','password'=>'admin'));
    return $db;
}

