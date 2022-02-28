<?php

//resend_email_otp.php

include('database_connection.php');
@include('class/smtp_class/class.phpmailer.php');

$message = '';

session_start();

if(isset($_SESSION["user_id"]))
{
	header("location:home.php");
}

if(isset($_POST["resend"]))
{
	if(empty($_POST["user_email"]))
	{
		$message = '<div class="alert alert-danger">Email Address is required</div>';
	}
	else
	{
		$data = array(
			':user_email'	=>	trim($_POST["user_email"])
		);

		$query = "
		SELECT * FROM register_user 
		WHERE user_email = :user_email
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		if($statement->rowCount() > 0)
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				if($row["user_email_status"] == 'verified')
				{
					$message = '<div class="alert alert-info">Email Address already verified, you can login into system</div>';
				}
				else
				{
					
					
					
					

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
					$mail->AddAddress("halim.akyol47@gmail.com","");  
					$mail->Subject = "Deneme"; 
					$mail->AddReplyTo('halim.akyol47@gmail.com');
					$mail->isHTML	(true); 
					$mail->Body  	= "Body";
					$mail->AltBody  = '';
					if(!$mail->Send()) {
						echo '<pre>';
						echo '<code>';
							print_r($mail);
						echo '</code>';
						echo '</pre>';
					}  else {}
					// Smtp Test // Smtp Test



					####################
					/*
					require 'class/class.phpmailer.php';
					$mail = new PHPMailer;
					$mail->IsSMTP();
					$mail->SMTPKeepAlive=true;
					$mail->SMTPAuth=true;
					$mail->SMTPSecure='tls';
					$mail->Port=80;
					$mail->Host="smtp.gmail.com";
					$mail->Username="halim.akyol47@gmail.com";
					$mail->Password="1905185414";
					$mail->setFrom("halim.akyol47@gmail.com","Abdulhalim AKYOL");
					$mail->AddAddress("halim.akyol47@gmail.com","Abdulhalim AKYOL");
					$mail->IsHTML(true);
					$mail->Subject = 'Verification code for Verify Your Email Address';
					$message_body = '
					<p>For verify your email address, enter this verification code when prompted: <b>'.$row["user_otp"].'</b>.</p>
					<p>Sincerely,</p>
					';
					$mail->Body = $message_body;

					if($mail->Send())
					{
						echo '<script>alert("Please Check Your Email for Verification Code")</script>';
						echo '<script>window.location.replace("email_verify.php?code='.$row["user_activation_code"].'");</script>';
					}
					else
					{

					}
					*/
					####################




				}
			}
		}
		else
		{
			$message = '<div class="alert alert-danger">Email Address not found in our record</div>';
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Resend Email Verification OTP in PHP Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="http://code.jquery.com/jquery.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Resend Email Verification OTP in PHP Registration</h3>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Resend Email Verification OTP</h3>
				</div>
				<div class="panel-body">
					<?php echo $message; ?>
					<form method="post">
						<div class="form-group">
							<label>Enter Your Email</label>
							<input type="email" name="user_email" class="form-control" />
						</div>
						<div class="form-group">
							<input type="submit" name="resend" class="btn btn-success" value="Send" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<br />
		<br />
	</body>
</html>