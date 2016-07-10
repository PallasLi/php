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


    bool mysql_query( sql, connection );
参数  说明
sql 必填-----用 SQL语句，执行各种数据库和表的增删改查
connection  可选的，如果没有指定，那么最后只连接到 mysql_connect 将被使用。

用 PHP 创建 MySQL 数据库

    <?php
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
    bool mysql_select_db( db_name, connection );
参数  说明
db_name 必填-----选择数据库名称
connection  可选的，如果没有指定，那么最后只连接到 mysql_connect 将被使用。

在当数据插入之前它的最佳实践是使用功能 get_magic_quotes_gpc()来查看当前魔法配置引号函数是否已经设置。如果这个函数返回 false，那么请使用函数 addslashes() 在引号之前添加斜杠。

    <?php
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
    
    ?>
    


使用 PHP 从数据库取数据


    <?php
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
    ?>
上述三个例子将产生相同的结果。

释放内存：一个好的习惯是释放游标记忆在每个 SELECT 语句结束时。这可以通过使用 PHP 函数 mysql_free_result() 函数来进行操作。下面的例子显示如何使用。

例子
    <?php
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
    ?>
获取数据时您可以编写复杂的 SQL。过程仍将与上面提到的相同。



通过 PHP 使用分页

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



使用 PHP 备份 MySQL 数据库

试试以下的例子使用 SELECT INTO OUTFILE 查询用于创建表的备份：
    <?php
    $table_name = "employee";
    $backup_file  = "/tmp/employee.sql";
    $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    ?>
可能存在实例，当你需要恢复数据备份的前一段时间。恢复备份你只需要运行数据加载 INFILE 查询如下：
    <?php
    $table_name = "employee";
    $backup_file  = "/tmp/employee.sql";
    $sql = "LOAD DATA INFILE '$backup_file' INTO TABLE $table_name";
    mysql_select_db('test_db');
    $retval = mysql_query( $sql, $conn );
    ?>

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
