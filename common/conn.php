<?php
require_once "./vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// $dsn = $_ENV['DB_DSN'];
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

// $host = "127.0.0.1";
// $dbname= "cda_weblibrary";
// $username = "root";
// $password = "";


// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>