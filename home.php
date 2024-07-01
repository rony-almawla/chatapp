<?php 
session_start();
include_once "php/config.php";

// Redirect to login page if user is not authenticated
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit; // Ensure no further code execution after redirection
}

// Fetch current user's details
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
} else {
    header("location: users.php"); // Redirect if current user not found (this should ideally not happen)
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once "header.php"; ?>
<body>
    <div class="container">
        <?php include_once "header.php"; ?>

        <!-- Users Section -->
        <div class="wrapper">
            <section class="users"> 
                <header>
                    <div class="content">
                        <img src="php/images/<?php echo $row['img']; ?>" alt="">
                        <div class="details">
                            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                            <p><?php echo $row['status']; ?></p>
                        </div>
                    </div>
                    <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
                </header>
                <div class="search">
                    <span class="text">Select a user to start chat</span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
                    <!-- Placeholder for users list -->
                </div>
            </section>
        </div>

        <!-- Chat Section -->
        <div class="wrapper">
            <section class="chat-area">
            <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);// it turns the data entered into a string to prevent my hacking problems
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
            </section>
        </div>

    </div>

    <!-- JavaScript Files -->
    <script src="javascript/users.js"></script>
    <script src="javascript/chat.js"></script>
</body>
</html>