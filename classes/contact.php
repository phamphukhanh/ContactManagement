<?php
class Contact
{
    private $contactID;
    private $userID;
    private $name;
    private $phone;
    private $email;
    private $company;
    private $notes;
    private $isBlocked;
    // Constructor
    public function __construct()
    {
    }

    //Getters
    public function getContactID()
    {
        return $this->contactID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function isBlocked()
    {
        return $this->isBlocked;
    }

    // Setter
    public function setContactID($contactID)
    {
        $this->contactID = $contactID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function setIsBlocked($isBlocked)
    {
        $this->isBlocked = $isBlocked;
    }

    // toString
    public function __toString()
    {
        return "Contact ID: " . $this->contactID . ", User ID: " . $this->userID . ", Name: " . $this->name . ", Phone: " . $this->phone . ", Email: " . $this->email . ", Company: " . $this->company . ", Notes: " . $this->notes . ", Is Blocked: " . $this->isBlocked;
    }
}
