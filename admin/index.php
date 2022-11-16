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
        $message = $conn->createGuest(1, NULL, NULL, 3, NULL, NULL, $usr_fname, $usr_lname, NULL, $usr_notes, $guest_birthdate, $guest_pet, $guest_family_group);
        if ($message === "Success") {
            //echo '<div class="alert alert-success" role="alert">Customer Created</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Error Creating Customer!</strong><br><small>' . $message . '</small></div>';
        }
    break;
    case 'updateGuest':
    break;
}

// var_dump( 
//     filter_input(INPUT_POST, 'inputFirstName'),
//  filter_input(INPUT_POST, 'inputLastName'),
//  filter_input(INPUT_POST, 'inputAddress'),
//  filter_input(INPUT_POST, 'inputPet'),
//  filter_input(INPUT_POST, 'inputFamily'),
// );




switch ($action) {
    case 'location':
        getLayout('main', 'location.php', NULL , ['title'=> 'Admin Dashboard'], ['css'=>'../css/admin.css']); 
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
