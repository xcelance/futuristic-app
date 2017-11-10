<?php

	//phpinfo()
	// echo mail("andsraj@gmail.com","Test","Hello");
	// echo mail("niraj.pathak@xcelance.com","Test","Hello");


// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// If you are using Composer (recommended)
	require 'vendor/autoload.php';
	// If you are not using Composer
	// require("path/to/sendgrid-php/sendgrid-php.php");
	$from = new SendGrid\Email("Example User", "niraj.pathak@xcelance.com");
	$subject = "Sending with SendGrid is Fun";
	$to = new SendGrid\Email("Example User", "niraj.pathak@xcelance.com");
	$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
	$mail = new SendGrid\Mail($from, $subject, $to, $content);
	$apiKey = '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';
	$sg = new \SendGrid($apiKey);
	$response = $sg->client->mail()->send()->post($mail);
	
	echo '<pre>'.$response->statusCode();
	print_r($response->headers());
	echo $response->body();
?>
