<?php
include_once "../dal/contact_dal.php";
include_once "../classes/user.php";

$contactDAL = new contact_dal();
session_start();
if (isset($_SESSION["user_info"])) {
    $user = $_SESSION["user_info"];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Kiểm tra xem nút "Add" đã được nhấn hay chưa
        if (isset($_POST["add"])) {
            // Lấy các giá trị từ form có method POST
            $user = $_SESSION["user_info"];
            $newContact = new Contact();

            $newContact->setUserID($user->getUserId());
            $newContact->setName($_POST["contact_name"]);
            $newContact->setPhone($_POST["phone"]);
            $newContact->setEmail($_POST["mail"]);
            $newContact->setCompany($_POST["company"]);
            $newContact->setNotes($_POST["notes"]);

            if ($contactDAL->insertNewContact($newContact)) {
                header(
                    "Location: ../ui/home.php?added=1"
                );
                exit();
            } else {
                header(
                    "Location: ../ui/home.php?added=0"
                );
                exit();
            }
        }
    }
}
