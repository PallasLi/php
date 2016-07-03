
邮件发送

必须正确配置 PHP 中 PHP.ini 文件中如何详细地使用系统发送电子邮件。打开php.ini文件中可用 /etc/目录，找到部分[邮件函数]。

Windows 用户应该确保提供两个指令。第一个叫做 SMTP，它定义了你的电子邮件服务器地址。第二个叫做 sendmail_from 定义您自己的电子邮件地址。

配置 Windows 看起来应该是这样的：

    [mail function]
    ; For Win32 only.
    SMTP = smtp.secureserver.net

    ; For win32 only
    sendmail_from = webmaster@tutorialspoint.com
Linux 用户只需要告诉 PHP 他们的sendmail 的应用程序位置。指定的路径和任何所需的开关应该在 sendmail_path 有所指引。

Linux 的配置应该是这样的：

    [mail function]
    ; For Win32 only.
    SMTP =

    ; For win32 only
    sendmail_from =

    ; For Unix only
    sendmail_path = /usr/sbin/sendmail -t -i
现在你准备好了。

发送纯文本的电子邮件
PHP 使用 mail() 函数来发送电子邮件。这个函数需要三个强制参数指定收件人的电子邮件地址，消息和实际消息的主题另外还有其他两个可选参数。

    mail( to, subject, message, headers, parameters );
这是每个参数的描述。

参数	描述
to	必需的。指定邮件的接收/接收器
subject	必需的。指定电子邮件的主题。该参数不能包含任何换行字符
message	必需的。定义要发送的消息。每一行应该分离低频(\ n)。行不得超过70个字符
headers	可选的。指定附加头,从Cc和Bcc。附加头应该被CRLF(\ r \ n) 分开
parameters	可选的。指定一个附加参数到sendmail的程序
尽快 PHP 调用邮件函数将试图发送电子邮件，那么成功它将返回 true，如果失败它将返回 false。

可以指定为多个收件人在 mail() 函数的第一个参数在一个逗号分隔的列表中。

示例
以下示例将发送 HTML 电子邮件消息到 xyz@somedomain.com。你可以以这样一种方式编写程序的代码，它应该接收来自用户的所有内容，然后应该发送一个电子邮件。

    <html>
    <head>
    <title>Sending email using PHP</title>
    </head>
    <body>
    <?php
       $to = "xyz@somedomain.com";
       $subject = "This is subject";
       $message = "This is simple text message.";
       $header = "From:abc@somedomain.com \r\n";
       $retval = mail ($to,$subject,$message,$header);
       if( $retval == true )  
       {
          echo "Message sent successfully...";
       }
       else
       {
          echo "Message could not be sent...";
       }
    ?>
    </body>
    </html>
发送 HTML 电子邮件
当你使用 PHP 发送一个文本信息所有的内容将被视为简单的文本。即使你包含 HTML 标签在一个文本消息时，它将显示简单的文本和 HTML 标记将不会通过 HTML 语法显示格式化。但 PHP 提供了选择发送 HTML 消息按照实际 HTML 消息。

发送电子邮件消息时您可以指定一个 Mime 版本，内容类型和字符集来发送 HTML 电子邮件。

例如
以下示例将 HTML 电子邮件消息发送到 xyz@somedomain.com 将它复制到 afgh@somedomain.com。你可以以编写这个程序的代码的方式从用户接收所有的内容，然后发送一个电子邮件。

    <html>
    <head>
    <title>Sending HTML email using PHP</title>
    </head>
    <body>
    <?php
       $to = "xyz@somedomain.com";
       $subject = "This is subject";
       $message = "<b>This is HTML message.</b>";
       $message .= "<h1>This is headline.</h1>";
       $header = "From:abc@somedomain.com \r\n";
       $header = "Cc:afgh@somedomain.com \r\n";
       $header .= "MIME-Version: 1.0\r\n";
       $header .= "Content-type: text/html\r\n";
       $retval = mail ($to,$subject,$message,$header);
       if( $retval == true )
       {
          echo "Message sent successfully...";
       }
       else
       {
          echo "Message could not be sent...";
       }
    ?>
    </body>
    </html>
用电子邮件发送附件
发送电子邮件与混合内容要求设置内容类型头到多部分/混合。然后可以在在边界里指定文本和附件部分。

边界始于两个连字符后跟一个惟一的编号这个编号不可以出现在电子邮件中的一部分。一个 PHP 函数 md5() 用于创建一个 32 位十六进制数唯一的号码。最终的边界表示电子邮件的最后部分也必须有两个连字符结束。

附加文件应该用 base64_encode () 函数编码进行安全传输和最好用 chunk_split() 函数分成块。这增加了 \r\n 定期内部文件，正常每 76 个字符。

下面的示例将发送文件 /tmp/test.txt 作为附件。你可以编写代码程序接收一个上传文件并将其发送。

    <html>
    <head>
    <title>Sending attachment using PHP</title>
    </head>
    <body>
    <?php
      $to = "xyz@somedomain.com";
      $subject = "This is subject";
      $message = "This is test message.";
      # Open a file
      $file = fopen( "/tmp/test.txt", "r" );
      if( $file == false )
      {
         echo "Error in opening file";
         exit();
      }
      # Read the file into a variable
      $size = filesize("/tmp/test.txt");
      $content = fread( $file, $size);

      # encode the data for safe transit
      # and insert \r\n after every 76 chars.
      $encoded_content = chunk_split( base64_encode($content));

      # Get a random 32 bit number using time() as seed.
      $num = md5( time() );

      # Define the main headers.
      $header = "From:xyz@somedomain.com\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-Type: multipart/mixed; ";
      $header .= "boundary=$num\r\n";
      $header .= "--$num\r\n";

      # Define the message section
      $header .= "Content-Type: text/plain\r\n";
      $header .= "Content-Transfer-Encoding:8bit\r\n\n";
      $header .= "$message\r\n";
      $header .= "--$num\r\n";

      # Define the attachment section
      $header .= "Content-Type:  multipart/mixed; ";
      $header .= "name=\"test.txt\"\r\n";
      $header .= "Content-Transfer-Encoding:base64\r\n";
      $header .= "Content-Disposition:attachment; ";
      $header .= "filename=\"test.txt\"\r\n\n";
      $header .= "$encoded_content\r\n";
      $header .= "--$num--";

      # Send email now
      $retval = mail ( $to, $subject, "", $header );
      if( $retval == true )
       {
          echo "Message sent successfully...";
       }
       else
       {
          echo "Message could not be sent...";
       }
    ?>
    </body>
    </html>


