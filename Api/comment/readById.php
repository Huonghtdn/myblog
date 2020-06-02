<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../model/Comment.php';

//instantiate  & connect
$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

//get id
$comment->id = isset($_GET['id']) ? $_GET['id']: die();

//get comment
$comment->readById();
//create array
$comment_arr = array(
    'id'=>$comment->id,
    'body_comment'=>$comment->body_comment,
    'author_comment' =>$comment->author_comment,
    'comment_at' =>$comment->comment_at,
    'post_id'=>$comment->post_id,
    'link'=>'/comment/'.$comment->id
);
//make json
print_r(json_encode($comment_arr));
?>