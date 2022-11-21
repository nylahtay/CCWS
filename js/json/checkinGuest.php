<?php 

/**
 * "Check In Guest" API JSON
 * This info will check in a user using the User Id to the guest_status table
 * This returns Success if the user id is available and guest succussfully checked in.
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
date_default_timezone_set("America/Chicago");
$checkin = date("Y-m-d H:i:s");



//Check if User is already checked in
//Load checked in guests for this location
$guestStatus = $conn->getGuestStatus($loc_id,$op_date);
//Put each id into an array.
$checked_usr_ids = array();
foreach($guestStatus as $guest)
{       
    $checked_usr_ids[] = $guest[3];
}

//Scan the array for our $usr_id that we are trying to check in.
$key = array_search( $usr_id, $checked_usr_ids ); // returns FALSE
if ( FALSE !== $key ) {
    // usr_id was found, key is in $index, return an error
    $result = 'Error! User Is Already Checked Into This Location';
}
else {

    //check to see if all data is set - javascript passes the empty values as 'undefined'
    $data = array($org_id, $loc_id, $usr_id, $op_date, $checkin);
    if (in_array('undefined', $data) || in_array(NULL, $data)){
        //a NULL or undefined value was in there, return an error
        $result = "Not all parameters passed";
    }
    else {
        //SUCCESS!!!
        //connect to the data base to run the checkinGuest function.
        $result = $conn->checkinGuest($org_id, $loc_id, $usr_id, $op_date, $checkin);
    }
}






// //result is true or false
 echo json_encode($result);



// //TESTING STUFF
// // $data = array($org_id, $loc_id, $usr_id, $op_date, $checkin);
// // echo json_encode($data);
