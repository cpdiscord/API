<?php
  class Image {
//DB + table name
    private $conn;
    private $table_name = "images";

    //object
    public $id;    
    public $name;
    public $description;
    public $createdBy;
    public $configJson;
    public $created;

    //Construct
    public function __construct($db){
      $this->conn = $db;
    }

    // read products
    function read($id){

      // select all query
      $query = "SELECT * FROM `images` where `id`=".$id;

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
    }
    // create image
function create(){
 
    // query to insert record
    $query = "INSERT INTO images SET name=:name, description=:description, configJson=:configJson, created=:created";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->description));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":configJson", $this->configJson);
    $stmt->bindParam(":createdBy", $this->createdBy);
    $stmt->bindParam(":created", $this->created);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
    // no products found will be here
}
