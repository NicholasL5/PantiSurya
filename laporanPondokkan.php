<?php
    
    session_start();
    if(!isset($_COOKIE['user_login'])){
        header("location:login2.php");
    }


    include "utils.php";
    $db = new myDB();

    $residentId = $_GET['id'];

    $stmt_resident = $db->prepare("SELECT * FROM penduduk WHERE id = :residentId");
    $stmt_resident->execute(['residentId' => $residentId]);
    $resident = $stmt_resident->fetch(PDO::FETCH_ASSOC);


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
    <script src="js/dataLaporanPondokkan.js"></script>
    <!--<script src="js/dataLaporanPondokkanUnpaid.js"></script>-->




    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
            <?php include 'nav2.php' ?>
                <div class="pad">
                <h1>Laporan Pondokkan - <?php echo $resident['nama']; ?></h1>
                
                <div class="btn-flex-left">
                    <a href="add_tagihan_pondokkan.php?id=<?php echo $residentId ?>">
                        <button type="submit" name="TambahPondokkan" class="btn btn-primary bg-blue">
                            Buat Tagihan Pondokkan
                        </button>
                    </a>
                    <a href="edit_balance_pondokkan.php?id=<?php echo $residentId ?>">
                        <button type="submit" name="EditPondokkan" class="btn btn-primary bg-blue" style="margin-left:15px">
                            Upload Bukti Pembayaran
                        </button>
                    </a>
                </div>
                <div class="content" style="align-items: flex-start;margin-bottom: 4rem;">
                    <h3>Pondokkan belum dibayar</h3>
                    <table class="table wfull table-hover">
                        <thead>         
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Jumlah Tagihan</th>
                            <th scope="col">Tagihan Bulan</th>
                            <th scope="col">Jenis Ruangan</th>
                            <th scope="col">Upload Kwitansi</th>
                            <th scope="col">Upload Bukti Pembayaran</th>
                            <th scope="col">Delete Tagihan</th>
                            <!-- <th scope="col">Tanggal</th>
                            <th scope="col" colspan="2">Action</th> -->
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_pondokkan_unpaid">
                            
                        </tbody>
                    </table>
                </div>

                <div class="content" style="align-items: flex-start;margin-top:20px">
                    <h3>Pondokkan sudah dibayar</h3>
                    <table class="table wfull table-hover">
                        <thead>         
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Jumlah Tagihan</th>
                            <th scope="col">Tanggal Input Kwitansi</th>
                            <th scope="col">Tagihan Bulan</th>
                            <th scope="col">Tanggal Transfer</th>
                            <th scope="col">Download Kwitansi</th>
                            <th scope="col">Download Bukti Transfer</th>
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_pondokkan">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('mybtn').addEventListener('click', function() {
            var holder = document.querySelector('.holder');
            holder.classList.toggle('open');
        });
    </script>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("download-btn-kwitansi")) {
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

    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("download-btn-bukti")) {
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

    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("delete-btn")) {
            var idPondokkan = event.target.getAttribute("data-id");
            console.log(idPondokkan);
            var confirmDelete = confirm("Are you sure you want to delete this record?");
            if (confirmDelete) {
                fetch("delete_tagihan.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `id=${idPondokkan}`
                })
                .then(response => response.text())
                .then(data => {
                    if (data === "success") {
                        alert("Record deleted successfully.");
                        location.reload(); 
                    } else {
                        alert("Error deleting record.");
                    }
                })
                .catch(error => console.error('Error:', error));
            }
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
        if (event.target.classList.contains("upload-btn-kwitansi")) {
            var tagihanId = event.target.getAttribute("data-id");
            console.log(tagihanId)
            // window.location.href = "edit_balance_pondokkan.php?id=" + id;
            window.location.href = "upload_pondokkan_kwitansi.php?id=" + id + "&tagihanId=" + tagihanId;
        }
    });

    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("upload-btn-bukti")) {
            var tagihanId = event.target.getAttribute("data-id");
            console.log(tagihanId)
            // window.location.href = "edit_balance_pondokkan.php?id=" + id;
            window.location.href = "edit_balance_pondokkan.php?id=" + id + "&tagihanId=" + tagihanId;
        }
    });
});
</script>


</html>