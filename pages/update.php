<?php
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['flash_msg']['type'] = 'errorContainer';
    $_SESSION['flash_msg']['text'] = 'Невалиден идентификатор';
    header('Location: ../index.php?page=read');
    exit;
}

$query = "SELECT * FROM crypto_types WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$crypto = $stmt->fetch();

if (!$crypto) {
    $_SESSION['flash_msg']['type'] = 'errorContainer';
    $_SESSION['flash_msg']['text'] = 'Търсената криптовалута не съществува';
    header('Location: ../index.php?page=read');
    exit;
}
?>

<section id="create-container">
    <div class="create-container-info">
        <h1>Edit Crypto</h1>
        <h4>Edit the details of your crypto offer</h4>
        <form method="POST" action="./handlers/handle_update.php">
            <label>Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($crypto['name']); ?>"
                placeholder="Bitcoin">

            <label>Image:</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($crypto['image']); ?>"
                placeholder="http://...">

            <label>Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($crypto['price']); ?>"
                placeholder="31,166.71">

            <label>Description:</label>
            <textarea id="description" name="description"
                placeholder="Introduce your coins..."><?php echo htmlspecialchars($crypto['description']); ?></textarea>

            <label>Payment method:</label>
            <select id="payment" name="payment">
                <option value="crypto-wallet" <?php echo $crypto['payment_method'] == 'crypto-wallet' ? 'selected' : ''; ?>>Crypto Wallet</option>
                <option value="credit-card" <?php echo $crypto['payment_method'] == 'credit-card' ? 'selected' : ''; ?>>
                    Credit Card</option>
                <option value="debit-card" <?php echo $crypto['payment_method'] == 'debit-card' ? 'selected' : ''; ?>>
                    Debit Card</option>
                <option value="paypal" <?php echo $crypto['payment_method'] == 'paypal' ? 'selected' : ''; ?>>PayPal
                </option>
            </select>

            <input type="hidden" name="id" value="<?php echo $crypto['id']; ?>">
            <input type="submit" id="btn" value="Update Crypto">
        </form>
    </div>
</section>