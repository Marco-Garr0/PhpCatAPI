<?php
include_once "GenericREST.php";
include_once "CatDAO.php";
$REST = new GenericREST(new CatDAO());
$REST->DAO::connect();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$data = file_get_contents("php://input");
	$newCat = Cat::jsonToCat($data);
	if($newCat == null){
		http_response_code(400);
		echo "Bad Request";
		return;
	}
	
	$response = $REST->post($newCat);
	if($response == null){
		http_response_code(500);
		echo "Internal Server Error";
		return;
	}
	http_response_code(200);
	echo $newCat->toJson();
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$request = 0;
	if(isset($_GET["id"]))
		$request = $_GET["id"];
	$response = $REST->get($request);
	if($response == null){
		http_response_code(404);
		echo "Entity not found";
		return;
	}
	$list_json = [];
	foreach ($response as $item) {
		$list_json[] = $item->toJson();
	}
	$list_json = implode(",", $list_json);
	http_response_code(200);
	echo "[".$list_json."]";
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
	$request = 0;
	if(isset($_GET["id"]))
		$request = $_GET["id"];

	if($request == 0){
		http_response_code(400);
		echo "Bad request";
		return;
	}

	$catToDelete = new Cat($request, null, null, null, null, null, null, null, null, null, null);
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
