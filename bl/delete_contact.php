<?php
include_once "../dal/contact_dal.php";

$contactDAL = new contact_dal();
$contactID = $_GET["contact_id"];

// echo $contactID;
if ($contactDAL->deleteContact($contactID)) {
    // Nếu thành công, trở về trang chủ với thông báo thành công
    header(
        "Location: ../ui/home.php?deleted=1"
    );
    exit();
} else {
    // Nếu không thành công, trở về trang chủ với thông báo không thành công
    header(
        "Location: ../ui/home.php?deleted=0"
    );
    exit();
}
