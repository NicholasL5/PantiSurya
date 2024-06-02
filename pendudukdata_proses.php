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
            <td>'.$row["alamat"].'</td>
            
            <td>'.$row["email"].'</td>
            <td>'.$row["notelp"].'</td>
            <td>'.$row["tanggal_masuk"].'</td>
            <td><a href="pendudukLihat.php?id='.$row["id"].'&username='.$row["nama"].'"><button type="button" class="btn btn-outline-primary" id="edituser">Edit</button></a></td> 
            <td><button type="button" class="btn btn-outline-danger del" data-rowid='.$row["id"].' style="margin:0px;z-index: index 10;">Delete</button></td>
            </tr>
            ';
           
            $counter += 1;
        }
    }else{
        echo '<tr><td colspan="6">No data found</td></tr>';
    }

?>

