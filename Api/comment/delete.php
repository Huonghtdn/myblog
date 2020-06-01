<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, 
// Content-Type, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../model/Comment.php';

//instantiate  & connect
$database = new Database();
$db = $database->connect();

$comment = new Comment($db);
$data = json_decode(file_get_contents("php://input"));

$comment->id = $data->id;

if($comment->delete()){
    echo json_encode(
        array('Message'=>'Comment Deleted')
    );
}else{
    echo json_encode(
        array('message'=>'Comment Not Deleted')
    );
}
?>