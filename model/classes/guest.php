<?php
include_once "user.php";


/**
 * Guest
 */


//Example $newStaff = new Guest(0, "nylah@gmail.com", "xxx", "0", "xxx.jpg","Nylah","Rogers", "ahs@jkasdhf", 0);
class Guest extends User
{
    /**
     * Properties
     */

    //Property for Guest ID Type: Int
    private $guestId;

    //Property for Guest Family Group Type: boolean 
    private $birthdate;

    //Property for Guest Pet Type: boolean 
    private $pet_status;

    //Property for Guest Family Group Type: boolean 
    private $family_group;

    /**
     * Methods
     */
    
    //Class Constructor
    public function __construct($id, $username=NULL, $auth, $email=NULL, $phone=NULL, $fname, $lname, $notes=null, $birthdate=NULL, $pet=NULL, $family=NULL)
    {
        parent::__construct($id, $username, $auth, $email, $phone, $fname, $lname, $notes);
        $this->birthdate = $birthdate;
        $this->pet_status = $pet;
        $this->family_group = $family;
    }


    /**
     * Getters
     */

    

    //Returns an Integer for GuestId
    function getPetStatus()
    {
        return $this->pet_status;
    }

    function getFamilyGroupStatus()
    {
        return $this->family_group;
    }

    function getGuestId()
    {
        return $this->guestId;
    }

    function getBirthdate()
    {
        return $this->birthdate;
    }

    


    /**
     * Setters
     */



    //Expects an Integer for guest Id
    function setGuestId($id)
    {
        $this->guestId = $id;
    }

    //Expects a bool for pet status
    function setPetStatus($status)
    {
        $this->pet_status = $status;
    }

    //Expects an BOOL for family group status
    function setFamilyGroupStatus($status)
    {
        $this->family_group = $status;
    }

    //Expects an BOOL for family group status
    function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    

}


/* TESTING
$nylah = new Guest(0, "nylah@gmail.com", "xxx", "0", "xxx.jpg","Nylah","Rogers", "ahs@jkasdhf", 0);
echo $nylah->getConfirmEmail();*/