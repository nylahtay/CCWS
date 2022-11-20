<?php
//include the db connection
//This is the path to config.php based on where mysql.php is locted. 
//This enables you to include this class from any location in the filetree
$path = (dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
include_once str_replace('/', DIRECTORY_SEPARATOR, $path);

//include all the data types
include_once dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . 'user.php';
include_once dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . 'guest.php';
include_once dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . 'location.php';

class Mysql extends Dbconfig
{

    public $conn;
    private $sqlQuery;

    protected $databaseName;
    protected $hostName;
    protected $userName;
    protected $passCode;

    //This is the constructor
    //We creat a new DBconfig object to retrieve the connection paramters.
    function __construct()
    {
        $this->conn = NULL;
        $this->sqlQuery = NULL;

        $dbPara = new Dbconfig();
        $this->databaseName = $dbPara->dbName;
        $this->hostName = $dbPara->serverName;
        $this->userName = $dbPara->userName;
        $this->passCode = $dbPara->passCode;
        $dbPara = NULL;
    }

    //this function connects to the DB
    function connect()
    {
        // use mysqli to update the $conn 
        $this->conn = new mysqli($this->hostName, $this->userName, $this->passCode, $this->databaseName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    //simple property to disconnect from the DB
    function disconnect()
    {
        $this->conn->close();
    }

    function selectAll($tableName)
    {
        $this->sqlQuery = 'SELECT * FROM ' . $this->databaseName . '.' . $tableName;
    }



    //Method to create an a User and it returns the user's id
    //IMPORTANT - thsi is set to private so that this can only by called by other funtions in this class.
    //If you create a user, you should be using createStaff() or createGuest() instead as they use this function.
    private function createUser($org_id, $usr_username = null, $usr_password = null, $usr_auth = 3, $usr_email = null, $usr_phone = null, $usr_fname = null, $usr_lname = null, $usr_profile_img = NULL, $usr_notes = null)
    {
        //todo update with org id
        $org_id = 1;

        //Database connection
        $this->connect();
        $this->sqlQuery = "INSERT INTO users (
            org_id, usr_username, usr_password_hash, usr_auth, usr_email, 
            usr_phone, usr_fname, usr_lname, usr_email_confirm, usr_text_confirm, 
            usr_profile_img, usr_notes, usr_created_by, usr_modified_by
            ) 
            VALUES (
                '$org_id', NULL, NULL, '$usr_auth', NULL, 
                NULL, '$usr_fname', '$usr_lname', NULL, NULL,
                NULL, '$usr_notes', NULL, NULL 
                );";
        if ($this->conn->query($this->sqlQuery) === TRUE) {
            //get the new id from the sql insert above
            $id = mysqli_insert_id($this->conn);

            //todo: if image, then move image to server
            
            return $id;
        } else {
            return "Error: " . $this->sqlQuery . "<br>" . $this->conn->error;
        }

        //disconnect from the DB
        self::disconnect();
    }


    //Method to create an appointment
    //This method creates an appointment.
    function createGuest($org_id, $usr_username = null, $usr_password = null, $usr_auth = 3, $usr_email = null, $usr_phone = null, $usr_fname = null, $usr_lname = null, $usr_profile_img = NULL, $usr_notes = null, $guest_birthdate = null, $guest_pet = 0, $guest_family_group=0)
    {

        //Database connection
        $this->connect();

        //uses the createUser() function to create the user in the user table first.
        //Sets the id to be the returned id from the createUser() function.
        if ($id = self::createUser($org_id, $usr_username, $usr_password, 3, $usr_email, $usr_phone, $usr_fname, $usr_lname, $usr_profile_img, $usr_notes)) {

            //create the customer record in the customer table using the $id that is returned
            $this->sqlQuery = "INSERT INTO guests (usr_id, guest_birthdate, guest_pet, guest_family_group, guest_created_by, guest_modified_by) VALUES ('$id','$guest_birthdate','$guest_pet','$guest_family_group', NULL, NULL)";

            if ($this->conn->query($this->sqlQuery) === TRUE) {
                return "Success";
            } else {
                return "Error: " . $this->sqlQuery . "<br>" . $this->conn->error;
            }
        } else {
            return "Error: " . $this->sqlQuery . "<br>" . $this->conn->error;
        }

        //disconnect from the DB
        self::disconnect();
    }


    //Method to retrive all the guests in the DB
    //This method returns an array of all the guests as Guest objects.
    function getGuests()
    {
        //create array of guest objects
        $guests = array();

        //Database connection
        $this->connect();
        $this->sqlQuery = "SELECT u.usr_id, u.usr_username, u.usr_auth, u.usr_email, u.usr_phone, u.usr_fname, u.usr_lname, u.usr_notes, g.guest_birthdate, g.guest_pet, g.guest_family_group FROM users AS u JOIN guests AS g ON u.usr_id = g.usr_id";
        $result = $this->conn->query($this->sqlQuery);

        //add each row into a new guest object in the array
        while ($row = $result->fetch_assoc()) {
            $guest = new Guest($row['usr_id'], $row['usr_username'], $row['usr_auth'], $row['usr_email'], $row['usr_phone'], $row['usr_fname'], $row['usr_lname'],  $row['usr_notes'],  $row['guest_birthdate'],  $row['guest_pet'],  $row['guest_family_group']);
            // $guest->setProfileImg($row['usr_profile_img']);
            // $guest->setGuestId($row['cus_id']);
            // $guest->setNotes($row['cus_notes']);
            $guests[] = $guest;
        }

        //disconnect from the DB
        self::disconnect();

        //return the array of Guest objects
        return $guests;
    }



    //Method to Check in Guests using the location id and user id
    function checkinGuest($org_id,$loc_id, $usr_id, $op_date, $checkin)
    {
        //create array of guest objects
        $result = array();

        //Database connection
        $this->connect();

        //create the customer record in the customer table using the $id that is returned
        $this->sqlQuery = "INSERT INTO guest_status (gs_id, gs_op_date, org_id, loc_id, usr_id, gs_checkin, gs_checkout) VALUES (NULL, '$op_date', '$org_id', '$loc_id', '$usr_id', '$checkin', NULL);";

        if ($this->conn->query($this->sqlQuery) === TRUE) {
            //disconnect from the DB
            self::disconnect();
            return "Success - User id $usr_id has been checked in";
        } else {
            //disconnect from the DB
            self::disconnect();
            return "Error: " . $this->sqlQuery . "<br>" . $this->conn->error;
        }
    }


    //Method to Check Out Guests using the location id and user id
    function checkoutGuest($org_id, $loc_id, $usr_id, $op_date, $checkout)
    {

        //Database connection
        $this->connect();

        //Get the row id from the guest_status table
        $this->sqlQuery = "SELECT gs_id FROM guest_status WHERE org_id = $org_id AND loc_id = $loc_id AND usr_id = $usr_id AND gs_op_date = '$op_date' AND gs_checkout IS NULL;";
        if ($this->conn->query($this->sqlQuery) === TRUE) {
            $gs_id = $this->conn->query($this->sqlQuery);
        } else {
            //disconnect from the DB
            self::disconnect();
            //return Error
            return "Error: " . $this->sqlQuery . "<br>" . $this->conn->error;
        }

        //Update the guest_status table with the checkout date
        $this->sqlQuery = "UPDATE guest_status SET gs_checkout = '$checkout' WHERE gs_id = $gs_id;";
        if ($this->conn->query($this->sqlQuery) === TRUE) {
            //disconnect from the DB
            self::disconnect();
            return "Success";
        } else {
            //disconnect from the DB
            self::disconnect();
            return "Error: " . $this->sqlQuery . "<br>" . $this->conn->error;
        }

    }

    
    //Method to Check Out Guests using the location id and user id
    function checkoutGuests($org_id, $loc_id, $usr_ids, $op_date, $checkout)
    {
        //Database connection
        $this->connect();
        $this->sqlQuery = "SELECT u.usr_fname, u.usr_lname, gs.gs_checkin, gs.gs_checkout, gs.usr_id FROM guest_status as gs JOIN users as u ON u.usr_id = gs.usr_id";
        $result = $this->conn->query($this->sqlQuery);
        
        //disconnect from the DB
        self::disconnect();

        //if $usr_ids has one or more id in it
        if(!in_array(NULL, $usr_ids)) { 
            //loop through each user id and check them out using the checkoutGuest() function
            foreach ($usr_ids as $usr_id)
            {
                self::checkoutGuest($org_id, $loc_id, $usr_id, $op_date, $checkout);
            }
        }
    }



    //Method to retrive get the guests status for a location
    function getGuestStatus($id, $date)
    {
        //create array of guest objects
        $guestStatus = array();

        //Database connection
        $this->connect();
        $this->sqlQuery = "SELECT u.usr_fname, u.usr_lname, gs.gs_checkin, gs.gs_checkout, gs.usr_id FROM guest_status as gs JOIN users as u ON u.usr_id = gs.usr_id WHERE loc_id = $id and gs_op_date = '$date'";
        $result = $this->conn->query($this->sqlQuery);

        //add each row into a new guest object in the array
        while ($row = $result->fetch_assoc()) {
            $guestStatus[] = [$row['usr_fname'] . ' ' . $row['usr_lname'], $row['gs_checkin'], $row['gs_checkout'], $row['usr_id']];
        }

        //disconnect from the DB
        self::disconnect();

        //return the array of Guest objects
        return $guestStatus;
    }



     //Method to retrive all the Locations in the DB
    //This method returns an array of all the locations as Location objects.
    function getLocations()
    {
        //create array of guest objects
        $locations = array();

        //Database connection
        $this->connect();
        $this->sqlQuery = "SELECT loc_id, loc_name, loc_address_street, loc_address_street_2, loc_address_city, loc_address_state, loc_serves, loc_capacity, loc_status FROM location";
        $result = $this->conn->query($this->sqlQuery);

        //add each row into a new guest object in the array
        while ($row = $result->fetch_assoc()) {
            $location = new Location($row['loc_id'], $row['loc_name'], $row['loc_address_street'], $row['loc_address_street_2'], $row['loc_address_city'], $row['loc_address_state'], NULL,  NULL,  $row['loc_serves'],  $row['loc_capacity'], $row['loc_status']);
            $locations[] = $location;
        }

        //disconnect from the DB
        self::disconnect();

        //return the array of Guest objects
        return $locations;
    }


    //Method to retrive a location record by providing the location ID
    //Expects an Integer for the $id
    //This method returns a Location Object
    function getLocationById($id)
    {
        //Database connection
        $this->connect();
        $this->sqlQuery = "SELECT loc_id, loc_name, loc_address_street, loc_address_street_2, loc_address_city, loc_address_state, loc_serves, loc_capacity, loc_status FROM location WHERE loc_id = $id;";
        $result = $this->conn->query($this->sqlQuery);

        //add each row into a new Customer object
        $row = $result->fetch_assoc();
        $location =  new Location($row['loc_id'], $row['loc_name'], $row['loc_address_street'], $row['loc_address_street_2'], $row['loc_address_city'], $row['loc_address_state'], NULL,  NULL,  $row['loc_serves'],  $row['loc_capacity'], $row['loc_status']);

        //disconnect from the DB
        self::disconnect();

        //return the Customer object
        return $location;
    }


    //todo need to figure out a better way to do this in sql
    function getLocationsFull( $date)
    {
        //$locationIds is an array of ids as INTs
        $locationIds = array();
        $locations = self::getLocations();
        foreach ($locations as $location)
        {
            $locationIds[]=$location->getId(); 
        }
        //date is a operating date in the format YYYY-MM-DD

        //create array of location objects
        $locationsFull = array();

        

        //Database connection
        $this->connect();

        //loop through each location id
        foreach ($locationIds as $id)
        {

            $this->sqlQuery = "SELECT loc_id, loc_name, loc_address_street, loc_address_street_2, loc_address_city, loc_address_state, loc_serves, loc_capacity, loc_status, loc_capacity-(SELECT count(usr_id) FROM guest_status WHERE loc_id = $id AND gs_op_date = '$date' AND gs_checkout IS NULL) AS loc_availability FROM location WHERE loc_id = $id";
            $result = $this->conn->query($this->sqlQuery);

            //add each row into a new guest object in the array
            while ($row = $result->fetch_assoc()) {
                $location = new Location($row['loc_id'], $row['loc_name'], $row['loc_address_street'], $row['loc_address_street_2'], $row['loc_address_city'], $row['loc_address_state'], NULL,  NULL,  $row['loc_serves'],  $row['loc_capacity'], $row['loc_status']);
                $location->setAvailability($row['loc_availability']);
                $locationsFull[] = $location;
            }

        }

        //disconnect from the DB
        self::disconnect();

        //return the array of Guest objects
        return $locationsFull;
    }


    //todo need to figure out a better way to do this in sql
    function getLocationFull($id, $date)
    {
    
        //Database connection
        $this->connect();

        $this->sqlQuery = "SELECT loc_id, loc_name, loc_address_street, loc_address_street_2, loc_address_city, loc_address_state, loc_serves, loc_capacity, loc_status, loc_capacity-(SELECT count(usr_id) FROM guest_status WHERE loc_id = $id AND gs_op_date = '$date' AND gs_checkout IS NULL) AS loc_availability FROM location WHERE loc_id = $id";
        $result = $this->conn->query($this->sqlQuery);

        //add each row into a new guest object in the array
        while ($row = $result->fetch_assoc()) {
            $location = new Location($row['loc_id'], $row['loc_name'], $row['loc_address_street'], $row['loc_address_street_2'], $row['loc_address_city'], $row['loc_address_state'], NULL,  NULL,  $row['loc_serves'],  $row['loc_capacity'], $row['loc_status']);
            $location->setAvailability($row['loc_availability']);
        }

        //disconnect from the DB
        self::disconnect();

        //return the array of Guest objects
        return $location;
    }




}