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

//get raw posted data
$data = json_decode(file_get_contents("php://input"));
//date_default_timezone_set('UTC');

$comment->body_comment = $data->body_comment;
$comment->author_comment = $data->author_comment;
$comment->post_id = $data->post_id;

if($comment->create()){
    echo json_encode(
        array('Message'=>'Comment '.$comment->body_comment. ' Created')
    );
}else{
    echo json_encode(
        array('message'=>'Comment Not Created')
    );
}

?>