<?php 
echo '<meta charset="utf8" />';
@include('class/smtp_class/class.phpmailer.php');
	// Smtp Test // Smtp Test
	$mail = new PHPMailer();
	$mail->SetLanguage("tr", "../mail/language");
	$mail->CharSet  ="utf-8";
	$mail->Encoding ="base64";
	$mail->IsSMTP();                                   
	$mail->Host     = "smtp.gmail.com"; 
	$mail->SMTPDebug = 2; 
	$mail->SMTPAuth = true;   
	$mail->SMTPSecure = 'tls'; 
	$mail->Port = "587"; // ssl:465 tls : 587 
	$mail->Username = "halim.akyol47@gmail.com";    
	$mail->Password = "1905185414"; 
	$mail->SetFrom("halim.akyol47@gmail.com", "Abdulhalim AKYOL");
	$mail->Fromname = "HALİMDEN GELDİ";
	$mail->AddAddress($user_email,"");  
	$mail->Subject = 'Verification code for Verify Your Email Address'; 
	$message_body = '	<p>For verify your email address, enter this verification code when prompted: <b>'.$user_otp.'</b>.</p>
	<p>Sincerely,</p>
	';
	$mail->Body = $message_body;
	$mail->AddReplyTo('halim.akyol47@gmail.com');
	$mail->isHTML	(true); 
	$mail->AltBody  = '';
	if(!$mail->Send()) {
	// $message = $mail->ErrorInfo;
		echo 'mail gönderilemedi';
	}  else {
		header('location:email_verify.php?code='.$user_activation_code);
		echo '<script>alert("Please Check Your Email for Verification Code")</script>';
	}
	// Smtp Test // Smtp Test


?>