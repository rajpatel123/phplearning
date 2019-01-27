<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
//  $_GET['q_id'] : die();
//$user->q_title = isset($_GET['q_title']) ?    $_GET['q_title'] : die();
// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // create array
    // for($x=0;$x<count($row);$x++){
     $user_arr=array(
        "status" => true,
     "message" => "Successfully Fetch quets Data!",
        "q_id" => $row['q_id'],
        "q_title" => $row['q_title'],
         "q_photo" => $row['q_photo'],
         "q_quet" => $row['q_quet'],
         "q_like" => $row['q_like'],
          "q_rating" => $row['q_rating']

    );
     




// make it json format
print_r(json_encode($user_arr));

}
}
?>