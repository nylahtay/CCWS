<?php 

/**
 * "Close Location" API JSON
 * This info will close a location for the day
 * This returns Success
 */


 //Including the path to the db
//example: include_once "../../model/classes/mysql.php";
$path = (dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'mysql.php');
include_once str_replace('/', DIRECTORY_SEPARATOR, $path);


//get the data from the POST info
$api_key = (isset($_POST['api_key'])) ? htmlspecialchars(filter_input(INPUT_POST, "api_key"), ENT_QUOTES) :  NULL ;
$org_id = (isset($_POST['org_id'])) ? htmlspecialchars(filter_input(INPUT_POST, "org_id"), ENT_QUOTES) :  NULL ;
$loc_id = (isset($_POST['loc_id'])) ? htmlspecialchars(filter_input(INPUT_POST, "loc_id"), ENT_QUOTES) :  NULL ;


//todo - check to see if api_key is valid for this org_id


//create new connection to database
$conn = new mysql;

//get the location's operating date
if (!is_null($loc_id))  $location = $conn->getLocationFull($loc_id) ;
$op_date = $location->getOpDate();

//Load checked in guests for this location
$guestStatus = $conn->getGuestStatus($loc_id,$op_date);



//generate the current date to be the check in date
//YY-MM-DD HH-MM-SS
//todo - change date and time to use location's settings for timezone
date_default_timezone_set("America/Chicago");
$checkout = date("Y-m-d H:i:s");

$data = array();
//Checkout all guests
foreach($guestStatus as $guest)
{       
    $usr_id = $guest[3];
    //if user is not checked out
    if(!isset($guest[2]))
    {
        //connect to the data base to run the checkoutGuest function.
        //$data[] = [$org_id, $loc_id, $usr_id, $op_date, $checkout];
        $result = $conn->checkoutGuest($org_id, $loc_id, $usr_id, $op_date, $checkout);
    }
}

//Set location status and op_date
$result = $conn->closeLocation($org_id, $loc_id);

echo json_encode($result);
