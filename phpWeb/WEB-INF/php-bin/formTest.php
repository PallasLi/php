
<html>
<body>
    <?php include("commons/top.php"); ?>
    <?php
	$str = $_SERVER["QUERY_STRING"];  

	print_r($str. "<br />");
	if( $_GET["name"] || $_GET["age"] )
      {
         echo "_GET Welcome ". $_GET['name']. "<br />";
         echo "_GET You are ". $_GET['age']. " years old.". "<br />";
      }
    if( $_REQUEST["name"] || $_REQUEST["age"] )
      {
         echo "_REQUEST Welcome ". $_REQUEST['name']. "<br />";
         echo "_REQUEST You are ". $_REQUEST['age']. " years old.". "<br />";
      }
	if($_POST)
		  if( $_POST["name"] || $_POST["age"] )
		  {
		     echo "_POST Welcome ". $_POST['name']. "<br />";
		     echo "_POST You are ". $_POST['age']. " years old.";
		     exit();
		  }	

?>
  <form action="<?php $_PHP_SELF ?>" method="POST">
  Name: <input type="text" name="name" />
  Age: <input type="text" name="age" />
  <input type="submit" />
  </form>
</body>
</html>