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
        unlink($filename);
}
else
{
        //invalid cookie
        echo "Invalid Session! Try ReLogin";
        $sec = 2;
        header("Refresh: $sec; url=" . $redirect);
        exit(0);
}
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "usercontrol.php");
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
	echo "Welcome " . $_POST[firstname] . " " . $_POST[lastname] . "! You are registered as a " . $_POST[usertype] . " user.<br>";
	if(strlen($_POST[iba]) > 2)
	{
		echo "<br>Performing IBA Control operation now ...<br>";
		if(strcmp($_POST[iba], "training") == 0) //re-enable training
		{
			$handle = fopen($_POST[statusfile], "w");
			if(!$handle) echo "Error accessing file. Contact system admin. Error 002.<hr>";
			else
			{
				fwrite($handle, "1");
				fclose($handle);
				echo "<br>Training has been successfully re-enabled! Next time you login, you will be undergoing training";
				echo " and you will be able to proceed once you have finished your training.<hr>";
			}
		}
		if(strcmp($_POST[iba], "password") == 0) //reset password
                {
                        $handle = fopen($_POST[statusfile], "w");
                        if(!$handle) echo "Error accessing file. Contact system admin. Error 002.<hr>";
                        else
                        {
                                fwrite($handle, "0");
                                fclose($handle);
                                echo "<br>Your password reselection has been enabled now! Next time you login, you will be asked to reselect your ";
				echo "password";
                                echo ". <font color=red>We highly recommend that you reselct your password immediately after logging out!</font>.";
				echo " This will ensure highest level of security for your account. Also you will have to undergo training as ususal";
				echo " before you are able to access your account!<hr>";
                        }
                }
		if(strcmp($_POST[iba], "account") == 0) //change account details
		{
			if(strcmp($_POST[verified], "false") == 0) //logout user here as chance of fraud
			{
				echo "<br><font color=red>Security Question / Answer does not match.</font> To maintain account privacy you are now";
				echo " being logged out. <b>Try relogin again and redo the operation.</b>";
				$sec = 3;
        			header("Refresh: $sec; url=" . $redirect);
        			exit(0);
			}
			elseif(strcmp($_POST[verified], "true") == 0) //generate the form
			{
			
			}
			else //check for security question and answer, if no match
			{
				echo "<br>Under Implementation ... <br>";
			}
		}
	}
	if(strlen($_POST[choice]) > 2)
	{
		$userfile = $basepath . "users/" . $_POST[username];
        	$handle = fopen($userfile, "r");
        	$lastname = "";
        	$ufid = "";
        	$email = "";
        	if(!$handle)
        	{ 
        	        echo "<br>Error accessing your data. Contact system administrator. Error Code 002.<hr>";
        	}
        	else
        	{
                	while(!feof($handle) && $handle)
                	{
                        	$line = trim(fgets($handle));
                        	if(substr_count($line, "lastname") > 0) $lastname = substr($line, strrpos($line,":") + 1);
                        	if(substr_count($line, "ufid") > 0) $ufid = substr($line, strrpos($line,":") + 1);
                        	if(substr_count($line, "email") > 0) $email = substr($line, strrpos($line,":") + 1);
                	}
                	fclose($handle);
        	}
		if(strcmp($_POST[choice], "grade") == 0) //show user's grades
		{
			$gradebook = $basepath . $_POST[usertype] . "/" . $_POST[usertype] ."-gradebook.csv";
			if(file_exists($gradebook))
                	{
                        	$handle = fopen($gradebook, "r");
                        	$header = 0;
                        	$array;
                        	$loc_ufid = -1;
                        	$loc_fname = -1;
                        	$loc_lname = -1;
                        	$loc_email = -1;
				$headerarray;
				$found = 0;
				while(!feof($handle) && $handle)
                        	{
					$contents = rtrim(rtrim(fgets($handle)), ",");
                                	$count = substr_count($contents, ",");
                                	if($count == 0) continue;
                                	$array = explode(",", $contents);
                                	if($header == 0) //this is the header line. process it to find the email and name and ufids
                                	{
						for($i=0; $i < count($array); $i++)
                                        	{
                                    	if(strcmp(strtolower(trim(rtrim(ltrim($array[$i], "\""),"\""))),"ufid") == 0) $loc_ufid = $i;
                                       	if(strcmp(strtolower(trim(rtrim(ltrim($array[$i], "\""),"\""))),"email") == 0) $loc_email = $i;
                                      	if(strcmp(strtolower(trim(rtrim(ltrim($array[$i], "\""),"\""))),"first name") == 0) $loc_fname = $i;
                                      	if(strcmp(strtolower(trim(rtrim(ltrim($array[$i], "\""),"\""))),"last name") == 0) $loc_lname = $i;
					$headerarray[$i] = strtolower(trim(rtrim(ltrim($array[$i], "\""),"\""))); //saving the header fields
                                        	}
                                        	if($loc_ufid != -1 && $loc_email != -1 && $loc_fname != -1 && $loc_lname != -1)
                                        	{
                                                	$header = 1;
                                                	continue;
                                        	}
                                        	else
                                        	{
                                        	        echo "<br>Incompatible header or no header found! Report this error to your TA!<hr>";
                                        	}
					}
					//access his grades here and display them
					if($header == 1)
					{//finding out next if the lastname in the class roster (which is a 1 word entry) is a part of user given data
					if(substr_count(strtolower($lastname), strtolower(trim(rtrim(ltrim(trim($array[$loc_lname]),"\""),"\"")))) > 0)
						{
							$fileufid = "";
							if(strlen(trim(rtrim(ltrim(trim($array[$loc_ufid]),"\""),"\""))) != 8)
							{
								$diff = 8 - strlen(trim(trim(trim($array[$loc_ufid]),"\"")));
								$lead = "";
								for($i=0;$i<$diff;$i++) $lead = "0" . $lead;
                                                		$fileufid =  $lead . trim(rtrim(ltrim(trim($array[$loc_ufid]),"\""),"\""));
							}
                                   			else $fileufid = trim(rtrim(ltrim(trim($array[$loc_ufid]),"\""),"\""));
							if(strcmp($ufid, $fileufid) == 0)
							{
								//display the grade values here ... exact match
								echo "<br>Here are your grades - [Information Valid Since: ";
								echo date("F d Y H:i:s.",filemtime($gradebook)) . "]";
								echo "<br><br>";
								//echo "<b><font style='color:white; background:black;'>";
								echo "<table border=0 style='border-style:dashed;border-color:green' bgcolor=white>";
								for($i=0;$i<count($headerarray);$i++)
								{
									if($i == $loc_ufid || $i == $loc_email || $i == $loc_fname || $i == $loc_lname)
										continue;
									if(strlen(trim(rtrim(ltrim(trim($array[$i]),"\""),"\""))) > 0)
									{
									if(strncmp(trim(rtrim(ltrim(trim($headerarray[$i]),"\""),"\"")), "##", 2) != 0)
									{
									//echo "[" . $headerarray[$i] . ": " . rtrim(ltrim($array[$i],"\""),"\"") . "]";
echo "<tr><td style='color:green;font-size:8pt;border-style:dashed;border-width:1px' width=100 align=center>" . $headerarray[$i]; 
echo "<td style='color:orange;font-size:8pt;border-style:dashed;border-width:1px' align=center width=50>" . trim(rtrim(ltrim($array[$i],"\""),"\""));
									}
									}
								}
								echo "</table>";
								//echo "</font></b>";
								$found = 1;
							}
						}
					}
				}
				if($found == 0)
				echo "<br><font color=red>** Error! Your registration data does not match with gradebook entries. Contact TA **</font><br>";
				echo "<hr>";
				fclose($handle);
			}
			else
                	{   
                		echo "<br>Class gradebook not yet uploaded. Unable to access your grade currently!<hr>";
                	}
		}
		if(strcmp($_POST[choice], "userupload") == 0)
		{
			
			$uploaddir = $_POST[directory];
			$uploadfile = basename($_FILES['userfile']['name']);
			$file_extension = strtolower(substr(strrchr($uploadfile,"."),1));
			$uploadedfile = $uploadfile;
                        $uploadfile = $_POST[uploadtype] . "-" . $ufid . "." . $file_extension;
                        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile))
                        {
				$timestamp = time();
                                echo "<br>File is valid, and was successfully uploaded.<br>";
				$contents = file_get_contents($uploaddir . $uploadfile);
				$secretkey = file_get_contents($keyfile);
				$confirmation = md5($contents . $secretkey . $uploadfile . $timestamp) . $timestamp;
				echo "<br>File Upload Confirmation #: <font color=red><b>" . $confirmation . "</b></font><br><br>";
				echo "In case of a system crash, this confirmation number will validate any later submissions made by you";
				echo " as a valid timely submission. Make sure you also save the file you just uploaded as proof of submission ";
				echo "along with this confirmation #. Make sure you do not later modify this file because modifications ";
				echo "will result in mismatch with the generated confirmation #.<br>";
				$subject = "Submission Confirmation";
				$headers = 'From: '.$_POST[usertype].' alert'."\r\n".'Reply-To:'. "do-not-reply"."\r\n".'X-Mailer:PHP/'.phpversion();
				$message = "Confirmation for submission made by " . $_POST[firstname] . " " . $_POST[lastname] . "\n\n";
				$message .= "Confirmation #: " . $confirmation . "\n\n";
				$message .= "Uploaded File: " . $uploadedfile . " File Saved As: " . $uploadfile . " on the remote server.\n\n";
				$message .= "Submission Time: " . date("F d Y H:i:s.",$timestamp) . "\n\n";
				$message .= "Please make sure you retain this email as a proof of your submission. Also make sure you ";
				$message .= "save the file you just uploaded safely for later re-validation in case of any future issues. ";
				$message .= "It is important that you do not modilfy your submitted file if this was your final submission. ";
				$message .= "Any future modifications will result in no-match with the above confirmation number.";
				$message = wordwrap($message, 70);
				$status = mail($email, $subject, $message, $headers);
				if($status)
				{
					echo "<br>A confirmation email was successfully sent at this address: " . $email . "<hr>";
				}
				else
				{
					echo "<br>There was some problem in sending the confirmation email. Make sure you save the above generated";
					echo " confirmation # and the submitted file.<hr>";
				}
                        }
                        else
                        {
                                echo "<br>Upload Failed!<hr>";
                        }
		}
		if(strcmp($_POST[choice], "upload") == 0)
		{
			$homework = $basepath . $_POST[usertype] . "/homework/";
			echo "<br>Please select the file you want to upload ... Also choose properly your submission type!<br>";
			echo "<form class=register enctype=multipart/form-data method=post action=usercontrol.php>";
			echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";
                	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";
                	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
                	echo "<input type=hidden name=usertype value=" . $_POST[usertype] . ">";
                	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
                	echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
                	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                	echo "<input type=hidden name=control value=student>";
                       	echo "<input type=hidden name=choice value=userupload>";
			echo "<input type=hidden name=directory value=" . $homework . ">";
                    	echo "<input type=hidden name=MAX_FILE_SIZE value=1000000>";
                        echo "File to upload:  <input class=general  name=userfile type=file> ";
			echo "Submit As: <select class=contact name=uploadtype size=1>";
			echo "<option value=hw1>Homework 1";
			echo "<option value=hw2>Homework 2";
			echo "<option value=hw3>Homework 3";
			echo "<option value=hw4>Homework 4";
			echo "<option value=hw5>Homework 5";
			echo "<option value=hw6>Homework 6";
			echo "<option value=hw7>Homework 7";
			echo "<option value=hw8>Homework 8";
			echo "<option value=proj1>Project 1";
			echo "<option value=proj2>Project 2";
			echo "<option value=proj3>Project 3";
			echo "<option value=proj4>Project 4";
			echo "<option value=proj5>Project 5";
			echo "</select>";
                        echo " <input class=login type=submit value='Proceed'>";
                        echo "</form><hr>";
		}
		if(strcmp($_POST[choice], "checkout") == 0)
		{
			$homework = $basepath . $_POST[usertype] . "/homework/";
			$dhandle = opendir($homework);
			$filearray; $count = 0;
			while (($file = readdir($dhandle)) !== false) {
                		if(strncmp($file, ".", 1) == 0 || strncmp($file, "..", 2) == 0)
                		{
                		}
                		else
                		{
                        		if(substr_count($file, $ufid) > 0)
					{
						$filearray[$count] = $file;
						$count++;
					}
                		}
        		}
        		closedir($dhandle);
			if(count($filearray) == 0)
			{
				echo "<br>No file(s) currently available for download!";
			}
			else
			{
				echo "<form class=register method=post action=checkout.php>";
				echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
				echo "<input type=hidden name=login value=" . $_POST[username] . ">";
				echo "<input type=hidden name=control value=checkout>";
				echo "<input type=hidden name=filename value=userfile>";
				echo "<br>Select the file you want to download: <select name=filepath size=1 class=contact>";
				for($i=0; $i < count($filearray); $i++)
				{
					echo "<option value=" . $homework . $filearray[$i] . ">" . $filearray[$i];
				}
				echo "</select>";
				echo " <input class=login type=submit value='Process Request'>";
				echo "</form>";
			}
			echo "<hr>";
		}
	}
	if(strcmp($_POST[control],"survey") == 0) //process the survey here
	{
		$filename = $_POST[surveyfile];
		$handle = fopen($filename, "w");
		$qcount = $_POST[qcount];
		if($handle)
		{
			fwrite($handle, "Timestamp: " . time() . "\n");
			for($i=1; $i<=$qcount; $i++)
			{
				fwrite($handle, $_POST[q . $i]);
				if($i % 5 == 0) fwrite($handle, "\n");
				else fwrite($handle, " ");
			}
			//fwrite($handle, $_POST[q1] . " " . $_POST[q2] . " " . $_POST[q3] . " " . $_POST[q4] . " " . $_POST[q5] . "\n");
			//fwrite($handle, $_POST[q6] . " " . $_POST[q7] . " " . $_POST[q8] . " " . $_POST[q9] . " " . $_POST[q10] . "\n");
			fwrite($handle, "\nComments: " . $_POST[comments] . "\n");
		}
		fclose($handle);
	}
	if(strcmp($_POST[control],"msgboard") == 0) //process the survey here
        {
		$msgfile = $_POST[msgfile];
		$handle = fopen($msgfile, "a");
		if(!$handle)
		{
			echo $msgfile . "<br><font color=red>** Error in accessing message board files. Contact your TA or try again **</font><br>";
		}
		else
		{
			$received = trim($_POST[message]);
			if(strlen($received) > 0)
			{
				$message = $_POST[firstname] . " " . $_POST[lastname] . " on " . date("F d Y H:i:s.",time()) . " said: ";
				$message .= "<font color=brown>" . $received . "</font>\n";
				//$message = wordwrap($message, 80);
				fwrite($handle, $message);
			}
			else
			{
				echo "<br>** Warning! Empty message can not be posted on the board **<br>";
			}
			fclose($handle);
		}
	}
	if(strcmp($_POST[usertype],"general") != 0)
        {
        	echo "<fieldset class=admin><legend><b>" . $_POST[usertype] . "</b> options</legend>";
            	echo "<form class=register name=selection method=post action=usercontrol.php>";
            	echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";  
              	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";    
               	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
            	echo "<input type=hidden name=usertype value=" . $_POST[usertype] . ">";    
              	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
              	echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
              	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
            	echo "<input type=hidden name=control value=student>";
         	echo "<input type=radio class=general name=choice value=grade>View Grades ";
              	echo "<input type=radio class=general name=choice value=checkout>Checkout HWs ";
               	echo "<input type=radio class=general name=choice value=upload>Submit HWs ";
            	echo "<input class=login type=submit value='Process Request'>";
              	echo "</form>";
              	echo "</fieldset>";
            	echo "<p class=front><u>Instructions:</u><br><br>While submitting a project or homework that contains multiple file";
              	echo " first tar all the files into a single tar file using the following command: <br><br>";
            	echo "<b>tar cvf [title.tar] [file list to tar]</b><br><br>Choose your filename appropriately. ";
            	echo "Name your file as HWx.pdf or PROJx.tar where 'x' is number such as 1, 2 .. and so on. Question / Answer type ";
              	echo "homeworks must be submitted as a pdf file and all programming projects must be submitted as a tar file ";
               	echo "containing all the source code along with the documentation file.</p><hr>";
		echo "<fieldset class=admin><legend><b>" . $_POST[usertype] . "</b> group discussion board</legend>";
              	echo "<div id=board ";
             	echo "style='position:relative;left:2px;width:540px;height:150px;color:black;"; 
             	echo "background:white;font-size:10px;font-family:Verdana;overflow:auto;'>";
              	$msgfile = $basepath . $_POST[usertype] . "/grpboard.msg";
              	if(!file_exists($msgfile)) echo "No messages found currently. Be the first to post ...";
		elseif(strlen(trim(file_get_contents($msgfile))) == 0) echo "No messages found currently. Be the first to post ...";
               	else
               	{
                	$handle = fopen($msgfile, "r");
                     	while(!feof($handle) && $handle)
                     	{
                        	$contents = trim(fgets($handle));
                             	echo "<div align=adjusted>" . $contents . "</div><br>";
                      	}
                     	fclose($handle);
              	}
              	echo "</div><br>";
             	echo "<form class=register name=selection method=post action=usercontrol.php>";
             	echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";
             	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";
             	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
             	echo "<input type=hidden name=usertype value=" . $_POST[usertype] . ">";
              	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
		echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";    
               	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";  
              	echo "<input type=hidden name=control value=msgboard>";   
              	echo "<input type=hidden name=msgfile value=" . $msgfile . ">";
              	echo "<textarea class=contact name=message cols=65 rows=3></textarea>";
              	echo " <input class=login type=submit value='Post Message'>";
               	echo "</form>";
               	echo "</fieldset>";
              	echo "<p class=front>Use this message board to discuss class related issues with your classmates.";
               	echo " This message board is mostly unmoderated but will be visited from time to time by TAs";
              	echo " to answer any particular concern if need arises.</p><hr>";
      	}
	echo "<fieldset class=admin><legend><b>User Survey</b> panel</legend>";
	$sno = 0;
       	if(strcmp($enablesurvey1, "yes") == 0) $sno = 1;
       	if(strcmp($enablesurvey2, "yes") == 0) $sno = 2;
      	if(strcmp($enablesurvey3, "yes") == 0) $sno = 3;
      	if(strcmp($enablesurvey4, "yes") == 0) $sno = 4;
      	if($sno != 0)
        {
		if(!file_exists($basepath . "survey/survey" . $sno . "-" . $_POST[username]))
                {
                	if(file_exists($basepath . "survey" . $sno . ".txt") && is_file($basepath . "survey" . $sno . ".txt"))
                     	{
                        	echo "Survey " . $sno . ": Please select the choice best reflecting your opinion.<br><br>";
                            	echo "<table width=530 border=0 align=left>";
                            	echo "<tr>";
                           	echo "<td bgcolor=black style='font-size:8pt;' align=center><font color=white><nobr>Question</nobr></font>";
                               	echo "<td bgcolor=black style='font-size:8pt;' align=center><font color=white><nobr>Strongly";
                               	echo "Disagree</nobr></font>";
                               	echo "<td bgcolor=black style='font-size:8pt;' align=center><font color=white><nobr>Disagree</nobr></font>";
                                echo "<td bgcolor=black style='font-size:8pt;' align=center><font color=white><nobr>Neutral</nobr></font>";
                              	echo "<td bgcolor=black style='font-size:8pt;' align=center><font color=white><nobr>Agree</nobr></font>";
                              	echo "<td bgcolor=black style='font-size:8pt;' align=center><font color=white><nobr>Strongly";
                              	echo "Agree</nobr></font>";
                               	echo "<form class=register name=selection0 method=post action=usercontrol.php>";
                            	$handle = fopen($basepath . "survey" . $sno . ".txt", "r");
                            	$qindex = 1;
                             	while(!feof($handle) && $handle)
                            	{
                                	$question = trim(fgets($handle));
                                     	if(strlen($question) > 0)
                                      	{
                                                echo "<tr>";
                                                echo "<td style='font-size:8pt;' bgcolor=brown><font color=orange>" . $question . "</font>";
                                                echo "<td align=center bgcolor=white><input type=radio class=general name=q" . $qindex . " value=1>";
                                                echo "<td align=center bgcolor=white><input type=radio class=general name=q" . $qindex . " value=2>";
                                                echo "<td align=center bgcolor=white><input type=radio class=general name=q" . $qindex . " value=3 checked>";
                                                echo "<td align=center bgcolor=white><input type=radio class=general name=q" . $qindex . " value=4>";
                                                echo "<td align=center bgcolor=white><input type=radio class=general name=q" . $qindex . " value=5>";
                                                $qindex++;
                                     	}
                              	}
				fclose($handle);
                            	echo "<tr>";
                            	echo "<td style='font-size:8pt;' bgcolor=brown><font color=white>Any other comments:</font>";
                             	echo "<td colspan=5 align=right><textarea name=comments cols=40 rows=3></textarea>";
                            	echo "<tr><td colspan=6 align=right>";
                            	echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";
                           	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";
                            	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
                            	echo "<input type=hidden name=usertype value=" . $_POST[usertype] . ">";
                            	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
                            	echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
                          	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                              	echo "<input type=hidden name=surveyfile value=" . $basepath . "survey/survey" . $sno . "-". $_POST[username] . ">";
                           	echo "<input type=hidden name=control value=survey>";
                              	echo "<input type=hidden name=qcount value=" . ($qindex - 1) . ">";
                            	echo "<br><input class=login type=submit value='Submit Survey'>";
                               	echo "</form></table>";
                   	}
			else
                    	{
                        	echo "<div align=center>Survey " . $sno . " file not found. Error! No new survey planned at the moment... </div>";
                      	}
                      	//create form and appropriate control values here also keep a textarea for comments by users
         	}
          	else
            	{
              		echo "<div align=center>You have taken survey " . $sno . ". Thank You! No new survey planned at the moment ...</div>";
           	}
        }
        else
        {
      		echo "<div align=center>No survey available currently ...</div>";
        }
        echo "</fieldset>";
	echo "<p class=front><font color=green>Please provide us with your honest opinion while taking the surveys</font>. ";
        echo "It has been designed to determine the usability and acceptance of the UF-IBA system and might help us ";
        echo "with further research and improving the system in future.</p>";
      	echo "<fieldset class=admin><legend><b>IBA Control</b> options</legend>";
      	echo "<form class=register name=selection1 method=post action=usercontrol.php>";
     	echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";
       	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";
       	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
      	echo "<input type=hidden name=usertype value=" . $_POST[usertype] . ">";                                                
       	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
      	echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
       	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
      	echo "<input type=hidden name=control value=general>";
     	echo "<input type=radio class=general name=iba value=training>Re-enable Training ";
      	echo "<input type=radio class=general name=iba value=password>Reset Password ";
	echo "<input type=radio class=general name=iba value=account>Change Registration ";      
    	echo "<input class=login type=submit value='Process Request'>";
       	echo "</form>";
	echo "</fieldset>";
      	echo "<p class=front>Note: IBA options will take effect next time you login. You will be prompted to reselect password ";
      	echo "or undergo training on your next login attempt based on the option selected.</p><hr>";
      	echo "<form class=register  method=post action=adminlogout.php>"; 
      	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
       	echo "<input type=hidden name=control value=logout>";
    	echo "<input type=hidden name=login value=" . $_POST[username] . ">";
      	echo "<input class=login type=submit value='Logout'>";
   	echo "</form>";
?>
</p>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<b><a href="index.php">BACK TO MAIN PAGE</a></b> 
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
</body>
</html>
