<?php

$hasfile=file_exists("/Users/lyt1987/Desktop/GitHub/php/phpStudy/newfile.php");
echo "\n";
echo $hasfile; //判断文件是否存在
echo "\n";
readfile("/Users/lyt1987/Desktop/GitHub/php/phpStudy/newfile.php");//读取文件

?>