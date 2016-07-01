

正则表达式

　　 正则表达式(regular expression) 只不过是一种字符串匹配的模式，它提供了模式匹配功能的基础。

使用正则表达式可以在一个字符串中搜索一个特定的字符串，你可以在一个字符串中换取另一个字符串，当然你也可以将一个字符串分割成很多块。

PHP 提供了两组针对正则表达式的函数，每一个函数对应于一种特定的正则表达式。基于你的需求，您可以使用任何该函数：

POSIX 正则表达式　
PERL 风格正则表达式
POSIX 正则表达式
POSIX 正则表达式的结构并没有什么不同的典型的算术表达式：它是由各种元素(运算符)相结合并形成更复杂的正则表达式。 　 最简单的正则表达式就是匹配一个字符，例如 g，在 gg，haggle 或者 bag 等字符串内部。

让我们可以先给一些解释性的概念介绍怎么使用 POSIX 正则表达式。之后,我们将介绍这个正则表达式相关功能。

括号

方括号([])是具有特殊意义的在上下文中使用的正则表达式。他们是用来发现一系列字符。

正则表达式	描述
[0-9]	匹配任意一个数字从0到9
[a-z]	匹配所有的小写字母从a到z
[A-Z]	匹配所有的大写字母从A到Z
[a-Z]	匹配所有的字母从a到Z
上面所示的范围是大致范围;您还可以使用范围[0 – 3]匹配任何十进制数字从0到3的任意一个十进制数字,或范围[b-v]来匹配任何小写字符从字符 b 到字符 v。

量词　

　　　 括起来的字符序列的频率或位置和单个字符都可以用来表示一个特殊的角色。每个特殊字符都有一个特定的隐含意义。+, *, ?, {int. range}和$ flag都遵循一个字符序列。

正则表达式	描述
p+	匹配P的子表达式一次或多次。
p*	它匹配包含零个或多个p的任何字符串。
p?	它匹配包含零个或多个p的任何字符串。这只是另一种方式使用p *。
p{N}	它匹配N个 p的任何字符串
p{2,3}	它匹配包含一个序列的两个p或三个p任何字符串。
p{2, }	它匹配包含至少两个p的序列的任何字符串。
p$	它匹配任何以p结尾的字符串。
^p	它匹配任何以p开头的字符串。
例子

下面的例子将会帮助你梳理你的匹配字符的概念。

正则表达式	说明
[^a-zA-Z]	它匹配任何不包含从a到z、A到Z的字符的字符串。
p.p	它匹配任何包含p的字符串,其次是任何字符,紧随其后的是另一个p。
^.{2}$	它匹配任何包含两个字符的字符串。
<b>(.*)</b>	它匹配任何封闭在和之间的字符串。
p(hp)*	它匹配任何包含一个字符p紧随其后的零个或多个字符hp的字符串.
预定义的字符序列　　　　

为了你编程的方便，预定义了一些可用的字符集,也被称为字符类。字符类是指定一个完整的范围内的字符,例如,字母或一组整数:

正则表达式	说明
[[:alpha:]]	它匹配任何包含字母字符从字符aA 到字符zZ 的字符串。
[[:digit:]]	它匹配任何包含数值数字0到9的字符串。
[[:alnum:]]	它匹配任何包含字母字符从字符aA 到字符zZ 和数字0到9的字符串。
[[:space:]]	它匹配任何包含一个空格的字符串。
php 的 posix 正则表达式函数
PHP 目前提供了七个使用 POSIX-style 来搜索字符串的正则表达式函数:

正则表达式	说明
ereg()	函数用指定的模式来搜索指定的字符串中的字符串,成功返回true, ,否则,则返回false。
ereg_replace()	本函数以 pattern 的规则来解析比对字符串 string，欲取而代之的字符串为参数 replacement。返回值为字符串类型，为取代后的字符串结果。
eregi()	函数用指定的模式来搜索指定的字符串中的字符串。搜索不区分大小写。
eregi_replace()	本函数和 ereg_replace() 类似，用法也相同。不同之处在于 ereg_replace() 有区分大小写，本函数与大小写无关。
split()	函数返回一个字符串数组，每个单元为$string经正则表达式$pattern作为边界分割出的子串。
spliti()	本函数和 split() 类似，用法也相同。不同之处在于 split()有区分大小写，本函数与大小写无关
sql_regcase()	sql_regcase()函数可以被认为是一个效用函数, 返回的表达式是将 string 中的每个字母字符转换为方括号表达式，该方括号表达式包含了该字母的大小写形式。
PERL 风格正则表达式
　　　　 Perl-style 正则表达式类似于 POSIX 正则表达式。POSIX 语法与 Perl-style 正则表达式函数语法相似几乎可以互换。事实上,您可以使用任何前面的 POSIX 小节中介绍的量词。　　

