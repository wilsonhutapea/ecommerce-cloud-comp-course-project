<?php
require 'config.php';

// Fetch products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Products</h1>
  <div class="products">
    <?php foreach ($products as $p): ?>
      <div class="product-card">
        <img src="images/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
        <strong><?= htmlspecialchars($p['name']) ?></strong>
        <div class="price">$<?= number_format($p['price'],2) ?></div>
        <a class="add-to-cart" href="cart.php?add=<?= $p['id'] ?>">Add to Cart</a>
      </div>
    <?php endforeach; ?>
  </div>
  <hr>
  <a class="cart-link" href="cart.php">View Cart (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a>
</body>
</html>
