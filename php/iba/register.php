<?php
        //initializing variables here
        //$configfile = "/cise/homes/pharsh/public_html/private/iba_data/config.ini";
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
//        header("Refresh: $sec; url=" . $redirect . "register.php");
//        exit(0);
//}
setcookie("IBASession", "", time() - 3600);
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
<p class="front">Welcome Visitor! Please provide correct details for registration. We may use
the contact details provided by you in order to provide you timely system reminders. Your details
will not be shared with any third party. We strictly follow UF-privacy guidelines. <u>If you are not
associated with UF</u>, please use <b>00000000</b> in the UF-ID field and <b>NONE</b> in the UF-Major field. 
</p> 
<form class="register" method="post" action="register1.php">
First Name:<input class="register" type="text" name="firstname" size="20">
Last Name (Surname):<input class="register" type="text" name="lastname" size="20"><br>

<br>Note: Please do not add prefixes like Mr., Dr. etc. or suffixes like Jr., Sr., III etc as part of your first name or last name.
Also keep your <u>last name</u> entry a <u>single word</u> only otherwise there might be a problem accessing your class records later on.
No such restrictions apply for General Survey User. Still having questions, contact your TA.<br><br>

Contact Email:<input class="register" type="text" name="email" size="35">
UF-ID [8 digits]:<input class="register" type="text" name="ufid" size="8" maxlength="8"><br>
UF-Major (Your department's name or area of specialization):<input class="register" type="text" name="major" size="17"><br>
<br>
Gender:
<select class="contact" name="sex" size=1>
<option value="m">Male
<option value="f" selected>Female
</select>
Your Age:<input class="register" type="text" name="age" size="3">
Purpose of use:
<select class="contact" name="user" size=1>
<?php
	$configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        $enablelog = "";
        $redirect = "";
	$regchoice = "";
        while(!feof($handle) && $handle)
        {
                $line = trim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablelog") > 0) $enablelog = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "redirect") > 0) $redirect = trim(substr($line, strrpos($line,"=") + 1));
		if(substr_count($line, "regchoice") > 0) $regchoice = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
	$array = explode(":", trim($regchoice));
	for($i=0; $i<count($array); $i++)
	{
		$array1 =  explode(",",trim($array[$i]));
		if(count($array1) == 2)
		{
			if($i == 0) echo "<option value='" . $array1[1] . "' selected>" . $array1[0];
			else echo "<option value='" . $array1[1] . "'>" . $array1[0];
		}
	}
?>
</select><br><br>
Select a Username (use letters and numbers only):<input class="register" type="text" name="username" size="27">
<br><br>
Please select a security question:
<select class="contact" name="resetquestion" size=1>
<option value="birth">Place of Birth
<option value="color">Favorite Color
<option value="superhero">Favorite Superhero
<option value="school">Name of First School
</select><br>
Answer to Security Question (use no spaces):<input class="register" type="password" name="answer" size="24"><br>
Please reconfirm the answer (use no spaces):<input class="register" type="password" name="answer1" size="24"><br><br>
<br><br>
<input class="login" type="submit" value="Click to Submit">
</form>
<p class="front">
Please make sure you have provided correct ufid. In case you are using this authentication
system to access your grades providing wrong ufid will result in registration failure. Security
question will help you reset your password in case you have forgotten it.
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
