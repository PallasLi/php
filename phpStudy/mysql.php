<?php
try{
    // 新建一个数据库连接
    // You'll probably want to replace hostname with localhost in the first parameter.
    // The PDO options we pass do the following:
    // \PDO::ATTR_ERRMODE enables exceptions for errors.  This is optional but can be handy.
    // \PDO::ATTR_PERSISTENT disables persistent connections, which can cause concurrency issues in certain cases.  See "Gotchas".
    // \PDO::MYSQL_ATTR_INIT_COMMAND alerts the connection that we'll be passing UTF-8 data.
    // This may not be required depending on your configuration, but it'll save you headaches down the road
    // if you're trying to store Unicode strings in your database.  See "Gotchas".
    $link = new \PDO(   'mysql:host=your-hostname;dbname=your-db', 
                        'your-username', 
                        'your-password', 
                        array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
                            \PDO::ATTR_PERSISTENT => false, 
                            \PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4'
                        )
                    );

    $handle = $link->prepare('select Username from Users where UserId = ? or Username = ? limit ?');

    // PHP bug: if you don't specify PDO::PARAM_INT, PDO may enclose the argument in quotes.
    // This can mess up some MySQL queries that don't expect integers to be quoted.
    // See: https://bugs.php.net/bug.php?id=44639
    // If you're not sure whether the value you're passing is an integer, use the is_int() function.
    $handle->bindValue(1, 100, PDO::PARAM_INT);
    $handle->bindValue(2, 'Bilbo Baggins');
    $handle->bindValue(3, 5, PDO::PARAM_INT);

    $handle->execute();

    // Using the fetchAll() method might be too resource-heavy if you're selecting a truly massive amount of rows.
    // If that's the case, you can use the fetch() method and loop through each result row one by one.
    // You can also return arrays and other things instead of objects.  See the PDO documentation for details.
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    foreach($result as $row){
        print($row->Username);
    }
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
?>
/**
陷阱
当绑定整型变量时，如果不传递 PDO::PARAM_INT 参数有事可能会导致 PDO 对数据加引号。 这会搞坏特定的 MySQL 查询。查看该 bug 报告。

未使用 set names utf8mb4 作为首个查询，可能会导致 Unicode 数据错误地存储进数据库，这依赖于你的配置。 如果你绝对有把握你的 Unicode 编码数据不会出问题，那你可以不管这个。

启用持久连接可能会导致怪异的并发相关的问题。 这不是一个 PHP 的问题，而是一个应用层面的问题。只要你仔细考虑了后果，持久连接一般会是安全的。 查看 Stack Overfilow 这个问题。

即使你使用了 set names utf8mb4，你也得确认实际的数据库表使用的是 utf8mb4 字符集！

可以在单个 execute() 调用中执行多条 SQL 语句。 只需使用分号分隔语句，但注意这个 bug，在该文档所针对的 PHP 版本中还没修复。

Laruence：PDOStatement::bindParam 的一个陷阱


**/





MySQL

PHP 几乎可以使用所有的数据库软件，包括 Oracle 和 Sybase 但最常用的是免费的 MySQL 数据库。

你应该掌握几个了吗?
你已经通过 MySQL 教程了解 MySQL 基础知识。
下载并安装最新版本的 MySQL。
创建数据库用户 guest 密码 guest123。
如果您还没有创建了一个数据库，那么你需要用根用户和密码创建一个数据库。
我们本章分为以下部分

Connecting to MySQL database
连接到 MySQL 数据库，学习如何使用 PHP 来打开和关闭一个 MySQL 数据库连接。

Create MySQL Database Using PHP
使用 PHP 创建 MySQL 数据库，这部分解释了如何使用 PHP 创建 MySQL 数据库和表。

Delete MySQL Database Using PHP
这部分解释了如何使用 PHP 删除 MySQL 数据库和表。

Insert Data To MySQL Database
一旦你已经创建了数据库和表，那么你想向你的创建表插入你的数据。本阶段通过实际例子展示数据插入。

Retrevieng Data From MySQL Database
如何使用 PHP 从数据库取数据，学习如何使用 PHP 从 MySQL 数据库获取记录。

