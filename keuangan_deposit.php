<?php
    session_start();

    if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
        header("location:login2.php");
        exit();
    }
    
    require 'utils.php';

    $db = new myDB();
    $stmt_all_residents = $db->getAllPenduduk();
    $residents = $stmt_all_residents->fetchAll(PDO::FETCH_ASSOC);

    // Search
    $search_results = null;
    if(isset($_POST['search'])) {
        $search_name = $_POST['search'];

        $stmt_search = $db->search($search_name);
        $residents = $stmt_search->fetchAll(PDO::FETCH_ASSOC);


    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "layout/stylejquerynbs5.php" ?>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/styledatasiswa.css">

    <title>Keuangan Deposit</title>
</head>
<body>

<div class="app">
    <div class="dashboard">
        <?php include 'nav.php'?>
        
        <div class="main">
            <div class="pad">
                <h1>KEUANGAN DEPOSIT</h1>
                <div class="search-bar">
                    <form method="POST" class="d-flex">
                        <input type="text" name="search" placeholder="Search by name" id="search_by_name" class="form-control me-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="residents-table">
                        <div style="display:flex; justify-content:space-between">
                            <h3 style="padding: 1rem; padding-left: 0;">Daftar Penduduk</h3>
                        </div>
                        <div class="content">
                            <table class="table table-hover table-striped" id="tabelPondokan">
                                <thead>
                                    <tr>
                                        <th width="15%">No induk</th>
                                        <th>Nama</th>
                                        <th>Jumlah Uang Deposit</th>
                                        
                                        <th>Kwitansi Deposit</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Edit deposit</th>

                                        
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="tabelPondokanBody">
                                    <?php if (empty($residents)){?>
                                    <tr><td colspan="6">No data found</td></tr>
                                    <?php };?>
                                    <?php foreach($residents as $resident): ?>
                                    <tr>
                                        <td><?php echo $resident['nomor_induk']; ?></td>
                                        <td><?php echo $resident['nama']; ?></td>
                                        <td><?php echo $db->formatRupiah($resident['deposit']); ?></td>
                                        
                                        <td>
                                            <?php if (!empty($resident['kwitansi_path'])): ?>
                                                <a href="deposit/<?php echo $resident['nama']; ?>/<?php echo $resident['kwitansi_path']; ?>" class="btn btn-outline-success" target="_blank">Download</a>
                                            <?php else: ?>
                                                <button class="btn btn-outline-primary" onclick="openUploadModal('<?php echo $resident['id']; ?>', true)">Upload</button>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td>
                                            <?php if (!empty($resident['bukti_path'])): ?>
                                                <a href="deposit/<?php echo $resident['nama']; ?>/<?php echo $resident['bukti_path']; ?>" class="btn btn-outline-success" target="_blank">Download</a>
                                            <?php else: ?>
                                                <button class="btn btn-outline-primary" onclick="openUploadModal('<?php echo $resident['id']; ?>', false)">Upload</button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button onclick="window.location.href='laporanDeposit.php?id=<?php echo $resident['id']; ?>'" class="btn btn-outline-primary">Edit deposit</button>
                                        </td>
                            
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>




                    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="upload.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="resident_id" id="residentId">
                                        <input type="hidden" name="file_type" id="fileType">
                                        <div class="mb-3">
                                            <label for="file" class="form-label">Choose file to upload</label>
                                            <input type="file" class="form-control" id="file" name="file" onchange="previewFile()">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Preview: </label>
                                            <img id="filePreview" src="" alt="Image preview" style="display: none; width: 100%; max-height: 300px;">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <?php include 'footer.php'?>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('kwitansi').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('kwitansi-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('deposit').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('deposit-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });


        function previewFile() {
            const file = document.getElementById('file').files[0];
            const preview = document.getElementById('filePreview');
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                // convert image file to base64 string
                preview.src = reader.result;
                preview.style.display = 'block';
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function openUploadModal(residentId, kwitansi) {
            console.log(kwitansi);
            if(kwitansi){
                document.getElementById('fileType').value = 'kwitansi';
            }else{
                document.getElementById('fileType').value = 'bukti';
            }
            
            document.getElementById('residentId').value = residentId;
            var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
            uploadModal.show();
        }
</script>
</body>
</html>

