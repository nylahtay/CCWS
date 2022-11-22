<?php
//session_start();

//include functions
include_once 'model/functions.php';

//include database
include_once 'model/db.php';
$conn = new Mysql();

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        //$action = 'login';
        $action = 'dashboard';
    }
}




//If $_POST, get the postAction
$postAction = filter_input(INPUT_POST, 'postAction');
switch ($postAction) {
    case 'createGuest':
        //Check to see if there is data
        $guest = (isset($_POST['guest'])) ? $_POST['guest'] :  NULL;
        
        $usr_fname = isset($guest['FirstName']) ? htmlspecialchars($guest['FirstName'], ENT_QUOTES) : NULL;
        $usr_lname = isset($guest['LastName']) ? htmlspecialchars($guest['LastName'], ENT_QUOTES) : NULL;
        $guest_birthdate = isset($guest['Birthdate']) ? htmlspecialchars($guest['Birthdate'], ENT_QUOTES) : NULL;
        $guest_pet = isset($guest['Pet']) ? htmlspecialchars($guest['Pet'], ENT_QUOTES) : false;
        $guest_family_group = isset($guest['Family']) ? htmlspecialchars($guest['Family'], ENT_QUOTES) : false;
        $usr_notes = isset($guest['Notes']) ? htmlspecialchars($guest['Notes'], ENT_QUOTES) : NULL;

        //create the guest
        $message = $conn->createGuest($org_id, NULL, NULL, 3, NULL, NULL, $usr_fname, $usr_lname, NULL, $usr_notes, $guest_birthdate, $guest_pet, $guest_family_group);
        if ($message === "Success") {
            //echo '<div class="alert alert-success" role="alert">Customer Created</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Error Creating Customer!</strong><br><small>' . $message . '</small></div>';
        }
    break;
    case 'updateGuest':
        //Check to see if there is data
        $guest = (isset($_POST['guest'])) ? $_POST['guest'] :  NULL;
        
        $usr_id = isset($guest['Id']) ? htmlspecialchars($guest['Id'], ENT_QUOTES) : NULL;
        $usr_fname = isset($guest['FirstName']) ? htmlspecialchars($guest['FirstName'], ENT_QUOTES) : NULL;
        $usr_lname = isset($guest['LastName']) ? htmlspecialchars($guest['LastName'], ENT_QUOTES) : NULL;
        $guest_birthdate = isset($guest['Birthdate']) ? htmlspecialchars($guest['Birthdate'], ENT_QUOTES) : NULL;
        $guest_pet = isset($guest['Pet']) ? htmlspecialchars($guest['Pet'], ENT_QUOTES) : false;
        $guest_family_group = isset($guest['Family']) ? htmlspecialchars($guest['Family'], ENT_QUOTES) : false;
        $usr_notes = isset($guest['Notes']) ? htmlspecialchars($guest['Notes'], ENT_QUOTES) : NULL;
        //create the guest
        $message = $conn->updateGuest($org_id, $usr_id, $usr_fname, $usr_lname, $usr_notes, $guest_birthdate);
        if ($message === "Success") {
            //echo '<div class="alert alert-success" role="alert">Customer Created</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Error Creating Customer!</strong><br><small>' . $message . '</small></div>';
        }
    break;
}




switch ($action) {
    case 'location':
        getLayout('location', 'location.php', NULL , ['title'=> 'Admin - Location'], ['css'=>'../css/admin.css']); 
    break;
    case 'newreservation':
        getLayout('main', 'newreservation.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
    break;
    case 'newguest':
        getLayout('main', 'newguest.php', NULL , ['title'=> 'Admin - New Guest'], ['css'=>'../css/admin.css']); 
    break;
    case 'guests':
        getLayout('main', 'guests.php', NULL , ['title'=> 'Admin - Edit Guest'], ['css'=>'../css/admin.css']); 
    break;
    case 'editguest':
        getLayout('main', 'editguest.php', NULL , ['title'=> 'Admin - Edit Guest'], ['css'=>'../css/admin.css']); 
    break;
    case 'status':
        getLayout('location', 'status.php', NULL , ['title'=> 'Admin - Guest Status'], ['css'=>'../css/admin.css']); 
    break;
    case 'location_settings':
        getLayout('location', 'settings.php', NULL , ['title'=> 'Admin - Guest Status'], ['css'=>'../css/admin.css']); 
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
