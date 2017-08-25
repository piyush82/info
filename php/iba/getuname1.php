<?php
	//initializing variables here
        $configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        $enablelog = "";
        $redirect = "";
        while(!feof($handle) && $handle)
        {
                $line = trim(fgets($handle));
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
//        header("Refresh: $sec; url=" . $redirect . "getuname1.php");
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
                $line = trim(fgets($handle));
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
	$retrievepath = $basepath . "retrieve/" . strtolower(trim($_POST[ufid]));
    	$retrievepath .= substr(strtolower(trim($_POST[firstname])),0,1) . substr(strtolower(trim($_POST[lastname])),0,1) . $_POST[sex];
        $handle = fopen($retrievepath, "r");
	$email = "";
	$username = "";
	$file_exist = TRUE;
        if(!$handle)
        { 
                echo "Error accessing your file. Contact system administrator. Error Code 003.<br>";
		$file_exist = FALSE;
        }
        else
        {
             	$username = trim(fgets($handle));
		$email = trim(fgets($handle));
                fclose($handle);
        }
        if($file_exist) //success
        {
		if(strlen($username) > 0 && strlen($email) > 2)
		{
			$message = "This is your UF-IBA Username: " . $username . "\n";
			$subject = "UF-IBA Username Reminder";
			$headers = 'From: UF-IBA-SYSTEM' . "\r\n" . 'Reply-To: ' . "do-not-reply"  . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n";
			$headers .= "Content-type: text/html";
			$message = wordwrap($message, 70);
			mail($email, $subject, $message, $headers);
			if(strcmp($enablelog, "yes") == 0)
                	{
                 		$handle = fopen($basepath . "log/" . $username . ".log", "a"); //open the global log file
                        	if($handle)
                      		{
                       			fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." getuname1.php succ");
                             		fwrite($handle, " email " . $email . ">>\n");
                      		} //succ == username reminder send successful email = email address at which username sent
                		fclose($handle);
                	}
			echo "<p class=front>Your correct username has been sent to this email address: " . $email . "</p>";
			echo "<form class=register  method=post action=adminlogout.php>";
                	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                	echo "<input type=hidden name=control value=logout>";
                	echo "<input type=hidden name=login value=" . $username . ">";
               		echo "<input class=login type=submit value='Logout'>";
                	echo "</form>";
		}
		else
		{
			echo "<p class=front>** Error! Unable to retrieve your username! Contact the system admin or your TA.</p>";
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." getuname1.php nunf");
                                        fwrite($handle, " email " . $email . ">>\n");
                                } //nunf == no username or email found in the file, file exists
                                fclose($handle);
                        }
		}
	}
	else //error
        {
		if(strcmp($enablelog, "yes") == 0 && !$file_exist)
                {
                        $handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                        if($handle)
                        {
                                fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." getuname1.php fnff>>\n");
                        } //ffnf == failed .. filename not found
                        fclose($handle);
                }
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
