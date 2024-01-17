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
        $this->conn = $db;
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
            ORDER BY p.created DESC';
    
        //Prepare the Statement

        $stmt = $this->conn->prepare($query);
        //Execute the query
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
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
            WHERE p.id = ? LIMIT 1';

            //Prepare the Statement

        $stmt = $this->conn->prepare($query);
        //Binding Parameter
        $stmt->bindParam(1, $this->id);
        //Execute the query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
       
    }
}

?>

