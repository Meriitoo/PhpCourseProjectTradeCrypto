<?php
require_once('db.php');

$search = $_GET['search'] ?? '';

if (!empty($search)) {
    setcookie('last_search', $search, time() + (86400 * 30), "/"); // Expires in 30 days
}

$crypto_types = [];
$query = "SELECT * FROM crypto_types WHERE name LIKE :search";
$stmt = $pdo->prepare($query);
$stmt->execute([':search' => "%$search%"]);

while ($row = $stmt->fetch()) {
    $fav_query = "SELECT id FROM favorite_crypto_users WHERE user_id = :user_id AND crypto_id = :crypto_id";
    $fav_stmt = $pdo->prepare($fav_query);
    $fav_params = [
        ':user_id' => $_SESSION['user_id'] ?? 0,
        ':crypto_id' => $row['id']
    ];
    $fav_stmt->execute($fav_params);
    $row['is_favorite'] = $fav_stmt->fetch() ? '1' : '0';

    $crypto_types[] = $row;
}
?>

<section class="crypto-market">
    <h1 class="crypto-title"><span>Crypto</span> Trade</h1>
    <div class="search-form-container">
        <form class="search-form" method="GET">
            <input type="hidden" name="page" value="search">
            <div class="search-input-group">
                <input style="margin-left: 160px; width:60%;" type="text" class="search-input" placeholder="Search Crypto" name="search"
                    value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn-search" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="offer-list" style="margin-top: 50px; display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
        <?php if (!empty($crypto_types)): ?>
            <?php foreach ($crypto_types as $crypto): ?>
                <?php
                $fav_btn = '';
                if (isset($_SESSION['user_name'])) {
                    if ($_SESSION['user_id'] == $crypto['user_id']) {
                        $fav_btn = '
                           <div class="coin-actions">
                                <p style="font-weight: bold; font-size: 18px; color: red;">You cannot buy your own listing.</p>
                            </div>

                        ';
                    } else {
                        if ($crypto['is_favorite'] == '1') {
                            $fav_btn = '
                                <div class="coin-actions">
                                    <button type="button" class="btn-details remove-crypto" data-crypto="' . $crypto['id'] . '">Undo</button>
                                </div>
                            ';
                        } else {
                            $fav_btn = '
                                <div class="coin-actions">
                                    <button type="button" class="btn-details add-crypto" data-crypto="' . $crypto['id'] . '">Buy</button>
                                </div>
                            ';
                        }
                    }
                }
                ?>
                <div class="coin" style="width: 35%;">
                    <div class="coin-img">
                        <img src="<?php echo htmlspecialchars($crypto['image']); ?>"
                            alt="<?php echo htmlspecialchars($crypto['name']); ?>" class="coin-img-element">
                    </div>

                    <div class="coin-info">
                        <h1 class="coin-name"><?php echo htmlspecialchars($crypto['name']); ?></h1>
                        <p class="coin-price"><span>Price: </span>$<?php echo number_format($crypto['price'], 2); ?></p>
                        <p class="coin-payment"><span>Payment Method:
                            </span><?php echo htmlspecialchars($crypto['payment_method']); ?></p>
                    </div>

                    <?php echo $fav_btn; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-offer">
                <p>There are no crypto offers found!</p>
            </div>
        <?php endif; ?>
    </div>
</section>