<?php

require_once('../db.php');

$response = [
    'success' => true,
    'data' => [],
    'error' => ''
];

$crypto_id = intval($_POST['crypto_id'] ?? 0);

if ($crypto_id <= 0) {
    $response['success'] = false;
    $response['error'] = 'Невалиден продукт.';
} else {
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO favorite_crypto_users (user_id, crypto_id) VALUES (:user_id, :crypto_id)";
    $stmt = $pdo->prepare($query);
    $params = [
        ':user_id' => $user_id,
        ':crypto_id' => $crypto_id
    ];

    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Грешка при добавяне в любими.';
    }
}

echo json_encode($response);
exit;

?>