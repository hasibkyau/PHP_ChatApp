<?php 
session_start();
include_once "../php/config.php";
include_once "header.php"; 
?>

<body>
  <div class="container">

    <div class="wrapper">
      <section class="users">
        <header>
          <div class="content">
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <img src="../php/images/<?php echo $row['img']; ?>" alt="">
            <div class="details">
              <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
              <p><?php echo $row['status']; ?></p>
            </div>
          </div>
          <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
        </header>

   


        <form class="form-inline" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <button type="submit" class="btn btn-primary m-2">All Users</button>  
        <button type="submit" class="btn btn-primary m-2">New Users</button>
          <button type="submit" class="btn btn-primary m-2">Active Users</button>
          <button type="submit" class="btn btn-primary m-2">Chat History</button>
        </form>


        <div class="search">
          <span class="text">Select an user to start chat</span>
          <input type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>


        <!-- <div class="users-list"> -->
        <div class="users-list">
          <?php
          $user = $_SESSION['unique_id'];
          $sql = "SELECT * FROM contact_list ORDER BY contact_id DESC";
          $query = mysqli_query($conn, $sql);
          $output = "";
          if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available to chat";
          } elseif (mysqli_num_rows($query) > 0) {
            // include_once "data.php";
            while ($row = mysqli_fetch_assoc($query)) {
              $sql2 = "SELECT * FROM messages WHERE (sender = {$row['contact_id']}
          OR receiver = {$row['contact_id']}) ORDER BY msg_id DESC LIMIT 1";
              $query2 = mysqli_query($conn, $sql2);
              $row2 = mysqli_fetch_assoc($query2);

              if (isset($row2['sender'])) {
                ($user == $row2['sender']) ? $you = "You: " : $you = "";
                // ($user == $row2['sender']) ? $seen =" " : $seen = ' (' . $row2['status'] . ')';
              } else {
                $you = "";
              }

              (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
              // (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' . $seen : $msg = $result. $seen ;
              (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;
              // ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
              ($user == $row['contact_owner']) ? $hid_me = "hide" : $hid_me = "";

              $output .= '<a href="../chat.php?contact_id=' . $row['contact_id'] . '">
            <div class="content">
              <img src="../php/images/' . $row['img'] . '" alt="">
              <div class="details">
                <span>' . $row['contact_number'] . '</span>
                <p>' . $you . $msg . '</p>
              </div>
            </div>

          </a>';
            }
          }
          echo $output;
          ?>
        </div>

      </section>
    </div>

  </div>

  <script src="javascript/users.js"></script>

</body>

</html>