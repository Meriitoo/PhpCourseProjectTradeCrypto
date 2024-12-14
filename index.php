<?php
require_once('functions.php');
require_once('db.php');

$page = $_GET['page'] ?? 'home';
$search = $_GET['search'] ?? '';

if (mb_strlen($search) > 0) {
    setcookie('last_search', $search, time() + 3600, '/', 'localhost', false, false);
}

$flash = [];
if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($page); ?> - Crypto Web</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/catalog.css">
    <link rel="stylesheet" href="./css/404.css">
    <link rel="stylesheet" href="./css/create.css">
    <link rel="stylesheet" href="./css/details.css">
    <link rel="stylesheet" href="./css/search.css">
    <link rel="stylesheet" href="./css/toast.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>
    <script>
        $(function () {
            $(document).on('click', '.add-crypto', function () {
                let btn = $(this);
                let cryptoId = btn.data('crypto');
                $.ajax({
                    url: './ajax/buy_crypto.php',
                    method: 'POST',
                    data: {
                        crypto_id: cryptoId
                    },
                    success: function (response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            alert('Crypto is added successfully.');
                            let removeBtn = $('<button type="button" class="btn-details remove-crypto" data-crypto="' + cryptoId + '">Undo</button>');
                            btn.replaceWith(removeBtn);
                        } else {
                            alert('Error: ' + res.error);
                        }
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });

            $(document).on('click', '.remove-crypto', function () {
                let btn = $(this);
                let cryptoId = btn.data('crypto');
                $.ajax({
                    url: './ajax/remove_crypto.php',
                    method: 'POST',
                    data: {
                        crypto_id: cryptoId
                    },
                    success: function (response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            alert('Crypto is removed successfully.');
                            let addBtn = $('<button type="button" class="btn-details add-crypto" data-crypto="' + cryptoId + '">Buy</button>');
                            btn.replaceWith(addBtn);
                        } else {
                            alert('Error: ' + res.error);
                        }
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });

    </script>

    <header class="header">
        <nav>
            <img src="./images/logo.png" class="logo">
            <ul>
                <li><a class="nav-link <?php echo ($page == 'home' ? 'active' : '') ?>" href="?page=home">Home</a></li>
                <li><a class="nav-link <?php echo ($page == 'catalog' ? 'active' : '') ?>" href="?page=catalog">All
                        Crypto</a></li>
                <li><a class="nav-link <?php echo ($page == 'search' ? 'active' : '') ?>" href="?page=search">Search</a>
                </li>

                <?php if (isset($_SESSION['user_name'])): ?>
                    <li><a class="nav-link <?php echo ($page == 'create' ? 'active' : '') ?>" href="?page=create">Create
                            Offer</a></li>
                    <span class="text-light me-3" style="color: #ff960b; font-weight: bold;"><?php echo htmlspecialchars($_SESSION['user_name']); ?>'s profile</span>
                    <li><a class="nav-link" href="./handlers/handle_logout.php" style="color: #ff960b; font-weight: bold;">Logout</a></li>
                <?php else: ?>
                    <li><a class="nav-link" href="?page=login" style="color: #ff960b; font-weight: bold;">Login</a></li>
                    <li><a class="nav-link" href="?page=register" style="color: #ff960b; font-weight: bold;">Register</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>

    <main>

        <?php


        if (isset($flash['message'])) {
            $type = $flash['message']['type']; 
            $text = htmlspecialchars($flash['message']['text']);
            echo "<div class='{$type}'><p>{$text}</p></div>";
        }


        if (file_exists('./pages/' . $page . '.php')) {
            require_once('./pages/' . $page . '.php');
        } else {
            require_once('./pages/not_found.php');
        }
        ?>

    </main>

    <footer >
        <p>PHP 2024</p>
    </footer>

</body>

</html>

