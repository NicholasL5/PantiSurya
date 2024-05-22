<?php
// require "connection.php";


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

    function getAllPenduduk()
    {
        $query = "SELECT * FROM penduduk";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    function getAllBerita()
    {
        $query = "SELECT * FROM news";
        $res = $this->db->prepare($query);
        $res->execute();
        return $res;
    }

    function getAllPondokkan()
    {
        $query = "SELECT * FROM data_pondokkan";
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

    function checkPasswordError($password, $res, $fetch_data)
    {
        $error_val = [];

        if ($res->rowCount() == 0)
            $error_val['username'] = 'Username tidak tersedia.';

        if ($password == '' || ($res->rowCount() > 0 && !password_verify($password, $fetch_data->password)))
            $error_val['password'] = 'Kata sandi yang diketik salah.';

        return $error_val;
    }

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

    function searchPondokkan($expr)
    {
        if ($expr == "") {
            return $this->getAllPondokkan();
        } else {
            $query = "SELECT * FROM data_pondokkan WHERE title LIKE ?";
            $res = $this->db->prepare($query);
            $res->execute(["%" . $expr . "%"]);
            return $res;
        }
    }

    function delbyId($id)
    {
        $query = "DELETE FROM penduduk WHERE id=?";
        $res = $this->db->prepare($query);
        $res->execute([$_POST['delid']]);
    }

    function delbyIdBerita($id)
    {
        $query = "DELETE FROM news WHERE id=?";
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
        $query = "UPDATE `akun` SET last_access=? WHERE username=?";
        $res = $this->db->prepare($query);
        $res->execute([date("Y-m-d"), $username]);
    }

    function addUser($username, $password, $role)
    {
        $query = "INSERT INTO akun (username, password, role) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username, $password, $role]);
    }

    function insertNews($title, $description, $date)
    {
        $query = "INSERT INTO news (title, description, date) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$title, $description, $date]);
    }

    function editNews($title, $description, $date, $id)
    {
        $query = "UPDATE news SET title = ?, description = ?, date = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$title, $description, $date, $id]);
    }

    function insertPenduduk($nama, $alamat, $pengobatan, $email, $noTelpon, $profilePictureDirectory)
    {
        $query = "INSERT INTO penduduk (nama, alamat, pengobatan_terakhir, email, notelp, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nama, $alamat, $pengobatan, $email, $noTelpon, $profilePictureDirectory]);
    }

    function editPenduduk($alamat, $email, $noTelpon, $id)
    {
        $query = "UPDATE penduduk SET alamat = ?, email = ?, notelp = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$alamat, $email, $noTelpon, $id]);
    }

    function insertGambar($profilePictureDirectory)
    {
        $query = "INSERT INTO images (path_picture, input_date) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$profilePictureDirectory, date("Y-m-d")]);
    }

    function insertGambarPondokkan($pendudukId, $profilePictureDirectory)
    {
        $query = "INSERT INTO data_pondokkan (penduduk_id, image_path, input_date) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$pendudukId, $profilePictureDirectory, date("Y-m-d")]);
    }

    function getGambar()
    {
        $query = "SELECT path_picture FROM images";
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
            $db = new PDO('mysql:host=localhost;dbname=pantisurya', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL statement
            $stmt = $db->prepare("UPDATE penduduk SET $imageType = :imagePath WHERE id = :id");

            // Bind parameters
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->bindParam(':id', $id);

            // Execute the query
            $stmt->execute();

            // Close the connection
            $db = null;

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






}