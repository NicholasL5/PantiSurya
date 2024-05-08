<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_POST['username'])) {
    header("location:login2.php");
}

require "utils.php";

$db = new myDB();

// Fetch total number of residents
$stmt_residents = $db->prepare("SELECT COUNT(*) AS total_residents FROM penduduk");
$stmt_residents->execute();
$total_residents = $stmt_residents->fetch(PDO::FETCH_ASSOC)['total_residents'];

// Fetch total number of unpaid medicines
$stmt_unpaid = $db->prepare("SELECT COUNT(*) AS total_unpaid FROM rekam_medis WHERE sudah_bayar = 0");
$stmt_unpaid->execute();
$total_unpaid = $stmt_unpaid->fetch(PDO::FETCH_ASSOC)['total_unpaid'];

// Fetch all residents
$stmt_all_residents = $db->prepare("SELECT * FROM penduduk");
$stmt_all_residents->execute();
$residents = $stmt_all_residents->fetchAll(PDO::FETCH_ASSOC);

// Search
$search_results = null;
if(isset($_POST['search'])) {
    $search_name = $_POST['search'];
    $stmt_search = $db->prepare("SELECT * FROM penduduk WHERE nama LIKE :name");
    $stmt_search->execute(['name' => '%' . $search_name . '%']);
    $residents = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Overview</title>
    <style>
        /* Add your custom styles here */
        .search-bar {
            margin-bottom: 20px;
        }
        .search-input {
            width: 70%; /* Adjust the width as needed */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .search-button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
        .resident-table {
            width: 100%;
            border-collapse: collapse;
        }
        .resident-table th, .resident-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .resident-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>Overview</h2>
                <p>Hello, <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : 'N/A'; ?>👋</p>
                <p style="font-style: italic;">Last Login: <?php echo isset($_SESSION["last_access"]) ? $_SESSION["last_access"] : 'N/A'; ?></p>
                
                <!-- Display total number of residents and unpaid medicines -->
                <div class="overview-info">
                    <p>Total Residents: <?php echo isset($total_residents) ? $total_residents : 'N/A'; ?></p>
                    <p>Total Unpaid Medications: <?php echo isset($total_unpaid) ? $total_unpaid : 'N/A'; ?></p>
                </div>

                <div class="search-bar">
                    <form method="POST">
                        <input type="text" name="search" placeholder="Search by name" class="search-input">
                        <button type="submit" class="search-button">Search</button>
                    </form>
                </div>

                <!-- Display all residents in a table -->
                <div class="residents-table">
                    <h3>All Residents</h3>
                    <table class="resident-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>View Medical Record</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($residents as $resident): ?>
                            <tr>
                                <td><?php echo $resident['nama']; ?></td>
                                <td><button onclick="window.location.href='laporanmedis.php?id=<?php echo $resident['id']; ?>'" class="btn btn-primary">View Medical Record</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        feather.replace()
    </script>
</body>
</html>
