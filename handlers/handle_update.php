<?php

require_once '../db.php';

$id = intval($_POST['id'] ?? 0);
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';
$description = $_POST['description'] ?? '';
$image = $_POST['image'] ?? '';
$payment_method = $_POST['payment'] ?? '';

if (empty($name) || empty($price) || empty($image) || empty($description) || empty($payment_method)) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Please, fill all fields!";

    header('Location: ../index.php?page=create');
    exit;
}

$query = "UPDATE crypto_types SET name = :name, price = :price, description = :description, image = :image, payment_method = :payment_method WHERE id = :id";

$stmt = $pdo->prepare($query);
$params = [
    ':id' => $id,
    ':name' => $name,
    ':price' => $price,
    ':description'=> $description,
    ':image' => $image,
    ':payment_method'=> $payment_method,
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Crypto is edited!";

    header('Location: ../index.php?page=details&id=' . $id);

    exit;
} else {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Something went wrong when editing!";

    header('Location: ../index.php?page=create');
    exit;
}

?>
