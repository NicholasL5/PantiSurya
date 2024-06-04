<?php
session_start();
require 'utils.php';

$db = new myDB();
$id = $_POST['id'];
$res = $db->searchObatUnpaid($_POST['search'], $id);

$counter = 1;
if($res->rowCount() > 0){
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        echo '
        <tr>
        <th scope="row">'.$counter.'</th>
        <td style="width: 20%;">'.$row["deskripsi"].'</td>
        <td style="width: 20%;">'.$row["jenis"].'</td>
        <td style="width: 20%;">'.$row["obat"].'</td>  
        <td style="width: 20%;">'.$row["tagihan"].'</td> 
        <td style="width: 20%;">'.$row["tanggal_berobat"].'</td>  
        ';
        if($_SESSION['role'] == 0){
            echo '<td><button type="button" class="btn btn-outline-primary upload-btn" data-id="'.$row['pengobatan_id'].'" data-tagihan-id="'.$row['tagihan_id'].'">Upload</button></td>';
            // echo '<td><button type="button" class="btn btn-outline-primary upload-btn" data-id="'.$row['id'].'">Upload</button></td>';
        } else {
            echo '</tr>';
        }
        $counter += 1;
    }
} else {
    echo '<tr><td colspan="6">No data found</td></tr>';
}
?>
