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
	//unlink($filename); do not unlink file here, cookie set here first time so not accessible yet
}
else
{
	//invalid cookie
}
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "adminprocess.php");
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
  <title>UF-IBA: SURVEY PAGE - Admin Login</title>
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
	$keyfile = "";
        while(!feof($handle) && $handle)
        {
                $line = trim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "enablelog") > 0) $enablelog = trim(substr($line, strrpos($line,"=") + 1));
                if(substr_count($line, "redirect") > 0) $redirect = trim(substr($line, strrpos($line,"=") + 1));
		if(substr_count($line, "keyfile") > 0) $keyfile = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        $adminfile = "";
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
	if(strlen($keyfile) < 4)
                $keyfile = "/cise/homes/pharsh/ssl_key/my_server.key";
	$adminfile = $basepath . "admin-list";
        $handle = fopen($adminfile, "r");
        $status = 0;
        $pieces;
        while (!feof($handle) && $handle) {
                $line = trim(fgets($handle));
                $pieces = explode(" ", $line);
                if(strcmp($_POST[login], $pieces[0]) == 0)
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
	echo "You are now Logged On. Your have admin rights for <font color=red>" . $pieces[1] . "</font><br><br>";
	$uploaddir = $basepath . $pieces[1] . "/";
	$filename = $basepath . "tmp/" .  md5($_POST[sessionid]);
	if(file_exists($filename) || (strcmp($_COOKIE["IBASession"], md5($_POST[sessionid])) == 0 && !file_exists($filename))) //valid session
	{
		if(file_exists($filename)) unlink($filename);
		//continue processing
		echo "This session makes use of unique cookies to verify valididty. ";
		echo "Please make sure you close your browser at the end of your current session to preserve privacy and clear all the cookies<br>";
		echo "<br>Last Operation - ";
		//////////////////////
		if(strcmp($_POST[control], "uploadroster") == 0)
		{
			$lockstatusfile = $uploaddir . $pieces[1] . "-roster.lck";
			$status = "unlocked";
			$person = $_POST[login];
			$timestamp = "";
			if(file_exists($lockstatusfile) && is_file($lockstatusfile))
			{
				$lockstatus = trim(file_get_contents($lockstatusfile));
				$lockarray = explode(" ", $lockstatus);
				if(count($lockarray) == 3) { $status = $lockarray[0]; $person = $lockarray[1]; $timestamp = $lockarray[2]; }
				else { $timestamp = time(); }
			}
			if(strcmp($status,"unlocked") == 0 || strcmp($person,$_POST[login]) == 0)
			{
				$uploadfile = basename($_FILES['userfile']['name']);
				echo "Uploaded File: " . $uploadfile . " Status:";
				$uploadfile = $pieces[1] . "-roster.csv";
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile))
				{
    					echo "File is valid, and was successfully uploaded.<br>";
					$handle = fopen($lockstatusfile, "w");
					if($handle) fwrite($handle, "unlocked " . $_POST[login] . " " . time() . "\n");
					fclose($handle);
					if(strcmp($enablelog, "yes") == 0)
                                	{        
                                        	$handle = fopen($basepath . "log/" . $_POST[login] . ".log", "a"); //open the log file            
                                        	if($handle)         
                                        	{         
                                                	fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]);
                                                	fwrite($handle, " % " . $uploadfile . " adminprocess.php uros>>\n");
                                        	} //uros == class roster uploaded successfully     
                                        	fclose($handle);         
                                	}
				}
				else
				{
    					echo "Upload Failed!<br>";
				}
			}
			else
			{
				echo "Upload Failed! Class Roster state is locked! Checked out by " . $person . " on " . date("F d Y H:i:s.",$timestamp);
				echo "<br>";
			}
		}
		if(strcmp($_POST[control], "uploadgradebook") == 0)
                {
			$lockstatusfile = $uploaddir . $pieces[1] . "-gradebook.lck";
                        $status = "unlocked";
                        $person = $_POST[login];
                        $timestamp = "";
                        if(file_exists($lockstatusfile) && is_file($lockstatusfile))   
                        {
                                $lockstatus = trim(file_get_contents($lockstatusfile));
                                $lockarray = explode(" ", $lockstatus);
                                if(count($lockarray) == 3) { $status = $lockarray[0]; $person = $lockarray[1]; $timestamp = $lockarray[2]; }
                                else { $timestamp = time(); }   
                        }
                        if(strcmp($status,"unlocked") == 0 || strcmp($person,$_POST[login]) == 0)
                        {
                        	$uploadfile = basename($_FILES['userfile']['name']);
                        	echo "Uploaded File: " . $uploadfile . " Status:";
                        	$uploadfile = $pieces[1] . "-gradebook.csv";
                        	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile))
                        	{
                                	echo " Successfully uploaded.<br>";
					$handle = fopen($lockstatusfile, "w");
                                        if($handle) fwrite($handle, "unlocked " . $_POST[login] . " " . time() . "\n");
                                        fclose($handle);
					if(strcmp($enablelog, "yes") == 0)
                                	{
                                        	$handle = fopen($basepath . "log/" . $_POST[login] . ".log", "a"); //open the log file
                                        	if($handle)
                                        	{
                                                	fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]);
                                                	fwrite($handle, " % " . $uploadfile . " adminprocess.php ugbk>>\n");
                                        	} //ugbk == class gradebook uploaded successfully
                                        	fclose($handle);
                                	}
                        	}     
                        	else
                        	{
                        	        echo "Upload Failed!<br>";
                        	}
			}
			else
                        {
                                echo "Upload Failed! Class Gradebook state is locked! Checked out by " . $person ." on ". date("F d Y H:i:s.",$timestamp);
                                echo "<br>";
                        }
                }
		if(strcmp($_POST[control], "communicate") == 0)
                {
			$emailto = "";
			for($i=0; $i < count($_POST[emailto]); $i++)
			{
				$emailto .= $_POST[emailto][$i] . ",";
			}
			$emailto = ltrim(rtrim($emailto, ","), ",");
			$subject = $_POST[subject];
			$message = wordwrap($_POST[message], 70);
			$headers = 'From: ' . $pieces[1] . ' alert' . "\r\n" . 'Reply-To: ' . "do-not-reply"  . "\r\n" . 'X-Mailer: PHP/'.phpversion();
			mail($emailto, $subject, $message, $headers);
                	echo "Your Message Has Been Sent Successfully to: ";
			$temp = explode(",", $emailto);
			for($i=0;$i<count($temp);$i++) echo $temp[$i] . " ";
			if(strcmp($enablelog, "yes") == 0)
                        {
                               	$handle = fopen($basepath . "log/" . $_POST[login] . ".log", "a"); //open the log file
                               	if($handle)
                               	{
                               		fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]);
                                      	fwrite($handle, " % " . $emailto . " adminprocess.php emls>>\n");	
                               	} //emls == successfully sent emails
                               	fclose($handle);
                        }
		}
		$verificationResult = "";
		if(strcmp($_POST[control], "fileverify") == 0)
                {
			echo "File Verification: See Results / Comments below.";
			$uploaddir = $_POST[directory];
                        $uploadfile = basename($_FILES['userfile']['name']);
                        $file_extension = strtolower(substr(strrchr($uploadfile,"."),1));
                        $uploadedfile = $uploadfile;
                        $uploadfile = $_POST[uploadtype] . "-" . $_POST[ufid] . "." . $file_extension;
                        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile))
                        {
                                $timestamp = substr($_POST[confirm],32);
				$verificationResult .= "According to provided data, this file was uploaded on: " . date("F d Y H:i:s.",$timestamp) . "<hr>";
				$contents = file_get_contents($uploaddir . $uploadfile);
                                $secretkey = file_get_contents($keyfile);
                                $confirmation = md5($contents . $secretkey . $uploadfile . $timestamp) . $timestamp;
                                $verificationResult .= "Submitted Confirmation #: <font color=black>" . $confirmation . "</font><br>";
                                $verificationResult .= "Generated Confirmation #: <font color=brown>";
                                $verificationResult .= $_POST[confirm] . "</font><hr>";
                                $verificationResult .= "STATUS OF VERIFICATION OPERATION: ";
                                if(strcmp($_POST[confirm], $confirmation) == 0)
                                {
                                        $verificationResult .= "<font color=green>SUCCESS</font>";
                                }
                                else
                                {
                                        $verificationResult .= "<font color=red>FAILURE</font>";
                                }
                                $verificationResult .= "";
                        }
                        else
                        {
                                $verificationResult .= "Upload Failed!";
                        }
		}
		//////////////////////
		echo "<br><br>What would you like to do next?<br><br>";
		echo "<fieldset class=admin>";
                echo "<legend><b>File Upload Choices</b></legend>";
                echo "<form class=register enctype=multipart/form-data method=post action=adminprocess.php>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=uploadroster>";
                echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                echo "<input type=hidden name=MAX_FILE_SIZE value=1000000>";
                echo "Upload Class Roster [CSV File]:  <input class=general  name=userfile type=file>";
                echo " <input class=login type=submit value='Process Request'>";
                echo "</form>";      
                echo "<form class=register enctype=multipart/form-data method=post action=adminprocess.php>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=uploadgradebook>";
                echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                echo "<input type=hidden name=MAX_FILE_SIZE value=1000000>";
                echo "Upload Gradebook [CSV File]:  <input class=general name=userfile type=file size=21>";
                echo " <input class=login type=submit value='Process Request'>";
                echo "</form>";
                echo "</fieldset><br>";
                echo "<fieldset class=admin>";
                echo "<legend><b>Viewing Choices</b></legend>";
                echo "<form class=register  method=post action=viewfile.php target='_blank'>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=viewfile>";
		echo "<input type=hidden name=directory value=" . $pieces[1] . ">";
                echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                echo "View Class Roster <input class=general type=radio name=filename value=roster>";
                echo " View Gradebook <input class=general type=radio name=filename value=gradebook checked>";
                echo " <input class=login type=submit value='Process Request'>";
                echo "</form>";
                echo "</fieldset><br>";
                echo "<fieldset class=admin>";
                echo "<legend><b>Checking Out Choices</b></legend>";
                echo "<form class=register  method=post action=checkout.php>";                           
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=checkout>";
		echo "<input type=hidden name=directory value=" . $pieces[1] . ">";
                echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                echo "Checkout Class Roster <input class=general type=radio name=filename value=roster>"; 
                echo " Checkout Gradebook <input class=general type=radio name=filename value=gradebook checked>";
                echo " <input class=login type=submit value='Process Request'>";    
                echo "</form>";
                echo "</fieldset><br>";
		echo "<fieldset class=admin>";
                echo "<legend><b>Communication Options</b></legend>";
                $gradebook = $basepath . $pieces[1] . "/" . $pieces[1] ."-gradebook.csv";
                if(file_exists($gradebook))
                {
                	$handle = fopen($gradebook, "r");
                	$header = 0;
                        $array;
                        $loc_ufid = -1;
                        $loc_fname = -1;
                        $loc_lname = -1;
                        $loc_email = -1;
                        $broadcast = "";
                      	echo "<form class=register method=post action=adminprocess.php>";
			while(!feof($handle) && $handle)
                        {
                        	$contents = rtrim(rtrim(trim(fgets($handle))), ",");
                                $count = substr_count($contents, ",");
                                if($count == 0) continue;
                                $array = explode(",", $contents);
                                if($header == 0) //this is the header line. process it to find the email and name and ufids
                                {
                               		for($i=0; $i < count($array); $i++)
                                        {
                                      	if(strcmp(strtolower(trim(rtrim(ltrim(trim($array[$i]), "\""),"\""))),"ufid") == 0) $loc_ufid = $i;
                                        if(strcmp(strtolower(trim(rtrim(ltrim(trim($array[$i]), "\""),"\""))),"email") == 0) $loc_email = $i;
                                        if(strcmp(strtolower(trim(rtrim(ltrim(trim($array[$i]), "\""),"\""))),"first name") == 0) $loc_fname = $i;
                                        if(strcmp(strtolower(trim(rtrim(ltrim(trim($array[$i]), "\""),"\""))),"last name") == 0) $loc_lname = $i;
                                        }
					if($loc_ufid != -1 && $loc_email != -1 && $loc_fname != -1 && $loc_lname != -1)
					{
						$header = 1;
                                      		echo "Select multiple people for sending email by using Ctrl-key and left Mouse-Click<br>";
                                     		echo "<br>Send Email To:<br><select class=contact name=emailto[] multiple=multiple size=5>";
                                      		continue;
					}
					else
					{	
						echo "Incompatible header or no header found! Check documentation for proper format!<br>";
					}
                            	}
				if($header == 1)
                                {
                                	$broadcast .= trim(rtrim(ltrim(trim($array[$loc_email]),"\""),"\"")) . ",";
                                      	echo "<option value=" . trim(rtrim(ltrim(trim($array[$loc_email]),"\""),"\"")) . "> UFID: ";
                                        if(strlen(trim(rtrim(ltrim(trim($array[$loc_ufid]),"\""),"\""))) != 8)
                                        {
						$diff = 8 - strlen(trim(trim(trim($array[$loc_ufid]),"\"")));
                                                $lead = "";
                                                for($i=0;$i<$diff;$i++) $lead = "0" . $lead;
                                        	echo $lead . trim(rtrim(ltrim(trim($array[$loc_ufid]),"\""),"\""));
                                        }
                                        else echo trim(rtrim(ltrim(trim($array[$loc_ufid]),"\""),"\""));
                                        echo " Name: " . trim(rtrim(ltrim(trim($array[$loc_fname]),"\""),"\"")) . " ";
                                        echo trim(rtrim(ltrim(trim($array[$loc_lname]),"\""),"\""));
                           	}
                   	}
                      	if($header == 1)
                        {
                      		echo "<option value=" . trim(ltrim(rtrim($broadcast, ","), ",")) . ">BROADCAST EMAIL TO ALL";
                            	echo "</select><br><br>";
                             	echo "Subject: <input class=contact name=subject size=46><br>";
                             	echo "Type Your Message Below:<br>";
                            	echo "<textarea class=contact cols=53 rows=5 name=message></textarea>";
                       	}
                      	fclose($handle);
                   	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                      	echo "<input type=hidden name=control value=communicate>";
                     	echo "<input type=hidden name=login value=" . $_POST[login] . ">";
                      	echo "<br><br><input class=login type=submit value='Process Request'>";   
                     	echo "</form>";
		}                              
                else
                {   
               		echo "Class gradebook not yet uploaded. Unable to setup communication options currently!<br>";
                }
		echo "</fieldset><br>";
		echo "<fieldset class=admin>";
		echo "<legend><b>File Verification Panel</b></legend>";
                echo "<form class=register enctype=multipart/form-data method=post action=adminprocess.php>";
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=fileverify>";
                echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
                $tmpdir = $basepath . "/tmp/";
                echo "<input type=hidden name=directory value=" . $tmpdir . ">";
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
                echo " <input class=login type=submit value='Click to Verify'>";
                echo "</form>";
                echo "</fieldset><br>";
                echo "<fieldset class=admin>";
                echo "<legend><b>File Verification Result</b></legend>";
		if(strcmp($_POST[control], "fileverify") == 0)
                {
			echo $verificationResult;
		}
		else
		{
                	echo "No Results to Display yet ...";
		}
                echo "</fieldset><br>";
		echo "<form class=register  method=post action=adminlogout.php>";       
                echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                echo "<input type=hidden name=control value=logout>";  
                echo "<input type=hidden name=login value=" . $_POST[login] . ">"; 
                echo " <input class=login type=submit value='Logout'>";                                  
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
