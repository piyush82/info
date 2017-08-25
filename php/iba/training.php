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
//        header("Refresh: $sec; url=" . $redirect . "training.php");
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
                    	if(substr_count($line, "answer") > 0) $answer = substr($line, strrpos($line,":") + 1);
               	}
          	fclose($handle);
	}
	if(strcmp($_POST[question],$question) == 0 && strcmp(strtolower(md5(strtolower($_POST[answer]))),strtolower($answer)) == 0) //success
	{
	 if(strcmp($_POST[nextbucket], "") == 0) $bucket = 0;
	 else
	 {
		$bucket = substr($_POST[nextbucket],0,1);
		if(strcmp($enablelog, "yes") == 0)
                {
                        $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                        if($handle)
                        {
                                fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." training.php disp");
                                fwrite($handle, " " . $bucket . ">>\n");
                        } //disp == particular bucket screen displayed
                        fclose($handle);
                }
	 }
	 //also randomize the image locations
	 $shuffled = ""; $array;
	 for($i=37;$i<=72;$i++) $shuffled .= chr($i);
	 $shuffled = str_shuffle($shuffled);
	 for($i=1; $i<=36; $i++)
	 {
		$loc = ord(substr($shuffled, $i - 1, 1)) - 36;
		$array[$i] = $loc;
	 }
	 if($bucket == 0) //varify the chosen password
	 {
	 	$passwordfile = $basepath . "password/" . $_POST[username];
		$handle = fopen($passwordfile, "r");
		$actualpassword;
		$index = 0;
		echo "<p class=front>This is the actual password set that you had originally selected:</p>";
		while(!feof($handle) && $handle)
		{
			$readcontent = rtrim(fgets($handle));
			if(strlen($readcontent) > 8)
			{
				$actualpassword[$index] = $readcontent;
				$index++;
				echo "<image src=" . $actualpassword[$index - 1] . " hspace=2 vspace=2 width=80 height=53>";
                                if($index % 6 == 0) echo "<br>";
			}
		}
		fclose($handle);
		echo "<hr>";
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
		echo "<p class=front>This is the password you selected just now [in no particular order]:</p>";
		$index = 0;
		for($i=0; $i < count($passarray); $i++)
                {
			if(strlen($passarray[$i]) > 8)
			{
                        	echo "<img src=" . $passarray[$i] . " hspace=2 vspace=2 width=80 height=53>";
				$index++;
			}
                        if($index % 6 == 0) echo "<br>";
                }
		echo "<hr>";
		//now verify whether it was correct or not.
		for($i=0; $i < count($passarray); $i++)
		{
			for($j=0; $j < count($actualpassword); $j++)
			{
				if(strcmp($actualpassword[$j],$passarray[$i]) == 0)
				{
					$actualpassword[$j] = ""; $passarray[$i] = "";
				}
			}
		}
		$success = 1;
		echo "<p class=front>Wrong Images selected by you this round:</p>";
		$index = 0;
		for($i=0; $i < count($passarray); $i++)
                {
                  	if(strcmp($passarray[$i],"") != 0)
                       	{
				$success = 0;
                         	echo "<img src=" . $passarray[$i] . " hspace=2 vspace=2 width=80 height=53>";
				$index++;
                        	if($index % 6 == 0) echo "<br>";       
                      	}
                }
		$extra = $index;
		echo "<p class=front>Images missed by you this round [from your password set]:</p>";
                $index = 0;
                for($i=0; $i< count($actualpassword); $i++)
                {
                        if(strcmp($actualpassword[$i],"") != 0)                         
                        {
				$success = 0;
                                echo "<img src=" . $actualpassword[$i] . " hspace=2 vspace=2 width=80 height=53>";
                                $index++;
                                if($index % 6 == 0) echo "<br>";
                        }
                }
		if($success == 0)
		{
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." training.php fail");
                                        fwrite($handle, " missed " . $index . " extra " . $extra . ">>\n");
                                } //fail == this training round succeeded $index ==  number of wrong images selected
                                fclose($handle);
                        }
			echo "<p class=front>This training round was in <font color=red>ERROR</font>.</p><hr>";
		}
		else
		{
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." training.php succ");    
                                        fwrite($handle, ">>\n");
                                } //succ == this training round succeeded $index ==  number of wrong images selected
                                fclose($handle);
                        }
			echo "<p class=front>This training round was in <font color=green>SUCCESS</font>.</p><hr>";
		}
		echo "<p class=front>It is highly recommended that you continue to train till you become comfortable with this system. ";
		echo "Also you should train until you successfully authenticate yourself at least twice in back to back sessions. ";
		echo "Choose from one of the options below:</p>";
		echo "<form class=register name=selection method=post action=training.php>";
                echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";  
                echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";    
                echo "<input type=hidden name=username value=" . $_POST[username] . ">";    
                echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
                echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=choice value=" . $_POST[choice] . ">";
                echo "<input type=hidden name=question value=" . $_POST[question] . ">";
                echo "<input type=hidden name=answer value=" . $_POST[answer] . ">";
		echo "<input type=hidden name=nextbucket value=" . str_shuffle("123") . ">";
                echo "<input class=login type=submit value='Continue to Train'> : Press this button to continue training now.";
                echo "</form>";
		echo "<form class=register  method=post action=adminlogout.php>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=endtraining>";
                echo "<input type=hidden name=login value=" . $_POST[username] . ">";
		echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
                echo "<input class=login type=submit value='End Training Session'> : <font color=red>";
		echo "[You will not be allowed to train next time you login]</font>";
                echo "</form>";
		echo "<form class=register  method=post action=adminlogout.php>"; 
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=logout>";
                echo "<input type=hidden name=login value=" . $_POST[username] . ">";
                echo "<input class=login type=submit value='Logout'> : Logout Now - this will allow you to continue training next time you login.";
		echo "</form>";
	 }
	 else
	 {
	 	echo "<p class=justify>Welcome " . $_POST[firstname] . " " . $_POST[lastname] . ". You are registered as <b>" . $_POST[usertype] . "</b> user.";
	 	echo "<br><br>Please select from the images below that you believe are in your password set. ";
		echo "You can select any number of image(s) per screen. <br><br><font color=red>";
		echo "If you have not chosen any image from the current image set just click on continue to move on to the next "; 
		echo "image set</font>. <br><br>**TRAINING SESSION IN PROGRESS**</p>";
	 	echo "<form class=register name=selection method=post action=training.php>";
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
		echo "<input type=hidden name=nextbucket value=" . substr($_POST[nextbucket],1) . ">";
	 	echo "<input type=hidden name=selectedpass value=" . $temp . ">";
	 	for($i = 1; $i<=36; $i++) echo "<input type=hidden name=img" . $i . " value=''>";
	 	echo "Make your selection below and then <input class=general type=submit value='Continue'> to next screen.";
         	echo "</form>";
	 	//echo "<p class=login>Displaying Images from Bucket: " . $bucket . "</p>";
	 	echo "<table border=0 align=center><tr>";
	 	for($i = 1; $i<=36; $i++)
	 	{
			if($array[$i] < 10)
			{
				echo "<td><img name=img" . $bucket . "0" . $array[$i] . " src=images/bucket" . $bucket . "/0" . $array[$i] . 
				".jpg onMouseOver=change(" . $array[$i] . ","  . $bucket . "); onMouseOut=reset(" . $array[$i] . "," . 
				$bucket . "); onClick=toggle(" . $array[$i] . "," . $bucket . "); width=80 height=53 border=0  style='border-color:red;'>";
			}
			else
			{
			 	echo "<td><img name=img" . $bucket . $array[$i] . " src=images/bucket" . $bucket . "/" . $array[$i] . 
				".jpg onMouseOver=change(" . $array[$i] . "," . $bucket . "); onMouseOut=reset(" . $array[$i] . "," . 
				$bucket . "); onClick=toggle(" . $array[$i] . "," . $bucket . "); width=80 height=53 border=0 style='border-color:red;'>";
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

