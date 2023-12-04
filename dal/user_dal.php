<?php
include_once "../classes/user.php";
include_once "database.php";
class user_dal extends database
{

    function __construct()
    {
        parent::__construct();
    }

    function insertNewAccount($user)
    {
        $sql = "INSERT INTO users (first_name, last_name, username, password)
        VALUES (" .
            "'" . $user->getFirstName() . "'" . ", " .
            "'" . $user->getLastName() . "'" . ", " .
            "'" . $user->getUsername() . "'" . ", " .
            "'" . $user->getPassword() . "'" .
            ")";
        echo $sql;
        $result = $this->con->query($sql);
        if ($result) {
            return true;
        }
        // Nếu có lỗi xảy ra, trả về thông báo lỗi.
        return $this->con->error;
    }

    function getUserByEmail($username)
    {
        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result = $this->con->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            $item = mysqli_fetch_assoc($result);
            $user = new User();
            $user->setuserID($item["user_id"]);
            $user->setFirstName($item["first_name"]);
            $user->setLastName($item["last_name"]);
            $user->setUsername($item["username"]);
            $user->setPassword($item["password"]);
            return $user;
        } else {
            return null;
        }
    }

    function getLoginPassword($username)
    {
        $sql = "SELECT password FROM users WHERE username = '" . $username . "'";
        // echo $sql . "<br>";
        $result = $this->con->query($sql);
        if ($result != null) {
            $item = mysqli_fetch_assoc($result);
            return $item['password'];
        } else {
            return null;
        }
    }
}
