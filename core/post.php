<?php

class Post{

    //Enter DB Content
    
    private $conn;
    private $table = 'posts';

    //Here we enter the Posts Properties

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created;

    //Constructor with DB Connection, to initialize the class

    public function __construct($db){
        $this ->conn = $db;
    }

    //Code for getting the posts from the DB

    public function read(){
        //Create the read query
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created 
            FROM
            ' .$this->table . ' p 
            LEFT JOIN
            categories c ON p.category_id = c.id
            ORDERED BY p.created DESC';
    
        //Prepare the Statement

        $stmt = $this->conn->prepare($query);
        //Execute the query
        $stmt->execute();

        return $stmt;
    }
}

?>
