<?php include_once "header.php"; ?>

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
              <img src="php/images/<?php echo $row['img']; ?>" alt="">
              <div class="details">
                <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                <p><?php echo $row['status']; ?></p>
              </div>
            </div>
            <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
          </header>

          <?php
          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contact_number = $_POST['contact_number'];
            $contact_owner = $_SESSION['unique_id'];

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
                  header("Location: users.php"); // Redirect to chat page
                } else {
                  echo "<p>Error: Failed to add contact. Please try again later.</p>";
                }
              }
            } else {
              echo "<p>Error: Failed to add contact. Please try again later.</p>";
            }
          }
          ?>


          <form class="form-inline" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputPassword2" class="sr-only">New Contact</label>
              <input id="contact_number" type="text" class="form-control" name="contact_number" placeholder="New Contact">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Add to Chat</button>
          </form>


          <div class="search">
            <span class="text">Select an user to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
          </div>


          <div class="users-list">

          </div>
        </section>
      </div>

  </div>

  <script src="javascript/users.js"></script>

</body>

</html>