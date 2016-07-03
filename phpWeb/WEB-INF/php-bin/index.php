 <html>
    <body>
    <?php

		include("commons/top.php"); 

		$viewer = getenv( "HTTP_USER_AGENT" );
		$browser = "An unidentified browser";
		if( preg_match( "/MSIE/i", "$viewer" ) )
		{
		  $browser = "Internet Explorer";
		}
		else if(  preg_match( "/Netscape/i", "$viewer" ) )
		{
		  $browser = "Netscape";
		}
		else if(  preg_match( "/Mozilla/i", "$viewer" ) )
		{
		  $browser = "Mozilla";
		}
		$platform = "An unidentified OS!";
		if( preg_match( "/Windows/i", "$viewer" ) )
		{
		  $platform = "Windows!";
		}
		else if ( preg_match( "/Linux/i", "$viewer" ) )
		{
		  $platform = "Linux!";
		}
		echo("You are using $browser on $platform<br>");
    ?>
    
   
    </body>
</html>