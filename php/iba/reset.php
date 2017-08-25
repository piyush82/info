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
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "reset.php");
//        exit(0);
//}
?>
<?php
Header("Cache-control: private, no-cache");
Header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
Header("Pragma: no-cache");
Header("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
?>
<head>
  <META http-equiv="expires" content="0">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>UF-IBA: SURVEY PAGE - Admin Control Page</title>
  <meta name="description" content="IBA Survey">
  <meta name="keywords" content="UF, IBA, CISE">
  <meta name="author" content="root">
  <meta name="generator" content="Bluefish 1.0.5">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body bgcolor=#330066>
<table align="center" valign="center" border="0" width="800" bgcolor="white">
<tr><td colspan="2"><img src="banner.jpg" vspace="0">
<tr> 
<td width=540 height=400 valign="top" align="left">
<p>
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
	$userfile = $basepath . "users/" . trim($_POST[username]);
        $handle = fopen($userfile, "r");
        $question = "";
        $answer = "";
	$email = "";
	$file_exist = TRUE;
        if(!$handle)
        { 
                echo "Error accessing your data. Contact system administrator. Error Code 002.<br>";
		$file_exist = FALSE;
        }
        else
        {
                while(!feof($handle) && $handle)
                {
                        $line = rtrim(fgets($handle));
                        if(substr_count($line, "question") > 0) $question = substr($line, strrpos($line,":") + 1);
                        if(substr_count($line, "answer") > 0) $answer = substr($line, strrpos($line,":") + 1); //this is the MD5 hashed version
                	if(substr_count($line, "email") > 0) $email = substr($line, strrpos($line,":") + 1);
		}
                fclose($handle);
        }
        if(strcmp($_POST[question],$question) == 0 && strcmp(strtolower(md5(strtolower($_POST[answer]))),strtolower($answer)) == 0) //success
        {
		$passwordfile = $basepath . "password/" . trim($_POST[username]);
                $handle = fopen($passwordfile, "r");
                $actualpassword;
                $index = 0;
                //echo "<p class=front>This is the actual password set that you had originally selected:</p>";
		if($handle)
		{
                	while(!feof($handle))
                	{
                        	$readcontent = rtrim(fgets($handle));
                        	if(strlen($readcontent) > 8)
                        	{
                                	$actualpassword[$index] = $readcontent;
                                	$index++;
                        	}
                	}
                	fclose($handle);
			$message = "<html><body>Below is your password set. If you wish to reset your password try login again now that you know your";
			$message .= " correct password. Once you have logged in you can reset your password from the control options.<br><br>";
			for($i=0; $i<count($actualpassword); $i++)
			{
				$message .= "<img border=0 hspace=2 vspace=2 width=80 height=53 src=https://www.cise.ufl.edu/~pharsh/iba/";
				$message .= $actualpassword[$i] . ">";
				if(($i + 1)%6 == 0) $message .= "<br>";
			}
			$message .= "</body></html>";
			$subject = "UF-IBA Password Reminder";
			$headers = 'From: UF-IBA-SYSTEM' . "\r\n" . 'Reply-To: ' . "do-not-reply"  . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n";
			$headers .= "Content-type: text/html";
			$message = wordwrap($message, 70);
			$status = mail($email, $subject, $message, $headers);
			/*
			$statusfile = $basepath . "status/" . $_POST[username];
			$handle = fopen($statusfile, "w");
			fwrite($handle, "0");
			fclose($handle);
			*/
			if(strcmp($enablelog, "yes") == 0)
                	{
                 		$handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                        	if($handle)
                      		{
					if($status)
					{
                       				fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." reset.php succ");
                             			fwrite($handle, " email " . $email . ">>\n");
					}
					else
					{
						fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." reset.php fail");
                                                fwrite($handle, " email " . $email . ">>\n");
					}
                      		} //succ == password reminder send successful email = email address at which password sent
                		fclose($handle);
                	}
			if($status)
			{
				echo "<p class=front>Your correct password has been sent to this email address: " . $email . "<br>";
				echo "Don't forget to enable show images options in your email client to view your image set.</p>";
			}
			else
			{
				echo "<p class=front>** There has been some error in sending password to this email address: " . $email . " **<br>";
                                echo "Please contact your TA or system admin.</p>";
			}
		}
		else
		{
			echo "<p class=front>** Error! Your Password file does not exist yet! If you think this is an error contact your TA or";
			echo " the system admin **</p>";
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." reset.php ffnf");
                                        fwrite($handle, " email " . $email . ">>\n");
                                } //fnfn == password reminder send failed password file not found email = email address at which password sent
                                fclose($handle);
                        }
		}
		echo "<form class=register  method=post action=adminlogout.php>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=logout>";
                echo "<input type=hidden name=login value=" . $_POST[username] . ">";
               	echo "<input class=login type=submit value='Logout'>";
                echo "</form>";
	}
	else //error
        {
		if(strcmp($enablelog, "yes") == 0 && $file_exist)
                {
                 	$handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                       	if($handle)
                   	{
                       		fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." reset.php qanm>>\n");
                     	} //qanm == failes because secret question and / or answer does not match
                      	fclose($handle);
                }
		if(strcmp($enablelog, "yes") == 0 && !$file_exist)
                {
                        $handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                        if($handle)
                        {
                                fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." reset.php fail ");
				fwrite($handle, " uname " . $_POST[username] . ">>\n");
                        } //fail == userfile does not exist uname = username provided
                        fclose($handle);
                }
                echo "<p class=login>Security Question and / or answer does not match! Try again</p>";
        }
?>
</p>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<b><a href="index.php">BACK TO MAIN PAGE</a></b><br>
<b><a href="contact.html">CONTACT US</a></b>
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
