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
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "login.php");
//        exit(0);
//}
?>
<html>
<!-- Created on: 6/12/2006 -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>UF-IBA: SURVEY PAGE - Registration</title>
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

	//checking for duplicate username here
	$path = $basepath . "users/";
	$dhandle = opendir($path);
	$status = 0;
	while (($file = readdir($dhandle)) !== false) {
		if(strncmp($file, ".", 1) == 0 || strncmp($file, "..", 2) == 0)
		{
		}
		else
		{
			if(strcmp($file, trim($_POST[username])) == 0) $status = 1;
		}
	}
	closedir($dhandle);
	if($status == 0) //username does not exist
	{
		echo "Login Error! This username does not exist.<br>";
		echo "<br><br>Please <a href=register.php>register</a>.<br><br><br><br><br><br><br><br>";
	}
	else //username exists read all the details as well as status details. 
	{
		$userfile = $basepath . "users/" . trim($_POST[username]);
		$statusfile = $basepath . "status/" . trim($_POST[username]);
		$handle = fopen($userfile, "r");
		$firstname = "";
		$lastname = "";
		$email = "";
		$ufid = "";
		$usertype = "";
		$question = "";
		$answer = "";
		if(!$handle)
		{
			echo "Error accessing your data. Contact system administrator.<br>";
		}
		else
		{
			while(!feof($handle) && $handle)
			{
				$line = trim(fgets($handle));
				if(substr_count($line, "firstname") > 0) $firstname = substr($line, strrpos($line,":") + 1);
				if(substr_count($line, "lastname") > 0) $lastname = substr($line, strrpos($line,":") + 1);
				if(substr_count($line, "email") > 0) $email = substr($line, strrpos($line,":") + 1);
				if(substr_count($line, "ufid") > 0) $ufid = substr($line, strrpos($line,":") + 1);
				if(substr_count($line, "usertype") > 0) $usertype = substr($line, strrpos($line,":") + 1);
				if(substr_count($line, "question") > 0) $question = substr($line, strrpos($line,":") + 1);
				if(substr_count($line, "answer") > 0) $answer = substr($line, strrpos($line,":") + 1);
			}
			fclose($handle);
			echo "Welcome " . $firstname . " " . $lastname;
			echo "! You are registered as a " . $usertype . " user.<br>";
			$handle = fopen($statusfile, "r");
			$status = trim(fgets($handle));
			$currtime = time();
                        $sessionid = md5($currtime);
                        $tempfile = $basepath . "tmp/" . $sessionid;
                        fopen($tempfile, "w");
                        fclose($tempfile);
			if(strcmp($status, "0") == 0)
			{
				//in the selectpass.php file see if security question is empty or not
				//always verify the user's security answer. Access these info from the file.
				echo "<br><br>Our System indicates that you have not selected / reselected your password yet.";
				echo " Would you like to do that now?";
				echo "<form class=login method=post action=selectpass.php>";
				echo "Yes <input class=login type=radio name=choice value=y>";
				echo "No <input class=login type=radio name=choice value=n><br><br>";
				echo "For additional security please select your security question and answer it.<br><br>";
				echo "Security Question: <select class=contact name=question size=1>";
				echo "<option value=birth>Place of Birth";
				echo "<option value=color>Favorite Color";
				echo "<option value=superhero>Favorite Superhero";
				echo "<option value=school>Name of First School";
				echo "</select>";
				echo "<br>Answer (use no spaces): <input class=register type=password name=answer size=24><br><br><br>";
				echo "<input type=hidden name=username value=" . trim($_POST[username]) . ">";
				echo "<input type=hidden name=firstname value=" . $firstname . ">";
				echo "<input type=hidden name=lastname value=" . $lastname . ">";
				echo "<input type=hidden name=email value=" . $email . ">";
				echo "<input type=hidden name=usertype value=" . $usertype . ">";
				echo "<input type=hidden name=userfile value=" . $userfile . ">";
				echo "<input type=hidden name=statusfile value=" . $statusfile . ">";
				echo "<input type=hidden name=sessionid value=" . $currtime . ">";
				echo "<input class=login type=submit value=Proceed>";
				echo "</form>";
			}
			if(strcmp($status, "1") == 0)
                        {
                                //in the selectpass.php file see if security question is empty or not
                                //always verify the user's security answer. Access these info from the file.
                                echo "<br><br>Our System indicates that you have not undergone / finished your training yet.";
                                echo " Would you like to do that now? Choosing no will automatically log you out!";
                                echo "<form class=login method=post action=training.php>";
                                echo "Yes <input class=login type=radio name=choice value=y>";
                                echo "No <input class=login type=radio name=choice value=n><br><br>";
                                echo "For additional security please select your security question and answer it.<br><br>";
                                echo "Security Question: <select class=contact name=question size=1>";
                                echo "<option value=birth>Place of Birth";
                                echo "<option value=color>Favorite Color";
                                echo "<option value=superhero>Favorite Superhero";   
                                echo "<option value=school>Name of First School";
                                echo "</select>";
                                echo "<br>Answer (use no spaces): <input class=register type=password name=answer size=24><br><br><br>";
                                echo "<input type=hidden name=username value=" . trim($_POST[username]) . ">";
                                echo "<input type=hidden name=firstname value=" . $firstname . ">";
                                echo "<input type=hidden name=lastname value=" . $lastname . ">";
                                echo "<input type=hidden name=email value=" . $email . ">";
                                echo "<input type=hidden name=usertype value=" . $usertype . ">";
                                echo "<input type=hidden name=userfile value=" . $userfile . ">";
                                echo "<input type=hidden name=statusfile value=" . $statusfile . ">";
                                echo "<input type=hidden name=sessionid value=" . $currtime . ">";
				echo "<input type=hidden name=nextbucket value=" . str_shuffle("123") . ">";
                                echo "<input class=login type=submit value=Proceed>";
                                echo "</form>";
                        }
			if(strcmp($status, "2") == 0) //automatically redirect to the authentication module
                        {
				$lastaccessfile = $basepath . "lastaccess/" . trim($_POST[username]) . ".lac";
				$handle = fopen($lastaccessfile, "r");
				$lastaccess = "";
				if($handle)
				{
					$lastaccess = trim(fgets($handle));
				}
				else $lastaccess = time();
				fclose($handle);
				$handle = fopen($lastaccessfile, "w");
				if($handle) fwrite($handle, time() . "\n");
				fclose($handle);
				if(strcmp($enablelog, "yes") == 0)
                        	{
                                	$handle = fopen($basepath . "log/" . $username . ".log", "a"); //open the global log file
                                	if($handle)
                                	{
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." login.php atst");
                                        fwrite($handle, " status " . $status . ">>\n");
                                	} //atst = authentication start, time = time of start, status = user status file entry
                                	fclose($handle);
                        	}
				if(strcmp($_POST[publicopen],"no") == 0)
				{
                                	echo "<form class=login name=autoform1 method=post action=authenticate.php>";
                                	echo "<input type=hidden name=username value=" . trim($_POST[username]) . ">";
                                	echo "<input type=hidden name=firstname value=" . $firstname . ">";
                                	echo "<input type=hidden name=lastname value=" . $lastname . ">";
                                	echo "<input type=hidden name=email value=" . $email . ">";
                                	echo "<input type=hidden name=usertype value=" . $usertype . ">";
                                	echo "<input type=hidden name=userfile value=" . $userfile . ">";
                                	echo "<input type=hidden name=statusfile value=" . $statusfile . ">";
                                	echo "<input type=hidden name=sessionid value=" . $currtime . ">";
					echo "<input type=hidden name=lastaccess value=" . $lastaccess . ">";
                                	echo "<input type=hidden name=nextbucket value=" . str_shuffle("123") . ">";
                                	echo "</form>";
					echo "<script language=Javascript>";
					echo "setTimeout('document.autoform1.submit()',1);";
					echo "</script>";
					exit(0);
				}
				else
				{
					echo "<form class=login name=autoform2 method=post action=pub-authenticate.php>";
                                        echo "<input type=hidden name=username value=" . trim($_POST[username]) . ">";
                                        echo "<input type=hidden name=firstname value=" . $firstname . ">";
                                        echo "<input type=hidden name=lastname value=" . $lastname . ">";
                                        echo "<input type=hidden name=email value=" . $email . ">";
                                        echo "<input type=hidden name=usertype value=" . $usertype . ">";
                                        echo "<input type=hidden name=userfile value=" . $userfile . ">";
                                        echo "<input type=hidden name=statusfile value=" . $statusfile . ">";
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        echo "<input type=hidden name=lastaccess value=" . $lastaccess . ">";
                                        echo "<input type=hidden name=nextbucket value=" . str_shuffle("123") . ">";
                                        echo "</form>";
                                        echo "<script language=Javascript>";
                                        echo "setTimeout('document.autoform2.submit()',1);";
                                        echo "</script>";
                                        exit(0);
					//echo "<br><br>Under Implementation<br>";
					//exit(0);
				}
                        }
			echo "<form class=register  method=post action=adminlogout.php>"; 
                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                        echo "<input type=hidden name=control value=logout>";
                       	echo "<input type=hidden name=login value=" . trim($_POST[username]) . ">";
                        echo " <input class=login type=submit value='Logout'>";
                        echo "</form>";
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
