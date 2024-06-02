<?php
    session_start();

    require 'utils.php';

    $db = new myDB();
    $res = $db->search($_POST['search']);

    $counter = 0;
    if($res->rowCount() > 0){
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo 
            '
            <tr>
            <th scope="row">'.$counter.'</th>
            <td>'.$row["nama"].'</td>
            <td>'.$row["keuangan_tabungan"].'</td>
            <td><button type="button" class="btn btn-primary view" data-rowid='.$row["id"].'> View Laporan Keuangan </button></td>
            ';
            $counter += 1;
            echo '</tr>';
        }
    }else{
        echo '<tr><td colspan="3">No data found</td></tr>';
    }


?>