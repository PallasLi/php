<?php
// chdir();	//改变当前的目录。	4
// chroot();	//改变当前进程的根目录。	4.0.4
// dir();	//打开一个目录句柄，并返回一个对象。	4
// closedir();	//关闭目录句柄。	4
// getcwd();	//返回当前目录。	4
// opendir();	//打开目录句柄。	4
// readdir();	//返回目录句柄中的条目。	4
// rewinddir();	//重置目录句柄。	4
// scandir();	//列出指定路径中的文件和目录。	5
$hasfile=file_exists("/Users/lyt1987/Desktop/GitHub/php/phpStudy/newfile.php");
echo "\n";
echo $hasfile; //判断文件是否存在
echo "\n";
readfile("/Users/lyt1987/Desktop/GitHub/php/phpStudy/newfile.php");//读取文件


// fopen()函数用于打开一个文件。它需要两个参数声明文件名称和操作模式。
// r	打开文件仅供阅读。将指针放到文件的开头。
// r+	打开文件进行阅读和写作。将指针放到文件的开头。
// w	打开文件仅供编写。将指针放到文件的开头。如果文件不存在它将创建一个文件存在。
// w+	打开文件仅供阅读和写作。将指针放到文件的开头。如果文件不存在它将创建一个文件存在。
// a	打开文件仅供编写。将指针放到文件的结尾。如果文件不存在它将创建一个文件存在。
// a+	打开文件仅供阅读和写作。将指针放到文件的结尾。如果文件不存在它将创建一个文件存在。

$filename = "/home/user/guest/tmp.txt";
    $file = fopen( $filename, "r" );
    if( $file == false )
    {
       echo ( "Error in opening file" );
       exit();
    }
    $filesize = filesize( $filename );
    $filetext = fread( $file, $filesize );

    fclose( $file );

    echo ( "File size : $filesize bytes" );
    echo ( "<pre>$filetext</pre>" );




     $filename = "/home/user/guest/newfile.txt";
    $file = fopen( $filename, "w" );
    if( $file == false )
    {
       echo ( "Error in opening new file" );
       exit();
    }
    fwrite( $file, "This is  a simple test\n" );
    fclose( $file );



    if( file_exist( $filename ) )
    {
       $filesize = filesize( $filename );
       $msg = "File  created with name $filename ";
       $msg .= "containing $filesize bytes";
       echo ($msg );
    }
    else
    {
       echo ("File $filename does not exit" );
    }
?>