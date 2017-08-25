<?php
Header("Cache-control: private, no-cache");
Header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
Header("Pragma: no-cache");
Header("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
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
//        header("Refresh: $sec; url=" . $redirect . "checkout.php");
//        exit(0);
//}
$filename = $basepath . "tmp/" .  md5($_POST[sessionid]);
if(strcmp($_COOKIE["IBASession"], md5($_POST[sessionid])) == 0 || file_exists($filename)) //valid session
{
		if(strcmp($_POST[control], "checkout") == 0)
                {
			$lockstatusfile = "";
			if(strcmp($_POST[filename],"roster") == 0)
			{
				$lockstatusfile = $basepath . $_POST[directory] . "/" . $_POST[directory] . "-roster.lck";
			}
			if(strcmp($_POST[filename],"gradebook") == 0)
			{
				$lockstatusfile = $basepath . $_POST[directory] . "/" . $_POST[directory] . "-gradebook.lck";
			}
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
                        	$filename = "";
                        	if(strcmp($_POST[filename],"roster") == 0)
                        	{
                        		$filename = $basepath . $_POST[directory] . "/" . $_POST[directory] . "-roster.csv";
                        	}
                        	elseif(strcmp($_POST[filename],"gradebook") == 0)
                        	{
                        		$filename = $basepath . $_POST[directory] . "/" . $_POST[directory] . "-gradebook.csv";
                        	}
				elseif(strcmp($_POST[filename],"userfile") == 0)
				{
					$filename = $_POST[filepath];
				}
                        	$filename = realpath($filename);
                        	$file_extension = strtolower(substr(strrchr($filename,"."),1));
                        	switch ($file_extension) {
                                	case "pdf": $ctype="application/pdf"; break;
                                	case "exe": $ctype="application/octet-stream"; break;
                                	case "zip": $ctype="application/zip"; break;
                                	case "doc": $ctype="application/msword"; break;
                                	case "xls": $ctype="application/vnd.ms-excel"; break;
                                	case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
                                	case "gif": $ctype="image/gif"; break;
                                	case "png": $ctype="image/png"; break;
                                	case "jpe": case "jpeg":
                                	case "jpg": $ctype="image/jpg"; break;
                                	default: $ctype="application/force-download";
                        	}
                        	if (!file_exists($filename)) {
                                	die("NO FILE HERE");
                        	}
				if(strcmp($_POST[filename],"roster") == 0 || strcmp($_POST[filename],"gradebook") == 0)  //update the lock status here
                        	{
                                	$handle = fopen($lockstatusfile, "w");
                                        if($handle) fwrite($handle, "locked " . $_POST[login] . " " . time() . "\n");
                                        fclose($handle);	  
                        	}
                        	header("Pragma: public");
                        	header("Expires: 0");
                        	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                        	header("Cache-Control: private",false);
                        	header("Content-Type: $ctype");
                        	header("Content-Disposition: attachment; filename=\"".basename($filename)."\";");
                        	header("Content-Transfer-Encoding: binary");
                        	header("Content-Length: ".@filesize($filename));
                        	set_time_limit(0);
				@readfile("$filename") or die("File not found.");
			}
			else
			{
				echo "Error! Checkout Failed! Class Roster state is locked! Checked out by " . $person . " on ";
				echo date("F d Y H:i:s.",$timestamp);
                                echo " Try again later. Go back to perform other operations.<br>";
        			//$sec = 2;
        			//header("Refresh: $sec; url=" . $redirect);
        			//exit(0);	
			}
		}
}
else
{
	echo "Invalid Session! Try login again...<br>";
	$sec = 2;
        header("Refresh: $sec; url=" . $redirect);
        exit(0);
}
?>
