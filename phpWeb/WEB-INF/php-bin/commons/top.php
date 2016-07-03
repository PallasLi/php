
<a href="index.php">index</a>-
<a href="cookieTest.php">cookie测试</a>-
<a href="sessionTest.php">session测试</a>-
<a href="formTest.php?name=lyt&age=3">表单测试</a>-
<a href="phpinfo.php">phpinfo</a>-
<a href="home.php">home</a>-
<a href="upload.php">上传</a>-

<form action="redirect.php" method="POST">
	跳转重定向:<input type="text" name="location" />
	<input type="submit" />
</form>

<?php
/**
*  include  include_once   遇到错误生成一个警告，但是脚本会继续执行。
*  require  require_once   遇到错误生成一个致命错误,停止脚本的执行。
**/

?>