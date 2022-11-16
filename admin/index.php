<?php
//session_start();

//include functions
include_once 'model/functions.php';

//include database
include_once 'model/db.php';

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        //$action = 'login';
        $action = 'dashboard';
    }
}
var_dump( $_POST);
// var_dump( 
//     filter_input(INPUT_POST, 'inputFirstName'),
//  filter_input(INPUT_POST, 'inputLastName'),
//  filter_input(INPUT_POST, 'inputAddress'),
//  filter_input(INPUT_POST, 'inputPet'),
//  filter_input(INPUT_POST, 'inputFamily'),
// );


switch ($action) {
    case 'locations':
        getLayout('main', 'locations.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'newreservation':
        getLayout('main', 'newreservation.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'newguest':
        getLayout('main', 'newguest.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'status':
        getLayout('main', 'status.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'checkin':
        getLayout('main', 'checkin.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'login':
        getLayout('login', '', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
        //header('Location: '. dirname(__DIR__) );
    break;
    default:   
    getLayout('main', 'dashboard.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 

}
