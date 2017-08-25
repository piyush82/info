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
	//unlink($filename); do not unlink filename here. this is the first place the cookie is set so is not accessible yet
}
else
{
	//invalid cookie
}
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "admincontrol.php");
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
<!-- Created on: 6/12/2006 -->
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
	$adminfile = $basepath . "admin-list";
        $handle = fopen($adminfile, "r");
        $status = 0;
        $pieces;
        while (!feof($handle) && $handle) {
                $line = trim(fgets($handle));
                $pieces = explode(" ", $line);
                if(strcmp($_POST[login], $pieces[0]) == 0 && strcmp($_POST[login], "admin") == 0)
                {
                        $status = 1;
                        break;
                }
        }
        fclose($handle);
	if($status == 0)
        {
                echo "Login Error! You do not have admin privilages!<br>";
		if(strcmp($enablelog, "yes") == 0)
                {
                        $handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                        if($handle)
                        {
                                fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." admin.php iusr>>\n");
                        } //iusr == invalid username
                        fclose($handle);
                }
                $sec = 2;  
                header("Refresh: $sec; url=" . $redirect);
		exit(0);                     
        }
	echo "You are now Logged On. Your have admin rights for <font color=red>" . $pieces[1] . "</font>.<br><br>";
	$dir = $basepath;
	$filename = $basepath . "tmp/" .  md5($_POST[sessionid]);
	if(file_exists($filename) || (strcmp($_COOKIE["IBASession"], md5($_POST[sessionid])) == 0 && !file_exists($filename))) //valid session
	{
		if(file_exists($filename)) unlink($filename);
		//continue processing
		echo "This session makes use of unique cookies to verify valididty. ";
		echo "Please make sure you close your browser at the end of your current session to preserve privacy and clear all the cookies<br>";
		//////////////////////start displaying admin control options here, for creating new admin accounts, resetting passwords, iba settings
		if(strcmp($_POST[control], "adminlist") == 0)
		{
			$contents = trim($_POST[adminlist]);
			$handle = fopen($adminfile, "w");
			fwrite($handle, $contents);
			fclose($handle);
			echo "<br>Updating Admin List: Status - done.<br>";
			if(strcmp($enablelog, "yes") == 0)
                        {
                      	       $handle = fopen($basepath . "log/" . $_POST[login] . ".log", "a"); //open the log file
                               if($handle)
                               {
                               fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." admincontrol.php uadl>>\n");
                               } //uadl == updated admin-list
                               fclose($handle);
                      	}
		}
		if(strcmp($_POST[control], "newaccount") == 0)
                {
			$dir = $basepath . trim($_POST[createdir]);
			$homework = $dir . "/homework";
			$passfile = $basepath . "password/admins/" . trim($_POST[createlogin]);
			$handle = fopen($passfile, "w");
			if($handle)
			{
				fputs($handle, $_POST[createpass]);
				fclose($handle);
				echo "<br>Creating New Admin Account: Updated Password File Successfully.<br>";
				if(strcmp($enablelog, "yes") == 0)
                        	{        
                               		$handle = fopen($basepath . "log/" . $_POST[login] . ".log", "a"); //open the log file            
                               		if($handle)         
                               		{         
              					fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]);
						fwrite($handle, " % " . $_POST[createlogin] . " admincontrol.php nada>>\n");
                               		} //nada == created new admin account successfully     
                               		fclose($handle);         
                        	}
			}
			else
			{
				echo "<br>Creating New Admin Account: Password Update Failure!<br>";
			}
			if(mkdir($dir, 0700))
			{
				echo "<br>Creating New Admin Account: Created Directory Successfully.<br>";
			}
			else
			{
				echo "<br>Directory Creation Failed! Check if directory already exists or not!<br>";
			}
			if(mkdir($homework, 0700))
                        {
                                echo "<br>Creating New Admin Account: Created Homework Directory Successfully.<br>";
                        }   
                        else
                        {
                                echo "<br>Homework Directory Creation Failed! Check if directory already exists or not!<br>";
                        }
		}
		$contents = "";
                $handle = fopen($adminfile, "r");
                while(!feof($handle) && $handle)
                {
                        $contents = $contents . trim(fgets($handle)) . "\n";
                }
                fclose($handle);
		echo "<hr>";
		echo "<form class=register method=post action=admincontrol.php>";
		echo "Modify Admin List Below:<br><br>";
		echo "<textarea name=adminlist class=register rows=4 cols=40>" . $contents . "</textarea><br><br>";
		echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
		echo "<input type=hidden name=control value=adminlist>";
		echo "<input type=hidden name=login value=" . $_POST[login] . ">";
		echo "<input class=login type=submit value='Modify Admin-List'>";
		echo "</form>";
		echo "<hr>";
		echo "<form class=register method=post action=admincontrol.php>";
                echo "Create New Admin Account: [Make sure you modify admil-list above accordingly]<br><br>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=newaccount>";
                echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                echo "Admin Login: <input class=register name=createlogin type=text size=20> ";
                echo "Initial Admin Password: <input class=register name=createpass type=password size=20><br>";
		echo "Control Domain: <input class=register name=createdir type=text size=18><br><br>";
		echo "Control Domain usually means the subdirectory where the admin will have upload privilages. ";
		echo "Examples: cop5615fa04 , cot3100su05 and so on ...<br><br>";
                echo "<input class=login type=submit value='Create New Account'></form>";
		echo "<hr>";
		echo "<form class=register  method=post action=adminlogout.php>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=logout>";
                echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                echo "<input class=login type=submit value='Logout'>";
                echo "</form>";
		
	}
	else
	{
		echo "Invalid Session! Please try relogin again.<br>";
		if(strcmp($enablelog, "yes") == 0)
                {
                	$handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                       	if($handle)
                       	{
                      		fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." admin.php invs>>\n");
                       	} //invs == invalid session
                    	fclose($handle);
               	}
		$sec = 2;
                header("Refresh: $sec; url=" . $redirect);
                exit(0);
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
