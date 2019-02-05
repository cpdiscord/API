<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate objects
include_once '../objects/image.php';

$database = new Database();
$db = $database->getConnection();

$image = new Image($db);

$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->description) &&
    !empty($data->createdBy) &&
    !empty($data->configJson)
){
 
    // set image property values
    $image->name = $data->name;
    $image->description = $data->description;
    $image->createdBy = $data->createdBy;
    $image->configJson = $data->configJson;
    $image->created = date('Y-m-d H:i:s');
 
    // create the image
    if($image->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "image was created."));
    }
 
    // if unable to create the image, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create image."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create image. Data is incomplete."));
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
?>