<html>
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
<p class=front>
<?php
        //initializing variables here
        $configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        $enablelog = "";
        $redirect = "";
        $keyfile = "";
        $enablesurvey1 = "";
        $enablesurvey2 = "";
        $enablesurvey3 = "";
        $enablesurvey4 = "";
        while(!feof($handle) && $handle)
        {
                $line = trim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablelog") > 0) $enablelog = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "redirect") > 0) $redirect = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "keyfile") > 0) $keyfile = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablesurvey1") > 0) $enablesurvey1 = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablesurvey2") > 0) $enablesurvey2 = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablesurvey3") > 0) $enablesurvey3 = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablesurvey4") > 0) $enablesurvey4 = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        $adminfile = "";
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
        if(strlen($keyfile) < 4)
                $keyfile = "/cise/homes/pharsh/ssl_key/my_server.key";
	if(strcmp($_POST[choice], "adminverify") != 0)
	{
 			$homework = $basepath . "/tmp/";
                        echo "<br><br><form class=register enctype=multipart/form-data method=post action=verify.php>";
                        echo "<input type=hidden name=choice value=adminverify>";
                        echo "<input type=hidden name=directory value=" . $homework . ">";
                        echo "<input type=hidden name=MAX_FILE_SIZE value=2000000>";
                        echo "FILE to Verify  <input class=general  name=userfile type=file> ";
                        echo "Submitted As: <select class=contact name=uploadtype size=1>";
                        echo "<option value=proj1>Project 1";
                        echo "<option value=proj2>Project 2";
                        echo "<option value=proj3>Project 3";
                        echo "<option value=proj4>Project 4";
                        echo "<option value=proj5>Project 5";
                        echo "</select><br><br>";
			echo "Paste Confirm# <input class=general type=text name=confirm size=42><br><br>";
			echo "Student's UFID: <input class=general type=text name=ufid size=8>";
                        echo " <input class=login type=submit value='CLICK to Verify'>";
                        echo "</form>";
	}
	else
	{
			$uploaddir = $_POST[directory];
                        $uploadfile = basename($_FILES['userfile']['name']);
                        $file_extension = strtolower(substr(strrchr($uploadfile,"."),1));
                        $uploadedfile = $uploadfile;
                        $uploadfile = $_POST[uploadtype] . "-" . $_POST[ufid] . "." . $file_extension;
                        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile))
                        {
                                $timestamp = substr($_POST[confirm],32);
				echo "<br><br><b>According to confirmation# this file was uploaded on: " . date("F d Y H:i:s.",$timestamp) . "<br>";
                                $contents = file_get_contents($uploaddir . $uploadfile);
                                $secretkey = file_get_contents($keyfile);
                                $confirmation = md5($contents . $secretkey . $uploadfile . $timestamp) . $timestamp;
                                echo "<br>File Upload Confirmation #: <br><font color=red><b>" . $confirmation . "</b></font><br><br>";
				echo "This is the Upload Confirmation # provided by you on the previous page:<br>";
				echo $_POST[confirm] . "</b><br><hr>";
				echo "<b>STATUS OF VERIFICATION OPERATION: ";
				if(strcmp($_POST[confirm], $confirmation) == 0)
				{
					echo "<font color=green>SUCCESS</font>";
				}
				else
				{
					echo "<font color=red>FAILURE</font>";
				}
				echo "</b>";
                        }
                        else
                        {
                                echo "<br>Upload Failed!";
                        }
	}
?>
</p>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<b><a href="verify.php">BACK TO VERIFICATION PAGE</a></b> 
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
