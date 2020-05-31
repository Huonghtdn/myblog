<?php

class Post{
    private $conn;
    private $table= 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
        $query ="SELECT c.name as category_name, p.id,
         p.category_id, p.title, p.body, p.author, p.image, p.created_at 
         FROM " .$this->table. " p 
         LEFT JOIN categories c on p.category_id = c.id
         ORDER BY p.created_at DESC";
         $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function single_read(){
        $query ="SELECT c.name as category_name, p.id,
         p.category_id, p.title, p.body, p.author, p.image, p.created_at 
         FROM " .$this->table. " p 
         LEFT JOIN categories c on p.category_id = c.id
         WHERE p.id = ?
         limit 0,1";

         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(1, $this->id);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->title = $row['title'];
         $this->body = $row['body'];
         $this->author = $row['author'];
         $this->image = $row['image'];
         $this->created_at = $row['created_at'];
         $this->category_id = $row['category_id'];
         $this->category_name = $row['category_name'];

        return $stmt;
    }

    //create post
    public function create(){
        $query = 'insert into '.$this->table.'
                set title = :title,
                body = :body,
                author = :author,
                image = :image,
                category_id = :category_id';
         $stmt = $this->conn->prepare($query);
         $this->title = htmlspecialchars(strip_tags($this->title));
         $this->body = htmlspecialchars(strip_tags($this->body));
         $this->author = htmlspecialchars(strip_tags($this->author));
         $this->image = htmlspecialchars(strip_tags($this->image));
         //$this->create_at = htmlspecialchars(strip_tags($this->create_at));
         $this->category_id = htmlspecialchars(strip_tags($this->category_id));
       
         $stmt->bindParam(':title', $this->title);
         $stmt->bindParam(':body', $this->body);
         $stmt->bindParam(':author', $this->author);
         $stmt->bindParam(':image', $this->image);
         //$stmt->bindParam(':create_at', $this->create_at);
         $stmt->bindParam(':category_id', $this->category_id);


         if($stmt->execute()){
             return true;
         }
         printf("Error: %s.\n", $stmt->error);
         return false;

    }
    //update
    public function update(){
        $query = 'update '.$this->table.'
                set title = :title,
                body = :body,
                author = :author,
                image = :image,
                category_id = :category_id
                where id = :id';
         $stmt = $this->conn->prepare($query);

         $this->title = htmlspecialchars(strip_tags($this->title));
         $this->body = htmlspecialchars(strip_tags($this->body));
         $this->author = htmlspecialchars(strip_tags($this->author));
         $this->image = htmlspecialchars(strip_tags($this->image));
         $this->category_id = htmlspecialchars(strip_tags($this->category_id));
         $this->id = htmlspecialchars(strip_tags($this->id));
       
         $stmt->bindParam(':title', $this->title);
         $stmt->bindParam(':body', $this->body);
         $stmt->bindParam(':author', $this->author);
         $stmt->bindParam(':image', $this->image);
         $stmt->bindParam(':category_id', $this->category_id);
         $stmt->bindParam(':id', $this->id);


         if($stmt->execute()){
             return true;
         }
         printf("Error: %s.\n", $stmt->error);
         return false;

    }

    //delete
    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>