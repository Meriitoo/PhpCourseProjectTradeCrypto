<?php
require_once('db.php');

$query = "SELECT * FROM crypto_types";
$stmt = $pdo->query($query);
$crypto_types = [];
while ($row = $stmt->fetch()) {
    $crypto_types[] = $row;
}

?>

<section class="crypto-market">
    <h1><span>Crypto</span> Trade</h1>
    <div class="offer-list" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
        <?php if (!empty($crypto_types)): ?>
            <?php foreach ($crypto_types as $crypto): ?>
                <div class="coin" style="width: 35%;">
                    
                    <div class="coin-img">
                        <img src="<?php echo htmlspecialchars($crypto['image']); ?>"
                            alt="<?php echo htmlspecialchars($crypto['name']); ?>">
                    </div>

                    <div class="coin-info">
                        <h1><?php echo htmlspecialchars($crypto['name']); ?></h1>
                        <p><span>Price: </span>$<?php echo number_format($crypto['price'], 2); ?></p>
                        <p style="margin-bottom: 30px;"><span>Payment: </span><?php echo htmlspecialchars($crypto['payment_method']); ?></p>
                    </div>

                    <a href="?page=details&id=<?php echo $crypto['id']; ?>" class="btn-details">Details</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-offer">
                <p>There are no crypto offers found!</p>
            </div>
        <?php endif; ?>
    </div>
</section>
