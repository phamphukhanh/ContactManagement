<?php
class User
{
    private $userID;
    private $firstName;
    private $lastName;
    private $username;
    private $password;

    function __construct()
    {
    }

    // Getter and Setter methods
    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function __toString()
    {
        return "User ID: " . $this->userID . ", Name: " . $this->firstName . " " . $this->lastName . ", Username: " . $this->username . ", Password: " . $this->password;
    }
}