让我们可以给一些概念解释被用于 PERL 的正则表达式。之后，我们将介绍这个正则表达式相关功能。

元字符

元字符只是一个字母字符，在元字符之前加入一个反斜杠，给组合特别的意义。

例如,您可以使用“\d”元字符：/([\d]+)000/搜索大量资金总额，这里 \d 将在任何的字符串中寻找数值字符。

下面是元字符的列表，可以使用 PERL 风格的正则表达式。

    字符            说明
    .       一个字符
    \s：    用于匹配单个空格符，包括tab键和换行符；
    \S：    用于匹配除单个空格符之外的所有字符；
    \d：    用于匹配从0到9的数字；
    \D：    用于匹配没有数字的所有字符；
    \w：    用于匹配字母，数字或下划线字符(a-z, A-Z, 0-9, _)；
    \W：    用于匹配所有与\w不匹配的字符；
    [aeiou]        在给定的集合内匹配一个字符
    [^aeiou]       在给定的集合外匹配一个字符
    (foo|bar|baz)  匹配任何指定的备选方案
修饰符

使用几个 regexp 修饰符，它能使你的工作更容易，比如字母大小写敏感性、搜索多个行等等。

    修饰符 说明
    i 在和正则匹配是不区分大小写 
    m 将字符串视为多行。默认的正则开始“^”和结束“$”将目标字条串作为一单一的一“行”字符（甚至其中包括换行符也是如此）。如果在修饰符中加上“m”，那么开始和结束将会指点字符串的每一行的开头就是“^”结束就是“$”。 
    o   评估表达式只有一次
    s 如果设定了这个修正符，那么，被匹配的字符串将视为一行来看，包括换行符，换行符将被视为普通字符串。 
    x 忽略空白，除非进行转义的不被忽略。 
    g   在全局范围内找到所有匹配
    cg  即使全局匹配失败也允许搜索继续
PHP 的 Regexp PERL 兼容函数
PHP 提供了以下函数使用 perl 的正则表达式来搜索字符串

函数	说明
preg-match()	执行一个正则表达式匹配，成功返回 true，否则返回 false。
preg_match_all()	执行一个全局正则表达式匹配
preg_replace()	使用 preg_replace() 函数和使用函数 ereg_replace()类似,除了可以使用正则 表达式的模式和替换外还可以输入参数
preg_split()	使用 preg_split() 函数和使用函数 split() 类似,除此之外还接受正则表达式模式作为输入的参数
preg_grep()	preg_grep() 函数搜索 input_array 的所有元素,返回所有匹配正则表达式模式的元素。
preg_ quote()	引用正则表达式字符



PHP 函数 ereg()

语法
    int ereg(string pattern, string originalstring, [array regs]);
定义和用途
ereg()函数用指定的模式搜索一个字符串中指定的字符串,如果匹配成功返回true,否则,则返回false。搜索字母的字符是大小写敏感的。

可选的输入参数规则包含一个数组的所有匹配表达式,他们被正则表达式的括号分组。

Return Value
如果匹配成功返回true,否则,则返回false

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $email_id = "admin@tutorialspoint.com";
    $retval = ereg("(\.)(com$)", $email_id);
    if( $retval == true )
    {
       echo "Found a .com<br>";
    }
    else
    {
       echo "Could not found a .com<br>";
    }
    $retval = ereg(("(\.)(com$)"), $email_id, $regs);
    if( $retval == true )
    {
       echo "Found a .com and reg = ". $regs[0];
    }
    else
    {
       echo "Could not found a .com";
    }
    ?>
这将会产生以下结果：

    Found a .com
    Found a .com and reg = .com



PHP 函数 ereg_replace()

语法
    string ereg_replace (string pattern, string replacement, string originalstring);
定义和用法　　
ereg_replace()函数搜索字符串指定的模式和如果发现模式则取代和替换。ereg_replace()函数就像ereg()函数运行方式,除了功能扩展到查找和替换模式而不是简单地定位。　　　　

像ereg(),ereg_replace()是区分大小写的。

返回值
替换发生后,将返回修改后的字符串。
如果没有找到匹配的字符串将保持不变。
例子
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $copy_date = "Copyright 1999";
    $copy_date = ereg_replace("([0-9]+)", "2000", $copy_date);
    print $copy_date;

    ?>    
这将会产生以下结果：

    Copyright 2000



PHP 函数 eregi()

语法
    int eregi(string pattern, string string, [array regs]);
