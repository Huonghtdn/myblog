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
$comment->post_id = isset($_GET['post_id']) ? $_GET['post_id']: die();

$result = $comment->read();
//$num = $result->rowCount();
if($result!=null){
    //post array
    $comments_arr["comment"] = array();

    while($row = $result->fetch(PDO:: FETCH_ASSOC)){
        extract($row);
        $comment_item = array(
            'id'=>$id,
            'body'=>html_entity_decode($body_comment),
            'author' =>$author_comment,
            'comment_at'=>$comment_at,
            'post_id'=>$post_id,
            'link'=>'/comment/'.$id
        );

        //push to 'comment'
        array_push($comments_arr["comment"], $comment_item);
    }
    echo json_encode($comments_arr);
}else{
    echo json_encode(
        array('message'=>'No Comment on Posts Found')
    );
}
?>