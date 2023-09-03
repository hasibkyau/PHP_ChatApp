<?php
session_start();
include_once "php/config.php";
require_once 'header.php'; // Include the database connection

isset($_SESSION['unique_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    if($row['payment_status']=='paid'){
        header("location:users.php");
    }else{
        echo "<body>";
        echo "<div class='verification-container'>";
        echo "<h1>Pending Verification</h1>";
        // echo "<h4>Send Another</h4>";
        // echo "<form action='' method='POST' enctype='multipart/form-data'>";
        // echo "<input type='text' name='transaction_id' placeholder='Transaction ID' required>";
        // echo "<button type='submit' name='submit'>Submit Verification</button>";
        // echo "</form>";
        // echo "</div>";
        // echo "</body>";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $unique_id = $_SESSION['unique_id']; // Assuming user is already logged in
    $transaction_id = $_POST['transaction_id'];

    $insertQuery = "INSERT INTO payment_verification (unique_id, transaction_id) VALUES ('$unique_id', '$transaction_id')";
    $conn->query($insertQuery);
    header("location:users.php");
}
?>

<body>
    <div class="verification-container">
        <h1>Subscription Payment Verification</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="transaction_id" placeholder="Transaction ID" required>
            <button type="submit" name="submit">Submit Verification</button>
        </form>
    </div>
</body>