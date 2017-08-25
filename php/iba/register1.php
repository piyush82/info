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
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "register.php");
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
	$regchoice = "";
        while(!feof($handle) && $handle)
        {
                $line = rtrim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablelog") > 0) $enablelog = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "redirect") > 0) $redirect = trim(substr($line, strrpos($line,"=") + 1));
		if(substr_count($line, "regchoice") > 0) $regchoice = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        $adminfile = "";
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
	//checking for duplicate username
	$path = $basepath . "users/";
	$dhandle = opendir($path);
	$i = 0;
	$status = 0;
	$status1 = 0;
	$status2 = 0;
	$status3 = 0;
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
	if(strcmp(trim($_POST[firstname]), "") == 0)
	{
		$status1 = 2;
	}
	if(strcmp(trim($_POST[lastname]), "") == 0)
	{	
		$status1 = 2;
	}
	if((strcmp(trim($_POST[email]), "") == 0) || (substr_count($_POST[email], "@") != 1) || (substr_count($_POST[email], ".") < 1))
	{
		$status1 = 2;
	}
	//testing here for validity of email address
	$parts = explode("@", $_POST[email]);
	$host = "%^&";
	if(count($parts) == 2) $host = $parts[1] . ".";
	if(getmxrr($host, $mxhosts))
	{

	}
	else $status3 = 1;
	if(strlen(trim($_POST[ufid])) != 8)
	{
		$status1 = 2;
	}
	if(strcmp(trim($_POST[major]), "") == 0)
	{
		$status1 = 2;
	}
	if(strcmp(trim($_POST[age]), "") == 0)
	{
		$status1 = 2;
	}
	if(strcmp(trim($_POST[username]), "") == 0)
	{
		$status1 = 2;
	}
	if(strcmp($_POST[answer] , "") == 0 || strcmp($_POST[answer1], "") == 0 || strcmp(strtolower($_POST[answer]),strtolower($_POST[answer1])) != 0)
	{
		$status1 = 2;
	}
	
	if(strcmp($_POST[user], "general") != 0)
	{
		$status2 = 1;
		//now checking whether the UFID is in the class roster or not also check whether the name matches or not
		$filepath = $basepath . $_POST[user] . "/" .$_POST[user] . "-roster.csv";
		$handle = fopen($filepath, "r");
		if(!$handle)
		{
			echo "Roster for class you are trying to register does not exist.";
			echo " Please contact your TA or try registering as a General User.<br>";
		}
		else
		{
			while(!feof($handle))
			{
				$array;
				$line = trim(trim(fgets($handle)), ",");
				if(strlen($line) > 8 && substr_count($line, ",") > 0)
				{
					$array = explode(",", $line);
				}
				$length = strlen(trim($array[0]));
				$diff = 8 - $length;
				if($diff != 0)
				{
					for($i=0;$i<$diff;$i++) $array[0] = "0" . trim($array[0]);
				}
				if(strncmp(trim($_POST[ufid]), $array[0], 8) == 0) //found user's UFID. 
				{
if(substr_count(strtolower($array[1]),strtolower(trim($_POST[firstname]))) > 0 && substr_count(strtolower($array[1]),strtolower(trim($_POST[lastname]))) >
0)
						$status2 = 0;
				}	
			}
			fclose($handle);
		}
		if($status2 == 1)
		{
			echo "<font color=red>***Your UFID / Name combination is not present in class roster</font>."; 
			echo "<br><b>Contact your TA or register as a General User.</b><br><br>";
		}
	}
	
	if(($status == 0) && ($status1 == 0) && ($status2 == 0) && ($status3 == 0))
	{
		//everything seems OK.
		$userpath = $basepath . "users/" . trim($_POST[username]);
		$statuspath = $basepath . "status/" . trim($_POST[username]);
		$retrievepath = $basepath . "retrieve/" . substr(strtolower(trim($_POST[ufid])),4);
		$retrievepath .= substr(strtolower(trim($_POST[firstname])),0,1) . substr(strtolower(trim($_POST[lastname])),0,1) . $_POST[sex];
		$handle = fopen($userpath, "w");
		$handle1 = fopen($statuspath, "w");
		$handle2 = fopen($retrievepath, "w");
		if(!$handle || !$handle1 || !$handle2)
		{
			echo "FILESYSTEM ERROR! Contact Administrator.<br>";
			echo "<br><br><br><br><br><br><br><br><br><br>";
			unlink($handle);
			unlink($handle1);
			unlink($handle2);
		}
		else
		{
			fwrite($handle, "firstname:" . trim($_POST[firstname]) . "\n");
			fwrite($handle, "lastname:" . trim($_POST[lastname]) . "\n");
			fwrite($handle, "email:" . trim($_POST[email]) . "\n");
			fwrite($handle, "ufid:" . trim($_POST[ufid]) . "\n");
			fwrite($handle, "major:" . trim($_POST[major]) . "\n");
			fwrite($handle, "sex:" . $_POST[sex] . "\n");
			fwrite($handle, "age:" . trim($_POST[age]) . "\n");
			fwrite($handle, "usertype:" . $_POST[user] . "\n");
			fwrite($handle, "username:" . trim($_POST[username]) . "\n");
			fwrite($handle, "question:" . $_POST[resetquestion] . "\n");
			fwrite($handle, "answer:". md5(strtolower(trim($_POST[answer]))) . "\n"); //stores the md5 hash of the secret answer
			fclose($handle);
			fwrite($handle1, "0"); //status 0 means successfully registered but not selected password
			fclose($handle1);
			fwrite($handle2, $_POST[username] . "\n" . trim($_POST[email]) . "\n");
			fclose($handle2);
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." register1.php succ");
                                        fwrite($handle, ">>\n");
                                } //succ == account successfully created
                                fclose($handle);
                        }
			echo "Your account has been successfully created.<br><br>";
			echo "You can now access your control options via the main login page.<br><br>";
			echo "<p class=front>You may next go to select your password or logout:</p>";
                        echo "<form class=register  method=post action=login.php>";
                        echo "<input type=hidden name=username value=" . $_POST[username] . ">";
                        echo "<input class=login type=submit value='Proceed for Password Selection'>";
                        echo "</form>";
                        echo "<form class=register  method=post action=adminlogout.php>"; 
                        echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                        echo "<input type=hidden name=control value=logout>";
                        echo "<input type=hidden name=login value=" . $_POST[username] . ">";
                        echo "<input class=login type=submit value='Logout'>";
                        echo "</form>";
			echo "<br><br><br><br><br><br><br><br><br><br>";
		}
	}
	else //something wrong in the form entry, ask user to retry
	{
		echo "Error in form entry! Fields in error are in yellow. Correct the errors and ReSubmit!<br><br>";
		echo "<form class=register method=post action=register1.php>";
		
		if(strcmp($_POST[firstname], "") == 0)
		{
			echo "First Name:<input class=error type=text name=firstname size=20 " . "value=" . $_POST[firstname] . ">";
		}
		else
		{
			echo "First Name:<input class=register type=text name=firstname size=20 " . "value=" . $_POST[firstname] . ">";		
		}
		
		if(strcmp($_POST[lastname], "") == 0)
		{	
			echo "Last Name (Surname):<input class=error type=text name=lastname size=20 " . "value=" . $_POST[lastname] . "><br>";
		}
		else
		{
			echo "Last Name (Surname):<input class=register type=text name=lastname size=20 " . "value=" . $_POST[lastname] . "><br>";
		}

		echo "<br>Note: Please do not add prefixes like Mr., Dr. etc. or suffixes like Jr., Sr., III etc as part of your first name";
		echo " or last name. Also keep your <u>last name</u> entry a <u>single word</u> only otherwise there might be a problem accessing your";
		echo "class records later on. No such restrictions apply for General Survey User. Still having questions, contact your TA.<br>";
				
		if((strcmp($_POST[email], "") == 0) || (substr_count($_POST[email], "@") != 1) || (substr_count($_POST[email], ".") < 1) || $status3 == 1)
		{
			if($status3 == 1)
				echo "<br><font color=red>** Possibly invalid email address. Found no mail servers for this address.  **</font><br>";
			echo "Contact Email:<input class=error type=text name=email size=35 " . "value=" . $_POST[email] . ">";
		}
		else
		{
			echo "<br>Contact Email:<input class=register type=text name=email size=35 " . "value=" . $_POST[email] . ">";		
		}
		
		if(strlen($_POST[ufid]) != 8)
		{
			echo "UF-ID [8 digits]:<input class=error type=text name=ufid size=8 maxlength=8 " . "value=" . $_POST[ufid] . "><br>";
		}
		else
		{
			echo "UF-ID [8 digits]:<input class=register type=text name=ufid size=8 maxlength=8 " . "value=" . $_POST[ufid] . "><br>";
		}
		
		if(strcmp($_POST[major], "") == 0)
		{
			echo "UF-Major (Your department's name or area of specialization):<input class=error type=text name=major size=17 " . "value=" . $_POST[major] . "><br>";
		}
		else
		{
			echo "UF-Major (Your department's name or area of specialization):<input class=register type=text name=major size=17 " . "value=" . $_POST[major] . "><br>";
		}
		
		echo "<br>";
		echo "Gender:";
		echo "<select class=contact name=sex size=1>";
		if(strcmp($_POST[sex], "m") == 0)
		{
			echo "<option value=m selected>Male";
		}
		else
		{
			echo "<option value=m>Male";
		}
		if(strcmp($_POST[sex], "f") == 0)
		{
			echo "<option value=f selected>Female";
		}
		else
		{
			echo "<option value=f>Female";
		}
		echo "</select>";
		
		if(strcmp($_POST[age], "") == 0)
		{
			echo "Your Age:<input class=error type=text name=age size=3 " . "value=" . $_POST[age] . ">";
		}
		else
		{
			echo "Your Age:<input class=register type=text name=age size=3 " . "value=" . $_POST[age] . ">";
		}
		
		echo "Purpose of use:";
		if($status2 == 1)
		{
			echo "<select class=error name=user size=1>";
		}
		else
		{
			echo "<select class=contact name=user size=1>";
		}

		$array = explode(":", trim($regchoice));
        	for($i=0; $i<count($array); $i++)
        	{
                	$array1 =  explode(",",trim($array[$i]));
                	if(count($array1) == 2)
                	{
                        	if(strcmp($_POST[user],$array1[1]) == 0) echo "<option value='" . $array1[1] . "' selected>" . $array1[0];
                        	else echo "<option value='" . $array1[1] . "'>" . $array1[0];
                	}
        	}
		/*
		if(strcmp($_POST[user], "general") == 0)
		{
			echo "<option value=general selected>General Survey User";
		}
		else
		{
			echo "<option value=general>General Survey User";
		}
		if(strcmp($_POST[user], "cop5615fa06") == 0)
		{
			echo "<option value=cop5615fa06 selected>Fall 2006 COP5615 User";
		}
		else
		{	
			echo "<option value=cop5615>Fall 2006 COP5615 User";
		}
		*/
		echo "</select><br><br>";
		
		if(($status == 1) || (strcmp($_POST[username], "") == 0))
		{
			if($status == 1)
			{
		 		echo "<font color=red>*** THIS USERNAME IS ALREADY IN USE! SELECT ANOTHER USERNAME ***</font><br>";
		 	}
			echo "Select a Username (use letters and numbers only):<input class=error type=text name=username size=27 value=" . $_POST[username] . ">";
		}
		else
		{
			echo "Select a Username (use letters and numbers only):<input class=register type=text name=username size=27 value=" . $_POST[username] . ">";		
		}
		
		echo "<br><br>";
		echo "Please select a security question:";
		echo "<select class=contact name=resetquestion size=1>";
		if(strcmp($_POST[resetquestion], "birth") == 0)
		{	
			echo "<option value=birth selected>Place of Birth";
		}
		else
		{
			echo "<option value=birth>Place of Birth";
		}
		if(strcmp($_POST[resetquestion], "color") == 0)
		{	
			echo "<option value=color selected>Favorite Color";
		}
		else
		{
			echo "<option value=color>Favorite Color";
		}
		if(strcmp($_POST[resetquestion], "superhero") == 0)
		{	
			echo "<option value=superhero selected>Favorite Superhero";
		}
		else
		{
			echo "<option value=superhero>Favorite Superhero";
		}
		if(strcmp($_POST[resetquestion], "school") == 0)
		{	
			echo "<option value=school selected>Name of First School";
		}
		else
		{
			echo "<option value=school>Name of First School";
		}
		echo "</select><br>";
		
		if(strcmp($_POST[answer],"")==0 || strcmp($_POST[answer1],"")==0 || (strcmp(strtolower($_POST[answer]),strtolower($_POST[answer1]))!=0))
		{
		echo "<br><font color=red>*** ANSWERS PROVIDED DO NOT MATCH ***</font><br>";
		echo "Answer to Security Question (use no spaces):<input class=error type=password name=answer size=24 value=" . $_POST[answer] . "><br>";
		echo "Please reconfirm the answer (use no spaces):<input class=error type=password name=answer1 size=24 value=".$_POST[answer1]."><br><br>";
		}
		else
		{
		echo "Answer to Security Question (use no spaces):<input class=register type=password name=answer size=24 value=" . $_POST[answer]. "><br>";
		echo "Please reconfirm the answer (use no spaces):<input class=register type=password name=answer1 size=24 value=" . $_POST[answer1];
		echo "><br><br>";
		}
		echo "<br><br>";
		echo "<input class=login type=submit value='Click to ReSubmit'>";
		echo "</form>";
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
