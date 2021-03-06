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
if(strcmp($_POST[choice],"n") == 0)
{
	setcookie("IBASession",md5($_POST[sessionid]),time() - 3600);
	echo "Redirecting to the home page!";
        $sec = 2;
        header("Refresh: $sec; url=" . $redirect);
        exit(0);
}
//if(strcmp($_SERVER["HTTPS"],"on")!=0)
//{
//        $sec = 0;
//        header("Refresh: $sec; url=" . $redirect . "authenticate.php");
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
  <script>
	var imgId=0;
	var bucketId=0;
	var imgCount=0;
	function change(imgId, bucketId)
	{
	<?php
	for($i=1; $i <=3; $i++)
	{
		for($j=1; $j <= 36; $j++)
		{
			echo "if(imgId==" . $j . " && bucketId==" . $i . ") {";
			if($j < 10)
			{
				echo "document.img" . $i . "0" . $j . ".src='images/bucket" . $i . "/sharp/0" . $j . ".jpg';";
				echo "document.original.src='images/bucket" . $i . "/sharp/0" . $j . ".jpg'; }";
			}
			else 
			{
				echo "document.img" . $i . $j . ".src='images/bucket" . $i . "/sharp/" . $j . ".jpg';";
				echo "document.original.src='images/bucket" . $i . "/sharp/" . $j . ".jpg'; }";
			}
		}
	}
	?>
	}
	function reset(imgId, bucketId)
	{
		document.original.src='blank.jpg';
	<?php
        for($i=1; $i <=3; $i++)
        {
                for($j=1; $j <= 36; $j++)
                {
                        echo "if(imgId==" . $j . " && bucketId==" . $i . ")";
                        if($j < 10) echo "document.img" . $i . "0" . $j . ".src='images/bucket" . $i . "/0" . $j . ".jpg';";
                        else echo "document.img" . $i . $j . ".src='images/bucket" . $i . "/" . $j . ".jpg';";
                }
        }
        ?>
	}
	<?php
	for($i=1; $i<=36; $i++) echo "var value" . $i . "=0;";
	?>
	function setborder(imgId, bucketId)
	{
		<?php
		for($i=1; $i <=3; $i++)
	        { 
	                for($j=1; $j <= 36; $j++)
	                {
	                        echo "if(imgId==" . $j . " && bucketId==" . $i . ") {"; //start of outermost if
				if($j < 10)
				{
					echo "if(value" . $j . "==1){";
					echo "document.img" . $i . "0" . $j . ".border='2';";
					echo "imgCount++;";
					echo "if(bucketId == 1)";
					echo "document.selection.img" . $j . ".value='images/bucket1/sharp/0" . $j . ".jpg';";
					echo "else if(bucketId == 2) document.selection.img" . $j . ".value='images/bucket2/sharp/0" . $j . ".jpg';";
					echo "else document.selection.img" . $j . ".value='images/bucket3/sharp/0" . $j . ".jpg';";
					echo "}";
					echo "else {";
					echo "document.img" . $i . "0" . $j . ".border='0';";
					echo "imgCount--;";
					echo "document.selection.img" . $j . ".value='';";
					echo "}";
				}
				else //$j >= 10
				{
					echo "if(value" . $j . "==0){";
					echo "document.img" . $i . $j . ".border='0';";
					echo "imgCount--;";
					echo "document.selection.img" . $j . ".value='';";
					echo "}";
					echo "else {";
					echo "document.img" . $i . $j . ".border='2';";
					echo "imgCount++;";
					echo "if(bucketId == 1)";
                                        echo "document.selection.img" . $j . ".value='images/bucket1/sharp/" . $j . ".jpg';";
                                        echo "else if(bucketId == 2) document.selection.img" . $j . ".value='images/bucket2/sharp/" . $j . ".jpg';";
                                        echo "else document.selection.img" . $j . ".value='images/bucket3/sharp/" . $j . ".jpg';";
					echo "}";
				}
				echo "}"; //close of outermost {
	                }
	        }
		?>	
	}
	function toggle(imgId, bucketId)
	{
	<?php
	for($i=1; $i<=36; $i++)
	{
		echo "if(imgId==" . $i . "){";
		echo "if(value" . $i . " == 0) value" . $i . " = 1;";
		echo "else value" . $i . " = 0;";
		echo "}";
	}
	?>
		setborder(imgId, bucketId);
	}
	function selectCount()
	{
		return ImgCount;
	}
	</script>
