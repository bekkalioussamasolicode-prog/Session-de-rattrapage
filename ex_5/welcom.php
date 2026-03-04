<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: signUp.php");
  exit;
}
$email = $_SESSION['email'];
echo "Hello your email is $email";
