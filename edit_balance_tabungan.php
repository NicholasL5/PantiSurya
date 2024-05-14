<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
    header("location:login2.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("location:overview.php");
    exit();
}

require "utils.php";

$db = new myDB();
$residentId = $_GET['id'];

$stmt_resident = $db->prepare("SELECT * FROM penduduk WHERE id = :residentId");
$stmt_resident->execute(['residentId' => $residentId]);
$resident = $stmt_resident->fetch(PDO::FETCH_ASSOC);

if (!$resident) {
    header("location:overview.php");
    exit();
}

$alertMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBalance']) && isset($_POST['removeBalance'])) {
    $addBalance = isset($_POST['addBalance']) ? intval($_POST['addBalance']) : 0;
    $removeBalance = isset($_POST['removeBalance']) ? intval($_POST['removeBalance']) : 0;

    $newBalance = $resident['keuangan_tabungan'] + $addBalance - $removeBalance;

    $stmt_update_balance = $db->prepare("UPDATE penduduk SET keuangan_tabungan = :newBalance WHERE id = :residentId");
    $stmt_update_balance->execute(['newBalance' => $newBalance, 'residentId' => $residentId]);

    $alertMessage = "Changes saved successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Balance - <?php echo $resident['nama']; ?></title>
</head>
<body>
    <h1>Edit Balance - <?php echo $resident['nama']; ?></h1>
    
    <?php if (!empty($alertMessage)): ?>
    <div>
        <script>
            alert("<?php echo $alertMessage; ?>");
            window.location.href = "keuangan_tabungan.php";
        </script>
    </div>
    <?php endif; ?>

    <form id="balanceForm" method="POST">
        <div>
            <label for="addBalance">Add Balance:</label>
            <input type="number" id="addBalance" name="addBalance" placeholder="Enter amount to add" class="form-control" min="0" step="1">
        </div>
        <div>
            <label for="removeBalance">Remove Balance:</label>
            <input type="number" id="removeBalance" name="removeBalance" placeholder="Enter amount to remove" class="form-control" min="0" step="1">
        </div>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
