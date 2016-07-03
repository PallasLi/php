

    <?php
 	//    临时文件的位置是在 php.ini 文件中称为 session.save_path 中设置的。

    //如果你在 PHP.INI 文件中设置 session.auto_start 变量为 1，当用户访问你的网站时你不需要调用 start_session() 函数来启动一个会话。

	// 当一个会话启动需要做以下事情： 　 　
	// PHP 特定会话首先会创建一个惟一的标识符，这个标识符是一个随机的 32 伪十六进制数字的字符串3c7foj34c3jj973hjkop2fc937e3443。　　　　
	// 一个 cookie 调用 PHPSESSID 自动发送到用户的电脑存储独特的会话识别的字符串。
	// 在指定服务器上会自动创建临时目录里的文件，这个文件存储名称前缀为 sess_ 的 sess_3c7foj34c3jj973hjkop2fc937e3443的唯一标识符。
	// 当 PHP 脚本要检索一个会话变量中的值，PHP 会自动获得独特的会话标识符的字符串 PHPSESSID cookie，然后在其临时目录的文件中可以通过比较两个值进行验证。
	// 当用户关闭了浏览器或离开浏览器后会话结束, 一般在预定时间后 30 分钟，服务器将终止该会话。

	// 开始一个 PHP 会话
	// 通过调用 session_start()函数一个 PHP 会话很容易开启。这个函数首先检查如果已经开始一个会话或者没有开始会话那么开启一个会话。建议把调用 session_start() 函数放在页面的头部。
	// 会话变量存储在名为 $ _SESSION[]的关联数组中。这些变量可以在一个会话的生命周期内被访问。

       session_start();
       if( isset( $_SESSION['counter'] ) )
       {
          $_SESSION['counter'] += 1;
       }
       else
       {
          $_SESSION['counter'] = 1;
       }
       $msg = "You have visited this page ".  $_SESSION['counter'];
       $msg .= "in this session.";
    ?>
    <html>
    <head>
    <title>Setting up a PHP session</title>
    </head>
    <body>
    <?php include("commons/top.php"); ?>
    <?php  echo ( $msg ); ?>
    </body>
    </html>



    <?php
    // 这是示例删除一个变量：
      // unset($_SESSION['counter']);
    ?>

    <?php
	// 这是函数将会摧毁所有的会话变量：
       //session_destroy();
    ?>



    <?php


// Sessions 是基于 Cookie 的
// 或许有这么一种情况当用户不允许在他们的机器中存储 cookies 时。所以还有另一个方法将 sessionID 发送到浏览器。

// 或者，您可以使用常数 SID 如果会话开始时被定义。如果客户端没有发送一个合适的会话 cookie，它的形式是session_name = session_id。不然，它会填充到一个空字符串。因此，你可以无条件地嵌入到 urls。
// 下面的例子演示了如何注册一个变量，以及如何使用 SID 正确的链接到另一个页面。
 
    ?>

    <p>
    To continue  click following link <br />
    <!-- 当打印 SID 时函数 htmlspecialchars() 为了防止 XSS 攻击。 -->

    <a  href="nextpage.php?<?php echo htmlspecialchars(SID); ?>">
    </p>

