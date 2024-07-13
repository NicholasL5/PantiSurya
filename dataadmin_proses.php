<?php
    session_start();

    require 'utils.php';

    $db = new myDB();
    $res = $db->searchAdmin($_POST['search']);

    $counter = 0;
    if($res->rowCount() > 0){
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            // Determine button state and text based on database value
        $adminButtonClass = $row["access_admin"] == 1 ? 'btn-success' : 'btn-danger';
        $adminButtonText = $row["access_admin"] == 1 ? 'Enabled' : 'Disabled';

        $beritaButtonClass = $row["access_berita"] == 1 ? 'btn-success' : 'btn-danger';
        $beritaButtonText = $row["access_berita"] == 1 ? 'Enabled' : 'Disabled';

        $keuanganButtonClass = $row["access_keuangan"] == 1 ? 'btn-success' : 'btn-danger';
        $keuanganButtonText = $row["access_keuangan"] == 1 ? 'Enabled' : 'Disabled';

        $galeriButtonClass = $row["access_galeri"] == 1 ? 'btn-success' : 'btn-danger';
        $galeriButtonText = $row["access_galeri"] == 1 ? 'Enabled' : 'Disabled';

        echo '
        <tr>
            <th scope="row">' . $counter . '</th>
            <td>' . htmlspecialchars($row["username"]) . '</td>
            <td>' . htmlspecialchars($row["last_access"]) . '</td>
            <td>
                <form action="update_access.php" method="POST">
                    <input type="hidden" name="id" value="' . $row["id"] . '">
                    <button type="submit" name="admin_access" class="btn ' . $adminButtonClass . '">' . $adminButtonText . '</button>
                </form>
            </td>
            <td>
                <form action="update_access.php" method="POST">
                    <input type="hidden" name="id" value="' . $row["id"] . '">
                    <button type="submit" name="berita_access" class="btn ' . $beritaButtonClass . '">' . $beritaButtonText . '</button>
                </form>
            </td>
            <td>
                <form action="update_access.php" method="POST">
                    <input type="hidden" name="id" value="' . $row["id"] . '">
                    <button type="submit" name="keuangan_access" class="btn ' . $keuanganButtonClass . '">' . $keuanganButtonText . '</button>
                </form>
            </td>
            <td>
                <form action="update_access.php" method="POST">
                    <input type="hidden" name="id" value="' . $row["id"] . '">
                    <button type="submit" name="galeri_access" class="btn ' . $galeriButtonClass . '">' . $galeriButtonText . '</button>
                </form>
            </td>
            <td><button type="button" class="btn btn-outline-danger del" data-rowid="' . $row["id"] . '" style="margin:0px; z-index: 10;">Delete</button></td>
        </tr>
        ';

    
            $counter += 1;
        }
    }else{
        echo '<tr><td colspan="6">No data found</td></tr>';
    }

?>