</head>
<body bgcolor=#330066>
<table align="center" valign="center" border="0" width="800" bgcolor="white">
<tr><td colspan="2"><img src="banner.jpg" vspace="0">
<tr>
<td width=540 height=400 valign="top" align="left" background="white">
<?php
	//initializing variables here
        $configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        $enablelog = "";
        $redirect = "";
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
	$userfile = $_POST[userfile];
	$handle = fopen($userfile, "r");
        $question = "";
        $answer = "";
	$bucket = 1;
        if(!$handle)
        {
        	echo "Error accessing your data. Contact system administrator. Error Code 002.<br>";
        }
        else
       	{
           	while(!feof($handle) && $handle)
               	{
                 	$line = trim(fgets($handle));
                     	if(substr_count($line, "question") > 0) $question = substr($line, strrpos($line,":") + 1);
                    	if(substr_count($line, "answer") > 0) $answer = substr($line, strrpos($line,":") + 1);
               	}
          	fclose($handle);
	}
	if(strcmp($_POST[nextbucket], "") == 0) $bucket = 0;
	else
	{
		$bucket = substr($_POST[nextbucket],0,1);
		if(strcmp($enablelog, "yes") == 0)
             	{
                  	$handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                      	if($handle)
                       	{
                       		fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." authenticate.php disp");
                           	fwrite($handle, " " . $bucket . ">>\n");
                     	} //disp == particular bucket screen displayed
                	fclose($handle);
            	}
	}
	//also randomize the image locations
	$shuffled = ""; $array;
	for($i=37;$i<=72;$i++) $shuffled .= chr($i);
	$shuffled = str_shuffle($shuffled);
	for($i=1; $i<=36; $i++)
	{
		$loc = ord(substr($shuffled, $i - 1, 1)) - 36;
		$array[$i] = $loc;
	}
	if($bucket == 0) //varify the chosen password
	{
	 	$passwordfile = $basepath . "password/" . $_POST[username];
		$handle = fopen($passwordfile, "r");
		$actualpassword;
		$index = 0;
		//echo "<p class=front>This is the actual password set that you had originally selected:</p>";
		while(!feof($handle) && $handle)
		{
			$readcontent = trim(fgets($handle));
			if(strlen($readcontent) > 8)
			{
				$actualpassword[$index] = $readcontent;
				$index++;
				//echo "<image src=" . $actualpassword[$index - 1] . " hspace=2 vspace=2 width=80 height=53>";
                                //if($index % 6 == 0) echo "<br>";
			}
		}
		fclose($handle);
		$temp = $_POST[selectedpass];
                for($i = 1; $i <=36; $i++)
                {
                        $var = "img" . $i;
                        if(strcmp($_POST[$var], "") != 0)
                        {
                                $count++;
                                $temp .= $_POST[$var] . ";";
                        }
                }
		$temp = rtrim($temp,";");
		$passarray = explode(";", $temp);
		/*
			echo "<p class=front>This is the password you selected just now [in no particular order]:</p>";
			$index = 0;
			for($i=0; $i < count($passarray); $i++)
                	{
				if(strlen($passarray[$i]) > 8)
				{
                  		      	echo "<image src=" . $passarray[$i] . " hspace=2 vspace=2 width=80 height=53>";
					$index++;
				}
                	        if($index % 6 == 0) echo "<br>";
                	}
		*/
		//now verify whether it was correct or not.
		for($i=0; $i < count($passarray); $i++)
		{
			for($j=0; $j < count($actualpassword); $j++)
			{
				if(strcmp($actualpassword[$j],$passarray[$i]) == 0)
				{
					$actualpassword[$j] = ""; $passarray[$i] = "";
				}
			}
		}
		$success = 1;
		//echo "<p class=front>Wrong Images selected by you this round:</p>";
		$index = 0;
		for($i=0; $i < count($passarray); $i++)
                {
                  	if(strcmp($passarray[$i],"") != 0)
                       	{
				$success = 0;
                         	//echo "<image src=" . $passarray[$i] . " hspace=2 vspace=2 width=80 height=53>";
				$index++;
                        	//if($index % 6 == 0) echo "<br>";       
                      	}
                }
		$extra = $index; //these are the extra images selected outside of pass set
		//echo "<p class=front>Images missed by you this round [from your password set]:</p>";
                $index = 0;
                for($i=0; $i< count($actualpassword); $i++)
                {
                        if(strcmp($actualpassword[$i],"") != 0)                         
                        {
				$success = 0;
                                //echo "<image src=" . $actualpassword[$i] . " hspace=2 vspace=2 width=80 height=53>";
                                $index++;
                                //if($index % 6 == 0) echo "<br>";
                        }
                }
		if($success == 0)
		{
			if(strcmp($enablelog, "yes") == 0)
                	{
                        	$handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file
                        	if($handle)
                        	{
                                	fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." authenticate.php fail");
					fwrite($handle, " missed " . $index . " extra " . $extra . ">>\n");
                        	} //fail == authentication failed $index ==  number of wrong images selected
                        	fclose($handle);
                	}
			echo "<p class=front>USER AUTHENTICATION <font color=red>FAILED!</font>. Try Again!</p>";
			echo "<p class=front>If you are not able to recall your password set even after multiple attempts please contact";
			echo " the TA / COURSE COORDINATOR / SYSTEM ADMIN for resetting your account. After your account has been reset";
			echo " you will have to reselect your password and undergo training sessions again.</p>";
			echo "<p class=front>Going to auto-logout mode in 10 seconds!</p>";
			echo "<form class=register name=autoform2 method=post action=adminlogout.php>";
                        echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
                        echo "<input type=hidden name=control value=logout>";
                        echo "<input type=hidden name=login value=" . $_POST[username] . ">";
                        echo "</form>";
			echo "<script language=Javascript>";
                        echo "setTimeout('document.autoform2.submit()',10000);";
                        echo "</script>";
		}
		else
		{
			if(strcmp($enablelog, "yes") == 0)
                        {
                                $handle = fopen($basepath . "log/" . $_POST[username] . ".log", "a"); //open the global log file      
                                if($handle)
                                {
                                        fwrite($handle, "<<".time()." ^ ".$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"]." authenticate.php succ");
                                        fwrite($handle, ">>\n");
                                } //succ == authentication succeeded
                                fclose($handle);
                        }
			echo "<p class=front>Welcome back " . $_POST[firstname] . " " . $_POST[lastname]  . "! Your last login attempt was made at: ";
			echo "<b>" . date("F d Y H:i:s.",$_POST[lastaccess]) . "</b> Choose from one of the options below or logout:</p>";
			//$userfile = "/cise/homes/pharsh/public_html/private/iba_data/users/" . $_POST[username];
			//$handle = fopen($userfile, "r");
			//$usertype = "";
			//while(!feof($handle))
                        //{
                        //        $line = rtrim(fgets($handle));
                        //        if(substr_count($line, "usertype") > 0) $usertype = substr($line, strrpos($line,":") + 1);
                        //}
                        //fclose($handle);
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
                                       echo "<input type=hidden name=surveyfile value=" . $basepath . "survey/survey" . $sno . "-". $_POST[username] .">";
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
					echo "<div align=center>You have taken survey ".$sno.". Thank You! No new survey planned at the moment ...</div>";
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
		}
	}
	else
	{
	 	echo "<p class=justify>Welcome " . $_POST[firstname] . " " . $_POST[lastname] . ". You are registered as <b>" . $_POST[usertype] . "</b> user.";
	 	echo "<br><br>Please select from the images below that you believe are in your password set. ";
		echo "You can select any number of image(s) per screen. <br><br><font color=red>";
		echo "If you have not chosen any image from the current image set just click on continue to move on to the next image set";
		echo " </font>.</p>";
	 	echo "<form class=register name=selection method=post action=authenticate.php>";
	 	echo "<input type=hidden name=firstname value=" . $_POST[firstname] . ">";
	 	echo "<input type=hidden name=lastname value=" . $_POST[lastname] . ">";
	 	echo "<input type=hidden name=username value=" . $_POST[username] . ">";
  	 	echo "<input type=hidden name=userfile value=" . $_POST[userfile] . ">";
	 	echo "<input type=hidden name=statusfile value=" . $_POST[statusfile] . ">";
	 	echo "<input type=hidden name=sessionid value=" . $_POST[sessionid] . ">";
		echo "<input type=hidden name=lastaccess value=" . $_POST[lastaccess] . ">";
	 	echo "<input type=hidden name=choice value=" . $_POST[choice] . ">";
	 	echo "<input type=hidden name=question value=" . $_POST[question] . ">";
	 	echo "<input type=hidden name=answer value=" . $_POST[answer] . ">";
		echo "<input type=hidden name=usertype value=" . $_POST[usertype] . ">";
	 	$count = 0;
	 	$temp = $_POST[selectedpass];
	 	for($i = 1; $i <=36; $i++)
	 	{
	  		$var = "img" . $i;
	  		if(strcmp($_POST[$var], "") != 0)
			{
				$count++;
				$temp .= $_POST[$var] . ";";
			}
		}
		echo "<input type=hidden name=nextbucket value=" . substr($_POST[nextbucket],1) . ">";
	 	echo "<input type=hidden name=selectedpass value=" . $temp . ">";
	 	for($i = 1; $i<=36; $i++) echo "<input type=hidden name=img" . $i . " value=''>";
	 	echo "Make your selection below and then <input class=general type=submit value='Continue'> to next screen.";
         	echo "</form>";
	 	//echo "<p class=login>Displaying Images from Bucket: " . $bucket . "</p>";
	 	echo "<table border=0 align=center><tr>";
	 	for($i = 1; $i<=36; $i++)
	 	{
			if($array[$i] < 10)
			{
				echo "<td><img name=img" . $bucket . "0" . $array[$i] . " src=images/bucket" . $bucket . "/0" . $array[$i] . 
				".jpg onMouseOver=change(" . $array[$i] . ","  . $bucket . "); onMouseOut=reset(" . $array[$i] . "," . 
				$bucket . "); onClick=toggle(" . $array[$i] . "," . $bucket . "); width=80 height=53 border=0  style='border-color:red;'>";
			}
			else
			{
			 	echo "<td><img name=img" . $bucket . $array[$i] . " src=images/bucket" . $bucket . "/" . $array[$i] . 
				".jpg onMouseOver=change(" . $array[$i] . "," . $bucket . "); onMouseOut=reset(" . $array[$i] . "," . 
				$bucket . "); onClick=toggle(" . $array[$i] . "," . $bucket . "); width=80 height=53 border=0 style='border-color:red;'>";
			}
			if(($i % 6 == 0) && ($i != 36)) echo "<tr>";
	 	}
	 	echo "</table>";
	} //end of else
?>
<td width=260 valign="center" background="login-back.jpg">
<p align="center">
<img name=original border=0 src=blank.jpg><br><br>
<b><a href="index.php">BACK TO MAIN PAGE</a></b> 
</p>
<tr><td colspan="2"><img src="footer.jpg" vspace="0">
</table>
</body>
</html>
</body>
</html>
