<?php
    session_start();

    require 'utils.php';

    $db = new myDB();
    $res = $db->searchBerita($_POST['search']);

    $counter = 0;
    if($res->rowCount() > 0){
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo 
            '
            <tr>
            <th scope="row">'.$counter.'</th>
            <td style="width: 25%";>'.$row["title"].'</td>
            <td style="width: 40%";>'.$row["description"].'</td>    
            <td style="width: 15%";>'.$row["date"].'</td>
            <td><button type="button" class="btn btn-outline-primary" id="edituser"><a href="editBerita.php?id='.$row["id"].'&title='.$row["title"].'">Edit</a></button></td> 
            <td><button type="button" class="btn btn-outline-danger del" data-rowid='.$row["id"].' style="margin:0px;z-index: index 10;">Delete</button></td>
            </tr>
            ';
    
            $counter += 1;
        }
    }else{
        echo '<tr><td colspan="6">No data found</td></tr>';
    }

?>

