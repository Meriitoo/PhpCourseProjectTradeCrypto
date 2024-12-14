
<?php

?>

<section id="create-container">
    <div class="create-container-info">
        <h1>Create Announcement</h1>
        <h4>Post your coins to sell</h4>
        <form method="POST" action="./handlers/handle_add_crypto.php">
            <label>Name:</label>
            <input type="text" id="name" name="name" placeholder="Bitcoin" value="<?php echo $flash['data']['name'] ?? '' ?>">
            <label>Image:</label>
            <input type="text" id="image" name="image" placeholder="http://..." value="<?php echo $flash['data']['image'] ?? '' ?>">
            <label>Price:</label>
            <input type="number" id="price" name="price" placeholder="31,166.71" value="<?php echo $flash['data']['price'] ?? '' ?>">
            <label>Description:</label>
            <textarea id="description" name="description" placeholder="Introduce your coins..."><?php echo $flash['data']['description'] ?? '' ?></textarea>
            <label>Payment method:</label>
            <select id="payment" name="payment">
                <option value="crypto-wallet">Crypto Wallet</option>
                <option value="credit-card">Credit Card</option>
                <option value="debit-card">Debit Card</option>
                <option value="paypal">PayPal</option>
            </select>
            <input type="submit" id="btn" value="TRADE"></input>
        </form>
    </div>
</section>