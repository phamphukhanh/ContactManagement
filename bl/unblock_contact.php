<?php
include_once "../dal/contact_dal.php";

$contactDAL = new contact_dal();
$contactID = $_GET["contact_id"];
if ($contactDAL->changeContactStatus($contactID, 0)) {
    header(
        "Location: ../ui/home.php?unblocked=1"
    );
    exit();
} else {
    header(
        "Location: ../ui/home.php?unblocked=0"
    );
    exit();
}
