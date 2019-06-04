<?php

require_once 'DbConnect.php';

//$response = array();
$response;

if (isset($_POST['email'])) 
{
	//echo $_POST['email'];
	$email =$_POST['email'];

	$sql = "SELECT email from userdata WHERE email = '$email'";	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{
    $response["status"] = 400;
	$response["message"] = "Email already exists.";
	$response["data"] = new stdClass(); 
    }
	else 
	{
    $first_name =$_POST['firstName'];
	$last_name =$_POST['lastName'];
	$email =$_POST['email'];
	$password = md5($_POST['password']);
	$phoneNumber =$_POST['phoneNumber'];
	$address =$_POST['address'];
	$lat =$_POST['lat'];
	$lng =$_POST['lng'];

	$sql = "INSERT INTO userdata(firstName, lastName, email, password, phoneNumber, Address, lat, lng) VALUES ('$first_name','$last_name','$email','$password','$phoneNumber','$address','$lat','$lng')";
		if ($conn->query($sql) === TRUE) 
		{
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
			$response["message"] = "Registration successful.";
			//$response["data"] = array($data);
			$response["data"] = $data; 
    		}
		else 
			{
			$response["status"] = 400;
			$response["message"] = "Something went wrong.";
			$response["data"] = new stdClass();
			}
		} 
		else 
		{
    		$response["status"] = 400;
			$response["message"] = "Something went wrong.";
			$response["data"] = new stdClass();
		}
	}
}
else
{
	$response["status"] = 400;
	$response["message"] = "Required method is POST method.";
	$response["data"] = new stdClass(); 
}
	//echo json_encode($response);
	$json_string = json_encode($response, JSON_PRETTY_PRINT);
	echo($json_string);
?>
