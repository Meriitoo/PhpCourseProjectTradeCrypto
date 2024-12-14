<?php

require_once('../functions.php');
require_once('../db.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "You must be logged in to add cryptocurrencies.";
    header('Location: ../index.php?page=login');
    exit;
}

$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';
$description = $_POST['description'] ?? '';
$image = $_POST['image'] ?? '';
$payment_method = $_POST['payment'] ?? '';
$user_id = $_SESSION['user_id'];

if (empty($name) || empty($price) || empty($image) || empty($description) || empty($payment_method)) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Please fill all fields!";
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=create');
    exit;
}

if (mb_strlen($description) < 10) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "The description must be at least 10 characters!";
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=create');
    exit;
}

if ($price < 0) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "The price must be greater than 0!";
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=create');
    exit;
}

$query = "INSERT INTO crypto_types (name, price, description, image, payment_method, user_id) 
          VALUES (:name, :price, :description, :image, :payment_method, :user_id)";
$stmt = $pdo->prepare($query);
$params = [
    ':name' => $name,
    ':price' => $price,
    ':description' => $description,
    ':image' => $image,
    ':payment_method' => $payment_method,
    ':user_id' => $user_id
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "The crypto is added successfully!";
    header('Location: ../index.php?page=catalog');
    exit;
} else {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Oops! Something went wrong!";
    header('Location: ../index.php?page=create');
    exit;
}

?>