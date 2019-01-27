<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "quets";
 
    // object properties
    public $q_id;
    public $q_title;
    public $q_photo;
    public $q_like;
    public $q_rating;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    q_title=:q_title, 
                    q_photo=:q_photo,
                    q_quet=:q_quet,
                    q_like=:q_like,
                    q_rating=:q_rating,
                     created=:created";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->q_title=htmlspecialchars(strip_tags($this->q_title));
         $this->q_photo=htmlspecialchars(strip_tags($this->q_photo));
        $this->q_quet=htmlspecialchars(strip_tags($this->q_quet));
         $this->q_like=htmlspecialchars(strip_tags($this->q_like));
         $this->q_rating=htmlspecialchars(strip_tags($this->q_rating));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":q_title", $this->q_title);
         $stmt->bindParam(":q_photo", $this->q_photo);
        $stmt->bindParam(":q_quet", $this->q_quet);
         $stmt->bindParam(":q_like", $this->q_like);
        $stmt->bindParam(":q_rating",$this->q_rating);
        $stmt->bindParam(":created", $this->created);
    
        // execute query
        if($stmt->execute()){
            $this->q_id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
    // login user
    function login(){
        // select all query
        $query = "SELECT * FROM
                " . $this->table_name . " ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
               q_title='".$this->q_title."'";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}

?>