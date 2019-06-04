<?php

require_once 'DbConnect.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
	$sql = "SELECT * FROM category";
	$result = $conn->query($sql);
	
				if ($result->num_rows > 0) 
				{
				$data = array();
			 	while($row = mysqli_fetch_array($result))
 				{ 
 				$tempData = array();         
     			$tempData['id'] = $row['id'];
     			$tempData['catName'] = $row['catName']; 
     			$tempData['image'] = $row['image']; 
     			$tempData['price'] = $row['price']; 
     			//$data['password'] = $row['password']; 
     			array_push($data, $tempData);              
 				}
		
    			$response["status"] = 200;
				$response["message"] = "Categories successful.";
				$response["data"] = $data; 
    			}
				else 
				{
				$response["status"] = 400;
				$response["message"] = "Something went wrong.Login failed.";
				$response["data"] = array();
				}
}
else
{
	$response["status"] = 400;
	$response["message"] = "Required method is GET method.";
	$response["data"] = array(); 
}

$json_string = json_encode($response, JSON_PRETTY_PRINT);
echo($json_string);

?>