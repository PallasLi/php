

<html>
<head>
<title>Setting Cookies with PHP</title>
</head>
<body>
    <?php include("commons/top.php"); ?>
<?php

if( isset($_COOKIE["name"]))
	echo "Welcome " . $_COOKIE["name"] . "<br />";
else
	echo "Sorry... Not recognized" . "<br />";

if( isset($_COOKIE["times"]))
	$times=$_COOKIE["times"];
else
	$times=3;
//   setcookie(name, value, expire, path, domain, security);
// Name——这设置 cookie 的名称和存储在一个名为 HTTP_COOKIE_VARS 的环境变量。这个变量是在访问使用cookie。　　　　
// Value——指定变量的值,是你实际想要存储的内容。　　　　
// Expiry——这指定一个未来的时间以秒为单位就是从 1970 年 1 月 1 日格林尼治时间之后。这个时间之后 Cookie 将无法访问。如果 cookie 里面没有设置这个参数，Web 浏览器关闭时将自动过期。　　　　
// Path——指定目录中 cookie 是有效的。一个正斜杠字符允许所有目录的 cookie 有效。　　　　
// Domain——这可以在非常大的领域里用来指定域名在并且必须包含至少两个有效的时期。创建 Cookie 都是唯一有效的主机和域名。
// Security——这可以设置为1可以指定发送的 cookie 只能使用 HTTPS 安全传输，否则设置为 0 意味着可以定期发送的 HTTP cookie。

setcookie("name", "John Watkin", time()+3600, "/","", 0);
setcookie("age", "36", time()+3600, "/", "",  0);
setcookie("times", $times-1, time()+3600, "/", "",  0);


//删除cookie

if( isset($_COOKIE["times"])&&$_COOKIE["times"]==0){
	setcookie( "name", "", time()- 60, "/","", 0);
	setcookie( "age", "", time()- 60, "/","", 0);
	setcookie( "times", "", time()- 60, "/","", 0);
}
?>
</body>
</html> 
</html>
