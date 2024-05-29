<?php
    
    session_start();
    if(!isset($_COOKIE['user_login'])){
        header("location:login2.php");
    }


    include "utils.php";
    $db = new myDB();

    $residentId = $_GET['id'];
    $res = $db->getPenduduk($residentId);
    $resident = $res->fetch(PDO::FETCH_ASSOC);

    $uang = $db->getJumlahTabungan($residentId);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/styledatasiswa.css">
    <link rel="stylesheet" href="layout/stylekeuangan.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Panti Surya | Daftar Penduduk</title>
</head>
<body>
    <script src="js/dataLaporanPondokkan.js"></script>




    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
                <h1>Edit Balance - <?php echo $resident['nama']; ?></h1>
                
                <h4>Jumlah Tabungan Sekarang: <?php echo $uang['keuangan_tabungan']; ?></h4>
                <div class="btn-flex-left">
                    <a href="edit_balance_tabungan.php?id=<?php echo $residentId ?>">
                        <button type="submit" name="EditPondokkan" class="btn btn-primary bg-blue" style="width: 5rem;">
                            Tambah
                        </button>
                    </a>
                    
                </div>
                <div class="content">
                    
                    <table class="table wfull table-hover">
                        <thead>         
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal Input Kwitansi</th>
                            <th scope="col">Path File</th>
                            <th scope="col">Download File</th>
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_pondokkan">
                            
                        </tbody>
                    </table>
                </div>
            </div>



            
        </div>
    </div>

</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("download-btn")) {
            const filePath = event.target.getAttribute("data-file-path");
            const fileName = event.target.getAttribute("data-file-name");
            const a = document.createElement("a");
            a.href = filePath;
            a.download = fileName;
            a.style.display = "none";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    });
});
</script>

</html>