定义和用法
eregi()函数在一个字符串搜索指定的模式的字符串。搜索不区分大小写。Eregi()可以特别有用的检查有效性字符串,如密码。　

可选的输入参数规则包含一个数组的所有匹配表达式,他们被正则表达式的括号分组。

返回值
如果匹配成功返回true,否则,则返回false

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $password = "abc";
    if (! eregi ("[[:alnum:]]{8,10}", $password))
    {
       print "Invalid password! Passwords must be from 8 - 10 chars";
    }
    else
    {
      print "Valid password";
    }
    ?>
这将会产生以下结果：

    Invalid password! Passwords must be from 8 - 10 chars



PHP 函数 eregi_replace()

语法
    string eregi_replace (string pattern, string replacement, string originalstring);
定义和用法　　　
eregi_replace()函数的运作就像函数ereg_replace(),除了搜索模式字符串是不区分大小写的。　　

返回值
替换发生后,将返回修改后的字符串。
如果没有找到匹配的字符串将保持不变。
例子
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $copy_date = "Copyright 2000";
    $copy_date = eregi_replace("([a-z]+)", "&Copy;", $copy_date);
    print $copy_date;

    ?>    
这将会产生以下结果：

    © 2000


PHP 函数 split()

函数
    array split (string pattern, string string [, int limit])
定义和用法
返回一个字符串数组，每个单元为 string 经区分大小写的正则表达式 pattern 作为边界分割出的子串。如果设定了 limit，则返回的数组最多包含 limit 个单元，而其中最后一个单元包含了 string 中剩余的所有部分。如果出错，则 split() 返回 FALSE。 　　　

在这种情况下,模式是一个字母字符,split()函数是区分大小写的。

返回值
返回分割一个字符串后的一个字符串数组。

例子
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $ip = "123.456.789.000"; // some IP address
    $iparr = split ("\.", $ip); 
    print "$iparr[0] <br />";
    print "$iparr[1] <br />" ;
    print "$iparr[2] <br />"  ;
    print "$iparr[3] <br />"  ;

    ?>   
这将会产生以下结果：

    123
    456
    789
    000



PHP 函数 spliti()

函数
    array spliti (string pattern, string string [, int limit])
定义和用法
spliti()函数与成员函数split()有完全相同的操作方式,但它不是大小写敏感的。区分大小写字符一个问题只有当模式是按字母顺序排列。对于所有其他字符,spliti()完全按split()操作。

返回值
返回分割一个字符串后的一个字符串数组。

例子
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $ip = "123.456.789.000"; // some IP address
    $iparr = spliti ("\.", $ip, 3); 
    print "$iparr[0] <br />";
    print "$iparr[1] <br />" ;
    print "$iparr[2] <br />"  ;
    print "$iparr[3] <br />"  ;

    ?>
这将会产生以下结果：

    123
    456
    789
    000



PHP 函数 sql_regcase()

语法
    string sql_regcase (string string)
定义和用法
sql_regcase()函数可以被认为是一个效用函数,返回与 string 相匹配的正则表达式，不论大小写字母。返回的表达式是将 string 中的每个字母字符转换为方括号表达式，该方括号表达式包含了该字母的大小写形式。其它字符保留不变。

如果字母字符大写和小写格式,支架将包含两种形式;否则原始字符会重复两次。

返回值
返回与 string相匹配的正则表达式。

例子
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $version = "php 4.0";
    print sql_regcase($version);

    ?>
这将会产生以下结果：

    [Pp][Hh][Pp] 4.0




PHP 函数 preg_match()

语法
    int preg_match (string pattern, string string [, array pattern_array],
                                  [, int $flags [, int $offset]]]);
定义和用法
rnate place from which to start the search. preg_match()函数搜索字符串模式,如果模式存在,返回true,否则,则返回false。　　　　

如果提供了可选的input参数pattern_array,如果适用的话,那么pattern_array将包含子模式搜索模式的各个部分。　　　　

如果这个flag作为PREG_OFFSET_CAPTURE传递,每发生匹配字符串附属物字符串偏移量也会被返回。

通常,搜索从主题字符串开始。可选参数偏移量可以被用来指定替代从这里去搜索。

返回值
如果匹配成功,返回true,否则,则返回false。

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $line = "Vi is the greatest word processor ever created!";
    // perform a case-Insensitive search for the word "Vi"
    if (preg_match("/\bVi\b/i", $line, $match)) :
      print "Match found!";
    endif;

    ?>
这将会产生以下结果：

    Match found!


PHP 函数 preg_match_all()

语法
    int preg_match_all (string pattern, string string, array pattern_array [, int order]);
