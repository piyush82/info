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
  <title>UF-IBA: SURVEY PAGE - Image Distribution</title>
  <meta name="description" content="IBA Survey">
  <meta name="keywords" content="UF, IBA, CISE">
  <meta name="author" content="root">
  <meta name="generator" content="Bluefish 1.0.5">      
  <link rel="stylesheet" type="text/css" href="styles.css">
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
	$passdir = $basepath . "password/cop5615/";
	$d = dir($passdir);
	$count = 0;
	$array[3][36];
	for($i=0; $i<3; $i++)
	{
		for($j = 0; $j < 36; $j++) $array[$i][$j] = 0;
	}
	echo "<table border=0 style='font-family:Verdana;font-size:9px;color:navy;'><tr><td>Progress:";
	while (false !== ($entry = $d->read()))
	{
		$filepath = $passdir . $entry;
		if(is_dir($filepath) == TRUE) continue;
		$handle = fopen($filepath, "r");
		while(!feof($handle) && $handle)
        	{
                	$line = trim(fgets($handle));
			if(substr_count($line,"bucket1") == 1)
			{
				$img = substr(trim(substr($line, strrpos($line,"/") + 1)),0,2);
				$array[0][$img - 1] += 1;
			}
			elseif(substr_count($line,"bucket2") == 1)
                        {
                                $img = substr(trim(substr($line, strrpos($line,"/") + 1)),0,2);
                                $array[1][$img - 1] += 1;
                        }
			elseif(substr_count($line,"bucket3") == 1)
                        {
                                $img = substr(trim(substr($line, strrpos($line,"/") + 1)),0,2);
                                $array[2][$img - 1] += 1;
                        }
		}
		fclose($handle);
		$count++;
		echo "<td width=5 bgcolor=black>";
	}	
	echo "<td>Files Processed: " . $count;
	echo "<td width=30><td bgcolor=brown style='color:white;'>(c) 2006 - Piyush Harsh : All Rights Reserved";
	echo "</table>";
	echo "<hr color=green>";
	echo "<table border=0 style='font-family:Courier;font-size:9px;color:red;'><tr><td>Image Distribution Frequency Chart:";
	echo "</table>";
	echo "<table border=0 align=left style='font-family:Verdana;font-size:9px;color:green;'>";
	for($i=0; $i<3; $i++)
        {
		echo "<tr><td><br>Bucket " . ($i + 1);
                for($j = 0; $j < 36; $j++)
		{
			if($j < 9) echo "<tr><td>" . "IMG0" . ($j + 1);
			else echo "<tr><td>IMG" . ($j + 1);
			for($k = 0; $k < $array[$i][$j]; $k++)
				echo "<td width=15 bgcolor=orange>";
			echo "<td>" . $array[$i][$j];
		}
        }
	echo "</table>";
	echo "<table border=0 bgcolor=navy cellspacing=2 style='font-family:Verdana;font-size:8px;color:black;position:absolute;left:600px;top:60px;'>";
	echo "<tr><td bgcolor=white>Image<td bgcolor=pink>Bucket 1<td bgcolor=pink>Bucket 2<td bgcolor=pink>Bucket 3";
	for($j = 0; $j < 36; $j++)
	{
		if($j < 9) echo "<tr><td bgcolor=white align=center>" . "IMAGE0" . ($j + 1);
		else echo "<tr><td bgcolor=white align=center>IMAGE" . ($j + 1);
		for($i = 0; $i < 3; $i++)
		{
			echo "<td bgcolor=yellow align=center>" . $array[$i][$j];
		}
	}
	echo "</table>";
	$imagepath = "images/";
	echo "<table border=0 bgcolor=navy cellspacing=2 style='font-family:Verdana;font-size:8px;color:black;position:absolute;left:830px;top:60px;'>";  
        echo "<tr><td bgcolor=white>Image<td bgcolor=pink>Bucket 1<td bgcolor=pink>Bucket 2<td bgcolor=pink>Bucket 3";
        for($j = 0; $j < 36; $j++)
        {
                if($j < 9) echo "<tr><td bgcolor=white align=center>" . "IMAGE0" . ($j + 1);
                else echo "<tr><td bgcolor=white align=center>IMAGE" . ($j + 1);
                for($i = 0; $i < 3; $i++)
                {
			$background = $imagepath . "bucket" . ($i+1) . "/sharp/";
			if($j < 9) $background .= "0" . ($j + 1) . ".jpg";
                	else $background .= ($j + 1) . ".jpg";
                        echo "<td align=center><img src=" . $background . " width=60 height=40>" ;
                }
        }
        echo "</table>";
?>
</body>
</html>
