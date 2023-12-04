<?php
include_once "../dal/contact_dal.php";
include_once "../classes/user.php";
$contactDAL = new contact_dal();

session_start();
if (isset($_SESSION["user_info"])) {
    $user = $_SESSION["user_info"];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Kiểm tra xem nút "Save" đã được nhấn hay chưa
        if (isset($_POST["save"])) {
            $selectedContact = $_SESSION["contact_info"];
            $contact = new Contact();

            $contact->setContactID($selectedContact->getContactID());
            $contact->setName($_POST["contact_name"]);
            $contact->setPhone($_POST["phone"]);
            $contact->setEmail($_POST["mail"]);
            $contact->setCompany($_POST["company"]);
            $contact->setNotes($_POST["notes"]);

            if ($contactDAL->updateContact($contact)) {
                header(
                    "Location: ../ui/home.php?updated=1"
                );
                exit();
            } else {
                header(
                    "Location: ../ui/home.php?updated=0"
                );
                exit();
            }
        }
    }
}
