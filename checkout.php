<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['cart'])) {
  // 1. Create order
  $pdo->exec("INSERT INTO orders () VALUES ()");
  $orderId = $pdo->lastInsertId();

  // 2. Insert order_items
  $stmt = $pdo->prepare(
    "INSERT INTO order_items (order_id, product_id, qty) VALUES (?, ?, ?)"
  );
  foreach ($_SESSION['cart'] as $prodId => $qty) {
    $stmt->execute([$orderId, $prodId, $qty]);
  }

  // 3. Clear cart & show confirmation styled like index.php
  $_SESSION['cart'] = [];
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Thank You!</h1>
    <div class="checkout-card">
      <p style="font-size:1.15rem;margin-bottom:18px;">✅ Your order has been placed. Fun fact, it is our <strong>#<?= htmlspecialchars($orderId) ?></strong> order.</p>
      <a class="cart-link" href="index.php">Back to shop</a>
    </div>
  </body>
  </html>
  <?php
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Checkout</h1>
  <div class="checkout-card">
    <form method="POST">
      <p>Click <strong>“Place Order”</strong> to complete your purchase.</p>
      <button class="checkout-btn" type="submit">Place Order</button>
    </form>
    <a class="cart-link" href="cart.php">Back to Cart</a>
  </div>
</body>
</html>