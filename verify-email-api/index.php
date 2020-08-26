<?php
/**
 * Verify Email API for Chatbot
 * Created by Ali Imran Mohamed
 * Website: https://www.fb.com/aliimran.mhd
 */

session_id($_POST['messenger_user_id']); // create a session id using {{messenger user id}}
session_start();

// replace with your own email address
$from = "no-reply@yourdomain.com";

// send verification code to this email address
$to = $_POST['userEmail'];

$subject = 'Verify Email API for Chatbot';

// 6 digits random number
$_SESSION["challenge_code"] = generateRandomNumber(6); // can generate up to 255

$message = $_SESSION["challenge_code"] . " is your 'Verify Email API' verification code. Don't reply to this email.";

$headers = "From: " . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// send mail
mail($to, $subject, $message, $headers);

function generateRandomNumber($length = 255)
{

    return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);

}
