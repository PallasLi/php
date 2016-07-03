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



预定义变量

PHP 在运行的脚本中提供了大量预定义的变量来供使用。PHP提供了一套附加的预定义数组，这些数组变量包含了来自 web 服务器环境和用户输入。这些新的数组被称为超全局变量：

以下所有的变量在全局范围内自动生效：

PHP 超全局变量：

变量	说明
$GLOBALS	包含一个引用变量这就表示其在脚本的所有作用域中都是可用的，变量的名字就是数组的键。
$_SERVER	是一个包含了诸如头信息(header)、路径(path)、以及脚本位置(script locations)等等信息的数组。这个数组中的项目由 Web 服务器创建。不能保证每个服务器都提供全部项目；见下一节的完整列表的所有服务器变量。
$_GET	通过HTTP GET方法传递给当前脚本的变量的关联数组。
$_POST	通过HTTP POST方法传递给当前脚本的变量的关联数组。
$_FILES	通过 HTTP POST 方式上传到当前脚本的项目的数组。
$_REQUEST	一个关联数组包含了 $_GET，$_POST 和 $_COOKIE 的数组。
$_COOKIE	通过 HTTP Cookies 方式传递给当前脚本的变量的关联数组。
$_SESSION	通过会话方式使用于当前脚本的变量的关联数组。
$_PHP_SELF	包含一个PHP脚本的文件名的字符串。
$php_errormsg	是一个包含文本的最后一个PHP生成的错误消息的变量。
服务器变量：$ _SERVER
$_SERVER 是一个包含了诸如头信息(header)、路径(path)、以及脚本位置(script locations)等等信息的数组。这个数组中的项目由 Web 服务器创建。不能保证每个服务器都提供全部项目。

SOFTWARE
变量	说明
$_SERVER['PHP_SELF']	当前执行脚本的文件名，与 document root 有关。
$_SERVER['argv']	传递给该脚本的参数的数组。当脚本以命令行方式运行时，argv 变量传递给程序 C 语言样式的命令行参数。当通过 GET 方式调用时，该变量包含查询字符串。
$_SERVER['argc']	包含命令行模式下传递给该脚本的参数的数目(如果运行在命令行模式下)。
$_SERVER['GATEWAY_INTERFACE']	服务器使用的 CGI 规范的版本；例如，“CGI/1.1”。
$_SERVER['SERVER_ADDR']	当前运行脚本所在的服务器的 IP 地址。
$_SERVER['SERVER_NAME']	当前运行脚本所在的服务器的主机名。如果脚本运行于虚拟主机中，该名称是由那个虚拟主机所设置的值决定。
$_SERVER['SERVER_SOFTWARE']	服务器标识字符串，在响应请求时的头信息中给出。
$_SERVER['SERVER_PROTOCOL']	请求页面时通信协议的名称和版本。例如，“HTTP/1.0”。
$_SERVER['REQUEST_METHOD']	访问页面使用的请求方法；例如，“GET”, “HEAD”，“POST”，“PUT”。
$_SERVER['REQUEST_TIME']	请求开始时的时间戳。从 PHP 5.1.0 起可用。
$_SERVER['QUERY_STRING']	query string（查询字符串），如果有的话，通过它进行页面访问。
$_SERVER['DOCUMENT_ROOT']	当前运行脚本所在的文档根目录。在服务器配置文件中定义。
$_SERVER['HTTP_ACCEPT']	当前请求头中 Accept: 项的内容，如果存在的话。
$_SERVER['HTTP_ACCEPT_CHARSET']	当前请求头中 Accept-Charset: 项的内容，如果存在的话。例如：“iso-8859-1,*,utf-8”。
$_SERVER['HTTP_ACCEPT_ENCODING']	当前请求头中 Accept-Encoding: 项的内容，如果存在的话。例如：“gzip”。
$_SERVER['HTTP_ACCEPT_LANGUAGE']	当前请求头中 Accept-Language: 项的内容，如果存在的话。例如：“en”。
$_SERVER['HTTP_CONNECTION']	当前请求头中 Connection: 项的内容，如果存在的话。例如：“Keep-Alive”。
$_SERVER['HTTP_HOST']	当前请求头中 Host: 项的内容，如果存在的话。
$_SERVER['HTTP_REFERER']	页面的地址(如果有的话),将当前页面的用户代理。
$_SERVER['HTTP_USER_AGENT']	该字符串表明了访问该页面的用户代理的信息。一个典型的例子是：Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)。
$_SERVER['HTTPS']	如果脚本是通过 HTTPS 协议被访问，则被设为一个非空的值。
$_SERVER['REMOTE_ADDR']	浏览当前页面的用户的 IP 地址。
$_SERVER['REMOTE_HOST']	浏览当前页面的用户的主机名。DNS 反向解析不依赖于用户的 REMOTE_ADDR。
$_SERVER['REMOTE_PORT']	服务器机器上的端口使用的web服务器进行通信。为默认设置,这将是“80”。
$_SERVER['SCRIPT_FILENAME']	当前执行脚本的绝对路径。
$_SERVER['SERVER_ADMIN']	该值指明了 Apache 服务器配置文件中的 SERVER_ADMIN 参数。如果脚本运行在一个虚拟主机上，则该值是那个虚拟主机的值。
$_SERVER['SERVER_PORT']	Web 服务器使用的端口。默认值为 “80”。如果使用 SSL 安全连接，则这个值为用户设置的 HTTP 端口。
$_SERVER['SERVER_SIGNATURE']	包含了服务器版本和虚拟主机名的字符串。
$_SERVER['PATH_TRANSLATED']	当前脚本所在文件系统（非文档根目录）的基本路径。这是在服务器进行虚拟到真实路径的映像后的结果。
$_SERVER['SCRIPT_NAME']	包含当前脚本的路径。这是有用的页面需要指向自己。
$_SERVER['REQUEST_URI']	给定的URI来访问这个页面;例如,/ index . html。
$_SERVER['PHP_AUTH_DIGEST']	当运行在Apache模块做消化HTTP身份验证这个变量设置为发送的“授权”头端。
$_SERVER['PHP_AUTH_USER']	运行在Apache和IIS(ISAPI PHP 5)作为HTTP身份验证模块做这个变量设置为用户提供的用户名。
$_SERVER['PHP_AUTH_PW']	当运行在Apache和IIS(ISAPI PHP 5)作为HTTP身份验证模块做这个变量设置为用户提供的密码。
$_SERVER['AUTH_TYPE']	当运行在Apache HTTP身份验证模块做这个变量设置为身份验证类型。
