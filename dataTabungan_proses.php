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
            </tr>';
            $counter += 1;
        }
    } else {
        echo '<tr><td colspan="6">Tidak ada transaksi</td></tr>';
    }


?>