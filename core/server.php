<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$driver = getenv('DB_CONNECTION');
$host = getenv('DB_HOST');
$db_user = getenv('DB_USERNAME');
$db_name = getenv('DB_DATABASE');
$db_password = getenv('DB_PASSWORD');

$dsn = "$driver:dbname=$db_name;host=$host";
$user = $db_user;
$password = $db_password;

try {
    $con = new PDO($dsn, $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //echo "PDO error: " . $e->getMessage();
    header('Location: /500'); // Modify the URL as needed
    exit();
}