<?php 

/**
 * "Check Out Guest" API JSON
 * This info will check out a user using the User Id to the guest_status table
 * This returns true or false if the user id is available and guest succussfully checked in.
 */


//Including the path to the db
//example: include_once "../../model/classes/mysql.php";
$path = (dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'mysql.php');
include_once str_replace('/', DIRECTORY_SEPARATOR, $path);


//get the data from the POST info
$api_key = (isset($_POST['api_key'])) ? htmlspecialchars(filter_input(INPUT_POST, "api_key"), ENT_QUOTES) :  NULL ;
$org_id = (isset($_POST['org_id'])) ? htmlspecialchars(filter_input(INPUT_POST, "org_id"), ENT_QUOTES) :  NULL ;
$loc_id = (isset($_POST['loc_id'])) ? htmlspecialchars(filter_input(INPUT_POST, "loc_id"), ENT_QUOTES) :  NULL ;
$usr_id = (isset($_POST['usr_id'])) ? htmlspecialchars(filter_input(INPUT_POST, "usr_id"), ENT_QUOTES) :  NULL ;
$op_date = (isset($_POST['op_date'])) ? htmlspecialchars(filter_input(INPUT_POST, "op_date"), ENT_QUOTES) :  NULL ;

//todo - check to see if api_key is valid for this org_id

//create new connection to database
$conn = new mysql;

//generate the current date to be the check in date
//YY-MM-DD HH-MM-SS
//todo - change date and time to use location's settings for timezone
$checkout = date("Y-m-d H:i:s");


//check to see if all data is set
$data = array($org_id, $loc_id, $usr_id, $op_date, $checkin);
if (!in_array(NULL, $data)){
    
    //connect to the data base to run the checkinGuest function.
    $result = $conn->checkinGuest($org_id, $loc_id, $usr_id, $op_date, $checkin);

}
else {
    $result = "Not all parameters passed";
}


//result is true or false
echo json_encode($result);



//TESTING STUFF
// $data = array($org_id, $loc_id, $usr_id, $op_date, $checkin);
// echo json_encode($data);
