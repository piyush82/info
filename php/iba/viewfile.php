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
//        header("Refresh: $sec; url=" . $redirect . "viewfile.php");
//        exit(0);
//}
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
<body>
<table class=stylish2>
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
		if(strcmp($_POST[control], "viewfile") == 0)
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
                        $handle1 = fopen($filename, "r");          
                        $contents = "";
                        while(!feof($handle1) && $handle1)
                        {
				$contents = rtrim(fgets($handle1));
				$count = substr_count($contents, ",");
				echo "<tr>";
				if($count > 0)
				{
                                	$pieces = explode("," , $contents);
					//echo "Count: " . count($pieces) . "<br>";
					for($i=0; $i < count($pieces); $i++)
					{
						//echo $i . "<br>";
						echo "<td class=viewfile>" . $pieces[$i];
					}
				}
				else
				{
					echo "<td class=viewfile>" . $contents;
				}
                        }
                        fclose($handle1);
		}
	}
	else
	{
		echo "Invalid Session!";
	}
?>
</table>
</body>
</html>
