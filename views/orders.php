<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php';
?>

<body>
    <?php
    include 'includes/navbar.php';
    ?>

    <section>
        <div class="container mb-5">
            <h1 class="title is-3">Orders</h1>
            <div class="orders">
                <?php foreach ($orders as $order) : ?>
                    <div class="order mb-4">
                        <div>
                            <h1 class="title is-4">Order: #<?= $order['oid'] ?></h1>
                            <?php switch ($order['state']) {
                                case 'new':
                                    echo '<span class="pill-info">New</span>';
                                    break;
                                case 'in_progress':
                                    echo '<span class="pill-warning">In Progress</span>';
                                    break;
                                case 'rejected':
                                    echo '<span class="pill-danger">Rejected</span>';
                                    break;
                                case 'delivered':
                                    echo '<span class="pill-success">Delivered</span>';
                                    break;
                            } ?>
                        </div>
                        <p>Total: $<?= $order['total'] ?></p>
                        <p style="color: gray;"><?= $order['order_date'] ?></p>
                        <a href="order?id=<?= $order['oid'] ?>" class="button is-primary mt-2">View</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script src="assets/js/darkMode.js"></script>
</body>

</html>