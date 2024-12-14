<?php

require_once('../functions.php');
require_once('../db.php');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$login_error = false;

if (empty($email) || empty($password)) {
    $login_error = true;
} else {
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        $login_error = true;
    } else {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];

            setcookie('user_email', $user['email'], time() + 3600, '/', 'localhost', false, true);
        } else {
            $login_error = true;
        }
    }
}

if ($login_error) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "Hmm! Something went wrong with your data!";
    header('Location: ../index.php?page=login');
    exit;
}

if (isset($_SESSION['user_name'])) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = "You loged in successfully!";
    header('Location: ../index.php');
    exit;
} 


