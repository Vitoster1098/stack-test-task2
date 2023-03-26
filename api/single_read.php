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
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getAuthorById();
if($item->first_name != null){
    // create array
    $authorParams = array(
        "id" =>  $item->id,
        "first_name" => $item->first_name,
        "second_name" => $item->second_name,
        "last_name" => $item->last_name,
        "birthday" => $item->birthday
    );

    http_response_code(200);
    echo json_encode($authorParams);
}

else{
    http_response_code(404);
    echo json_encode("Employee not found.");
}
?>