Using Paging through PHP
这一节解释如何分页显示查询结果，如何创建导航链接。

Updating Data Into MySQL Database
这部分解释了如何使用 PHP 更新现有记录到 MySQL 数据库。

Deleting Data From MySQL Database
这部分解释了如何使用 PHP 删除或清除 MySQL 数据库现有记录。

Using PHP To Backup MySQL Database
为了 MySQL 数据库安全学习不同的方法要备份你的数据库。




MySQL数据库连接

打开数据库连接
PHP 提供了 mysql_connect（） 函数打开一个数据库连接。此函数接受五个参数并返回一个 MySQL 成功连接标识符，如果执行失败将返回 FALSE。

语法：

connection mysql_connect(server,user,passwd,new_link,client_flag);
参数  说明
server  可选——运行数据库服务器上的主机名。如果没有指定,默认值是localhost:3306。 用户名 密码 newlink
user    可选——访问数据库的用户名。如果没有指定,默认是用户拥有的服务器进程名称。
passwd  可选——用户用密码访问数据库。如果没有指定,默认是空密码。
new_link    可选。如果用同样的参数第二次调用 mysql_connect()，将不会建立新连接，而将返回已经打开的连接标识。参数 new_link 改变此行为并使 mysql_connect() 总是打开新的连接，甚至当 mysql_connect() 曾在前面被用同样的参数调用过。
client_flags    可选。client_flags 参数可以是以下常量的组合：
MYSQL_CLIENT_SSL - 使用 SSL 加密
MYSQL_CLIENT_COMPRESS - 使用压缩协议
MYSQL_CLIENT_IGNORE_SPACE - 允许函数名后的间隔
MYSQL_CLIENT_INTERACTIVE - 允许关闭连接之前的交互超时非活动时间
提示和注释：

您可以在服务器 php.ini 文件指定用户名和密码，而不是一次又一次的在你的每一个 PHP 脚本使用他们。检查 php.ini 文件配置。

关闭数据库连接
PHP 提供了最简单的函数 mysql_close 关闭数据库连接。此函数接受 mysql_connect 函数返回的连接资源作为参数。成功它将返回 TRUE；如果执行失败将返回 FALSE。

语法：

    bool mysql_close ( resource $link_identifier );
如果没有指定一个资源，最后打开数据库被关闭。

例子

下面的例子尝试打开和关闭数据库连接：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'guest';
    $dbpass = 'guest123';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    mysql_close($conn);
    ?>



用 PHP 创建 MySQL 数据库

创建一个数据库
创建和删除数据库你应该有管理特权。它很容易创建一个新的 MySQL 数据库。PHP 使用 mysql_query 函数创建一个MySQL 数据库。这个函数接受两个参数执行成功并返回 TRUE；如果执行失败将返回 FALSE。

语法

    bool mysql_query( sql, connection );
参数  说明
sql 必填-----用 SQL查询语句创建一个数据库
connection  可选的，如果没有指定，那么最后只连接到 mysql_connect 将被使用。
例子

试运行以下例子创建数据库：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    $sql = 'CREATE Database test_db';
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not create database: ' . mysql_error());
    }
    echo "Database test_db created successfully\n";
    mysql_close($conn);
    ?>
选择一个数据库
一旦你打开一个连接到一个数据库服务器，那么它将需要选择一个特定的数据库相关联的所有表的地方。

这是必需的，因为可能有多个数据库驻留在一个单独的服务器上，你可以使用一个数据库。

PHP 提供了函数 mysql_select_db 选择一个数据库。成功它将返回 TRUE；如果执行失败将返回 FALSE。

语法

    bool mysql_select_db( db_name, connection );
参数  说明
db_name 必填-----选择数据库名称
connection  可选的，如果没有指定，那么最后只连接到 mysql_connect 将被使用。
例子

这里的示例向您展示如何选择一个数据库：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'guest';
    $dbpass = 'guest123';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    mysql_select_db( 'test_db' );
    mysql_close($conn);
    ?>
