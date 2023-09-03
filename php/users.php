<?php

session_start();
include_once "config.php";
$user = $_SESSION['unique_id'];
$sql = "SELECT * FROM contact_list WHERE contact_owner = {$user} ORDER BY contact_id DESC";
$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    // include_once "data.php";
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (sender = {$row['contact_id']}
                OR receiver = {$row['contact_id']})  ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);

        if(isset($row2['sender'])){
            ($user == $row2['sender']) ? $you = "You: " : $you = "";
            ($user == $row2['sender']) ? $seen =" " : $seen = ' (' . $row2['status'] . ')';
        }else{
            $you = "";
        }

        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' . $seen : $msg = $result. $seen ;
        // ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($user == $row['contact_owner']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="chat.php?contact_id='. $row['contact_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['contact_number'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    
                </a>';
    }
}
echo $output;
?>