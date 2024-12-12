<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['user'];
    $state = $_POST['state'];

    if ($state == 'active') {
        $stmt = $conn->prepare("UPDATE users SET state = 'blocked' WHERE uid = ?");
    } else {
        $stmt = $conn->prepare("UPDATE users SET state = 'active' WHERE uid = ?");
    }

    $stmt->bind_param('i', $uid);
    $stmt->execute();
    header('Location: users');
}
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
            <h1 class="title is-3">Users List</h1>
            <div class="users">
                <?php foreach ($users as $user) : ?>
                    <div class="user mb-4">
                        <p class="content">
                            <?= $user['username'] ?>
                        </p>
                        <?php if ($user['state'] == 'active') : ?>
                            <span class="pill-success">Active</span>
                        <?php else : ?>
                            <span class="pill-danger">Inactive</span>
                        <?php endif; ?>
                        <form action="" method="POST">
                            <input type="hidden" name="state" value="<?= $user['state'] ?>">
                            <?php if ($user['state'] == 'active') : ?>
                                <button class="button is-danger" type="submit" name="user" value="<?= $user['uid'] ?>">Block</button>
                            <?php else : ?>
                                <button class="button is-success" type="submit" name="user" value="<?= $user['uid'] ?>">Activate</button>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script src="assets/js/productList.js"></script>
</body>

</html>