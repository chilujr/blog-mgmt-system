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

    public function create(){
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';
        //Prepare the statement
        $stmt = $this->conn->prepare($query);
        //Clean Data
        $this->title         = htmlspecialchars(strip_tags($this->title));
        $this->body          = htmlspecialchars(strip_tags($this->body));
        $this->author        = htmlspecialchars(strip_tags($this->author));
        $this->category_id   = htmlspecialchars(strip_tags($this->category_id));
        //Binding of Parameters
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        //Execute the query
        if($stmt->execute()){
            return true;
        }

        //Print an error in case anything goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    public function update(){
        //Update query
        $query = 'UPDATE ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id
        WHERE id = :id';
        //Prepare the statement
        $stmt = $this->conn->prepare($query);
        //Clean Data
        $this->title         = htmlspecialchars(strip_tags($this->title));
        $this->body          = htmlspecialchars(strip_tags($this->body));
        $this->author        = htmlspecialchars(strip_tags($this->author));
        $this->category_id   = htmlspecialchars(strip_tags($this->category_id));
        $this->id            = htmlspecialchars(strip_tags($this->id));
        //Binding of Parameters
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
        //Execute the query
        if($stmt->execute()){
            return true;
        }

        //Print an error in case anything goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    public function delete(){
        //Create the query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        //Prepare the statement
        $stmt = $this->conn->prepare($query);
        //Clean the data
        $this->id   = htmlspecialchars(strip_tags($this->id));
        //Binding of Parameters
        $stmt->bindParam(':id', $this->id);
        //Execute the query
        if($stmt->execute()){
            return true;
        }

        //Print an error in case anything goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }
}

?>
