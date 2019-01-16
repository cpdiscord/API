<?php
  class Image {
//DB + table name
    private $conn;
    private $table_name = "images";

    //object
    public $id
    public $username;
    public $authkey;
    public $created;

    //Construct
    public function __construct($db){
      $this->conn = $db;
    }

    // read products
    function read(){

      // select all query
      $query = "SELECT
                  c.username as c.authkey, c.created, c.id
              FROM
                  " . $this->table_name . " p
                  LEFT JOIN
                      name
                          ON p.category_id = c.id
              ORDER BY
                  p.created DESC";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
    }
    // no products found will be here

}
