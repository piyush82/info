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
	$filename = $basepath . "tmp/" . $_COOKIE["IBASession"];
	if(file_exists($filename) && is_file($filename)) unlink($filename);
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//	$sec = 0;
//        header("Refresh: $sec; url=" . $redirect);
//	exit(0);
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
<!-- Created on: 6/7/2006 -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>UF-IBA: SURVEY PAGE - Login / Register</title>
  <meta name="description" content="IBA Survey">
  <meta name="keywords" content="UF, IBA, CISE">
  <meta name="author" content="root">
  <meta name="generator" content="Bluefish 1.0.5">	
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script language="JavaScript">
  <!--
  function openvideo() {
  	window.open("video.html","","toolbar=0,location=0,directories=0,menuBar=0,scrollbars=0,resizable=0,width=525,height=429,left=100,top=50");
  }
  function openflash() {
        window.open("demo.html","","toolbar=0,location=0,directories=0,menuBar=0,scrollbars=0,resizable=0,width=525,height=429,left=100,top=50");
  }
  //-->
<!--
var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

function setAlert()
{
	if(BrowserDetect.browser == "Explorer")
	{
		alert("This feature has not been tested for older versions of IE! \nReport any errors to Webmaster.");
	}
}
//-->
  </script>
</head>
<body bgcolor=#330066>
<table align="center" valign="center" border="0" width="800" bgcolor="white">
<tr><td colspan="2"><img src="banner.jpg" vspace="0">

<tr>
<td width=540 height=400 valign="top" align="left" background="white">
<p class="front">Welcome SURVEY user!</p>	
<p class="front">	
Thank you for taking part in University of Florida - Image based Authentication - User Survey.
This study has been designed to help the researchers find critical usage data and accepability
of an IBA System. In a nutshell an IBA System is a authentication module that lets the user
gain access to any system based on his/her image password rather than usual text based passwords.
</p> 
<p class="front">	
To find out more about the rationale behind such a system you are encouraged to read our research
paper which appeared in IEEE International Carnahan Conference on Security Technologies held in
Las Palmas, Spain in October 2005. <a href="http://www.cise.ufl.edu/~nemo/papers/Carnahan2005.pdf">
Here is the link to the document</a>.
</p> 
<p class="inst">	
Before you start here are the basic instructions:
</p> 
<ol type="i" class="inst">
<li>Please make sure you provide us with accurate information while registering. This will help us
contact you in case we need to send you any system reminders.<br><br>
<li>After you have selected your image password set, please familiarize yourself about our IBA system
by doing many training rounds before you are sure you understand the system and also you are quite
sure that you know your image set.<br><br>
<li>Make sure that you train till at least you have succeeded in successfully authenticating yourself
2 consecutive times. 
</ol>
<p class="front">
Click <a href="#top" onClick="alert('Please be patient! The browser is downloading a 35 Mb video and it may take some time.'); openvideo()">here</a> 
to see the whole process in action. Requires browser support for Windows Media Player. Or right click and choose Save target as ... to download the  
<a href="http://www.cise.ufl.edu/research/mix/survey/demo.mpg" target="_blank">media (35.4 Mb)</a> file. Also you may watch the low resolution
flash (best for dialup connection) version of the video <a href="#top" onClick="openflash()">here</a>.
</p>
<td width=260 valign="top" background="login-back.jpg">
	<table class="stylish" valign="center" align="center" width="99%"> 
	<tr><td>
	<p class="justify">
	Registered UF-IBA User:
	<form class="login" method="post" action="login.php"> 
		Username: <input class="login" type="password" name="username" size="19">
		<input class="login" type="submit" value="GO"><br>
		Is this a public terminal? 
		Yes <input class="login" type="radio" value="yes" name="publicopen" onClick="setAlert();">
		No <input class="login" type="radio" value="no" name="publicopen" checked>
	</form>	
	</p>
	<p class="justify">
	Not Registered! <a href="register.php">Click here</a>.<br>
	Forgot Your Password? <a href="passreset.php">Click here</a>.<br>
	Forgot Your Username? <a href="getuname.php">Click here</a>.
	</p>
	</table> <br>
	<table class="stylish2" valign="center" align="center" width="99%"> 
	<tr><td>
	<p class="justify">
	UF-IBA Administrator:
	<form class="login" method="post" action="admin.php"> 
		Username: <input class="admin" type="text" name="login" size="19"><br>
		Password : <input class="login" type="password" name="password" size="19">
		<input class="login" type="submit" value="GO">
	</form>
	</p>
	</table>
	<br><br><br>  
	<p align="center">
	<b><a href="contact.html">CONTACT US</a></b><br> 
	<b><a href="./help/">UF-IBA FAQs</a></b>
	</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
