<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $sender = $_SESSION['unique_id'];
        $receiver = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (sender, receiver, msg)
                                        VALUES ({$sender}, {$receiver}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>