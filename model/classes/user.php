<?php

/**
 * User
 */


class User
{
    /**
     * Properties
     */

    // Property for user ID, Type: Int    
    private $id;

    // Property for user's username, Type: String 
    private $username;

    // Property for the password hash, Type: String 
    private $passwordHash;

    // Property for user's email, Type: String 
    private $email;

    // Property for user's email, Type: String 
    private $phone;

    // Property for last name Type: String
    private $fname;

    // Property for first name, Type: String
    private $lname;

    // Property user authority, Type: Int 
    private $auth;

    // Property for profile image, Type: String 
    private $profileImg;

    // Property for confirmation email, Type: boolean    
    private $confirmEmail;

    // Property for confirmation text number, Type: boolean    
    private $confirmText;

    //Property for User notes
    private $notes;


    /**
     * Methods
     */


    //Class Constructor
    function __construct($id, $username=NULL, $auth, $email=NULL, $phone=NULL, $fname, $lname, $notes=null) 
    {
        $this->id = $id;
        $this->username = $username;
        $this->auth = $auth;
        $this->email = $email;
        $this->phone = $phone;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->notes = $notes;
        $this->profileImg = NULL;
        $this->passwordHash = NULL;
    }

    /**
     * Getters
     */

    //Returns an Integer for User ID
    function getId()
    {
        return $this->id;
    }

    //Returns a Username for Email
    function getUsername()
    {
        return $this->username;
    }

    //Returns a String for Password Hash
    function getPasswordHash()
    {
        return $this->passwordHash;
    }

    //Returns an Int for User Authority
    function getAuth()
    {
        return $this->auth;
    }

    //Returns a String for Email
    function getEmail()
    {
        return $this->email;
    }

    //Returns a String for Email
    function getPhone()
    {
        return $this->phone;
    }

    //Returns a String for First Name
    function getFirstName()
    {
        return $this->fname;
    }

    //Returns a String for Last Name
    function getLastName()
    {
        return $this->lname;
    }

    //Returns a String for First and Last Name
    function getFullName()
    {
        return $this->fname . ' ' . $this->lname;
    }

    //Returns a boolean for Confirmation Email
    function getConfirmEmail()
    {
        return $this->confirmEmail;
    }

    //Returns a boolean for Confirmation Phone Number
    function getConfirmText()
    {
        return $this->confirmText;
    }

    //Returns a String for the Profile Image Name
    function getProfileImg()
    {
        return $this->profileImg;
    }

    //Returns a String for the Profile Image Name
    function getProfileImgWithPath()
    {
        $path = "";
        $image =  $this->profileImg;
        return $path . $image;
    }

    //Returns an String for Notes
    function getNotes()
    {
        return $this->notes;
    }


    /**
     * Setters
     */

    //Expects an Integer for User Id
    function setId($id)
    {
        $this->id = $id;
    }

    //Expects a String for User's Username
    function setUsername($username)
    {
        $this->username = $username;
    }

    //Expects a String for password hash
    function setPasswordHash($hash)
    {
        $this->passwordHash = $hash;
    }

    //Expects an Integer for User Authority
    function setAuth($auth)
    {
        $this->auth = $auth;
    }

    //Expects a String for User Email
    function setEmail($email)
    {
        $this->email = $email;
    }

    //Expects a String for User Phone
    function setPhone($phone)
    {
        $this->phone = $phone;
    }


    //Expects a String for First Name
    function setLastName($lname)
    {
        $this->lname = $lname;
    }

    //Expects a String for First Name
    function setFirstName($fname)
    {
        $this->fname = $fname;
    }

    //Expects a boolean for Confirmation Email
    function setConfirmEmail($confirmEmail)
    {
        if(!is_bool($confirmEmail))
        {
            throw new Exception('$confirmEmail must be a boolean!');
        }
        else{
            $this->confirmEmail = $confirm;
        }
        
    }
    
    //Expects an boolean for Confirmation Phone Number
    function setConfirmText($confirmText)
    {
        if(!is_bool($confirmText))
        {
            throw new Exception('$confirmText must be a boolean!');
        }
        else{
            $this->confirmText = $confirmText;
        }
        
    }

    //Expects a String for Profile Image name
    function setProfileImg($profileImg)
    {
        $this->profileImg = $profileImg;
    }

    //Expects an string for guest notes
    function setNotes($notes)
    {
        $this->notes = $notes;
    }

}

