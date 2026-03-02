<form method="post">
  <label>Number :</label>
  <input type="number" name="nb">
  <button type="submit">Count</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nb = $_POST["nb"] ?? "";
  if (!empty($nb)) {
    if ($nb > 0) {
      echo "  <h2>The divisors are :</h2>";
      for ($i = 1; $i <= $nb; $i++) {
        if ($nb % $i === 0) {
          echo $i . "<br>";
        }
      }
    } else {
      echo "The numbers must be positive.";
    }
  } else {
    echo "Write a number first.";
  }
}
