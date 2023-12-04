<?php
include_once "../dal/contact_dal.php";

$contactDAL = new contact_dal();

$contactID = $_GET["contact_id"];
$selectedContact = $contactDAL->getContactsByID($contactID);
session_start();
$_SESSION['contact_info'] = $selectedContact;
