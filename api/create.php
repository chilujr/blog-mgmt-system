<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: Access-Control-Allow-Methods, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//This initializes our API
include_once('../core/initialize.php');

//Now we instantiate the Post
$post = new Post($db);

//Get the raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Code to create the post
if($post->create()){
    echo json_encode(
        array('message' => 'Post created. ')
    );
}else{
    echo json_encode(
        array('message' => 'Post not created. ')
    );

}

?>