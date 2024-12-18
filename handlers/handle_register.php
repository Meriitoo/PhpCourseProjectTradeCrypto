<?php

require_once('../functions.php');
require_once('../db.php');

$error = '';
// foreach ($_POST as $key => $value) {
//     if (empty($value)) {
//         $error = 'Please fill all fields !';
//         break;
//     }
// }

if (mb_strlen($error) > 0) {
    $_SESSION['flash']['message']['type'] = 'errorContainer';
    $_SESSION['flash']['message']['text'] = $error;
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=register');
    exit;
} else {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $repeat_password = $_POST['repeat_password'] ?? '';

    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $error = 'This user already exists!';
        $_SESSION['flash']['message']['type'] = 'errorContainer';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;
        header('Location: ../index.php?page=register');
        exit;
    }

    if (mb_strlen($username) < 6) {
        $error = 'The username must be at least 6 characters!';
        $_SESSION['flash']['message']['type'] = 'errorContainer';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;
        header('Location: ../index.php?page=register');
        exit;
    }

    if (mb_strlen($email) < 4) {
        $error = 'The email must be at least 4 characters!';
        $_SESSION['flash']['message']['type'] = 'errorContainer';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;
        header('Location: ../index.php?page=register');
        exit;
    }

    if (empty($password) |  empty($repeat_password)) {
        $error = 'Fill the passwords!';
        $_SESSION['flash']['message']['type'] = 'errorContainer';
        $_SESSION['flash']['message']['text'] = $error;
        header('Location: ../index.php?page=register');
        exit;
    }

    if ($password != $repeat_password) {
        $error = 'Password missmatch!';
        $_SESSION['flash']['message']['type'] = 'errorContainer';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;
        header('Location: ../index.php?page=register');
        exit;
    } else {
        $hash = password_hash($password, PASSWORD_ARGON2I);

        $query = "INSERT INTO users (username, email, `password`) VALUES (:username, :email, :hash)";
        $stmt = $pdo->prepare($query);
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':hash' => $hash
        ];

        if ($stmt->execute($params)) {
            $_SESSION['flash']['message']['type'] = 'errorContainer';
            $_SESSION['flash']['message']['text'] = "You created your account successfully!";
            header('Location: ../index.php?page=login');
            exit;
        } else {
            $error = 'Somthing went wrong!';
            $_SESSION['flash']['message']['type'] = 'errorContainer';
            $_SESSION['flash']['message']['text'] = $error;
            $_SESSION['flash']['data'] = $_POST;
            header('Location: ../index.php?page=register');
            exit;
        }
    }
}

?>
