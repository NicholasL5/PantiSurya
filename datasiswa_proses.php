<?php
    session_start();

    require 'connection.php';

    $flag = false;
    if($_POST['search'] == ""){
        $query = "SELECT * FROM siswa";
        $flag = true;
    }else{
        $query = "SELECT * FROM siswa WHERE nama LIKE ?";
        // echo $query;
    }
    $res = $pdo->prepare($query);

    if (!$flag)
        $res->execute(["%".$_POST['search']."%"]);
    else
        $res->execute();

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
            <td>'.$row["pengobatan_terakhir"].'</td>
            ';
            if($_SESSION['role'] == 0){
                echo '
                <td><button type="button" class="btn btn-outline-primary" id="edituser"><a href="lihatpenduduk.php?id='.$row["id"].'&username='.$row["nama"].'">Edit</a></button></td> 
                <td><button type="button" class="btn btn-outline-danger del" data-rowid='.$row["id"].' style="margin:0px;z-index: index 10;">Delete</button></td>
                ';
            }else{
                echo '</tr>';
            }
            $counter += 1;
        }
    }else{
        echo '<tr><td colspan="6">No data found</td></tr>';
    }

?>

