<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('en', 'phpmailer/language/');
	$mail->IsHTML(true);


	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'istvan.mbox@gmail.com';                     //SMTP username
	$mail->Password   = 'sitnphjwjmiqrinp';                               //SMTP password
	$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
	$mail->Port       = 587;                 


	//Від кого лист
	$mail->setFrom('istvan.mbox@gmail.com', 'Istvan Capfel'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('thorns@ukr.net'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'E-mail from test';

	//Тіло листа
	
	$Body = '<h1>Hi! It`s Test!</h1>';

	if(trim(!empty($_POST['email']))){
	$Body .= "<p>E-mail: <strong>".$_POST['email']."</strong></p>";
}
	if(trim(!empty($_POST['name']))){
	$Body .= "<p>Name: <strong>".$_POST['name']."</strong></p>";
}
	if(trim(!empty($_POST['tel']))){
	$Body .= "<p>Phone: <strong>".$_POST['tel']."</strong></p>";
}
	if(trim(!empty($_POST['message']))){
	$Body .= "<p>Message: <strong>".$_POST['message']."</strong></p>";
}

	$mail->Body = $Body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>