创建数据库表
创建新的数据库中的表你需要做同样的事情就像创建数据库。首先使用 SQL 查询创建表然后使用 mysql_query() 函数执行查询。

例如：尝试以下示例创建一个表：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    $sql = 'CREATE TABLE employee( '.
           'emp_id INT NOT NULL AUTO_INCREMENT, '.
           'emp_name VARCHAR(20) NOT NULL, '.
           'emp_address  VARCHAR(20) NOT NULL, '.
           'emp_salary   INT NOT NULL, '.
           'join_date    timestamp(14) NOT NULL, '.
           'primary key ( emp_id ))';

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not create table: ' . mysql_error());
    }
    echo "Table employee created successfully\n";
    mysql_close($conn);
    ?>
在一定情况下，您需要创建许多表首先最好先创建一个文本文件，把所有的 SQL 命令写到文本文件中,然后执行这些命令将该文件导入到 mysq 数据库中。

考虑以下内容 sql_query.txt 文件

    CREATE TABLE employee(
         emp_id INT NOT NULL AUTO_INCREMENT,
         emp_name VARCHAR(20) NOT NULL,
         emp_address  VARCHAR(20) NOT NULL,
         emp_salary   INT NOT NULL,
         join_date    timestamp(14) NOT NULL,
         primary key ( emp_id ));
    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $query_file = 'sql_query.txt';

    $fp    = fopen($query_file, 'r');
    $sql = fread($fp, filesize($query_file));
    fclose($fp); 

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not create table: ' . mysql_error());
    }
    echo "Table employee created successfully\n";
    mysql_close($conn);
    ?>



使用 PHP 删除 MySQL 数据库

删除一个数据库
如果数据库不再需要那么它将可以被永远删除。您可以使用 SQL 命令传递给 mysql_query 执行删除一个数据库。

例子

尝试以下例子来删除一个数据库。

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'DROP DATABASE test_db';
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not delete database db_test: ' . mysql_error());
    }
    echo "Database deleted successfully\n";
    mysql_close($conn);
    ?>
警告：对于删除一个数据库和表，它是非常危险的。所以删除任何表或数据库之前你应该确保你所做的一切是自愿的。

删除一个表
它通过 mysql_query 函数再次的发出一个 SQL 命令来删除任何数据库和数据表。但使用这个命令时要非常小心，因为这样做你可以在你的桌面上删除一些重要的信息。

尝试以下示例删除一个表：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'DROP TABLE employee';
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not delete table employee: ' . mysql_error());
    }
    echo "Table deleted successfully\n";
    mysql_close($conn);
    ?>


插入数据到 MySQL 数据库

数据可以通过 mysql_query PHP 函数执行 SQL INSERT 语句输入到 MySQL 表中。下面一个简单的例子将记录插入到 employee 表。

例子
尝试以下例子将记录插入到 employee 表。

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'INSERT INTO employee '.
           '(emp_name,emp_address, emp_salary, join_date) '.
           'VALUES ( "guest", "XYZ", 2000, NOW() )';

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not enter data: ' . mysql_error());
    }
    echo "Entered data successfully\n";
    mysql_close($conn);
    ?>
在真实的应用程序中，所有的值都将使用 HTML 表单进行提交，然后这些值将使用 PHP 脚本被捕获，最后将他们插入到 MySQL 数据表。

在当数据插入之前它的最佳实践是使用功能 get_magic_quotes_gpc()来查看当前魔法配置引号函数是否已经设置。如果这个函数返回 false，那么请使用函数 addslashes() 在引号之前添加斜杠。

