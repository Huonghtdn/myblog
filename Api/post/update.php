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
//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id update
$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->image = $data->image;
//$post->created_at = $data->created_at;
$post->category_id = $data->category_id;

if($post->update()){
    $post_arr = array(
        'id'=>$post->id,
        'title'=>$post->title,
        'author' =>$post->author,
        'image' =>$post->image,
        //'created_at'=>$post->created_at,
        'category_id'=>$post->category_id,
        'link'=> "/posts/".$post->id
    );
    //make json
    print_r(json_encode($post_arr));
}else{
    echo json_encode(
        array('message'=>'Post Not Updated')
    );
}

?>