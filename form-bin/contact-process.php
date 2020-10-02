<?php

date_default_timezone_set('America/New_York');
$today = date("F j, Y, g:i a");

if ((isset($_POST['contactfirstname'])) && (strlen(trim($_POST['contactfirstname'])) > 0)) {
	$contactfirstname = stripslashes(strip_tags($_POST['contactfirstname']));
} else {$contactfirstname = 'No First name entered';}

if ((isset($_POST['contactlastname'])) && (strlen(trim($_POST['contactlastname'])) > 0)) {
	$contactlastname = stripslashes(strip_tags($_POST['contactlastname']));
} else {$contactlastname = 'No Last name entered';}

if ((isset($_POST['contactphone'])) && (strlen(trim($_POST['contactphone'])) > 0)) {
	$contactphone = stripslashes(strip_tags($_POST['contactphone']));
} else {$contactphone = 'No phone entered';}

if ((isset($_POST['contactemail'])) && (strlen(trim($_POST['contactemail'])) > 0)) {
	$contactemail = stripslashes(strip_tags($_POST['contactemail']));
} else {$contactemail = 'No email address entered';}

if ((isset($_POST['contactaddress'])) && (strlen(trim($_POST['contactaddress'])) > 0)) {
	$contactaddress = stripslashes(strip_tags($_POST['contactaddress']));
} else {$contactaddress = 'No phone entered';}

if ((isset($_POST['contactiama'])) && (strlen(trim($_POST['contactiama'])) > 0)) {
	$contactiama = stripslashes(strip_tags($_POST['contactiama']));
} else {$contactiama = 'No I am a... was entered';}

if ((isset($_POST['contactcomments'])) && (strlen(trim($_POST['contactcomments'])) > 0)) {
	$contactcomments = stripslashes(strip_tags($_POST['contactcomments']));
} else {$contactcomments = 'No comments entered';}




function spamcheck($field)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }
  
ob_start();
?>


<html>
<head>
<style type="text/css">
</style>
</head>
<body>
<table width="550" border="1" cellspacing="2" cellpadding="2">
  <tr bgcolor="#f6f4f1">
    <td>First Name</td>
    <td><?=$contactfirstname;?></td>
  </tr>
  <tr bgcolor="#f1eef0">
    <td>Last Name</td>
    <td><?=$contactlastname;?></td>
  </tr>
  <tr bgcolor="#f1eef0">
    <td>Phone</td>
    <td><?=$contactphone;?></td>
  </tr>
  <tr bgcolor="#f6f4f1">
    <td>Email</td>
    <td><?=$contactemail;?></td>
  </tr>
  <tr bgcolor="#f6f4f1">
    <td>Address</td>
    <td><?=$contactaddress;?></td>
  </tr>
  <tr bgcolor="#f6f4f1">
    <td>I am a...</td>
    <td><?=$contactiama;?></td>
  </tr>
  <tr bgcolor="#f6f4f1">
    <td>Comments</td>
    <td><?=$contactcomments;?></td>
  </tr>
  <tr bgcolor="#f1eef0">
    <td>Date &amp; Time</td>
    <td><?=$today?></td>
  </tr>
  
</table>
</body>
</html>

<?

$mailcheck = spamcheck($_REQUEST['contactemail']);
  if ($mailcheck==FALSE)
    {
    echo "Invalid input";
    }
  else
    {//send email
		$body = ob_get_contents();
		
		
		require("class.phpmailer.php");
		
		$mail = new PHPMailer();
		
		$mail->From     = 'testemail@design446.com';  
		$mail->FromName = "Design 446 - Impactship";
		
		//$mail - Enter emails to 
		
		
		
		$mail->AddAddress("testemail@design446.com","Design 446 - Impactship");
		$mail->AddReplyTo($_REQUEST['contactemail']);
	
		$mail->AddBcc("mcarlino@design446.com","Design446 - Impactship");
		// $mail->AddBcc("design446@gmail.com","Design446 - Impactship");
		
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		
		$mail->Subject  =  "Design 446 - Impactship";
		$mail->Body     =  $body;
		$mail->AltBody  =  "This is the text-only body";
		
					$data = $_POST['contactfirstname'].",";
					$data .= $_POST['contactlastname'].",";
					$data .= $_POST['contactphone'].",";
					$data .= $_POST['contactemail'].",";
					$data .= $_POST['contactaddress'].",";
					$data .= $_POST['contactiama'].",";
					$data .= $_POST['contactcomments'].",";
					$data .= $today."\n\r";
		
		$fh = fopen("emails-register.csv", "a");
		fwrite($fh, $data);
		fclose($fh);
		
		if(!$mail->Send()) {
				$recipient = 'mcarlino@design446.com';
				$subject = 'Contact form failed';
				$content = $body;	
				mail($recipient, $subject, $content, "From: mcarlino@design446.com\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
			  exit;
				}
}

?>


