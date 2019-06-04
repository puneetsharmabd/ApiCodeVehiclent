<?php

require_once 'DbConnect.php';
$response;

if (isset($_POST['id'])) 
{
		$id = $_POST['id'];
		$sql = "SELECT * FROM userdata WHERE id = '$id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
				$sqll = "UPDATE userdata SET status= 0 WHERE id = '$id'";
				$resultl = $conn->query($sqll);
				$response["status"] = 200;
				$response["message"] = "Logout successful.";
				$response["data"] = new stdClass(); 
		}
		else
		{
			$response["status"] = 400;
			$response["message"] = "Something went wrong. Check your parameters.";
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