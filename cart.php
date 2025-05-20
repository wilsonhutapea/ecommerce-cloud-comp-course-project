<?php
require 'config.php';

// Initialize cart if needed
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Add item?
if (!empty($_GET['add'])) {
  $id = (int)$_GET['add'];
  $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
  header('Location: cart.php'); exit;
}

// Remove item?
if (!empty($_GET['remove'])) {
  $id = (int)$_GET['remove'];
  if (--$_SESSION['cart'][$id] <= 0) {
    unset($_SESSION['cart'][$id]);
  }
  header('Location: cart.php'); exit;
}

// Fetch product details in cart
$items = [];
if ($_SESSION['cart']) {
  $ids = implode(',', array_keys($_SESSION['cart']));
  $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
  $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Cart</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Your Cart</h1>
  <?php if (empty($items)): ?>
    <div class="empty-cart">
      <p>Your cart is empty.</p>
      <a class="cart-link" href="index.php">Shop now</a>
    </div>
  <?php else: ?>
    <div class="cart-list">
      <?php foreach ($items as $p): ?>
        <div class="cart-item">
          <div class="cart-item-info">
            <span class="cart-item-name"><?= htmlspecialchars($p['name']) ?></span>
            <span class="cart-item-qty">× <?= $_SESSION['cart'][$p['id']] ?></span>
            <span class="cart-item-price">($<?= number_format($p['price'] * $_SESSION['cart'][$p['id']],2) ?>)</span>
          </div>
          <a class="remove-btn" href="?remove=<?= $p['id'] ?>" title="Remove one">–1</a>
        </div>
      <?php endforeach; ?>
    </div>
    <a class="cart-link" href="checkout.php">Proceed to Checkout</a>
  <?php endif; ?>
  <a class="cart-link" href="index.php">Continue Shopping</a>
</body>
</html>