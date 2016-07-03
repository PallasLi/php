php服务器语言，四种标记
<?php
	printf("1.标准方式<?php ?>\n");
?>
<?
	printf("2.配置 --enable-short-tags 可使用短标签<?  ?>\n");
?>
<script language="PHP">
	printf("3.html风格但仍是服务端脚本<script language=\"PHP\" > </script>\n");
</script>
4.可在php.ini 中配置支持 <%....%>

注释
<?php
  

#dfd
#dfkaf
// 多行注释行尾加;
#adf
/*
   多行注释
   hjh
*/

$i=1+1;
printf($i);#//单行注释


?>
<?php phpinfo(); ?>
<html>

</html>