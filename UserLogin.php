<?php
require_once 'DbConnect.php';
$response;

	if (isset($_POST['email']) && isset($_POST['password'])) 
	{
		
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM userdata WHERE email = '$email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			$sql = "SELECT * FROM userdata WHERE password = '$password'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$sqll = "UPDATE userdata SET status= 1 WHERE email = '$email'";
				$resultl = $conn->query($sqll);
				// this is copied code
				$sql = "SELECT * FROM userdata WHERE email = '$email'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$data = array();
			 	while($row = mysqli_fetch_array($result))
 				{          
     			$data['id'] = $row['id'];
     			$data['firstName'] = $row['firstName']; 
     			$data['lastName'] = $row['lastName']; 
     			$data['email'] = $row['email']; 
     			//$data['password'] = $row['password']; 
     			$data['phoneNumber'] = $row['phoneNumber']; 
     			$data['Address'] = $row['Address']; 
     			$data['lat'] = $row['lat']; 
     			$data['lng'] = $row['lng'];              
 				}
		
    		$response["status"] = 200;
			$response["message"] = "Login successful.";
			$response["data"] = $data; 
    		}
		else 
			{
			$response["status"] = 400;
			$response["message"] = "Something went wrong.Login failed.";
			$response["data"] = new stdClass();
			}
				// this is end of copied code
			}
			else
			{
				$response["status"] = 400;
				$response["message"] = "Password is invalid.Try again.";
				$response["data"] = new stdClass();
			}
		}
		else
		{
			$response["status"] = 400;
			$response["message"] = "Email is not registered with us. Kindly sign up.";
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
?>