<?php
class database
{
    protected $con;
    function __construct()
    {
        $this->con = new mysqli("localhost", "root", "", "contacts_management");
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }
}
