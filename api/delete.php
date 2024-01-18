<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Methods: Access-Control-Allow-Methods, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// This initializes our API
include_once('../core/initialize.php');

// Now we instantiate the Post
$post = new Post($db);

// Get the raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if the 'id' property is set
if (isset($data->id)) {
    $post->id = $data->id;

    // Code to delete the post
    if ($post->delete()) {
        echo json_encode(array('message' => 'Post has been removed.'));
    } else {
        echo json_encode(array('message' => 'Post has not been removed.'));
    }
} else {
    // 'id' property is not set
    echo json_encode(array('message' => 'Invalid request. Missing or invalid "id" property.'));
}
?>
