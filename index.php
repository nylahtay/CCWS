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
        $action = 'login';
    }
}


getLayout('login', '', NULL , ['title'=> 'Login'], ['css'=>'../css/admin.css']); 
