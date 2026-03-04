<form method="post">
  <label>Quantity :</label>
  <input type="number" name="qte">
  <label>Price :</label>
  <input type="number" name="price">
  <button type="submit">Count</button>
</form>
<?php
function calcPrice($qte, $price)
{
  $total = $price * $qte;
  if ($qte > 10) {
    $total -= $total * 0.10;
  }
  return $total;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $qte = $_POST["qte"] ?? "";
  $price = $_POST["price"] ?? "";
  if (!empty($qte) && !empty($price)) {
    if ($qte > 0 && $price > 0) {
      echo "Total is " . calcPrice($qte, $price);
    } else {
      echo "Must be positive";
    }
  } else {
    echo "Not valide";
  }
}
?>