<?php
$to      = 'atnerio@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: noreply@kiranxray.com' . "\r\n" .
    'Cc: raju.solanki@kiranxray.com' . "\r\n";
    'Reply-To: noreply@kiranxray.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>