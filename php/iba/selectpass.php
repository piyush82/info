<?php
	//initializing variables here
        $configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        $enablelog = "";
        $redirect = "";
        while(!feof($handle) && $handle)
        {
                $line = rtrim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablelog") > 0) $enablelog = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "redirect") > 0) $redirect = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        $adminfile = "";
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
$filename = $basepath . "tmp/" .  md5($_POST[sessionid]);
if(strcmp($_COOKIE["IBASession"], md5($_POST[sessionid])) == 0 && !file_exists($filename)) //validsession continue
{

}
elseif(strcmp($_COOKIE["IBASession"], md5($_POST[sessionid])) != 0 && file_exists($filename)) //first time
{
        setcookie("IBASession", md5($_POST[sessionid]));
	unlink($filename);
}
else
{
        //invalid cookie
	echo "Invalid Session! Try ReLogin";
	$sec = 2;
        header("Refresh: $sec; url=" . $redirect);
	exit(0);
}
if(strcmp($_POST[choice],"n") == 0)
{
	setcookie("IBASession",md5($_POST[sessionid]),time() - 3600);
	echo "Redirecting to the home page!";
        $sec = 2;
        header("Refresh: $sec; url=" . $redirect);
        exit(0);
}
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "selectpass.php");
//        exit(0);
//}
?>
<?php
Header("Cache-control: private, no-cache");
Header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
Header("Pragma: no-cache");
Header("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
?>
<html>
<!-- Created on: 6/7/2006 -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>UF-IBA: SURVEY PAGE - Login / Register</title>
  <meta name="description" content="IBA Survey">
  <meta name="keywords" content="UF, IBA, CISE">
  <meta name="author" content="root">
  <meta name="generator" content="Bluefish 1.0.5">	
  <link rel="stylesheet" type="text/css" href="styles.css">	 
  <script>
	var imgId=0;
	var bucketId=0;
	var imgCount=0;
	function change(imgId, bucketId)
	{
	<?php
	for($i=1; $i <=3; $i++)
	{
		for($j=1; $j <= 36; $j++)
		{
			echo "if(imgId==" . $j . " && bucketId==" . $i . ") {";
			if($j < 10)
			{
				echo "document.img" . $i . "0" . $j . ".src='images/bucket" . $i . "/sharp/0" . $j . ".jpg';";
				echo "document.original.src='images/bucket" . $i . "/sharp/0" . $j . ".jpg'; }";
			}
			else 
			{
				echo "document.img" . $i . $j . ".src='images/bucket" . $i . "/sharp/" . $j . ".jpg';";
				echo "document.original.src='images/bucket" . $i . "/sharp/" . $j . ".jpg'; }";
			}
		}
	}
	?>
	}
	function reset(imgId, bucketId)
	{
		document.original.src='blank.jpg';
	<?php
        for($i=1; $i <=3; $i++)
        {
                for($j=1; $j <= 36; $j++)
                {
                        echo "if(imgId==" . $j . " && bucketId==" . $i . ")";
                        if($j < 10) echo "document.img" . $i . "0" . $j . ".src='images/bucket" . $i . "/0" . $j . ".jpg';";
                        else echo "document.img" . $i . $j . ".src='images/bucket" . $i . "/" . $j . ".jpg';";
                }
        }
        ?>
	}
	<?php
	for($i=1; $i<=36; $i++) echo "var value" . $i . "=0;";
	?>
	function setborder(imgId, bucketId)
	{
		<?php
		for($i=1; $i <=3; $i++)
	        { 
	                for($j=1; $j <= 36; $j++)
	                {
	                        echo "if(imgId==" . $j . " && bucketId==" . $i . ") {"; //start of outermost if
				if($j < 10)
				{
					echo "if(value" . $j . "==1){";
					echo "document.img" . $i . "0" . $j . ".border='2';";
					echo "imgCount++;";
					echo "if(bucketId == 1)";
					echo "document.selection.img" . $j . ".value='images/bucket1/sharp/0" . $j . ".jpg';";
					echo "else if(bucketId == 2) document.selection.img" . $j . ".value='images/bucket2/sharp/0" . $j . ".jpg';";
					echo "else document.selection.img" . $j . ".value='images/bucket3/sharp/0" . $j . ".jpg';";
					echo "}";
					echo "else {";
					echo "document.img" . $i . "0" . $j . ".border='0';";
					echo "imgCount--;";
					echo "document.selection.img" . $j . ".value='';";
					echo "}";
				}
				else //$j >= 10
				{
					echo "if(value" . $j . "==0){";
					echo "document.img" . $i . $j . ".border='0';";
					echo "imgCount--;";
					echo "document.selection.img" . $j . ".value='';";
					echo "}";
					echo "else {";
					echo "document.img" . $i . $j . ".border='2';";
					echo "imgCount++;";
					echo "if(bucketId == 1)";
                                        echo "document.selection.img" . $j . ".value='images/bucket1/sharp/" . $j . ".jpg';";
                                        echo "else if(bucketId == 2) document.selection.img" . $j . ".value='images/bucket2/sharp/" . $j . ".jpg';";
                                        echo "else document.selection.img" . $j . ".value='images/bucket3/sharp/" . $j . ".jpg';";
					echo "}";
				}
				echo "}"; //close of outermost {
	                }
	        }
		?>	
	}
	function toggle(imgId, bucketId)
	{
	<?php
	for($i=1; $i<=36; $i++)
	{
		echo "if(imgId==" . $i . "){";
		echo "if(value" . $i . " == 0) value" . $i . " = 1;";
		echo "else value" . $i . " = 0;";
		echo "}";
	}
	?>
		setborder(imgId, bucketId);
	}
	function selectCount()
	{
		return ImgCount;
	}
	</script>
</head>
<body bgcolor=#330066>
<table align="center" valign="center" border="0" width="800" bgcolor="white">
<tr><td colspan="2"><img src="banner.jpg" vspace="0">
<tr>
<td width=540 height=400 valign="top" align="left" background="white">
<?php
	//initializing variables here
        $configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        $enablelog = "";
        $redirect = "";
        while(!feof($handle) && $handle)
        {
                $line = rtrim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablelog") > 0) $enablelog = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "redirect") > 0) $redirect = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        $adminfile = "";
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
	$userfile = $_POST[userfile];
	$handle = fopen($userfile, "r");
        $question = "";
        $answer = "";
	$bucket = 1;
        if(!$handle)
        {
        	echo "Error accessing your data. Contact system administrator. Error Code 002.<br>";
        }
        else
       	{
           	while(!feof($handle) && $handle)
               	{
                 	$line = rtrim(fgets($handle));
                     	if(substr_count($line, "question") > 0) $question = substr($line, strrpos($line,":") + 1);
                    	if(substr_count($line, "answer") > 0) $answer = substr($line, strrpos($line,":") + 1); //this is the MD5 hashed version
               	}
          	fclose($handle);
	}
	if(strcmp($_POST[question],$question) == 0 && strcmp(strtolower(md5(strtolower($_POST[answer]))),strtolower($answer)) == 0) //success
	{
	 if(strcmp($_POST[nextbucket], "") == 0) $bucket = 1;
	 else $bucket = $_POST[nextbucket]; 
	 if($bucket == 0)
	 {
	 	//process password here and go to next page. change status too // also check if total number of passwords must be > 4
		$temp = $_POST[selectedpass];
                for($i = 1; $i <=36; $i++)
                {
                        $var = "img" . $i;
                        if(strcmp($_POST[$var], "") != 0)
                        {
                                $count++;
                                $temp .= $_POST[$var] . ";";
                        }
                }
		$temp = rtrim($temp,";");
		$passarray = explode(";", $temp);
		if(count($passarray) < 5)
		{
			echo "<p class= adjusted>Error! Total number of selected image < 5. Retry! Please logout and relogin to reselect.</p>";
			echo "<form class=register  method=post action=adminlogout.php>"; 
                        echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                        echo "<input type=hidden name=control value=logout>";
                        echo "<input type=hidden name=login value=" . $_POST[username] . ">";
                        echo " <input class=login type=submit value='Logout'>";
                        echo "</form>";
		}
		else
		{
			echo "<p class=front>This is the password you selected:</p>";
			for($i=0; $i < count($passarray); $i++)
                	{
                        	echo "<img src=" . $passarray[$i] . " hspace=2 vspace=2 width=80 height=53>";
                        	if(($i + 1) % 6 == 0) echo "<br>";
                	}
			echo "<p class=inst>Please memorize these images carefully before you proceed. It is highly recommend that you immediately";
			echo " continue to your training session. The training session will familiarize you with the actual authentication process";
			echo ".<br><br>In future if you need to change your password you can do so from your account control panel after logging in.";
			echo " In case you forgot your password you should contact the system administrator or your TA to reset your account.";
			echo "</p>";
			//next commit to password file and change status to 1
			$statusfile = $_POST[statusfile];
			$passwordfile = $basepath . "password/" . $_POST[username];
			$handle = fopen($passwordfile, "w");
			for($i=0; $i < count($passarray); $i++)
                        {
                                fwrite($handle, $passarray[$i] . "\n"); 
                        }
			fclose($handle);
			$handle = fopen($statusfile, "w");
			fwrite($handle, "1"); //status 1 means password selected but training not done
			fclose($handle);
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file      
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." selectpass.php succ");
                                        fwrite($handle, " count " . count($passarray) . ">>\n");
                                } //succ == password selection completed successfully count = number of images selected
                                fclose($handle);
                        }
			echo "<p class=front>Your password file has been successfully updated! You may next go to training sessions or logout:</p>";
			echo "<form class=register  method=post action=login.php>";
                        echo "<input type=hidden name=username value=" . $_POST[username] . ">";
                        echo "<input class=login type=submit value='Proceed for Training Session'>";
                        echo "</form>";
			echo "<form class=register  method=post action=adminlogout.php>"; 
                       	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                       	echo "<input type=hidden name=control value=logout>";
                       	echo "<input type=hidden name=login value=" . $_POST[username] . ">";
                       	echo "<input class=login type=submit value='Logout'>";
			echo "</form>";
		}
	 }
	 else
	 {
	 	echo "<p class=justify>Welcome " . $_POST[firstname] . " " . $_POST[lastname] . ". You are registered as <b>" . $_POST[usertype] . "</b> user.";
	 	echo "<br><br>Please select from the images below. These images will constitute your password so select carefully. ";
		echo "You can select any number of image(s) per screen. <br><br><font color=red>Your total selection must be at least 5 images in the";
		echo " end (not per screen). Also do not select images just based on its location in current screen because while authenticating all ";
		echo "images will be randomly placed in the grid</font>.</p>";
	 	echo "<p class=adjusted>Images in Password set till now:<br>";
		$displaystring = $_POST[selectedpass];
                for($i = 1; $i <=36; $i++)
                {
                        $var = "img" . $i;
                        if(strcmp($_POST[$var], "") != 0)
                        {
                                $count++;
                                $displaystring .= $_POST[$var] . ";";
                        }
                }  
		$imagearray = explode(";", rtrim(rtrim($displaystring,";")));
		for($i=0; $i < count($imagearray); $i++)
		{
			if(strlen($imagearray[$i]) >4)
				echo "<image src=" . $imagearray[$i] . " hspace=2 vspace=2 width=80 height=53>";
			if(($i + 1) % 6 == 0) echo "<br>";
		}
		echo "</p>";
	 	echo "<hr><form class=register name=selection method=post action=selectpass.php>";
	 	echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";
	 	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";
	 	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
  	 	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
	 	echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
	 	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
	 	echo "<input type=hidden name=choice value=" . $_POST[choice] . ">";
	 	echo "<input type=hidden name=question value=" . $_POST[question] . ">";
	 	echo "<input type=hidden name=answer value=" . $_POST[answer] . ">";
	 	$count = 0;
	 	$temp = $_POST[selectedpass];
	 	for($i = 1; $i <=36; $i++)
	 	{
	  		$var = "img" . $i;
	  		if(strcmp($_POST[$var], "") != 0)
			{
				$count++;
				$temp .= $_POST[$var] . ";";
			}
		}
		echo "<input type=hidden name=nextbucket value=" . ($bucket + 1)%4 . ">";
	 	echo "<input type=hidden name=selectedpass value=" . $temp . ">";
	 	for($i = 1; $i<=36; $i++) echo "<input type=hidden name=img" . $i . " value=''>";
	 	echo "Make your selection below and then <input class=general type=submit value='Continue'> to next screen.";
         	echo "</form>";
	 	//echo "<p class=login>Displaying Images from Bucket: " . $bucket . "</p>";
	 	echo "<table border=0 align=center><tr>";
	 	for($i = 1; $i<=36; $i++)
	 	{
			if($i < 10)
			{
				echo "<td><img name=img" . $bucket . "0" . $i . " src=images/bucket" . $bucket . "/0" . $i . ".jpg onMouseOver=change("
. $i . ","  . $bucket . "); onMouseOut=reset(" . $i . "," . $bucket . "); onClick=toggle(" . $i . "," . $bucket . "); width=80 height=53 border=0  
style='border-color:red;'>";
			}
			else
			{
			 	echo "<td><img name=img" . $bucket . $i . " src=images/bucket" . $bucket . "/" . $i . ".jpg onMouseOver=change(" . $i
. "," . $bucket . "); onMouseOut=reset(" . $i . "," . $bucket . "); onClick=toggle(" . $i . "," . $bucket . "); width=80 height=53 border=0 
style='border-color:red;'>";
			}
			if(($i % 6 == 0) && ($i != 36)) echo "<tr>";
	 	}
	 	echo "</table>";
	 } //end of else
	}
	else //error
	{
		echo "<p class=login>Security Question and / or answer does not match! Try again</p>";
	}
?>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<img name=original border=0 src=blank.jpg><br><br>
<b><a href="index.php">BACK TO MAIN PAGE</a></b> 
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
</body>
</html>
