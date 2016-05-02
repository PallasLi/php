<?php
//绑定微信号(将从微信服务器请求给web服务器的echostr返回给微信服务器即可绑定成功)
//绑定成功后即可进行消息传输
// $echoStr=$_GET("echostr");
// echo $echoStr;




//用户向公众号发送消息，公众号将消息转给我的网站处理
//通过PHP输入协议接收微信请求
// <xml>
// <ToUserName>
// <FromUserName>
// <createTime>
// <MsgType>
// <Content>
// </xml>

$requestContent=file_get_contents("php://input");
file_put_contents("./request.txt", $requestContent);


//解析数据进行业务处理


//发送数据给微信服务器，微信服务器再发送信息给公众号
//发送内容为xml,toUserName与 FromUserName反转
// <xml>
// <ToUserName>
// <FromUserName>
// <createTime>
// <MsgType>
// <Content>
// </xml>
//
$responseContent=$requestContent;
echo $responseContent;


//也可以用require './text.xml';
//定义变量后$fromUserName再text.xml使用变量<?php echo $fromUserName>
//text.xml内容如下
// <xml>
// <ToUserName><![CDATA[<?php echo $fromUserName>]]
// <FromUserName>
// <createTime>
// <MsgType>
// <Content>
// </xml>
//
//带图片的信息不用Content用Article
//

?>