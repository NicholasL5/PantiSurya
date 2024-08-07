<?php
// require "connection.php";
$uploadDirKTP = 'images/ktp/';
$uploadDirKK = 'images/kk/'; 
$uploadDirBPJS = 'images/bpjs/'; 
class myDB
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "pantisurya";
    private $db;

    function __construct()
    {
        if ($this->db == null) {
            try {
                $this->db = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
                // set the PDO error mode to exception
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

    }

    public function prepare($query)
    {
        return $this->db->prepare($query);
    }
    
    public function toggleAccess($userId, $accessField) {
        try {
            $stmt = $this->db->prepare("SELECT $accessField FROM akun WHERE id = :id");
            $stmt->execute(['id' => $userId]);
            $currentValue = $stmt->fetchColumn();

            $newValue = $currentValue == 1 ? 0 : 1;

            $stmt = $this->db->prepare("UPDATE akun SET $accessField = :value WHERE id = :id");
            $stmt->execute(['value' => $newValue, 'id' => $userId]);

            return true;
        } catch (PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * function untuk return semua penduduk
     * @return $res untuk hasil query semua penduduk
     */
    function getAllPenduduk()
    {
        $query = "SELECT * FROM penduduk WHERE status=0 ORDER BY nomor_induk";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    /**
     * function untuk return semua berita
     * @return $res untuk hasil query semua berita
     */
    function getAllBerita()
    {
        $query = "SELECT * FROM news";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }
    
    function getAllAdmin()
    {
        $query = "SELECT * FROM akun";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    /**
     * function untuk return count dari tabel penduduk
     * @return $total_residents untuk hasil query count as total_residents (int)
     */
    function getCountPenduduk(){
        $query = "SELECT COUNT(*) AS total_residents FROM penduduk WHERE status=0";
        $res = $this->db->prepare($query);
        $res->execute();
        $total_residents = $res->fetch(PDO::FETCH_ASSOC)['total_residents'];
        return $total_residents;
    }

    /**
     * function untuk return semua data_pondokan
     * @return $res untuk hasil query semua status yang paid
     */
    function getAllPondokkan($id)
    {
        $query = "SELECT * FROM data_pondokkan WHERE status = 1 and penduduk_id = $id";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    /**
     * function untuk return semua data_pondokan
     * @return $res untuk hasil query semua status yang unpaid
     */
    function getAllPondokkanUnpaid($id)
    {
        $query = "SELECT * FROM data_pondokkan WHERE status = 0 and penduduk_id = $id";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    function getAllObat($id)
    {
        $query = "SELECT * FROM rekam_medis WHERE sudah_bayar = 1 and penduduk_id = $id";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    function getAllObatUnpaid($id)
    {
        $query = "SELECT * FROM rekam_medis WHERE sudah_bayar = 0 and penduduk_id = $id";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    function getBeritaById($id)
    {
        $query = "SELECT * FROM news WHERE id = ?";
        $res = $this->db->prepare($query);
        $res->execute([$id]);
        return $res;
    }

    function getAccount($username)
    {
        $query = "SELECT * FROM `akun` WHERE username = ? ";
        $res = $this->db->prepare($query);
        $res->execute([$username]);
        return $res;
    }

    function getPenduduk($id)
    {
        $query = "SELECT * FROM `penduduk` WHERE id = ? ";
        $res = $this->db->prepare($query);
        $res->execute([$id]);
        return $res;
    }

    function getWali($id){
        $query = "SELECT * FROM `wali` WHERE penduduk_id=?";
        $res = $this->db->prepare($query);
        $res->execute([$id]);
        return $res;
    }

    function checkPasswordError($password, $res, $fetch_data)
    {
        $error_val = [];

        if ($res->rowCount() == 0)
            $error_val['username'] = 'Username tidak tersedia.';

        if ($password == '' || ($res->rowCount() > 0 && !password_verify($password, $fetch_data->password)))
            $error_val['password'] = 'Kata sandi yang diketik salah.';

        return $error_val;
    }

    /**
     * Search berdasarkan nama orang.
     * 
     * @param $expr untuk nama orang.
     * @return $res untuk hasil execute dari tabel penduduk. 
    */
    function search($expr)
    {
        if ($expr == "") {
            return $this->getAllPenduduk();
        } else {
            $query = "SELECT * FROM penduduk WHERE nama LIKE ?";
            $res = $this->db->prepare($query);
            $res->execute(["%" . $expr . "%"]);
            return $res;
        }
    }

    /**
     * Sama seperti search. Tapi dari tabel berita
     * @param $expr untuk title berita
     * @return $res untuk hasil execute dari tabel berita
     */
    function searchBerita($expr)
    {
        if ($expr == "") {
            return $this->getAllBerita();
        } else {
            $query = "SELECT * FROM news WHERE title LIKE ?";
            $res = $this->db->prepare($query);
            $res->execute(["%" . $expr . "%"]);
            return $res;
        }
    }
    
    function searchAdmin($expr)
    {
        if ($expr == "") {
            return $this->getAllAdmin();
        } else {
            $query = "SELECT * FROM akun WHERE username LIKE ?";
            $res = $this->db->prepare($query);
            $res->execute(["%" . $expr . "%"]);
            return $res;
        }
    }

    /**
     * Sama seperti search. Tapi dari tabel pondokan
     * @param $expr untuk title berita
     * @return $res untuk hasil execute dari tabel data_pondokan
     */
    function searchPondokkan($expr, $id)
    {
        if ($expr == "") {
            return $this->getAllPondokkan($id);
        } else {
            $query = "SELECT * FROM data_pondokkan WHERE title LIKE ?";
            $res = $this->db->prepare($query);
            $res->execute(["%" . $expr . "%"]);
            return $res;
        }
    }

    /**
     * Delete berdasarakan ID penduduk.
     * @param $id untuk id penduduk
     * @return $res untuk hasil execute dari tabel berita
     */

     function searchPondokkanUnpaid($expr, $id)
    {
        if ($expr == "") {
            return $this->getAllPondokkanUnpaid($id);
        } else {
            $query = "SELECT * FROM data_pondokkan WHERE title LIKE ?";
            $res = $this->db->prepare($query);
            $res->execute(["%" . $expr . "%"]);
            return $res;
        }
    }

    function searchObat($expr, $id)
    {
        if ($expr == "") {
            return $this->getAllObat($id);
        } 
        // else {
        //     $query = "SELECT * FROM rekam_medis WHERE title LIKE ?";
        //     $res = $this->db->prepare($query);
        //     $res->execute(["%" . $expr . "%"]);
        //     return $res;
        // }
    }

     function searchObatUnpaid($expr, $id)
    {
        if ($expr == "") {
            return $this->getAllObatUnpaid($id);
        } 
        // else {
        //     $query = "SELECT * FROM rekam_medis WHERE title LIKE ?";
        //     $res = $this->db->prepare($query);
        //     $res->execute(["%" . $expr . "%"]);
        //     return $res;
        // }
    }

    function delbyId($id)
    {
        $query = "UPDATE penduduk SET `status`=1 WHERE id=?";
        $res = $this->db->prepare($query);
        $res->execute([$id]);
    }

    function delbyIdBerita($id)
    {
        $query = "DELETE FROM news WHERE id=?";
        $res = $this->db->prepare($query);
        $res->execute([$_POST['delid']]);
    }
    
    function delbyIdAdmin($id)
    {
        $query = "DELETE FROM akun WHERE id=?";
        $res = $this->db->prepare($query);
        $res->execute([$_POST['delid']]);
    }

    function getLastLogin($username)
    {
        $query = "SELECT date FROM `akun` WHERE username = ? ";
        $res = $this->db->prepare($query);
        $res->execute([$username]);
        return $res;
    }

    function updateLastAccess($username)
    {
        date_default_timezone_set('Asia/Jakarta');
    
        $query = "UPDATE `akun` SET last_access = :last_access WHERE username = :username";
        $res = $this->db->prepare($query);

        $currentDateTime = date("Y-m-d H:i:s");
    
        $res->bindValue(':last_access', $currentDateTime, PDO::PARAM_STR);
        $res->bindValue(':username', $username, PDO::PARAM_STR);
    
        // Execute the query
        $res->execute();
    }

    function addUser($username, $password, $role)
    {
        $query = "INSERT INTO akun (username, password, role) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username, $password, $role]);
    }
    
    function getUserById($userId)
    {
        $query = "SELECT username, role, access_overview, access_berita, access_data_penghuni, access_keuangan, access_galeri FROM akun WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function insertNews($title, $description, $date, $path)
    {
        $query = "INSERT INTO news (title, description, date, image_path) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$title, $description, $date, $path]);
    }

    function editNews($title, $description, $date, $id, $path)
    {
        $query = "UPDATE news SET title = ?, description = ?, date = ?, image_path = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$title, $description, $date, $path, $id]);
    }

    function insertPenduduk($nama, $alamat, $tanggal_masuk, $email, $noTelpon, $profilePictureDirectory)
    {
        $query = "INSERT INTO penduduk (nama, alamat, tanggal_masuk, email, notelp, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nama, $alamat, $tanggal_masuk, $email, $noTelpon, $profilePictureDirectory]);
    }

    function addPenduduk($noinduk, $nama, $tempattinggal, $tanggalmasuk, $tempatlahir, $agama, $tanggallahir,  $deposit)
    {
        $query = "INSERT INTO penduduk (nomor_induk, nama, alamat, tanggal_masuk, tempat_lahir, tanggal_lahir, agama, deposit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$noinduk, $nama, $tempattinggal, $tanggalmasuk, $tempatlahir, $tanggallahir, $agama, $deposit]);  
    }

    function returnLastID(){
        return $this->db->lastInsertId();
    }

    function addWali($pendudukid, $nama, $alamat, $agama, $notelp, $pekerjaan, $hubungan ){
        $query = "INSERT INTO wali (penduduk_id, nama, alamat, agama, no_telp, pekerjaan, hubungan) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$pendudukid, $nama, $alamat, $agama, $notelp, $pekerjaan, $hubungan]);
    }

    function editWali($nama, $alamat, $agama, $notelp, $pekerjaan, $hubungan, $id, $waliId ){
        $query = "UPDATE wali SET nama=?, alamat=?, agama=?, no_telp=?, pekerjaan=?, hubungan=? WHERE penduduk_id = ? AND wali_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nama, $alamat, $agama, $notelp, $pekerjaan, $hubungan, $id, $waliId]);
    }


    function editPenduduk($noinduk, $nama, $alamat, $tempatlahir, $agama, $tanggallahir, $deposit, $tanggalmasuk, $id)
    {
        $query = "UPDATE penduduk SET nomor_induk = ?, nama = ?, alamat = ?, tempat_lahir = ?, agama = ?, tanggal_lahir = ?, deposit = ?, tanggal_masuk = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$noinduk, $nama, $alamat, $tempatlahir, $agama, $tanggallahir, $deposit, $tanggalmasuk, $id]);
    }

    function insertGambar($profilePictureDirectory, $id)
    {
        $query = "UPDATE penduduk set profile_picture = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, $id]);
    }

    function insertKwitansiPondokkan($id, $profilePictureDirectory)
    {
        $query = "UPDATE data_pondokkan SET kwitansi = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, $id]);
    }

    function insertGambarPondokkan($id, $profilePictureDirectory, $tanggal_transfer)
    {
        $query = "UPDATE data_pondokkan SET status = 1, image_path = ?, input_date = ?, tanggal_transfer = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, date("Y-m-d"), $tanggal_transfer, $id]);
    }

    function updatePondokkan2($id, $newTagihan)
    {
        $query = "UPDATE data_pondokkan SET tagihan = tagihan - ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$newTagihan, $id]);
    }

    function updateObat2($id, $newTagihan)
    {
        $query = "UPDATE rekam_medis SET tagihan = tagihan - ? WHERE pengobatan_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$newTagihan, $id]);
    }

    function deleteTagihanPondokkan($id)
    {
        $query = "DELETE FROM data_pondokkan WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }

    function insertKwitansiObat($id, $profilePictureDirectory)
    {
        $query = "UPDATE rekam_medis SET kwitansi = ? WHERE pengobatan_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, $id]);
    }

    function insertGambarObat($id, $profilePictureDirectory, $tanggal_transfer)
    {
        $query = "UPDATE rekam_medis SET sudah_bayar = 1, image_path = ?, input_date = ?, tanggal_transfer = ? WHERE pengobatan_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, date("Y-m-d"), $tanggal_transfer, $id]);
    }

    function deleteTagihanObat($id)
    {
        $query = "DELETE FROM rekam_medis WHERE pengobatan_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }

    function insertGambarTabungan($id, $profilePictureDirectory)
    {
        $query = "UPDATE tabungan SET image_path = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, $id]);
    }
    
    function tambahPondokkan($penduduk_id, $tagihan, $ruangan, $tagihan_date){
        $query = "INSERT INTO data_pondokkan (penduduk_id, tagihan, ruangan, status, tagihan_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$penduduk_id, $tagihan, $ruangan, 0, $tagihan_date]);
    }

    function updatePondokkan($tagihan, $penduduk_id){
        $query = "UPDATE penduduk SET keuangan_pondokkan = keuangan_pondokkan + ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$tagihan, $penduduk_id]);
    }

    function updatePondokkanHapus($tagihan, $penduduk_id){
        $query = "UPDATE penduduk SET keuangan_pondokkan = keuangan_pondokkan - ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$tagihan, $penduduk_id]);
    }

    function getTagihanPondokkan($id){
        $query = "SELECT * FROM data_pondokkan WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getTagihanObat($id){
        $query = "SELECT * FROM rekam_medis WHERE pengobatan_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function tambahObat($nomor, $penduduk_id,  $deskripsi_obat, $tagihan, $tanggal_berobat){
        $query = "INSERT INTO rekam_medis (nomor, penduduk_id, deskripsi, tagihan, tanggal_berobat, sudah_bayar) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nomor, $penduduk_id,  $deskripsi_obat, $tagihan, $tanggal_berobat, 0]);
    }

    function updateObat($tagihan, $penduduk_id){
        $query = "UPDATE penduduk SET keuangan_obat = keuangan_obat + ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$tagihan, $penduduk_id]);
    }

    function updateObatHapus($tagihan, $penduduk_id){
        $query = "UPDATE penduduk SET keuangan_obat = keuangan_obat - ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$tagihan, $penduduk_id]);
    }

    function formatRupiah($number) {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
    
    function getGambar()
    {
        $query = "SELECT * FROM images";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // function insertGambarPenduduk($profilePictureDirectory){
    //     $query = "INSERT INTO penduduk (profile_picture) VALUES (?)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute([$profilePictureDirectory]);
    // }

    function getGambarById($id)
    {
        $query = "SELECT profile_picture FROM penduduk WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteGambar($id) {
        $query = "DELETE FROM images WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }

    function getPathPondokkan($id)
    {
        $query = "SELECT image_path FROM data_pondokkan WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getPendudukPondokkan($id)
    {
        $query = "SELECT * FROM `penduduk` WHERE id = ? ";
        $res = $this->db->prepare($query);
        $res->execute([$id]);
        return $res;
    }

    public function updateGambarById($id, $imageType, $imagePath)
    {
        try {

            // Prepare the SQL statement
            $stmt = $this->db->prepare("UPDATE penduduk SET $imageType = :imagePath WHERE id = :id");

            // Bind parameters
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->bindParam(':id', $id);

            // Execute the query
            $stmt->execute();
            
            // Return true if update was successful
            return true;
        } catch (PDOException $e) {
            // Handle errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function uploadFile($fileInputName, $uploadDir, $allowedFormats, $dbConnection)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES[$fileInputName])) {
            $uploadFile = $uploadDir . basename($_FILES[$fileInputName]['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES[$fileInputName]['tmp_name']);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($uploadFile)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file format
            if (!in_array($imageFileType, $allowedFormats)) {
                echo "Sorry, only " . implode(', ', $allowedFormats) . " files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $uploadFile)) {
                    echo "The file " . htmlspecialchars(basename($_FILES[$fileInputName]['name'])) . " has been uploaded.";

                    // Save the file path to the database
                    $stmt = $dbConnection->prepare("UPDATE penduduk SET $fileInputName = :file_image WHERE id = :id");
                    $stmt->bindParam(':file_image', $uploadFile);
                    $stmt->bindParam(':id', $_POST['id']); // Assuming you have the id in the POST data
                    $stmt->execute();
                    echo "The file path has been saved to the database.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }


    

    function addDataTabungan($jumlah, $tipe, $tanggal, $id_penduduk, $deskripsi){
        $uangNow = $this->getJumlahTabungan($id_penduduk)['keuangan_tabungan'];
        $uangNow += $jumlah;


        $query = "INSERT INTO tabungan (id_penduduk, tipe_transaksi, jumlah, tanggal_transaksi, saldo, deskripsi) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_penduduk, $tipe, $jumlah, $tanggal, $uangNow, $deskripsi]);
    }


    function getJumlahTabungan($id){
        $query = "SELECT keuangan_tabungan FROM penduduk WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getSaldoTerakhir($id){
        $query = "SELECT saldo FROM tabungan WHERE id_penduduk = ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateTabunganPenduduk($id){
        $jumlah = $this->getSaldoTerakhir($id)['saldo'];

        $query = "UPDATE penduduk SET keuangan_tabungan = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$jumlah, $id]);
    }

    function getListTabungan($id){
        $query = "SELECT * FROM tabungan WHERE id_penduduk = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }

    function getCountUnpaidPondokan(){
        $query = "SELECT penduduk_id, SUM(tagihan) AS unpaid FROM data_pondokkan WHERE status=0 GROUP BY penduduk_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return count($stmt->fetchAll(PDO::FETCH_ASSOC));    
    }

    function delTabunganDatabyID($idpen, $id){
        
        $query = "DELETE FROM tabungan WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        
        $jumlah = $this->getSaldoTerakhir($idpen);
        $jumlah = $jumlah?$jumlah['saldo']:0;
        $query = 'UPDATE penduduk SET keuangan_tabungan=? WHERE id=?';
        $stmt = $this->db->prepare($query);
        $stmt->execute([$jumlah, $idpen]);

    }

    function updateBuktiKwitansi($id, $path){
        $query = "UPDATE penduduk SET kwitansi_path=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$path, $id]);
        
    }

    function updateBuktiDeposit($id, $path){
        $query = "UPDATE penduduk SET bukti_path=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$path, $id]);
    }
    
    function deleteWali($idwali){
        $query = "DELETE FROM wali WHERE wali_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idwali]);
    }






}
