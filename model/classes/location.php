<?php

/**
 * User
 */


class Location
{

    /**
     * Properties
     */

    // Property for user ID, Type: Int    
    private $id;

    // Property for Location name Type: String
    private $name;

    //Property for Street Address Type: String
    private $address1;

    //Property for Address 2 Type: String
    private $address2;

    //Property for Address City Type: String
    private $address3;

    //Property for Address State Type: String
    private $address4;

    // Property for location phone, Type: String 
    private $phone;

    // Property for location email, Type: String 
    private $email;

    // Property for location email, Type: String 
    private $serves;

    // Property for location capacity (number of beds), Type: int 
    private $capacity;

    //Property for Notes Type: String
    private $notes;

    /**
     * Methods
     */


    //Class Constructor
    function __construct($id, $name, $address1, $address2, $address3, $address4, $phone=NULL, $email=NULL, $serves, $capacity) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->address3 = $address3;
        $this->address4 = $address4;
        $this->phone = $phone = NULL;
        $this->email = $email = NULL;
        $this->serves = $serves;
        $this->capacity = $capacity;
    }

    /**
     * Getters
     */


     //Returns an Integer for User ID
    function getId()
    {
        return $this->id;
    }

    //Returns a String for Name
    function getName()
    {
        return $this->name;
    }


    /**
     * Setters
     */

    //Expects an Integer for User Id
    function setId($id)
    {
        $this->id = $id;
    }

}