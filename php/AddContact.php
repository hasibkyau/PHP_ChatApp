<?php
session_start();


include_once "config.php";

$contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
$contact_owner = $_SESSION['unique_id'];


$sql = mysqli_query($conn, "SELECT * FROM contact_list WHERE contact_number = '{$contact_number}' AND contact_owner = '{$contact_owner}' ");

if (mysqli_num_rows($sql) == 0) {


    $insert_query = mysqli_query($conn, "INSERT INTO contact_list (contact_number, contact_owner)
            VALUES ({$contact_number}, '{$contact_owner}')");
    if ($insert_query) {
        echo "success";
    } else {
        echo "Something went wrong. Please try again!";
    }
}
