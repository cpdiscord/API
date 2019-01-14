<?php
  class Image {
//DB + table name
    private $conn;
    private $table_name = "images";

    //object
    public $id
    public $name;
    public $description
    public $createdBy;
    public $configJson
    public $created;

    //Construct
    public function __construct($db){
      $this->conn = $db;
    }

function read(){
  // read products
function read(){

    // select all query
    $query = "SELECT
                c.name as name, p.id, p.name, p.description, p.createdBy, p.configJson, p.created;
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY
                p.created DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}
}

  }
