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


switch ($action) {
    case 'locations':
        getLayout('main', 'locations.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'newreservation':
        getLayout('main', 'newreservation.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
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
