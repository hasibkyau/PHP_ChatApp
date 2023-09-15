<?php
session_start();
include_once "../php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: ../login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="container">
    <div class="row"></div>
    <div class="row">
      <div class="col-6">
      <?php include_once "adminbar.php"; ?>
      </div>
      <div class="col-6">
        <div class="wrapper container">
          <section class="chat-area">
            <header>
              <?php
              $contact_id = mysqli_real_escape_string($conn, $_GET['contact_id']);

              $update =mysqli_query($conn, "UPDATE messages SET status='seen' WHERE sender = {$contact_id}");
              $sql = mysqli_query($conn, "SELECT * FROM contact_list WHERE contact_id = {$contact_id}");
              if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
              } else {
                header("location: ../users.php");
              }
              ?>
              <a href="../users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
              <img src="../php/images/<?php echo $row['img']; ?>" alt="">
              <div class="details">
                <span><?php echo $row['contact_number'] ?></span>
                
              </div>
              <!-- <button type="submit" class="btn btn-sm btn-info">Seen</button> -->
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
              <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $contact_id; ?>" hidden>
              <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
          </section>
        </div>
      </div>
    </div>

  </div>


  <script src="../javascript/chat.js"></script>

</body>

</html>