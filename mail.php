<?php

namespace PHPMailer\PHPMailer;

include('PHPMailer/src/Exception.php');
include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/SMTP.php');



$phpmail = new PHPMailer();
// $phpmail->setFrom($_SESSION['Email'], $_SESSION['Club']);
$phpmail->setFrom("omega@univ-comores.km", "UDC");
$phpmail->Subject = "Dossier en instance";
// $phpmail->addAddress($_SESSION['Emails']);
$phpmail->addAddress($don["email"]);
// $phpmail->addAddress('pro.mchangama1998@gmail.com');
$phpmail->Body = "Bonjour,<br>".$message;
$phpmail->isHTML(true);

if ($phpmail->send()) {
        echo "Email envoye";
} else {
        echo "Email non envoye";
}
