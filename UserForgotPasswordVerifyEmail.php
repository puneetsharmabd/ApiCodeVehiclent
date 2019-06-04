<?php

require_once 'DbConnect.php';

$response = array();
if (isset($_POST['email'])) 
	{	
		$email = $_POST['email'];
		$sql = "SELECT * FROM userdata WHERE email = '$email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{

			echo generateRandomString();

			// $to_email = $email;
			// $subject = 'Your password.';
			// $message = 'This mail is sent using the PHP mail function';
			// $headers = 'From: noreply @ company . com';
			// mail($to_email,$subject,$message,$headers);

			$to = 'puneetsharmabd@gmail.com';
			$subject = 'Test email'; 
			$message = "Hello World!\n\nThis is my first mail."; 
			$headers = "From: puneetseodiscovery@gmail.com\r\nReply-To: puneetsharmabd@gmail.com";
			$mail_sent = @mail( $to, $subject, $message, $headers );
			echo $mail_sent ? "Mail sent" : "Mail failed";
		
			$response["status"] = 200;
			$response["message"] = "Password is sent to your registered email. Kindly check.";
			$response["data"] = new stdClass();
		}
		else
		{
			$response["status"] = 400;
			$response["message"] = "Email is not registered with us. Check your email.";
			$response["data"] = new stdClass();
		}
	}
	else
	{
	$response["status"] = 400;
	$response["message"] = "Required method is POST method.";
	$response["data"] = new stdClass(); 
	}
	$json_string = json_encode($response, JSON_PRETTY_PRINT);
	echo($json_string);

	function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>