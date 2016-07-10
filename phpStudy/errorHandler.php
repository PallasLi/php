

错误处理

语法

    error_function(error_level,error_message, error_file,error_line,error_context); 
参数	说明
error_level	必需。为用户定义的错误规定错误报告级别。必须是一个值数。
error_message	必需。为用户定义的错误规定错误消息。
error_file	可选。规定错误在其中发生的文件名。
error_line	可选。规定错误发生的行号。
error_context	可选。规定一个数组，包含了当错误发生时在用的每个变量以及它们的值。
错误报告级别
这些错误报告级别是不同类型的错误可以使用用户定义的错误处理程序。这些值使用|操作符结合使用

值	常量	描述
1	E_ERROR	致命的运行时错误。停止执行脚本
2	E_WARNING	非致命的运行时错误。不暂停脚本执行。
4	E_PARSE	编译时解析错误。解析错误只能由解析器生成。
8	E_NOTICE	运行时通知。脚本发现可能有错误发生，但也可能在脚本正常运行时发生。
16	E_CORE_ERROR	致命的错误发生在PHP的初始启动。
32	E_CORE_WARNING	非致命的运行时错误。这发生在PHP的初始启动。
256	E_USER_ERROR	致命的用户生成的错误。这类似于程序员使用 PHP 函数 trigger_error() 设置的 E_ERROR。
512	E_USER_WARNING	非致命的用户生成的警告。这类似于程序员使用 PHP 函数 trigger_error() 设置的 E_WARNING。
1024	E_USER_NOTICE	用户生成的通知。这类似于程序员使用 PHP 函数 trigger_error() 设置的 E_NOTICE。
2048	E_STRICT	运行时通知。启用PHP建议修改您的代码将确保代码的最好的互操作性和兼容性。
4096	E_RECOVERABLE_ERROR	可捕获的致命错误。类似 E_ERROR，但可被用户定义的处理程序捕获。(参见 set_error_handler())
8191	E_ALL	所有错误和警告，除级别 E_STRICT 以外。（在 PHP 6.0，E_STRICT 是 E_ALL 的一部分）
所有上述错误级别可以使用 PHP 内置库函数设置表中定义的任意值。级别是任何水平高于表中定义的值。

    int error_reporting ( [int $level] )
下面是你可以创建一个错误处理功能函数：

    <?php
    function handleError($errno, $errstr,$error_file,$error_line)
    { 
     echo "<b>Error:</b> [$errno] $errstr - $error_file:$error_line";
     echo "<br />";
     echo "Terminating PHP Script";
     die();
    }
    ?>
你一旦定义自定义错误处理程序，您需要使用 PHP 内置库 set_error_handler 函数来设置它。现在让我们通过调用一个不存在的函数来检查我们的示例：

    <?php
    error_reporting( E_ERROR );
    function handleError($errno, $errstr,$error_file,$error_line)
    {
     echo "<b>Error:</b> [$errno] $errstr - $error_file:$error_line";
     echo "<br />";
     echo "Terminating PHP Script";
     die();
    }
    //set error handler
    set_error_handler("handleError");

    //trigger error
    myFunction();
    ?>
异常处理
PHP 5 提供了一种新的面向对象的错误处理方法。异常处理非常重要，它提供了一个更好的控制错误处理机制。

让我们解释这些新关键字相关的异常。

Try - 使用异常的函数应该位于 "try" 代码块内。如果没有触发异常，则代码将照常继续执行。但是如果异常被触发，会抛出一个异常。
Throw - 这里规定如何触发异常。每一个 "throw" 必须对应至少一个 "catch"。
Catch - "catch" 代码块会捕获异常，并创建一个包含异常信息的对象。
当将抛出一个异常，代码语句不会被执行后，和 PHP 将试图找到第一个匹配的 catch 代码块。如果没有捕获到异常，PHP 将会发布一个致命的错误“未捕获异常……”。

