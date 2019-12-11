
<?php
include "includes/funtions.php";

require 'C:\xampp\htdocs\WWi\composer\vendor\autoload.php';

$email = $_SESSION['email'];
$name = $_SESSION['name'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* New aliases. */
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


/* If you installed league/oauth2-google in a different directory, include its autoloader.php file as well. */
// require 'C:\xampp\league-oauth2\vendor\autoload.php';

/* Set the script time zone to UTC. */
date_default_timezone_set('Etc/UTC');

/* Information from the XOAUTH2 configuration. */
$google_email = 'wideworldimportersgroep5@gmail.com';
$oauth2_clientId = '717562242871-pjld72kvobs1vc3eruj6c1onu5s3hlmm.apps.googleusercontent.com';
$oauth2_clientSecret = '0TFd-v7y71zriaRAJmB9DfCY';
$oauth2_refreshToken = '1//09dZFySJiYGuzCgYIARAAGAkSNwF-L9IrVXFgl8Mc0nW038Mr1FxR3N1Yk_Eqxjbg1L15FeT6hIrxEKLVwikzQMjkiBmodbWwQ64';

$mail = new PHPMailer(TRUE);

try {

   $mail->setFrom($google_email, 'Groep5');
   $mail->addAddress($email, $name);
   $mail->Subject = 'Force';
   $mail->Body = 'There is a great disturbance in the Force.';
   $mail->isSMTP();
   $mail->Port = 587;
   $mail->SMTPAuth = TRUE;
   $mail->SMTPSecure = 'tls';

   /* Google's SMTP */
   $mail->Host = 'smtp.gmail.com';

   /* Set AuthType to XOAUTH2. */
   $mail->AuthType = 'XOAUTH2';

   /* Create a new OAuth2 provider instance. */
   $provider = new Google(
      [
         'clientId' => $oauth2_clientId,
         'clientSecret' => $oauth2_clientSecret,
      ]
   );

   /* Pass the OAuth provider instance to PHPMailer. */
   $mail->setOAuth(
      new OAuth(
         [
            'provider' => $provider,
            'clientId' => $oauth2_clientId,
            'clientSecret' => $oauth2_clientSecret,
            'refreshToken' => $oauth2_refreshToken,
            'userName' => $google_email,
         ]
      )
   );

   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}