<?php

require_once '../db.php';

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['flash_msg']['type'] = 'errorContainer';
    $_SESSION['flash_msg']['text'] = 'Invalid identificator';
    header('Location: ../index.php?page=catalog');
    exit;
}

$query = "DELETE FROM crypto_types WHERE id = :id";
$stmt = $pdo->prepare($query);

if ($stmt->execute([':id' => $id])){
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Crypto is deleted!";
} else {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Something went wrong when deleting!";

    
}

header('Location: ../index.php?page=catalog');
    exit;
?>