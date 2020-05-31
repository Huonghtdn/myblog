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

$result = $post->read();
$num = $result->rowCount();
if($num >0){
    //post array
    $posts_arr["post"] = array();
    //$posts_arr['data'] = array();

    while($row = $result->fetch(PDO:: FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id'=>$id,
            'title'=>$title,
            'body'=>html_entity_decode($body),
            'author' =>$author,
            'image' =>$image,
            'create_at'=>$create_at,
            'category_id'=>$category_id,
            'category_name'=>$category_name
        );

        //push to 'data'
        array_push($posts_arr["post"], $post_item);
    }
    echo json_encode($posts_arr);
}else{
    echo json_encode(
        array('message'=>'No Posts Found')
    );
}
?>