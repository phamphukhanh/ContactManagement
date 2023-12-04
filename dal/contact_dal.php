<?php
include_once "../classes/contact.php";
include_once "database.php";
class contact_dal extends database
{
    function getContacts($userID, $isBlocked)
    {
        $sql = "SELECT * FROM contacts WHERE user_id = '" . $userID . "' AND is_blocked = '" . $isBlocked . "'";
        // echo $sql;
        $result = $this->con->query($sql);
        // Nếu lấy được dữ liệu
        if ($result != null) {
            // Thì lưu dữ liệu thành một mảng các liên hệ
            $contacts = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $contact = new Contact();

                $contact->setContactID($row['contact_id']);
                $contact->setUserID($row['user_id']);
                $contact->setName($row['name']);
                $contact->setPhone($row['phone']);
                $contact->setEmail($row['email']);
                $contact->setCompany($row['company']);
                $contact->setNotes($row['notes']);
                $contact->setIsBlocked($row['is_blocked']);

                $contacts[] = $contact;
            }

            return $contacts;
        } else {
            return false;
        }
    }

    function getContactsByName($userID, $name, $isBlocked)
    {
        $sql = "SELECT * FROM contacts WHERE user_id = '" . $userID . "' AND name LIKE '%" . $name . "%' AND is_blocked = '" . $isBlocked . "'";
        // echo $sql;
        $result = $this->con->query($sql);
        // Nếu lấy được dữ liệu
        if ($result != null) {
            // Thì lưu dữ liệu thành một mảng các liên hệ
            $contacts = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $contact = new Contact();

                $contact->setContactID($row['contact_id']);
                $contact->setUserID($row['user_id']);
                $contact->setName($row['name']);
                $contact->setPhone($row['phone']);
                $contact->setEmail($row['email']);
                $contact->setCompany($row['company']);
                $contact->setNotes($row['notes']);
                $contact->setIsBlocked($row['is_blocked']);

                $contacts[] = $contact;
            }

            return $contacts;
        } else {
            return false;
        }
    }

    function getContactsByID($contactID)
    {
        $sql = "SELECT * FROM contacts WHERE contact_id = '" . $contactID . "'";
        echo $sql;
        $result = $this->con->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            $item = mysqli_fetch_assoc($result);
            $contact = new Contact();

            $contact->setContactID($item["contact_id"]);
            $contact->setUserID($item["user_id"]);
            $contact->setName($item["name"]);
            $contact->setPhone($item["phone"]);
            $contact->setEmail($item["email"]);
            $contact->setCompany($item["company"]);
            $contact->setNotes($item["notes"]);
            $contact->setIsBlocked($item["is_blocked"]);

            return $contact;
        } else {
            return null;
        }
    }

    function insertNewContact($contact)
    {
        $sql = "INSERT INTO contacts (user_id, name, phone, email, company, notes, is_blocked)
        VALUES (" .
            "'" . $contact->getUserID() . "'" . ", " .
            "'" . $contact->getName() . "'" . ", " .
            "'" . $contact->getPhone() . "'" . ", " .
            "'" . $contact->getEmail() . "'" . ", " .
            "'" . $contact->getCompany() . "'" . ", " .
            "'" . $contact->getNotes() . "'" . ", " .
            "'" . 0 . "'" .
            ")";
        echo $sql;
        $result = $this->con->query($sql);
        if ($result) {
            return true;
        }
        // Nếu có lỗi xảy ra, trả về thông báo lỗi.
        return $this->con->error;
    }

    function deleteContact($contactID)
    {
        $sql = "DELETE FROM contacts WHERE contact_id = '$contactID'";
        $result = $this->con->query($sql);
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }

    function updateContact($contact)
    {
        $sql =
            "UPDATE contacts SET " .
            "name = " . "'" . $contact->getName() . "', " .
            "phone = " . "'" . $contact->getPhone() . "', " .
            "email = " . "'" . $contact->getEmail() . "', " .
            "company = " . "'" . $contact->getCompany() . "', " .
            "notes = " . "'" . $contact->getNotes() . "' " .
            "WHERE contact_id = " . "'" . $contact->getContactID() . "'";
        $result = $this->con->query($sql);
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }

    function changeContactStatus($contactID, $status)
    {
        $sql =
            "UPDATE contacts SET " .
            "is_blocked = " . "'" . $status . "' " .
            "WHERE contact_id = " . "'" . $contactID . "'";
        echo $sql;
        $result = $this->con->query($sql);
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }
}
