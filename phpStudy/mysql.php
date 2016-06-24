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