例子
尝试将这段代码放入 add_employee.php 文件中，这将需要使用 HTML 表单进行输入，然后它将创建记录到数据库中。

    <html>
    <head>
    <title>Add New Record in MySQL Database</title>
    </head>
    <body>
    <?php
    if(isset($_POST['add']))
    {
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    if(! get_magic_quotes_gpc() )
    {
       $emp_name = addslashes ($_POST['emp_name']);
       $emp_address = addslashes ($_POST['emp_address']);
    }
    else
    {
       $emp_name = $_POST['emp_name'];
       $emp_address = $_POST['emp_address'];
    }
    $emp_salary = $_POST['emp_salary'];

    $sql = "INSERT INTO employee ".
           "(emp_name,emp_address, emp_salary, join_date) ".
           "VALUES('$emp_name','$emp_address',$emp_salary, NOW())";
    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not enter data: ' . mysql_error());
    }
    echo "Entered data successfully\n";
    mysql_close($conn);
    }
    else
    {
    ?>
    <form method="post" action="<?php $_PHP_SELF ?>">
    <table width="400" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td width="100">Employee Name</td>
    <td><input name="emp_name" type="text" id="emp_name"></td>
    </tr>
    <tr>
    <td width="100">Employee Address</td>
    <td><input name="emp_address" type="text" id="emp_address"></td>
    </tr>
    <tr>
    <td width="100">Employee Salary</td>
    <td><input name="emp_salary" type="text" id="emp_salary"></td>
    </tr>
    <tr>
    <td width="100"> </td>
    <td> </td>
    </tr>
    <tr>
    <td width="100"> </td>
    <td>
    <input name="add" type="submit" id="add" value="Add Employee">
    </td>
    </tr>
    </table>
    </form>
    <?php
    }
    ?>
    </body>
    </html>



使用 PHP 从数据库取数据

可以通过 PHP 函数 mysql_query 执行 SQL SELECT 语句从 MySQL 表中获取的数据。你有几个选项可以从 MySQL 获取数据。

最常用的方法是使用函数mysql_fetch_array()。这个函数返回的是作为一个关联数组结果集和一个索引数组结果集,或两者兼而有之。这个函数如果没有更多的行将返回FALSE。

下面是一个简单的例子从 employee 表获取记录。

例子
尝试以下例子来显示 employee 表的所有记录。

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'SELECT emp_id, emp_name, emp_salary FROM employee';

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
    {
        echo "EMP ID :{$row['emp_id']}  <br> ".
             "EMP NAME : {$row['emp_name']} <br> ".
             "EMP SALARY : {$row['emp_salary']} <br> ".
             "--------------------------------<br>";
    } 
    echo "Fetched data successfully\n";
    mysql_close($conn);
    ?>
这些结果集中的内容被分配给变量 $row 并且结果集中的值被打印出来。

注意：永远记住当你想插入数组的值到一个字符串要使用花括号。
在上面例子中常量 MYSQL_ASSOC 作为 mysql_fetch_array（）函数的第二个参数，以便它返回作为一个关联数组的结果集。通过使用一个关联数组的名字可以访问字段，而不是使用索引。

PHP 提供了另一个函数称为 mysql_fetch_assoc() 也返回作为一个关联数组的结果集。

例子
尝试以下例子使用 mysql_fetch_assoc() 函数从 employee 表来显示所有记录。

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'SELECT emp_id, emp_name, emp_salary FROM employee';

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    while($row = mysql_fetch_assoc($retval))
    {
        echo "EMP ID :{$row['emp_id']}  <br> ".
             "EMP NAME : {$row['emp_name']} <br> ".
             "EMP SALARY : {$row['emp_salary']} <br> ".
             "--------------------------------<br>";
    } 
    echo "Fetched data successfully\n";
    mysql_close($conn);
    ?>
您还可以使用常量 MYSQL_NUM，作为 mysql_fetch_array() 函数的第二个参数。这将导致该函数返回一个索引数组。

例子
尝试以下例子使用常量 MYSQL_NUM从employee 表中取数据来显示所有记录。

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'SELECT emp_id, emp_name, emp_salary FROM employee';

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    while($row = mysql_fetch_array($retval, MYSQL_NUM))
    {
        echo "EMP ID :{$row[0]}  <br> ".
             "EMP NAME : {$row[1]} <br> ".
             "EMP SALARY : {$row[2]} <br> ".
             "--------------------------------<br>";
    }
    echo "Fetched data successfully\n";
    mysql_close($conn);
    ?>
上述三个例子将产生相同的结果。