定义和用法
preg_match_all()函数匹配字符串中出现的所有模式。　　　　

它将这些匹配数组pattern_array您指定的顺序使用可选的输入参数。可能有两种类型的顺序:

－ PREG_PATTERN_ORDER 结果排序为$matches[0]保存完整模式的所有匹配, $matches[1] 保存第一个子组的所有匹配，以此类推。 pattern_array[0]是一个数组的所有完整的模式匹配,pattern_array美元[1]是一个数组的所有字符串匹配第一个括号的regexp,等等。　　

－ PREG_SET_ORDER 结果排序为$matches[0]包含第一次匹配得到的所有匹配(包含子组)， $matches[1]是包含第二次匹配到的所有匹配(包含子组)的数组，以此类推。

返回值
返回完整匹配次数。

例子
下面是一段代码,将这段代码复制并粘贴到一个文件中并验证结果。

    (.*)/U", $userinfo, $pat_array);
    print $pat_array[0][0]."  ".$pat_array[0][1]."n";

    ?>
这将产生以下结果。

    John Poul
    PHP Guru



PHP 函数 preg_replace()

语法
   mixed preg_replace (mixed pattern, mixed replacement, mixed string [, int limit [, int &$count]] );
定义和用法
　　 preg_replace()函数就像POSIX中的函数ereg_replace(),除了可以使用正则表达式的匹配模式和替换input参数。　　　　 可选的输入参数limit指定有多少匹配应该发生。　　　　 如果可选参数$count传递这个变量就会填充替代品的数量。

返回值
替换发生后,将返回修改后的字符串。　　　　　　

如果没有找到匹配的，字符串将保持不变。

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php
    $copy_date = "Copyright 1999";
    $copy_date = preg_replace("([0-9]+)", "2000", $copy_date);
    print $copy_date;
    ?>
这将会产生以下结果：

    Copyright 2000


PHP 函数 preg_split()

语法
  array preg_split (string pattern, string string [, int limit [, int flags]]);
定义和用法
preg_split()函数操作和函数split()一模一样,除了正则表达式接受input参数作为匹配的元素。　如果指定，将限制分隔得到的子串最多只有limit个，返回的最后一个 子串将包含所有剩余部分。flags可以任意组合的下列flags: 　　　 PREG_SPLIT_NO_EMPTY 如果这个标记被设置， preg_split() 将进返回分隔后的非空部分。 PREG_SPLIT_DELIM_CAPTURE 如果这个标记设置了，用于分隔的模式中的括号表达式将被捕获并返回。 PREG_SPLIT_OFFSET_CAPTURE 如果这个标记被设置, 对于每一个出现的匹配返回时将会附加字符串偏移量. 注意：这将会改变返回数组中的每一个元素, 使其每个元素成为一个由第0 个元素为分隔后的子串，第1个元素为该子串在subject 中的偏移量组成的数组。

返回值
返回一个使用 pattern 边界分隔 subject 后得到 的子串组成的数组。

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $ip = "123.456.789.000"; // some IP address
    $iparr = split ("/\./", $ip); 
    print "$iparr[0] <br />";
    print "$iparr[1] <br />" ;
    print "$iparr[2] <br />"  ;
    print "$iparr[3] <br />"  ;

    ?>
这将会产生以下结果：

    123
    456
    789
    000 



PHP 函数 preg_grep()

语法
  array preg_grep ( string $pattern, array $input [, int $flags] );
定义和用法
返回给定数组input中与模式pattern 匹配的元素组成的数组.如果将flag设置为PREG_GREP_INVERT, 这个函数返回输入数组中与 给定模式pattern不匹配的元素组成的数组.

返回值
返回给定数组input中与模式pattern 匹配的元素组成的数组.

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $foods = array("pasta", "steak", "fish", "potatoes");
    // find elements beginning with "p", followed by one or more letters.
    $p_foods = preg_grep("/p(\w+)/", $foods);
    print "Found food is " . $p_foods[0];
    print "Found food is " . $p_foods[1];

    ?>
这将会产生以下结果：

    Found food is pasta
    Found food is potatoes



PHP 函数 preg_quote()

语法
string preg_quote ( string $str [, string $delimiter] );
定义和用法
preg_quote()需要参数 str 并向其中 每个正则表达式语法中的字符前增加一个反斜线。

返回值
返回引用的字符串。

Example
下面是一段代码,这段代码复制并粘贴到一个文件中并验证结果。

    <?php

    $keywords = '$40 for a g3/400';
    $keywords = preg_quote($keywords, '/');
    echo $keywords;

    ?>
这将会产生以下结果：

    \$40 for a g3\/400
