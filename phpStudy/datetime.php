<?php

/*
checkdate($month, $day, $year)验证日期/时间有效性
date_default_timezone_get()取得时区
date_default_timezone_set($timezone_identifier)设置时区
date($format)日期格式化
getdate()获取日期/时间信息
gettimeofday()获取当前时间
localtime()获取本地时间
microtime()返回当前时间戳和微秒数
mktime()取得一个Unix时间戳
strtotime($time)字符串转Unix时间戳
time()返回当前时间戳



格式化含义：
Y 四位年 y两位 F英文月份 M英文简拼月份 m两位月份 d两位日 j自然日加S为英文日缩写
g 12小时制 无前导0 h 12小时制 两位  G H 24小时 a/A am/pm(AM/PM) i 分  s 秒  
L 是否闰年  I 星期  D 星期缩写  w W 星期数字1位2位的区别  t 本月天数 z 所在年的第几天
T 服务区的时间区域 I 是否夏令营 U 自70年的总秒数 c iso8601日期   r RFC822日期
*/
echo date("Y-m-j");
echo "\n";
echo date("y-n-j");
echo "\n";
echo date("Y-M-j");
echo "\n";
echo date("Y-m-d");
echo "\n";
echo date("Y-F-jS");
echo "\n";
echo date("g:i:s a");
echo "\n";
echo date("h:i:s A");
echo "\n";
echo date("G:i:s");
echo "\n";
echo date("L");
echo "\n";
echo date("I");
echo "\n";
echo date("D");
echo "\n";
echo date("T");
echo "\n";
echo date("t");
echo "\n";
echo date("W");
echo "\n";
echo date("z");
echo "\n";
echo date("c");
echo "\n";
echo date("r");
echo "\n";
echo date("U");
echo "\n";

?>


日期和时间

日期是的日常生活中常见一部分,就容易不假思索地与时间想在一起。PHP 还提供了强大的工具函数来简化操作日期的时间计算.

用 time() 函数得到时间戳
PHP 的 time() 函数会返回给你当前的日期和时间，它不需要参数，但会返回一个整数。

time() 函数返回的整数代表自 1970 年 1 月 1 日午夜格林尼治时间到现在经过的秒数。这一刻被称为新纪元时间，之后经过的秒数，被称为一个时间戳。

    <?php
    print time();
    ?>
他将会产生以下结果

    948316201
这是很难理解的。但是 PHP 提供了优秀的工具将一个时间戳转换成人类熟悉的一种形式。

用 getdate（）函数来转换时间戳
获取当前日期 getdate() 函数可以接受一个时间戳，并返回一个关联数组，其中就包含关于日期的信息。如果你省略了时间戳，time() 返回当前的时间戳。

下表列出了函数 getdate() 返回的数组元素中的单元。

    键名               说明                      返回值例子
    "seconds"   秒的数字表示（0 到 59）               20
    "minutes"   分钟的数字表示（0 到 59）              29
    "hours"     小时的数字表示(0 - 23)              22
    "mday"      月份中第几天的数字表示(1 - 31)          11
    "wday"      星期中第几天的数字表示                   4
    "mon"       月份的数字表示(1 - 12)               7
    "year"      4 位数字表示的完整年份(4 digits)      1997
    "yday"      一年中第几天的数字表示( 0 - 365 )      19
    "weekday"   星期几的完整文本表示                 hursday
    "month"     月份的完整文本表示                   January
    0           时间戳                            948370048
现在你已经完全掌握了日期和时间函数。你可以得到任何你想得到的日期和时间格式。

例子
试运行下面的例子

    <?php
    $date_array = getdate();
    foreach ( $date_array as $key => $val )
    {
       print "$key = $val<br />";
    }
    $formated_date  = "Today's date: ";
    $formated_date .= $date_array[mday] . "/";
    $formated_date .= $date_array[mon] . "/";
    $formated_date .= $date_array[year];

    print $formated_date;
    ?>
将会产生以下结果

    seconds = 27
    minutes = 25
    hours = 11
    mday = 12
    wday = 6
    mon = 5
    year = 2007
    yday = 131
    weekday = Saturday
    month = May
    0 = 1178994327
    Today's date: 12/5/2007
用 date() 函数把时间戳转化成日期
date() 函数返回一个格式化字符串代表一个日期。你可以练习大量的转换格式函数操作，date() 函数返回一个字符串。

    date(format,timestamp)
date (格式、时间戳)选择接受一个时间戳作为第二个参数，如果忽落掉第二个参数，那么将会使用当前的时间戳作为参数。

