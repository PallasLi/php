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
<?php 
echo  ctype_alnum("a\][fhaf344");	//做字母和数字字符检测	
echo ctype_alpha("alha");	//做纯字符检测	
echo ctype_cntrl("alh");	//做控制字符检测	
echo ctype_digit("43743");	//做纯数字检测	
echo ctype_graph("akfafl alfj");	//做可打印字符串检测，空格除外	
echo ctype_lower("akfhakf");	//做小写字符检测	
echo ctype_print("alfjlaf");	//做可打印字符检测	
echo ctype_punct("alfjal");	//检测可打印的字符是不是不包含空白、数字和字母	
echo ctype_space("ajflaf");	//做空白字符检测	
echo ctype_upper("KJHKK");	//做大写字母检测	
echo ctype_xdigit("ajflaf");	//检测字符串是否只包含十六进制字符	

?>
<html>

</html>