释放内存：一个好的习惯是释放游标记忆在每个 SELECT 语句结束时。这可以通过使用 PHP 函数 mysql_free_result() 函数来进行操作。下面的例子显示如何使用。

例子
    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $sql = 'SELECT emp_id, emp_name, emp_salary FROM employee';

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    while($row = mysql_fetch_array($retval, MYSQL_NUM))
    {
        echo "EMP ID :{$row[0]}  <br> ".
             "EMP NAME : {$row[1]} <br> ".
             "EMP SALARY : {$row[2]} <br> ".
             "--------------------------------<br>";
    }
    mysql_free_result($retval);
    echo "Fetched data successfully\n";
    mysql_close($conn);
    ?>
获取数据时您可以编写复杂的 SQL。过程仍将与上面提到的相同。



通过 PHP 使用分页

SQL SELECT 语句查询出的结果可能达到几千的记录总是可能的。但在页面上显示所有结果显然不是一个好主意。所以我们可以把这个结果面按要求分为许多页。在多个页面中分页显示查询结果而不是把它们都放在一个页面中。

使用 MySQL 中的两个参数的限制条款有助于生成分页。

第一个参数偏移量和第二个参数有多少应该从数据库返回的记录。

下面是一个简单的例子对获取记录使用限制条款来生成分页。

例子
尝试以下的例子每页显示 10 个记录。

    <html>
    <head>
    <title>Paging Using PHP</title>
    </head>
    <body>
    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $rec_limit = 10;

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db('test_db');
    /* Get total number of records */
    $sql = "SELECT count(emp_id) FROM employee ";
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    $row = mysql_fetch_array($retval, MYSQL_NUM );
    $rec_count = $row[0];

    if( isset($_GET{'page'} ) )
    {
       $page = $_GET{'page'} + 1;
       $offset = $rec_limit * $page ;
    }
    else
    {
       $page = 0;
       $offset = 0;
    }
    $left_rec = $rec_count - ($page * $rec_limit);

    $sql = "SELECT emp_id, emp_name, emp_salary ".
           "FROM employee ".
           "LIMIT $offset, $rec_limit";

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
    {
        echo "EMP ID :{$row['emp_id']}  <br> ".
             "EMP NAME : {$row['emp_name']} <br> ".
             "EMP SALARY : {$row['emp_salary']} <br> ".
             "--------------------------------<br>";
    } 

    if( $page > 0 )
    {
       $last = $page - 2;
       echo "<a href=\"$_PHP_SELF?page=$last\">Last 10 Records</a> |";
       echo "<a href=\"$_PHP_SELF?page=$page\">Next 10 Records</a>";
    }
    else if( $page == 0 )
    {
       echo "<a href=\"$_PHP_SELF?page=$page\">Next 10 Records</a>";
    }
    else if( $left_rec < $rec_limit )
    {
       $last = $page - 2;
       echo "<a href=\"$_PHP_SELF?page=$last\">Last 10 Records</a>";
    }
    mysql_close($conn);
    ?>



更新数据到 MySQL 数据库中

数据可以通过使用 PHP 函数 mysql_query() 执行 SQL UPDATE 语句将数据更新到 MySQL 表中。

下面是一个简单的例子更新记录到员工表中。更新记录应使用条件条款定位在任何表中的位置。

下面的例子使用主键匹配员工表中的记录。

例子
试试以下的例子可以使您理解更新操作。你需要提供一个 ID 来更新雇员的薪水。

    <html>
    <head>
    <title>Update a Record in MySQL Database</title>
    </head>
    <body>

    <?php
    if(isset($_POST['update']))
    {
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    $emp_id = $_POST['emp_id'];
    $emp_salary = $_POST['emp_salary'];

    $sql = "UPDATE employee ".
           "SET emp_salary = $emp_salary ".
           "WHERE emp_id = $emp_id" ;

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not update data: ' . mysql_error());
    }
    echo "Updated data successfully\n";
    mysql_close($conn);
    }
    else
    {
    ?>
    <form method="post" action="<?php $_PHP_SELF ?>">
    <table width="400" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td width="100">Employee ID</td>
    <td><input name="emp_id" type="text" id="emp_id"></td>
    </tr>
    <tr>
    <td width="100">Employee Salary</td>
    <td><input name="emp_salary" type="text" id="emp_salary"></td>
    </tr>
    <tr>
    <td width="100"> </td>
    <td> </td>
    </tr>
    <tr>
    <td width="100"> </td>
    <td>
    <input name="update" type="submit" id="update" value="Update">
    </td>
    </tr>
    </table>
    </form>
    <?php
    }
    ?>
    </body>
    </html>



