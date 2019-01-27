<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->q_title= $_POST['q_title'];
$user->q_photo = $_FILE['q_photo'];
$user->q_quet = $_POST['q_quet'];
$user->q_like = $_POST['q_like'];
$user->q_rating = $_POST['q_rating'];
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Uploaded!",
        "q_id" => $user->q_id,
        "q_title" => $user->q_title
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "title or photo already exists!"
    );
}
print_r(json_encode($user_arr));
?>