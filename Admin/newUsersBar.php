<?php include_once "../header.php"; ?>

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
          <a href="../php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
        </header>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $contact_number = $_POST['contact_number'];
          $ownerQuery = mysqli_query($conn, "SELECT * FROM contact_list WHERE contact_number = $contact_number");
          $ownerRow = mysqli_fetch_assoc($ownerQuery);
          $contact_owner = $ownerRow['contact_owner'];
          
          if (!empty($contact_owner)) {
            // Check if username or email already exist in the database
            $existingEmailQuery = "SELECT * FROM contact_list WHERE contact_owner = '$contact_owner' AND contact_number = '$contact_number'";

            $existingEmailResult = $conn->query($existingEmailQuery);

            if ($existingEmailResult->num_rows > 0) {
              echo "<p>Contact number is already added. Please use a different contact.</p>";
            } else {
              // Insert user information into the database
              $insertQuery = "INSERT INTO contact_list (contact_owner, contact_number) VALUES ('$contact_owner', '$contact_number')";
              if ($conn->query($insertQuery) === TRUE) {
                //echo "<p>Registration successful! You will receive a confirmation email soon.</p>";
                header("Location: ../users.php"); // Redirect to chat page
              } else {
                echo "<p>Error: Failed to add contact. Please try again later.</p>";
              }
            }
          } else {
            echo "<p>Error: Failed to add contact. Please try again later.</p>";
          }
        }
        ?>


       
        <a href="newUsers.php" class="btn btn-primary mb-2">User List</a>
          <button class="btn btn-primary mb-2">New Users</button>
          <button class="btn btn-primary mb-2">Active Users</button>
          <button class="btn btn-primary mb-2">Chat History</button>



        <div class="search">
          <span class="text">Select an user to start chat</span>
          <input type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>


        <!-- <div class="users-list"> -->
        <div class="users-list">
          <?php
          $user = $_SESSION['unique_id'];

          $sql = "SELECT * FROM users WHERE payment_status = 'unpaid' ORDER BY user_id DESC";
          $query = mysqli_query($conn, $sql);
          $output = "";
          if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available to chat";
          } elseif (mysqli_num_rows($query) > 0) {
            // include_once "data.php";
            while ($row = mysqli_fetch_assoc($query)) {
              

              ($user == $row['contact_owner']) ? $hid_me = "hide" : $hid_me = "";
              $image = "unseen.jpg";
              $button = "<button class='btn mx-2 btn-sm btn-danger mb-2'>Approve</button>";

              if($row['payment_status']=='paid'){
                $image = "seen.png";
                $button = "<button type='unseen' class='btn mx-2 btn-sm btn-primary mb-2'>Unseen</button>";
              }
              $output .= '<a href="adminChat.php?contact_id=' . $row['unique_id'] . '">
            <div class="content">
              <img src="../php/images/' . $row['img'] . '" alt="">
              <div class="details">
                <form class="form-inline" action="#" method="SEEN" enctype="multipart/form-data" autocomplete="off">
                <span>' . $row['unique_id'] . '</span>'.$button.'
                </form>
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

  <script src="../javascript/users.js"></script>

</body>

</html>