下表列出了一个格式字符串可以包含的代码:

格式	说明	返回值例子
a	小写的上午和下午值	下午
A	大写的上午和下午值	下午
d	月份中的第几天，有前导零的 2 位数字	01 到 31
D	星期中的第几天，文本表示，3 个字母	Mon 到 Sun
j	月份中的第几天，没有前导零	1 到 31
F	月份名称	January 到 December
h	小时，12 小时格式，有前导零	01 到 12
H	小时，24 小时格式，有前导零	00 到 23
g	小时，12 小时格式，没有前导零	1 到 12
G	小时，24 小时格式，没有前导零	0 到 23
i	有前导零的分钟数	00 到 59
j	一月里的天数	20
l	（“L”的小写字母）星期几，完整的文本格式	Sunday 到 Saturday
L	是否为闰年 如果是闰年为	1，否则为 0
m	数字表示的月份，有前导零	01 到 12
M	三个字母缩写表示的月份	Jan 到 Dec
r	RFC 822 格式的日期	例如：Thu, 21 Dec 2000 16:01:07 +0200
n	数字表示的月份，没有前导零	1 到 12
s	秒数，有前导零	00 到 59
U	从新纪元（January 1 1970 00:00:00 GMT）	开始至今的秒数 参见 time()
y	2 位数字表示的年份	例如：99 或 03
Y	4 位数字完整表示的年份	例如：1999 或 2003
z	年份中的第几天	0 到 366
例子
试运行下面的例子：

    <?php
    print date("m/d/y G.i:s<br>", time());
    print "Today is ";
    print date("j of F Y, \a\\t g.i a", time());
    ?>
产生结果如下：

    01/20/00 13.27:55
希望你有很好的理解根据您的需求如何格式化日期和时间。供您参考的所有日期和时间函数的完整列表中给出了 PHP 日期与时间函数。



PHP Calendar 常量
CAL_GREGORIAN	公历	3
CAL_JULIAN	罗马儒略历	3
CAL_JEWISH	犹太历	3
CAL_FRENCH	法国共和历	3
CAL_NUM_CALS	 	3
CAL_DOW_DAYNO	 	3
CAL_DOW_SHORT	 	3
CAL_DOW_LONG	 	3
CAL_MONTH_GREGORIAN_SHORT	 	3
CAL_MONTH_GREGORIAN_LONG	 	3
CAL_MONTH_JULIAN_SHORT	 	3
CAL_MONTH_JULIAN_LONG	 	3
CAL_MONTH_JEWISH	 	3
CAL_MONTH_FRENCH	 	3
CAL_EASTER_DEFAULT	 	4
CAL_EASTER_DEFAULT	 	4
CAL_EASTER_ROMAN	 	4
CAL_EASTER_ALWAYS_GREGORIAN	 	4
CAL_EASTER_ALWAYS_JULIAN	 	4
CAL_JEWISH_ADD_ALAFIM_GERESH	 	5
CAL_JEWISH_ADD_ALAFIM	 	5
CAL_JEWISH_ADD_GERESHAYIM	 	5


cal_days_in_month()	针对指定的年份和日历，返回一个月中的天数。	4
cal_from_jd()	把儒略日计数转换为指定日历的日期。	4
cal_info()	返回有关给定日历的信息。	4
cal_to_jd()	把日期转换为儒略日计数。	4
easter_date()	返回指定年份的复活节午夜的 Unix 时间戳。	3
easter_days()	返回指定年份的复活节与 3 月 21 日之间的天数。	3
FrenchToJD()	将法国共和历法转换成为儒略日计数。	3
GregorianToJD()	将格利高里历法转换成为儒略日计数。	3
JDDayOfWeek()	返回日期在周几。	3
JDMonthName()	返回月的名称。	3
JDToFrench()	把儒略日计数转换为法国共和国历法。	3
JDToGregorian()	把儒略日计数转换为格利高里历法。	3
jdtojewish()	把儒略日计数转换为犹太历法。	3
JDToJulian()	把儒略日计数转换为儒略历。	3
jdtounix()	把儒略日计数转换为 Unix 时间戳。	4
JewishToJD()	把犹太历法转换为儒略日计数。	3
JulianToJD()	把儒略历转换为儒略日计数。	3
unixtojd()	把 Unix 时间戳转换为儒略日计数。	4


