<?php
if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $secretKey = "6LeN69oUAAAAAPVjB4fwgI_7hvgfaNuVIxvONUVw";
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
$errors = "";
$myemail = "saikatacharyya.123@gmail.com";//<-----Put Your email address here.
if(empty($_POST["fname"])  || 
  empty($_POST["lname"])  ||
   empty($_POST["tel"])  ||
  empty($_POST["eaddress"]) 
  //|| 
//   empty($_POST["message"])
   )
   {
    $errors .= "\n Error: all fields are required";
}

$name1 = $_POST["fname"]; 
$name2 = $_POST["lname"];
$email_address = $_POST["eaddress"]; 
$tel=$_POST["tel"];
$message = $_POST["message"]; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name1";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name1 $name2 \n Email: $email_address \n Telephone No: $tel. \n Message: \n $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	$sent = mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	if ($sent)
    {
    header('Location: http://www.silcotfabrics.com/contact-form-thank-you.html');
    } else {
    echo "There has been an error sending your comments. Please try later.";
    }
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>There is an Error.</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>