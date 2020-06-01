<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../model/Post.php';

//instantiate  & connect
$database = new Database();
$db = $database->connect();

$post = new Post($db);

//get id
$post->id = isset($_GET['id']) ? $_GET['id']: die();

//get post
$post->readById();
//create array
$post_arr = array(
    'id'=>$post->id,
    'title'=>$post->title,
    'author' =>$post->author,
    'image' =>$post->image,
    'create_at' =>$post->create_at,
    'category_id'=>$post->category_id,
    'category_name'=>$post->category_name
);
//make json
print_r(json_encode($post_arr));
?>