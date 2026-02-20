<?php
$host = '127.0.0.1';
$db   = 'sklimedw_strsity';
$user = 'sklimedw_strsity';
$pass = 'y80jI&Gz8Qui';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

// Function to get product price by article
function getProductPrice($article) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT price FROM products WHERE article = ?");
    $stmt->execute([$article]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['price'] : null;
}

// Function to get product info by article
function getProductInfo($article) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE article = ?");
    $stmt->execute([$article]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Function to get NewVanna price by article
function getNewVannaPrice($article) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT price FROM NewVanna WHERE article = ?");
    $stmt->execute([$article]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['price'] : null;
}

// Function to get full NewVanna product info by article
function getNewVannaInfo($article) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM NewVanna WHERE article = ?");
    $stmt->execute([$article]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Optional: get all records from NewVanna
function getAllNewVanna() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM NewVanna");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>