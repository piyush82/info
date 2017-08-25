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
if(strcmp($_COOKIE["IBASession"], md5($_POST[sessionid])) == 0 || file_exists($filename)) //valid session
{
	if(strcmp($_POST[control], "logout") == 0)
        {
		setcookie("IBASession", "", time() - 3600);
	}
	else if(strcmp($_POST[control], "endtraining") == 0)
        {
                setcookie("IBASession", "", time() - 3600);
        }
	if(file_exists($filename)) unlink($filename);        
}
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "adminlogout.php");
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
<p class="front">You have been successfully logged out!<br><br>
We recommend you close your browser. Closing your browser will help clearing the cache and maintain security and privacy of documents.
</p>
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
	if(strcmp($_POST[control],"endtraining") == 0)
	{
		$statusfile = $_POST[statusfile];
		$handle = fopen($statusfile, "w");
                if($handle) fwrite($handle, "2"); //status 2 means training has been finished
		else echo "<br>** Filesystem Error! Contact system admin or your TA. Error Code 004 **<br>";
                fclose($handle);
	}
	if(strcmp($enablelog, "yes") == 0)
        {       
		$handle;
		if(strlen($_POST[login]) < 1) 
       			$handle = fopen($basepath . "log/global.log", "a"); //open the log file
		else
			$handle = fopen($basepath . "log/" . $_POST[login] . ".log", "a"); //open the log file            
               	if($handle)         
              	{         
                	fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]);
                      	fwrite($handle, " % " . $_POST[login] . " adminlogout.php lout>>\n");
                } //lout == session logged out     
             	fclose($handle);         
        }
	echo "<br><div style='font-size:14px;font-family:Verdana;color:orange;'><b>Redirecting to home page in 2 seconds ...</b></div>";
	$sec = 2;
 	header("Refresh: $sec; url=" . $redirect);
      	//exit(0);
?>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<b><a href="index.php">BACK TO MAIN PAGE</a></b><br>
<b><a href="contact.html">CONTACT US</a></b>
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>

