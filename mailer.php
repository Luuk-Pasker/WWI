
<?php
include "includes/funtions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\WWi\composer\vendor\autoload.php';

$email = $_SESSION['email'];
$name = $_SESSION['name'];

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
    /* Set the mail sender. */
    $mail->setFrom('kayleigh22x@gmail.com', 'Kayleigh Roest');

    /* Add a recipient. */
    $mail->addAddress("$email", $name);

    /* Set the subject. */
    $mail->Subject = 'Force';

    /* Set the mail message body. */
    $mail->Body = 'There is a great disturbance in the Force.';

    /* Finally send the mail. */
    $mail->send();
}
catch (Exception $e)
{
    /* PHPMailer exception. */
    echo $e->errorMessage();
}
catch (\Exception $e)
{
    /* PHP exception (note the backslash to select the global namespace Exception class). */
    echo $e->getMessage();
}