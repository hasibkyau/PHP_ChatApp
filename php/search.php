<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM contact_list WHERE contact_owner = {$outgoing_id} AND (contact_number LIKE '%{$searchTerm}%' OR name LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (sender = {$row['contact_id']}
                    OR receiver = {$row['contact_id']})  ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
    
            if(isset($row2['sender'])){
                ($outgoing_id == $row2['sender']) ? $you = "You: " : $you = "";
            }else{
                $you = "";
            }
    
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result ;
            // ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['contact_owner']) ? $hid_me = "hide" : $hid_me = "";
    
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
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>