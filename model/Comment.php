<?php

class Comment{
    private $conn;
    private $table= 'comment';

    public $id;
    public $post_id;
    public $body_comment;
    public $author_comment;
    public $comment_at;

    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
        $query ="SELECT  c.id, c.body_comment, c.author_comment, c.comment_at 
         FROM " .$this->table. " c 
         WHERE post_id = ?";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(1, $this->post_id);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->id = $row['id'];
         $this->body_comment = $row['body_comment'];
         $this->author_comment = $row['author_comment'];
         $this->comment_at = $row['comment_at'];

        return $stmt;
    }

    public function readById(){
        $query ="SELECT *
         FROM " .$this->table. " c
         WHERE c.id = ?";

         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(1, $this->id);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->body_comment = $row['body_comment'];
         $this->author_comment = $row['author_comment'];
         $this->comment_at = $row['comment_at'];
         $this->post_id = $row['post_id'];

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
                set body_comment = :body_comment,
                author_comment = :author_comment,
                post_id = :post_id
                where id = :id';
         $stmt = $this->conn->prepare($query);

         $this->body_comment = htmlspecialchars(strip_tags($this->body_comment));
         $this->author_comment = htmlspecialchars(strip_tags($this->author_comment));
         $this->post_id = htmlspecialchars(strip_tags($this->post_id));
         $this->id = htmlspecialchars(strip_tags($this->id));
       
         $stmt->bindParam(':body_comment', $this->body_comment);
         $stmt->bindParam(':author_comment', $this->author_comment);
         $stmt->bindParam(':post_id', $this->post_id);
         $stmt->bindParam(':id', $this->id);


         if($stmt->execute()){
             return true;
         }
         printf("Error: %s.\n", $stmt->error);
         return false;

    }

    //delete
    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id =?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>