<?php
session_start();
require 'utils.php';

$db = new myDB();
$id = $_POST['id'];
$res = $db->searchPondokkanUnpaid($_POST['search'], $id);

$counter = 1;
if($res->rowCount() > 0){
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        echo '
        <tr>
        <th scope="row">'.$counter.'</th>
        <td>'.$db->formatRupiah($row["tagihan"]).'</td>
        <td>'.$row["tagihan_date"].'</td>
        <td>'.$row["ruangan"].'</td>
        ';
        if($_SESSION['role'] == 0 || $_SESSION['role'] == 1){
            echo '<td><button type="button" class="btn btn-outline-primary upload-btn-kwitansi" data-id="'.$row['id'].'" data-kwitansi-id="'.$row['tagihan_id'].'">Upload</button></td>';
            echo '<td><button type="button" class="btn btn-outline-primary upload-btn-bukti" data-id="'.$row['id'].'" data-tagihan-id="'.$row['tagihan_id'].'">Upload</button></td>';
            echo '<td><button type="button" class="btn btn-outline-danger delete-btn" data-id="'.$row['id'].'" data-tagihan-id="'.$row['tagihan_id'].'">Delete</button></td>';
            // echo '<td><button type="button" class="btn btn-outline-primary upload-btn" data-id="'.$row['id'].'">Upload</button></td>';
        } else {
            echo '</tr>';
        }
        $counter += 1;
    }
} else {
    echo '<tr><td colspan="7">No data found</td></tr>';
}
?>
