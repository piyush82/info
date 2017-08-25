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
                //echo "Found the file\n\n";
                //exit(0);
        }
        fclose($handle);
        $adminfile = "";
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        if(strlen($redirect) < 4)
                $redirect = "https://www.cise.ufl.edu/~pharsh/iba/";
Header("Cache-control: private, no-cache");
Header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
Header("Pragma: no-cache");
Header("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "admin.php");
//        exit(0);
//}
?>
<html>
<!-- Created on: 6/12/2006 -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>UF-IBA: SURVEY PAGE - Admin Login</title>
  <META http-equiv="expires" content="0">
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
	
	//checking for valid username
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
		if(strcmp(trim($_POST[login]), $pieces[0]) == 0)
		{
			$status = 1;
			break;
		}
	}
	fclose($handle);
	if($status == 0)
	{
		echo "You have no admin privilages. Please contact the administrator or your TA supervisor.<br>";
		if(strcmp($enablelog, "yes") == 0)
		{
			$handle = fopen($basepath . "log/global.log", "a"); //open the global log file
			if($handle)
			{
				fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." admin.php iusr>>\n");
			} //iusr == invalid username
			fclose($handle);
		}
	}
	else //here verify for the password
	{			
		if(strlen($_POST[sessionid]) == 0)
		{					   
			//$passpath =  "/cise/homes/pharsh/public_html/private/iba_data/password/admins/" . $_POST[login];
			$passpath =  $basepath . "password/admins/" . trim($_POST[login]);
			$handle = fopen($passpath, "r");
			if(!$handle)
			{
				echo "Error! Try Again or contact system administrator! Error Code: 001<br>";
				exit(0);
			}
			$password = rtrim(fgets($handle));
			if(strcmp($_POST[password], $password) == 0 || strcmp(md5($_POST[password]), $password) == 0)
			{
				if(strcmp($_POST[password], $password) == 0) //ask the admin to change the password now
				{
					echo "Please change your password now: <br>";
					$currtime = time();
					$sessionid = md5($currtime);
					//$tempfile = "/cise/homes/pharsh/public_html/private/iba_data/tmp/" . $sessionid;
					$tempfile = $basepath . "tmp/" . $sessionid;
					fopen($tempfile, "w");
					fclose($tempfile);
					echo "<form class=register method=post action=admin.php>";
					echo "<input type=hidden name=sessionid value=" . $currtime . ">";
					echo "<input type=hidden name=login value=" . $_POST[login] . ">";
					echo "New Password: <input class=register type=password name=password size=25><br>";
					echo "Reconfirm Password: <input class=register type=password name=confirm size=20><br><br>";
					echo "<input class=login type=submit value='Change My Password'>";
					echo "</form>";
				}
				else //display control panel here now
				{
					echo "You are now Logged On. Your have admin rights for <font color=red>" . $pieces[1] . "</font><br>";
					//show controls for uploading roster, gradesheet and for checking out files and viewing the gradesheet and roster
					$currtime = time();
                                        $sessionid = md5($currtime);
                                        //$tempfile = "/cise/homes/pharsh/public_html/private/iba_data/tmp/" . $sessionid;
					$tempfile = $basepath . "tmp/" . $sessionid;
                                        fopen($tempfile, "w");
                                        fclose($tempfile);
					if(strcmp(trim($_POST[login]), "admin") == 0)
					{
						echo "<form class=register name=autoform method=post action=admincontrol.php>";
                                        	echo "<input type=hidden name=sessionid value=" . $currtime . ">"; 
                                        	echo "<input type=hidden name=control value=admin>";
                                        	echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
						echo "</form>";
						echo "<SCRIPT LANGUAGE=JavaScript>";
						echo "setTimeout('document.autoform.submit()',500);";
						echo "</SCRIPT>";
						exit(0);
					}
					echo "<br><fieldset class=admin>";
					echo "<legend><b>File Upload Choices</b></legend>";
                                        echo "<form class=register enctype=multipart/form-data method=post action=adminprocess.php>";
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
					echo "<input type=hidden name=control value=uploadroster>";
                                        echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
    					echo "<input type=hidden name=MAX_FILE_SIZE value=1000000>";
    					echo "Upload Class Roster [CSV File]:  <input class=general  name=userfile type=file>";
                                        echo " <input class=login type=submit value='Process Request'>";
                                        echo "</form>";      
                                        echo "<form class=register enctype=multipart/form-data method=post action=adminprocess.php>";
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        echo "<input type=hidden name=control value=uploadgradebook>";
                                        echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
                                        echo "<input type=hidden name=MAX_FILE_SIZE value=1000000>";
                                        echo "Upload Gradebook [CSV File]:  <input class=general name=userfile type=file size=21>";
                                        echo " <input class=login type=submit value='Process Request'>";
                                        echo "</form>";
                                        echo "</fieldset><br>";
					echo "<fieldset class=admin>";
                                        echo "<legend><b>Viewing Choices</b></legend>";
                                        echo "<form class=register  method=post action=viewfile.php target='_blank'>";
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        echo "<input type=hidden name=control value=viewfile>";
					echo "<input type=hidden name=directory value=" . $pieces[1] . ">";
                                        echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
					echo "View Class Roster <input class=general type=radio name=filename value=roster>";
					echo " View Gradebook <input class=general type=radio name=filename value=gradebook checked>";
                                        echo " <input class=login type=submit value='Process Request'>";
                                        echo "</form>";
                                        echo "</fieldset><br>";
					echo "<fieldset class=admin>";
                                        echo "<legend><b>Checking Out Choices</b></legend>";
                                        echo "<form class=register  method=post action=checkout.php>";                           
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        echo "<input type=hidden name=control value=checkout>";
					echo "<input type=hidden name=directory value=" . $pieces[1] . ">";
                                        echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
                                        echo "Checkout Class Roster <input class=general type=radio name=filename value=roster>"; 
                                        echo " Checkout Gradebook <input class=general type=radio name=filename value=gradebook checked>";
                                        echo " <input class=login type=submit value='Process Request'>";    
                                        echo "</form>";
                                        echo "</fieldset><br>";
					echo "<fieldset class=admin>";
					echo "<legend><b>Communication Options</b></legend>";
					//$gradebook = "/cise/homes/pharsh/public_html/private/iba_data/" . $pieces[1] . "/".$pieces[1]."-gradebook.csv";
					$gradebook = $basepath . $pieces[1] . "/" . $pieces[1] ."-gradebook.csv";
					if(file_exists($gradebook))
					{
						$handle = fopen($gradebook, "r");
						$header = 0;
						$array;
						$loc_ufid = 0;
						$loc_fname = 0;
						$loc_lname = 0;
						$loc_email = 0;
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
					if(strcmp(strtolower(trim(rtrim(ltrim(trim($array[$i]), "\""),"\""))),"first name") == 0) $loc_fname=$i;
					if(strcmp(strtolower(trim(rtrim(ltrim(trim($array[$i]), "\""),"\""))),"last name") == 0) $loc_lname =$i;
								}
								if($loc_ufid != -1 && $loc_email != -1 && $loc_fname != -1 && $loc_lname != -1)
								{
									$header = 1;
								echo "Select multiple people for sending email by using Ctrl-key and left Mouse-Click<br>";
									echo "<br>Send Email To:<br><select class=contact name=emailto[] multiple=multiple"; 
									echo " size=5>";
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
							echo "<option value=" . ltrim(rtrim($broadcast, ","), ",") . ">BROADCAST EMAIL TO ALL";
							echo "</select><br><br>";
							echo "Subject: <input class=contact name=subject size=46><br>";
							echo "Type Your Message Below:<br>";
							echo "<textarea class=contact cols=53 rows=5 name=message></textarea>";
						}
						fclose($handle);
						echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        	echo "<input type=hidden name=control value=communicate>";
                                        	echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
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
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
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
					echo "No Results to Display yet ...";
					echo "</fieldset><br>";
					echo "<form class=register  method=post action=adminlogout.php>";
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        echo "<input type=hidden name=control value=logout>";
                                        echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
                                        echo " <input class=login type=submit value='Logout'>";
                                        echo "</form>";
				}
			}
			else
			{
				echo "Invalid Password! Please try again.<br>";
				if(strcmp($enablelog, "yes") == 0)
                		{
                        		$handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                        		if($handle)
                        		{
                        	        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." admin.php wpas>>\n");
                        		} //wpas == wrong password
                        		fclose($handle);
                		}
			}
			fclose($handle);
		}
		else
		{
			//change of password effected here
			//$sessionfile = "/cise/homes/pharsh/public_html/private/iba_data/tmp/" . md5($_POST[sessionid]);
			$sessionfile = $basepath ."tmp/" .  md5($_POST[sessionid]);
			if(file_exists($sessionfile))
			{
				unlink($sessionfile);
				if(strcmp($_POST[password], $_POST[confirm]) == 0)
				{
					//$passpath =  "/cise/homes/pharsh/public_html/private/iba_data/password/admins/" . $_POST[login];
					$passpath =  $basepath . "password/admins/" . trim($_POST[login]);
                        		$handle = fopen($passpath, "w");
                        		$password = md5($_POST[password]);
					fputs($handle, $password);
					fclose($handle);
					echo "Password Changed Successully! Go to Login Page to access your control options.<br>";
				}
				else
				{
					echo "Passwords does not match. Try again.<br>";
					$currtime = time();
                                        $sessionid = md5($currtime);
                                        //$tempfile = "/cise/homes/pharsh/public_html/private/iba_data/tmp/" . $sessionid;
					$tempfile = $basepath . "tmp/" . $sessionid;
                                        fopen($tempfile, "w");
                                        fclose($tempfile);
                                        echo "<form class=register method=post action=admin.php>";
                                        echo "<input type=hidden name=sessionid value=" . $currtime . ">";
                                        echo "<input type=hidden name=login value=" . trim($_POST[login]) . ">";
                                        echo "New Password: <input class=register type=password name=password size=25><br>";
                                        echo "Reconfirm Password: <input class=register type=password name=confirm size=20><br><br>";
                                        echo "<input class=login type=submit value='Change My Password'>";
                                        echo "</form>";
				}
			}
			else
			{
				if(strcmp($enablelog, "yes") == 0)
                                {
                                        $handle = fopen($basepath . "log/global.log", "a"); //open the global log file
                                        if($handle)
                                        {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." admin.php invs>>\n");
                                        } //invs == invalid session
                                        fclose($handle);
                                }
				echo "Invalid Session! Try Again.<br>";
				$sec = 2;
        			header("Refresh: $sec; url=" . $redirect);
        			exit(0);
			}
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
