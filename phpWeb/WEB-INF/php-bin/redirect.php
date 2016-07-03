
<html>
<body>
    <?php include("commons/top.php"); ?>
    <?php
//header()函数提供原始 HTTP headers 到浏览器，可用于重定向到另一个位置。重定向脚本应该在页面的顶端，以防止加载页面的其他部分。
//Location:用来指定目标位置：header()函数使用 url 作为参数。在调用该函数之后使用exit() 函数可以阻止其他代码的解析
  if( $_POST["location"] )
  {
     $location = $_POST["location"];
     header( "Location:$location" );
     exit();
  }
?>
   <p>Choose a site to visit :</p>
   <form action="<?php $_PHP_SELF ?>" method="POST">
   <select name="location">
      <option value="phpinfo.php">
            phpinfo.php
      </option>
      <option value="formTest.php">
            formTest.php
      </option>
   </select>
   <input type="submit" />
   </form>
</body>
</html>