<form method="post">
  <label>Your note :</label>
  <input type="text" name="note" placeholder="MAX 20">
  <button type="submit">ok</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $note = $_POST["note"];
  if (empty($note)) {
    echo "<p style='color:red'>The input is empty</p>";
  } else {
    if (is_numeric($note) && $note >= 0 && $note <= 20) {
      if ($note >= 10) {
        echo "<p style='color:green'>You pass.</p>";
      } else {
        echo "<p style='color:red'>You didn't pass.</p>";
      }
    } else {
      echo "<p style='color:red'>Wrong!!</p>";
    }
  }
}

?>