<?php
// config.php
session_start();

// RDS connection

// 1. Database credentials
$host   = 'wilson-ecommerce-db.cwshurqxuxxl.us-east-1.rds.amazonaws.com';
$dbname = 'ecommerce';
$user   = 'admin';
$pass   = 'passwordhere';
$port   = 3306;

// 2. Try connecting via PDO
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // echo "<script>alert('✅ Connected successfully to RDS MySQL!');</script>";
} catch (PDOException $e) {
    echo "<script>alert('❌ Connection failed.');</script>";
    // echo "❌ Connection failed: " . $e->getMessage();
}
?>
