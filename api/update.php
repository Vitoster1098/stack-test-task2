<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/authors.php';

$database = new Database();
$db = $database->getConnection();

$item = new Authors($db);

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

//author values
$item->first_name = $data->first_name;
$item->second_name = $data->second_name;
$item->last_name = $data->last_name;
$item->birthday = $data->birthday;

if($item->updateAuthor()){
    echo json_encode("Author data updated.");
} else{
    echo json_encode("Data could not be updated.");
}
?>