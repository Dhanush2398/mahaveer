<?php

$name    = $_POST['name'];
$phone   = $_POST['phone'];
$email   = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$to = "kakrishnani208@gmail.com";
$subjectLine = "New contact from $name";

$txt = "
You have received a new contact form submission.

Name: $name
Phone: $phone
Email: $email
Subject: $subject
Message:
$message
";


$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "CC: kakrishnani208@gmail.com\r\n";


if(!empty($email)){
    mail($to, $subjectLine, $txt, $headers);
}

header("Location: thankyou.html");
exit;
?>
