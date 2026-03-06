<?php
session_start();
// if the cart session doesn't exist, create an empty array
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
// check if the file exists, then load it as an associative array
if (file_exists('products.json')) {
  $json = file_get_contents('products.json');
  $products = json_decode($json, true);
} else {
  $products = [];
}
// check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $product = $_POST["prod"] ?? "";
  $qte = $_POST["qte"] ?? "";
  if (!empty($product) && !empty($qte)) {
    // quantity must be positive
    if ($qte > 0) {
      // loop through products to find the selected product
      foreach ($products as $i => $prod) {
        $prodName = $prod['name'];
        if ($prodName == $product) {
          $stock = $prod["stock"];
          $price = $prod["price"];
          $total = $price * $qte;
          if ($qte <= $stock) {
            // store product information in the cart session
            $_SESSION['cart'][] = [
              "name" => $prodName,
              "quantity" => $qte,
              "price" => $price,
              "total" => $total
            ];
            // subtract the quantity from the product stock
            $products[$i]["stock"] -= $qte;
            // then update the json file
            file_put_contents('products.json', json_encode($products, JSON_PRETTY_PRINT));
            // this to prevent double add
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
          } else {
            echo "<p style='color:red;'>Not enough stock for $prodName. Available: $stock</p>";
          }
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Store</title>
  <style>
    form {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    button {
      padding: 8px 16px;
      background-color: #28A745;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="number"] {
      width: 60px;
      padding: 5px;
    }

    select {
      padding: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background-color: #f2f2f2;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
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
  <form method='post'>
    <label for='prod'>Products :</label>
    <select name='prod' id='prod'>
      <?php
      // create option tags for each product
      foreach ($products as $prod) {
        $prodName = $prod["name"];
        echo "
        <option value='$prodName'>$prodName({$prod['stock']})</option>
        ";
      }
      ?>
    </select>
    <label for='qte'>Quantity</label>
    <input type='number' name='qte'>
    <button type='submit'>Add</button>
  </form>
  <hr>
  <table border="1">
    <thead>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <!-- display cart items stored in the session -->
      <?php foreach ($_SESSION['cart'] as $item): ?>
        <tr>
          <td><?= $item['name'] ?></td>
          <td><?= $item['quantity'] ?></td>
          <td><?= $item['price'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="invoice.php">InVoice</a>

</body>

</html>