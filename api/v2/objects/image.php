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
    function read(){

      // select all query
      $query = "SELECT * FROM " . $this->table_name . ";";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
    }
    // no products found will be here

}
