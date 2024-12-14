<?php

require_once('db.php');

$query = "SELECT * FROM crypto_types LIMIT 3";
$stmt = $pdo->prepare($query);
$stmt->execute();

$crypto_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content">
    <h1>BUY & <br>SELL <span>Crypto</span></h1>
    <p>A crypto is a digital currency designed to work as a medium of <br>exchange through a computer network
        that is not reliant on any central authority.</p>
    <a href="#" class="trade">TRADE</a>
</div>

<div class="coin-list">
    <?php if (!empty($crypto_types)): ?>
        <?php foreach ($crypto_types as $crypto): ?>
            <div class="coin">
                <img src="<?php echo htmlspecialchars($crypto['image']); ?>"
                    alt="<?php echo htmlspecialchars($crypto['name']); ?>">
                <div>
                    <h3>$<?php echo number_format($crypto['price'], 2); ?></h3>
                    <p><?php echo htmlspecialchars($crypto['name']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No crypto data available.</p>
    <?php endif; ?>
</div>