<?php
session_start();
include_once "php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
include_once "header.php";
?>


<body>
  <div class="container">

    <div class="row">

    </div>


    <div class="row">
      <div class="col-6">
      <?php include_once "adminbar.php"; ?>
      </div>

      <div class="col-6">
      <div class="wrapper container">
          <section class="chat-area">
            <header>
              <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
              <img src="php/images/profile.jpg" alt="">
              <div class="details">
                <span>Select your contact</span>
                
              </div>
              <!-- <button type="submit" class="btn btn-sm btn-info">Seen</button> -->
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
              <input type="text" class="incoming_id" name="incoming_id">
             
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
          </section>
        </div>
      </div>

    </div>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>