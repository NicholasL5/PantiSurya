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
        <td style="width: 35%;">'.$row["tagihan"].'</td>
        <td style="width: 30%;">'.$row["tagihan_date"].'</td>
        
        ';
        if($_SESSION['role'] == 0){
            echo '<td><button type="button" class="btn btn-outline-primary upload-btn" data-id="'.$row['id'].'" data-tagihan-id="'.$row['tagihan_id'].'">Upload</button></td>';
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