需要进行异常处理的代码应该放入 try 代码块内，以便捕获潜在的异常。
每个 try 或 throw 代码块必须至少拥有一个对应的 catch 代码块。
使用多个 catch 代码块可以捕获不同种类的异常。
异常可以在 try 代码块内的 catch 代码块中再次抛出（re-thrown）异常。
实例

下面是一段代码，复制并粘贴这段代码到一个文件中并验证结果。

    <?php
    try {
        $error = 'Always throw this error';
        throw new Exception($error);

        // Code following an exception is not executed.
        echo 'Never executed';

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    // Continue execution
    echo 'Hello World';
    ?>
在上面的例子中使用 $ e - > getMessage函数得到错误消息。在使用异常类时有以下功能函数可以使用：

getMessage()- 得到异常的消息
getCode() – 异常的代码块
getFile() – 异常的源文件名称
getLine() – 异常的文件行号
getTrace() – 追踪机制
getTraceAsString() – 格式化追踪的字符串
创建自定义异常处理程序

你可以创建自定义异常处理程序。使用以下函数来设置一个用户自定义的异常处理程序函数。

    string set_exception_handler ( callback $exception_handler ) 
这里未捕获的异常发生时调用名称被称为 exception_handler 函数。必须定义此函数之前调用set_exception_handler()。

例子：

    <?php
    function exception_handler($exception) {
      echo "Uncaught exception: " , $exception->getMessage(), "\n";
    }

    set_exception_handler('exception_handler');

    throw new Exception('Uncaught Exception');

    echo "Not Executed\n";
    ?>




错误调试

项目程序第一次运行时很少有正常工作的。很多程序触发 PHP 错误机制并且产生相应的错误消息。你可以决定这些错误消息在那里被触发，也可以将错误消息连同其他程序输出到 web 浏览器页面。也可以包括在 web 服务器错误日志里。

为了使错误信息显示在浏览器中,您需要设置配置文件 display_errors 配置指令为 on (打开模式)。将错误发送到 web 服务器错误日志中，log_errors 设置为 on。如果你想在这两个地方都得到错误消息，你可以配置配置文件都为 on。

PHP 为 error_reporting 设置定义了一些常量可以使用，某些类型的错误会被报道：E_ALL(所有错误严格通知除外)，E_PARSE(解析错误)，E_ERROR(致命错误)，E_WARNING(警告)，E_NOTICE(提示)和E_STRICT (严格的通知)。　　

编写 PHP 程序，使用 PHP-aware BBEdit 和 Emacs 的编辑器是一个好主意。这些编辑器的共同特点之一就是语法高亮显示。你改变你的程序的不同部分，颜色基于这些部分会随之而改变。例如，字符串是粉红色的，关键词等是蓝色的，评论都是灰色的，变量是黑色的。

另外一个特性是引用要和括号匹配，这有助于确保你的引用和括号是成套配对的。当你输入一个关闭分隔符}时编辑器会自动提示开放{匹配。

有以下几点需要被应用当你调试您的程序时：

缺少分号——每个 PHP 语句必须以分号(;)结束。PHP 不会停止执行程序阅读，直到执行到一个分号。如果你离开一行的以分号结束时，PHP 程序会继续向下执行程序。
值不等价——当你对两个值是做比较的时，你需要使用两个等号(==)。使用一个等号是一种常见的错误。
敲错变量名称——如果你拼错变量名称，然后 PHP 会把它作为一个刚声明的变量来使用。记住：PHP，变量是去区分大小写的。
$ 符号—— 一个 $ 符号由于粗心忘记写了这时很难发现，但至少它通常会导致一个错误消息，你会通过这个错误提示知道去哪里找问题。
引用的问题—— 你或多或少存在错误引用的问题。所以检查平衡数量的引用。
遗忘的括号和花括号——他们应该总是成对。
数组索引——所有数组应该开始从 0，而不是 1。
尽管如此，妥善处理所有的错误信息和直接到系统日志文件中跟踪消息，这样如果发生任何错误，那么它将被记录到系统日志文件，你将很快找到并能够调试这个问题。








PHP Error 和 Logging 函数

这些都是处理错误处理和日志记录的函数。它们允许您定义自己的错误处理规则,以及可以修改错误记录的方式。这允许你改变和提高错误报告来满足您的需求。 　　　 使用这些日志记录功能,你可以直接发送消息到其他机器，电子邮件，系统日志，等等；所以你可以有选择地记录和监控您的应用程序和网站的最重要的部分。

安装
error 和 logging 函数是 PHP 核心的组成部分。无需安装即可使用这些函数。

运行时配置
在php.ini中设置会影响这些函数的行为。这些设置定义如下

名称	默认值	可改变的	变更日志
error_reporting	NULL	PHP_INI_ALL	 
display_errors	"1"	PHP_INI_ALL	 
display_startup_errors	"0"	PHP_INI_ALL	版本PHP 4.0.3之后可用
log_errors	"0"	PHP_INI_ALL	 
log_errors_max_len	"1024"	PHP_INI_ALL	版本PHP 4. 3.0之后可用
ignore_repeated_errors	"0"	PHP_INI_ALL	版本PHP 4. 3.0之后可用
ignore_repeated_source	"0"	PHP_INI_ALL	版本PHP 4. 3.0之后可用
report_memleaks	"1"	PHP_INI_ALL	版本PHP 4. 3.0之后可用
track_errors	"0"	PHP_INI_ALL	 
html_errors	"1"	PHP_INI_ALL	PHP_INI_SYSTEM in PHP
docref_root	""	PHP_INI_ALL	版本PHP 4. 3.0之后可用
docref_ext	""	PHP_INI_ALL	版本PHP 4. 3.0之后可用
error_prepend_string	NULL	PHP_INI_ALL	 
error_append_string	NULL	PHP_INI_ALL	 
error_log	NULL	PHP_INI_ALL	 
warn_plus_overloading	NULL	 	版本PHP 4. 0.0不可用
PHP Error 和 Logging 常数
PHP：表明最早版本的PHP支持常数。您可以使用任何常数当你配置了php.ini文件。

值	常量	描述	PHP
1	E_ERROR	致命的运行时错误。错误无法恢复。脚本的执行被中断。	 
2	E_WARNING	非致命的运行时错误。脚本的执行不会中断。	 
4	E_PARSE	编译时语法解析错误。解析错误只应该由解析器生成。	 
8	E_NOTICE	运行时提示。可能是错误，也可能在正常运行脚本时发生。	 
16	E_CORE_ERROR	由 PHP 内部生成的错误。	4
32	E_CORE_WARNING	由 PHP 内部生成的警告。	4
64	E_COMPILE_ERROR	由 Zend 脚本引擎内部生成的错误。	4
128	E_COMPILE_WARNING	由 Zend 脚本引擎内部生成的警告。	4
256	E_USER_ERROR	由于调用 trigger_error() 函数生成的运行时错误。	4
512	E_USER_WARNING	由于调用 trigger_error() 函数生成的运行时警告。	4
1024	E_USER_NOTICE	由于调用 trigger_error() 函数生成的运行时提示。	4
2048	E_STRICT	运行时提示。对增强代码的互用性和兼容性有益。	5
4096	E_RECOVERABLE_ERROR	可捕获的致命错误。（参阅 set_error_handler()）	5
8191	E_ALL	所有的错误和警告，除了 E_STRICT。	5
函数列表
PHP：指示支持该常量的最早的 PHP 版本。

函数	说明	PHP
debug_backtrace()	生成 backtrace。	4
debug_print_backtrace()	输出 backtrace。	5
error_get_last()	获得最后发生的错误。	5
error_log()	向服务器错误记录、文件或远程目标发送一个错误。	4
error_reporting()	规定报告哪个错误。	4
restore_error_handler()	恢复之前的错误处理程序。	4
restore_exception_handler()	恢复之前的异常处理程序。	5
set_error_handler()	设置用户自定义的错误处理函数。	4
set_exception_handler()	设置用户自定义的异常处理函数。	5
trigger_error()	创建用户自定义的错误消息。/td>	4
user_error()	trigger_error() 的别名。	4
