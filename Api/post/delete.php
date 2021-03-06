<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, 
// Content-Type, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../model/Post.php';

//instantiate  & connect
$database = new Database();
$db = $database->connect();

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

if($post->delete()){
    echo json_encode(
        array('Message'=>'Post Deleted')
    );
}else{
    echo json_encode(
        array('message'=>'Post Not Deleted')
    );
}
?>