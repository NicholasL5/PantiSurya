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
    <?php include "layout/stylejquerynbs5.php" ?>
    
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/styledatasiswa.css">
    <link rel="stylesheet" href="layout/stylekeuangan.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Panti Surya | Daftar Penduduk</title>
</head>
<body>
    <script src="js/dataLaporanTabungan.js"></script>

    <script>
        $(document).ready(function(){
            showdata("<?php echo $_GET["id"] ?>")
        })
        
    </script>



    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
                <h1>Edit Balance - <?php echo $resident['nama']; ?></h1>
                
                <h4>Jumlah Tabungan Sekarang: <?php echo $db->formatRupiah($uang['keuangan_tabungan']); ?></h4>
                <div class="btn-flex-left">
                    <a href="tambah_balance_tabungan.php?id=<?php echo $residentId ?>">
                        <button type="submit" name="EditPondokkan" class="btn btn-primary bg-blue" style="width: 5rem;">
                            Tambah
                        </button>
                    </a>
                    
                </div>
                <div class="content" style="align-items: flex-start;">
                    <div class="dropdown" style="align-items: left; display: flex;">
                        <button style="border: 1px solid gray;margin-left: 0.4rem;" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Lihat Semua Transaksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Semua</a></li>
                            <li><a class="dropdown-item" href="#">Bulan ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun ini</a></li>
                        </ul>
                    </div>
                    <table class="table wfull table-hover resident-table">

                        <thead>         
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tipe transaksi</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Upload Bukti Kwitansi</th>
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_tabungan">
                            
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Function to get query parameters from the URL
    function getQueryParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Get the 'id' parameter from the URL
    const id = getQueryParameter('id');
    console.log("ID from URL:", id); // Log the ID when the page loads

    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("upload-btn")) {
            var tagihanId = event.target.getAttribute("data-id");
            console.log(tagihanId)
            // window.location.href = "edit_balance_pondokkan.php?id=" + id;
            window.location.href = "edit_balance_tabungan.php?id=" + id + "&tagihanId=" + tagihanId;
        }
    });
});
</script>

</html>