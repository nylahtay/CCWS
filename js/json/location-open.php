<?php 

/**
 * "Open Location" API JSON
 * This info will open a location for the day
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
$op_date = (isset($_POST['op_date'])) ? htmlspecialchars(filter_input(INPUT_POST, "op_date"), ENT_QUOTES) :  NULL ;


//todo - check to see if api_key is valid for this org_id


//create new connection to database
$conn = new mysql;

//Set location status and op_date
$result = $conn->openLocation($org_id, $loc_id, $op_date);

echo json_encode($result);