Date/Time 配置选项
date.default_latitude	 "31.7667"	规定默认纬度（从 PHP 5 开始可用）。date_sunrise() 和 date_sunset() 使用该选项。	PHP_INI_ALL
date.default_longitude	"35.2333"	规定默认经度（从 PHP 5 开始可用）。date_sunrise() 和 date_sunset() 使用该选项。	PHP_INI_ALL
date.sunrise_zenith	"90.83"	规定日出天顶（从 PHP 5 开始可用）。date_sunrise() 和 date_sunset() 使用该选项。	PHP_INI_ALL
date.sunset_zenith	"90.83"	规定日落天顶（从 PHP 5 开始可用）。date_sunrise() 和 date_sunset() 使用该选项。	PHP_INI_ALL
date.timezone	""	规定默认时区（从 PHP 5.1 开始可用）。	PHP_INI_ALL



PHP Date / Time 函数
checkdate()	验证格利高里日期。	3
date_create()	返回new DateTime()对象	5
date_date_set()	设置日期	5
date_default_timezone_get()	返回默认时区。	5
date_default_timezone_set()	设置默认时区。	5
date_format()	返回根据指定格式进行格式化的日期。	5
date_isodate_set()	设置 ISO 日期。	5
date_modify()	修改时间戳。	5
date_offset_get()	返回时区偏移。	5
date_parse()	返回一个带有指定日期的详细信息的关联数组。	5
date_sun_info()	返回一个包含有关指定日期与地点的日出/日落和黄昏开始/黄昏结束的信息的数组。	5
date_sunrise()	返回给定的日期与地点的日出时间。	5
date_sunset()	返回给定的日期与地点的日落时间。	5
date_time_set()	设置时间。	5
date_timezone_get()	返回给定 DateTime 对象的时区。	5
date_timezone_set()	设置 DateTime 对象的时区。	5
date()	格式化本地时间／日期。	3
getdate()	返回日期／时间信息。	3
gettimeofday()	返回当前时间信息。	3
gmdate()	格式化 GMT/UTC 日期/时间。	3
gmmktime()	取得 GMT 日期的 UNIX 时间戳。	3
gmstrftime()	Formats a GMT/UTC time/date according to locale settings	3
idate()	将本地时间/日期格式化为整数	5
localtime()	返回本地时间。	4
microtime()	返回当前时间的微秒数。	3
mktime()	返回一个日期的 Unix 时间戳。	3
strftime()	根据区域设置格式化本地时间／日期。	3
strptime()	解析由 strftime 生成的日期／时间。	5
strtotime()	将任何英文文本的日期或时间描述解析为 Unix 时间戳。	3
time()	返回当前时间的 Unix 时间戳。	3
timezone_abbreviations_list()	返回包含夏令时、偏移量和时区名称的关联数组。	5
timezone_identifiers_list()	返回带有所有时区标识符的数值数组。	5
timezone_name_from_abbr()	根据时区缩略语返回时区名称。	5
timezone_name_get()	返回时区的名称。	5
timezone_offset_get()	返回相对于 GMT 的时区偏移。	5
timezone_open()	创建一个新的 DateTimeZone 对象。	5
timezone_transitions_get()	返回时区的所有转换。	5
PHP Date / Time 常量
常量	说明
DATE_ATOM	Atom (example: 2005-08-15T16:13:03+0000)
DATE_COOKIE	HTTP Cookies (example: Sun, 14 Aug 2005 16:13:03 UTC)
DATE_ISO8601	ISO-8601 (example: 2005-08-14T16:13:03+0000)
DATE_RFC822	RFC 822 (example: Sun, 14 Aug 2005 16:13:03 UTC)
DATE_RFC850	RFC 850 (example: Sunday, 14-Aug-05 16:13:03 UTC)
DATE_RFC1036	RFC 1036 (example: Sunday, 14-Aug-05 16:13:03 UTC)
DATE_RFC1123	RFC 1123 (example: Sun, 14 Aug 2005 16:13:03 UTC)
DATE_RFC2822	RFC 2822 (Sun, 14 Aug 2005 16:13:03 +0000)
DATE_RSS	RSS (Sun, 14 Aug 2005 16:13:03 UTC)
DATE_W3C	World Wide Web Consortium (example: 2005-08-14T16:13:03+0000)
SUNFUNCS_RET_TIMESTAMP	Timestamp ( Available in 5.1.2 )
SUNFUNCS_RET_STRING	Hours:minutes (example: 08:02) ( Available in 5.1.2 )
SUNFUNCS_RET_DOUBLE	Hours as floating point number (example 8.75)( Available in 5.1.2 )




