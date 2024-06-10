<?php
    session_start();
    require "utils.php";

    $db = new myDB();
    $res = $db->getListTabungan($_POST['id']);

    $counter = 1;
    if($res->rowCount() > 0){
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo '
            <tr>
            <td>'.$counter.'</td>
            <td>'.$row["tipe_transaksi"].'</td>
            <td>'.$row["jumlah"].'</td>
            <td>'.$row["tanggal_transaksi"].'</td>
            ';
            if($_SESSION['role'] == 0){
                echo '<td><button type="button" class="btn btn-outline-primary upload-btn" data-id="'.$row['id'].'" data-tagihan-id="'.$row['id'].'">Upload</button></td>';
            } else {
                echo '</tr>';
            }
            $counter += 1;
        }
    } else {
        echo '<tr><td colspan="6">Tidak ada transaksi</td></tr>';
    }


?>