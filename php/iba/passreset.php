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
//        header("Refresh: $sec; url=" . $redirect . "passreset.php");
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
</head>
<body bgcolor=#330066>
<table align="center" valign="center" border="0" width="800" bgcolor="white">
<tr><td colspan="2"><img src="banner.jpg" vspace="0">

<tr>
<td width=540 height=400 valign="top" align="left" background="white">
<p class="front">Welcome registered IBA-survey user!</p>
<form class="register" method="post" action="reset.php">
Enter Your Username:<input class="register" type="text" name="username" size="27">
<br><br>
Please select a security question:
<select class="contact" name="question" size=1> 
<option value="birth">Place of Birth
<option value="color">Favorite Color
<option value="superhero">Favorite Superhero
<option value="school">Name of First School
</select><br>
Answer to Security Question (use no spaces):<input class="register" type="password" name="answer" size="24"><br><br>
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
	$currtime = time();
	$sessionid = md5($currtime);
	$tempfile = $basepath . "tmp/" . $sessionid;
	fopen($tempfile, "w");
	fclose($tempfile);
	echo "<input type=hidden name=sessionid value=" . $currtime . ">";
?>
<input class="login" type="submit" value="Click to Submit">
</form>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<b><a href="index.php">BACK TO MAIN PAGE</a></b><br>
<b><a href="contact.html">CONTACT US</a></b>
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
