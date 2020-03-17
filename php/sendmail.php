<?php
if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $secretKey = "6LdrUcsUAAAAAP-4JuQN9cYHtiUKhpm6RKKdXu8H";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
		$response=file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
	    $data=json_decode($response);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($data["success"]) {
                echo '<h2>Thanks for posting comment</h2>';
        } else {
                echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }
$email_to = "saikatacharyya.123@gmail.com";
$email_from = $_POST["email"];
$email_subject = "Subscribe request from website";
$headers = "From: " . $email_from . "\n";
$headers .= "Reply-To: " . $email_from . "\n";
$message = "Need to contact ";
ini_set("sendmail_from", $email_from);
$sent = mail($email_to, $email_subject, $message, $headers, "-f" .$email_from);
if ($sent)
{
header("Location: http://www.silcotfabrics.com/contact-form-thank-you.html");
} else {
echo "There has been an error sending your comments. Please try later.";
}
?>