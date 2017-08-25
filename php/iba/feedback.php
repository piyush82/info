<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>UF-IBA: SURVEY PAGE - Feedback Confirmation</title>
  <meta name="description" content="IBA Survey">
  <meta name="keywords" content="UF, IBA, CISE">
  <meta name="author" content="Piyush Harsh">
  <meta name="generator" content="AceHTML 6 Pro">	
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body bgcolor=#330066>
<table align="center" valign="center" border="0" width="800" bgcolor="white">
<tr><td colspan="2"><img src="banner.jpg" vspace="0">
<tr>
<td width=540 height=400 valign="top" align="left">
<p class="front">
<?php	 
		$email = "pharsh@cise.ufl.edu";
		if(strcmp($_POST[receiver], "pi") == 0)
		{
			$email = "nemo@cise.ufl.edu";
		}
		else
		{
			$email = "pharsh@cise.ufl.edu";
		}
		if(strlen(trim($_POST[firstname]))>0&&strlen(trim($_POST[surname]))>0&&strlen(trim($_POST[email]))>0&&strlen(trim($_POST[comments]))>0)
		{
			$valid = 1;
			$parts = explode("@", $_POST[email]);
        		$host = "%^&";
        		if(count($parts) == 2) $host = $parts[1] . ".";
			else $valid = 0;
        		if(getmxrr($host, $mxhosts))
        		{
				
        		}
        		else $valid = 0;
			if($valid == 0)
			{
				echo "** Possibly incorrect email address ** <br><br> No valid email server found for that address. <br><br>";
				echo "Please provide a valid email and try again!";
			}
			else
			{
				$message = "Sender: " . trim($_POST[firstname]) . " " . trim($_POST[surname]) . "\n";
				$message = $message . "Sender's Email: " . trim($_POST[email]) . "\n\n";
				$message = $message . "Message: " . "\n" . trim($_POST[comments]) . "\n\n";
				$message = $message . "IP:PORT " . $_SERVER["REMOTE_ADDR"] . ":" . $_SERVER["REMOTE_PORT"];
				$message = wordwrap($message, 70);
				$subject = "UF-IBA Visitor Feedback";
				$headers = 'From: UF-IBA-SYSTEM' . "\r\n" . 'Reply-To: ' . $_POST[email]  . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				mail($email, $subject, $message, $headers);
				echo "<br><br>Your Message Has Been Sent Successfully.<br><br><br><br><br><br><br>";
			}
		}
		else
		{
			echo "** One or more of the form fields had no entry. **";
			echo "<br><br>Please fill the contact form completely and try again!";
		}
?>
<br><br><br><br>
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
