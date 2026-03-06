<?php
session_start();
// if the cart session doesn't exist, redirect to store page
if (!isset($_SESSION['cart'])) {
  header("Location: store.php");
  exit;
}
// get the session else empty array
$cart = $_SESSION['cart'] ?? [];
$grandTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    a {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 16px;
      background-color: #007BFF;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
  </style>

</head>

<body>
  <h2>Invoice</h2>
  <!-- case cart empty  -->
  <?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
  <?php else: ?>
    <table border="1">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cart as $item):
          $total = $item['total'];
          $grandTotal += $total;
        ?>
          <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $total ?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="3">Total to pay</td>
          <td><?= $grandTotal ?></td>
        </tr>
      </tbody>
    </table>
  <?php endif; ?>
  <br>
  <a href="store.php">Back to shop</a>


</body>

</html>