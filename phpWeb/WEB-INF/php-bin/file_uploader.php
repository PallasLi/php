
 <?php



// PHP 脚本允许用户使用 HTML 格式上传文件到服务器上。最初的文件被上传到一个临时目录中，随后 PHP 脚本将其转移到最终目录中。

// 在 phpinfo.php 页面中信息描述用于文件上传的临时目录为 upload_tmp_dir，并且允许最大上传文件为upload_max_filesize。这些参数被设置在 PHP 配置文件 PHP.ini 中

// 上传文件步骤如下:　 　

// 用户打开页面，其中包含 HTML 文本文件表单，浏览按钮和提交按钮。　　　　
// 用户单击浏览按钮并从本地电脑上选择文件上传。　
// 选中文件的完整路径出现在文本框中，然后单击提交按钮。　　　　
// 所选文件被发送到服务器上的临时目录中。　　　　
// 指定为形式的 PHP 脚本处理程序在表单的动作属性检查文件已经到达后，然后将文件复制到目标目录中。
// PHP 脚本确认上传成功。
// 通常，在临时和最终的位置中，写入文件设置权限为允许是很有必要的。如果被设置为只读那么过程将会失败 一个上传文件可以是一个文本文件或图像文件或任何其他文档。

// 创建上传表单
// 下面 HTML 代码创建了一个上传表单。这种表单属性设置为 post，enctype属性设置为 multipart/from-data


// 有一个全局 PHP 变量名为 $_FILES。这个变量是二维数组，保留了所有上传文件的相关信息。因此，如果分配给在上传表单输入值的名称 File，那么 PHP 将创建 5 个变量：

// $_FILES['file']['tmp_name']-——上传文件在 web 服务器上的临时目录。　　　　
// $_FILES['file']['name']——上传文件的真实名称。　　　　
// $_FILES['file']['size']——上传文件的大小以字节为单位。　　　　
// $_FILES['file']['type']——上传文件的 MIME 类型。　　　　
// $_FILES['file']['error']——与此文件上传相关的错误代码。




 
    if( $_FILES['file']['name'] != "" )
    {
       copy( $_FILES['file']['name'], "/var/www/html" ) or 
               die( "Could not copy file!");
    }
    else
    {
        die("No file specified!");
    }
    ?>
    <html>
    <head>
    <title>Uploading Complete</title>
    </head>
    <body>
    <?php include("commons/top.php"); ?>
    <h2>Uploaded File Info:</h2>
    <ul>
    <li>Sent file: <?php echo $_FILES['file']['name'];  ?>
    <li>File size: <?php echo $_FILES['file']['size'];  ?> bytes
    <li>File type: <?php echo $_FILES['file']['type'];  ?>
    </ul>
    </body>
    </html>