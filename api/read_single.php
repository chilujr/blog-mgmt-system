<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

// Initialize our API
include_once('../core/initialize.php');

// Instantiate the Post
$post = new Post($db);

// Set the post ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read a single post
$post->read_single();

// Create an array to hold post data
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

// Output JSON
print_r(json_encode($post_arr));
?>
