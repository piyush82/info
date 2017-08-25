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
  <title>UF-IBA: Log Analysis - Control Panel</title>
  <meta name="description" content="IBA Survey">
  <meta name="keywords" content="UF, IBA, CISE">
  <meta name="author" content="root">
  <meta name="generator" content="Bluefish 1.0.5">      
  <link rel="stylesheet" type="text/css" href="">
</head>

<body bgcolor="navy">
<?php
        //initializing variables here
        $configfile = ltrim(rtrim(file_get_contents("configfile")));
        $handle = fopen($configfile, "r");
        $basepath = "";
        while(!feof($handle) && $handle)
        {
                $line = trim(fgets($handle));
                if(strncmp($line,"#",1) == 0) continue; //ignore lines starting with # as comments
                if(substr_count($line, "ibadata") > 0) $basepath = trim(substr($line, strrpos($line,"=") + 1));
        }
        fclose($handle);
        $adminfile = "";                                                                                          
        if(strlen($basepath) < 4)
                $basepath = "/cise/homes/pharsh/public_html/private/iba_data/";
        $logdir = $basepath . "log/cop5615/";
        $d = dir($logdir);
	echo "<form name=selection method=post action=loganalysis.php>";
	echo "<select name=filename size=1 style='font-family:Verdana;font-size:9px;color:navy;'>";
	echo "<option value=''>";
        while (false !== ($entry = $d->read()))
        {
                $filepath = $logdir . $entry;
		if(is_dir($filepath) == TRUE) continue;
		//echo $filepath . "<br>";
                $handle = fopen($filepath, "r");
                if($handle)
                {
			echo "<option value=" . $filepath . ">" . $entry . " Size:" . filesize($filepath) . " bytes";
                }
                fclose($handle);
        }       
	echo "</select>";
	echo " <input style='font-family:Verdana;font-size:9px;color:red;' type=submit value='Proceed'>";
       	echo "</form>";
	echo "<hr style='color:orange;'>";
	echo "<div style='position:relative;width:770px;height:500px;background:#006699;overflow:auto;' id=analysis>";
	if(strlen($_POST[filename]) > 10)
	{
		echo "<p style='font-family:Courier;font-size:8px;color:white;'>";
		$file = $_POST[filename];
		$handle = fopen($file, "r");
		while(!feof($handle) && $handle)
                {
			$line = trim(fgets($handle));
			echo $line . "<br>";
		}
		fclose($handle);
		echo "</p>";
	}
	echo "</div>";
?>
</body>
</html>
