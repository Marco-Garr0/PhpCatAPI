<?php
include_once "GenericREST.php";
include_once "CatDAO.php";
$REST = new GenericREST(new CatDAO());
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$data = file_get_contents("php://input");
	$newCat = Cat::jsonToCat($data);
	if($newCat == null){
		http_response_code(400);
		echo "Bad Request";
		return;
	}
	
	$response = $REST->post($newCat);
	$newCat->setId($response);
	http_response_code(200);
	echo $newCat->toJson();
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$request = 0;
	if(isset($_GET["id"]))
		$request = $_GET["id"];
	$response = $REST->get($request);
	if($response == ""){
		http_response_code(404);
		echo "Entity not found";
		return;
	}
	http_response_code(200);
	echo $response;
}
if($_SERVER["REQUEST_METHOD"] == "PUT"){
	$data = file_get_contents("php://input");
	$catToUpdate = Cat::jsonToCat($data);
	if($catToUpdate == null){
		http_response_code(400);
		echo "Bad request";
		return;
	}
	$response = $REST->put($catToUpdate);
	var_dump($response);
	if($response){
		http_response_code(404);
		echo "Entity not found";
	}
	else{
		http_response_code(200);
		echo $catToUpdate->toJson();
	}
}
if($_SERVER["REQUEST_METHOD"] == "DELETE"){
	$data = file_get_contents("php://input");
	$decoded = json_decode($data);
	if($decoded->id == null){
		http_response_code(400);
		echo "Bad Request";
		return;
	}

	$catToDelete = new Cat($decoded->id,"",0);
	$response = $REST->delete($catToDelete);
	if($response){
		http_response_code(404);
		echo "{'deleted': false}";
	}
	else{
		http_response_code(200);
		echo "{'deleted': true}";
	}
}
?>
