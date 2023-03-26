<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/authors.php';
$database = new Database();
$db = $database->getConnection();
$items = new Authors($db);
$stmt = $items->getAuthors();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);
if($itemCount > 0){

    $authorParams = array();
    $authorParams["body"] = array();
    $authorParams["itemCount"] = $itemCount;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "id" => $id,
            "first_name" => $first_name,
            "second_name" => $second_name,
            "last_name" => $last_name,
            "birthday" => $birthday
        );
        $authorParams["body"][] = $e;
    }
    echo json_encode($authorParams);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>