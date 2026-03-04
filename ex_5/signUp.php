<form method="post">
  <label>Email :</label>
  <input type="email" name="email">
  <br>
  <label>Password :</label>
  <input type="password" name="password">
  <br>
  <label>Confirm password :</label>
  <input type="password" name="confPassword">
  <br>
  <button type="submit">Sign Up</button>
</form>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
  $password = $_POST["password"] ?? "";
  $confPassword = $_POST["confPassword"] ?? "";
  if (!empty($email) && !empty($password) && !empty($confPassword)) {
    if (str_ends_with($email, '@ofppt.ma')) {
      if (strlen($password) >= 8) {
        if (preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password)) {
          if ($password === $confPassword) {
            $_SESSION['email'] = $email;
            header("Location: welcom.php");
            exit;
          } else {
            echo "Password must be the same";
          }
        } else {
          echo "Password must have at least one number and one UpperCase";
        }
      } else {
        echo "Password must have at least 8 charchters";
      }
    } else {
      echo "Email must ends with @ofppt.ma";
    }
  } else {
    echo "All fields are required";
  }
}
?>