从 MySQL 数据库删除数据

可以通过 PHP 函数 mysql_query 执行 SQL DELETE 语句从 MySQL 表中删除数据。

下面是一个简单的例子从 employee 表删除记录。删除记录时使用条件条款应定位在任何表的某个记录。

下面的例子使用主键匹配员工表中的记录。

例子
尝试以下的例子理解删除操作。您需要提供一个雇员 ID 从 employee 表删除一个雇员记录。

    <html>
    <head>
    <title>Delete a Record from MySQL Database</title>
    </head>
    <body>

    <?php
    if(isset($_POST['delete']))
    {
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    $emp_id = $_POST['emp_id'];

    $sql = "DELETE employee ".
           "WHERE emp_id = $emp_id" ;

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not delete data: ' . mysql_error());
    }
    echo "Deleted data successfully\n";
    mysql_close($conn);
    }
    else
    {
    ?>
    <form method="post" action="<?php $_PHP_SELF ?>">
    <table width="400" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td width="100">Employee ID</td>
    <td><input name="emp_id" type="text" id="emp_id"></td>
    </tr>
    <tr>
    <td width="100"> </td>
    <td> </td>
    </tr>
    <tr>
    <td width="100"> </td>
    <td>
    <input name="delete" type="submit" id="delete" value="Delete">
    </td>
    </tr>
    </table>
    </form>
    <?php
    }
    ?>
    </body>
    </html>



使用 PHP 备份 MySQL 数据库

定期备份你的数据库总是一种好的做法。有三种方法可以使用备份你的 MySQL 数据库。

通过 PHP 使用 SQL 命令。
使用 MySQL 二进制通过 PHP mysqldump。
使用 phpMyAdmin 的用户界面。
通过 PHP 使用 SQL 命令
可以执行 SQL SELECT 命令完成任何表的备份。把一个完整的数据库存储您需要为单独的表编写单独的查询。每个表将存储到单独的文本文件中。

例子

试试以下的例子使用 SELECT INTO OUTFILE 查询用于创建表的备份：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $table_name = "employee";
    $backup_file  = "/tmp/employee.sql";
    $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not take data backup: ' . mysql_error());
    }
    echo "Backedup  data successfully\n";
    mysql_close($conn);
    ?>
可能存在实例，当你需要恢复数据备份的前一段时间。恢复备份你只需要运行数据加载 INFILE 查询如下：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }
    $table_name = "employee";
    $backup_file  = "/tmp/employee.sql";
    $sql = "LOAD DATA INFILE '$backup_file' INTO TABLE $table_name";

    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
      die('Could not load data : ' . mysql_error());
    }
    echo "Loaded  data successfully\n";
    mysql_close($conn);
    ?>
使用 MySQL 通过 PHP 二进制 mysqldump
MySQL 提供一个实用程序，mysqldump 执行数据库备份。使用这种二进制您可以在一个命令得到完整的数据库转储。

例子

下面的例子尝试把你完整的数据库转储：

    <?php
    $dbhost = 'localhost:3036';
    $dbuser = 'root';
    $dbpass = 'rootpassword';

    $backup_file = $dbname . date("Y-m-d-H-i-s") . '.gz';
    $command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass ".
               "test_db | gzip > $backup_file";

    system($command);
    ?>
使用 phpMyAdmin 用户界面:
如果你有 phpMyAdmin 用户界面可用，它很容易为你备份你的数据库。

备份您的 MySQL 数据库使用 phpMyAdmin 点击 phpMyAdmin 主页上的“出口”链接。您希望备份数据库，检查适当的 SQL 选项和输入备份文件的名称。

