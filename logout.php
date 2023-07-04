      <?php
      session_start();
unset($_SESSION["admin_id"]);
unset($_SESSION['username']);
unset($_SESSION['password']);
header('Location: login.php'); // default page
?>