<?php
session_start();
require 'utils.php';

$db = new myDB();
$id = $_POST['id'];
$res = $db->searchPondokkan($_POST['search'], $id);

$counter = 1;
if($res->rowCount() > 0){
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        echo '
        <tr>
        <th scope="row">'.$counter.'</th>
        <td style="width: 15%;">'.$db->formatRupiah($row["tagihan"]).'</td>
        <td style="width: 25%;">'.$row["input_date"].'</td>
        <td style="width: 15%;">'.$row["tagihan_date"].'</td>
        <td style="width: 15%;">'.$row["tanggal_transfer"].'</td>';
        if($_SESSION['role'] == 0 || $_SESSION['role'] == 1){
            $filePath = $row["kwitansi"];
            $filePath2 = $row["image_path"];
            $penduduk = $db->getPendudukPondokkan($row["penduduk_id"]);
            $penduduk = $penduduk->fetch(PDO::FETCH_ASSOC);
            $penduduk = $penduduk['nama'];
            $fileName = "Kwitansi_Pondokkan_" . $penduduk . "_" . $row['input_date'];
            $fileName2 = "Bukti_Transfer_Pondokkan_" . $penduduk . "_" . $row['input_date'];
            echo '<td><button type="button" class="btn btn-outline-primary download-btn-kwitansi" data-file-path="' . htmlspecialchars($filePath) . '" data-file-name="' . htmlspecialchars($fileName) . '">Download</button></td>';
            echo '<td><button type="button" class="btn btn-outline-primary download-btn-bukti" data-file-path="' . htmlspecialchars($filePath2) . '" data-file-name="' . htmlspecialchars($fileName2) . '">Download</button></td>';
        } else {
            echo '</tr>';
        }
        $counter += 1;
    }
} else {
    echo '<tr><td colspan="7">No data found</td></tr>';
}
?>

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
