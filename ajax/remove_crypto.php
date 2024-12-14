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

    $query = "DELETE FROM favorite_crypto_users WHERE user_id = :user_id AND crypto_id = :crypto_id";
    $stmt = $pdo->prepare($query);
    $params = [
        ':user_id' => $user_id,
        ':crypto_id' => $crypto_id
    ];

    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Грешка при премахване от любими.';
    }
}

echo json_encode($response);
exit;

?>