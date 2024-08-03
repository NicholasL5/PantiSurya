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
            <td>'.$row["tanggal_transaksi"].'</td>
            <td>'.$row['deskripsi'].'</td>
            <td>'.$row["tipe_transaksi"].'</td>
            <td>'.$db->formatRupiah($row["jumlah"]).'</td>
            <td>'.$db->formatRupiah($row["saldo"]).'</td>
            <td><button type="button" class="btn btn-outline-danger del" data-rowid='.$row["id"].' style="margin:0px;z-index: index 10;">Delete</button></td>
            
            ';
            if($_SESSION['role'] == 0 || $_SESSION['role'] == 1){
                
            } else {
                echo '</tr>';
            }
            $counter += 1;
        }
    } else {
        echo '<tr><td colspan="10">Tidak ada transaksi</td></tr>';
    }


?>