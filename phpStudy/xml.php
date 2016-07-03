

XML

XML 是一种扩展标记语言，看起来很像 HTML。XML 文档是纯文本，包含分隔符<和>标签。XML 和 HTML 之间有两大不同：

XML 不用定义一组特定的标签来作为规范来使用。
XML 文档结构非常严谨。
使用 XML 比 HTML 更自由更随意。HTML 有一组特定的标记：<a> </a>标记来定义一个链接，<p> 标签表示开始一段等等。然而，XML 文档可以使用任何你想要的标签。把<rating> </rating>可以用来标记电影，<height></height>可以用来标记某人的高度。因此 XML 给你选择自己想要的标签。

XML 文档结构时要求很严格。HTML 让你松弛有度的打开和关闭标签。但这并不是 XML 的情况。

HTML 列表不是有效的 XML
    <ul>
    <li>Braised Sea Cucumber
    <li>Baked Giblets with Salt
    <li>Abalone with Marrow and Duck Feet
    </ul>
这不是一个有效的 XML 文档，因为没有关闭标签 </li>来匹配的三个打开的 <li> 标签。XML 文档中的每个打开标签都必须关闭标签相匹配。

解析一个 XML 文档
PHP 5 的新增加的 SimpleXML 模块使得解析 XML 文档更加简单方便。它将 XML 文档转换为一个对象，提供结构化访问 XML。

从 XML 文档中创建一个 SimpleXML 对象将其存储在一个字符串中，然后将字符串传递给 smplexml_load_string() 函数。它会返回一个 SimpleXML 对象。

例子
运行以下事例：

    <?php

    $channel =<<<_XML_
    <channel>
    <title>What's For Dinner<title>
    <link>http://menu.example.com/<link>
    <description>Choose what to eat tonight.</description>
    </channel>
    _XML_;

    $xml = simplexml_load_string($channel);
    print "The $xml->title channel is available at $xml->link. ";
    print "The description is \"$xml->description\"";
    ?>
它将会产生以下结果：

    The What's For Dinner channel is available at http://menu.example.com/. The description is "Choose what to eat tonight." 
注意: 如果你有一个 XML 内容文件您可以使用函数 simplexml_load_file(filename)。

为了更详细的了解 XML 解析函数请察看 PHP 函数。

XML 文档的生成
SimpleXML 解析现有 XML 文档非常快，但你不能用它来创建一个新的 xml 文档。

最简单的生成一个 XML 文档的方法是建立一个 PHP 数组来影射 XML 的结构，然后遍历该数组，打印每个元素与适当的格式。

例子

运行以下实例：

    <?php

    $channel = array('title' => "What's For Dinner",
                     'link' => 'http://menu.example.com/',
                     'description' => 'Choose what to eat tonight.');
    print "<channel>\n";
    foreach ($channel as $element => $content) {
       print " <$element>";
       print htmlentities($content);
       print "</$element>\n";
    }
    print "</channel>";
    ?>
上述代码将会产生以下结果：

    <channel>
    <title>What's For Dinner</title>
    <link>http://menu.example.com/</link>
    <description>Choose what to eat tonight.</description>
    </channel></html>


