<?php
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['flash_msg']['type'] = 'errorContainer';
    $_SESSION['flash_msg']['text'] = 'Invalid identifier';
    header('Location: ../index.php?page=read');
    exit;
}

$query = "SELECT * FROM crypto_types WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$crypto = $stmt->fetch();

if (!$crypto) {
    $_SESSION['flash_msg']['type'] = 'errorContainer';
    $_SESSION['flash_msg']['text'] = 'No match';
    header('Location: ../index.php?page=read');
    exit;
}

$isOwner = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $crypto['user_id'];
?>

<section id="details-info">
    <h1>Details</h1>
    <div class="coin-image">
        <img src="<?php echo htmlspecialchars($crypto['image']); ?>">
    </div>

    <div class="coin-info">
        <div class="coin-text">
            <h1 id="name">Type: <?php echo htmlspecialchars($crypto['name']); ?></h1>
            <h3 id="payment" name="payment" style="margin-top: 15px; margin-bottom: 15px;">
                Payment method: <?php echo htmlspecialchars($crypto['payment_method']); ?>
            </h3>
            <p id="price"><span>Price: $<?php echo number_format($crypto['price'], 2); ?></span></p>
            <p id="description"><?php echo htmlspecialchars($crypto['description']); ?></p>
        </div>
        <div class="product-btn">
            <?php if ($isOwner): ?>
                <div class="author">
                    <a href="?page=update&id=<?php echo $crypto['id']; ?>" class="btn-edit"
                        style="margin-left: 40px;">Edit</a>
                    <form method="POST" action="./handlers/handle_delete.php" id="deleteForm-<?php echo $crypto['id']; ?>">
                        <input type="hidden" name="id" value="<?php echo $crypto['id']; ?>">
                        <button type="button" class="btn-delete"
                            onclick="showToastConfirmation(<?php echo $crypto['id']; ?>)">Delete</button>
                    </form>
                </div>
            <?php elseif (isset($_SESSION['user_id'])): ?>
                <p style="font-weight: bold; font-size: 18px; text-align: center; margin-bottom: 10px;">You do not have permission to
                    edit or delete this item.</p>
            <?php else: ?>
                <p style="font-weight: bold; font-size: 18px; text-align: center; margin-bottom: 10px;">You must be logged in and owner to
                    manage this cryptocurrency.</p>
            <?php endif; ?>

        </div>
    </div>
</section>

<script>
    function showToastConfirmation(id) {
        const toast = document.createElement('div');
        toast.classList.add('toast-confirmation');
        toast.innerHTML = `
            <span>Are you sure you want to delete this item?</span>
            <button class="confirm">Yes</button>
            <button class="cancel">No</button>
        `;

        document.body.appendChild(toast);
        toast.style.display = 'block';

        toast.querySelector('.confirm').addEventListener('click', () => {
            document.getElementById(`deleteForm-${id}`).submit();
        });

        toast.querySelector('.cancel').addEventListener('click', () => {
            toast.style.display = 'none';
            document.body.removeChild(toast);
        });
    }
</script>