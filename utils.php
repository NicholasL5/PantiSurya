<?php
    // require "connection.php";
    

    class myDB{
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "pantisurya";
        private $db;

        function __construct(){
            if ($this->db == null){
                try {
                    $this->db = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
                    // set the PDO error mode to exception
                    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // echo "Connected successfully";
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
            
        }

        public function prepare($query) {
            return $this->db->prepare($query);
        }

        function getAllPenduduk(){
            $query = "SELECT * FROM penduduk";
            $res = $this->db->prepare($query);
            $res->execute();
            return $res;
        }

        function getAllBerita(){
            $query = "SELECT * FROM news";
            $res = $this->db->prepare($query);
            $res->execute();
            return $res;
        }

        
        function getBeritaById($id){
            $query = "SELECT * FROM news WHERE id = ?";
            $res = $this->db->prepare($query);
            $res->execute([ $id ]);
            return $res;
        }

        function getAccount($username){
            $query = "SELECT * FROM `akun` WHERE username = ? ";
            $res = $this->db->prepare($query);
            $res->execute([ $username ]);
            return $res;
        }

        function getPenduduk($id){
            $query = "SELECT * FROM `penduduk` WHERE id = ? ";
            $res = $this->db->prepare($query);
            $res->execute([ $id ]);
            return $res;
        }

        function checkPasswordError($password, $res, $fetch_data){
            $error_val = [];

            if ($res->rowCount() == 0)
                $error_val['username'] = 'Username tidak tersedia.';

            if ($password == '' || ($res->rowCount() > 0 && !password_verify($password, $fetch_data->password)))
                $error_val['password'] = 'Kata sandi yang diketik salah.';

            return $error_val;
        }

        function search($expr){
            if ($expr == ""){
                return $this->getAllPenduduk();
            }else{
                $query = "SELECT * FROM penduduk WHERE nama LIKE ?";
                $res = $this->db->prepare($query);
                $res->execute(["%".$expr."%"]);
                return $res;
            }
        }

        function searchBerita($expr){
            if($expr == ""){
                return $this->getAllBerita();
            } else{
                $query = "SELECT * FROM news WHERE title LIKE ?";
                $res = $this->db->prepare($query);
                $res->execute(["%".$expr."%"]);
                return $res;
            }
        }

        function delbyId($id){
            $query = "DELETE FROM penduduk WHERE id=?";
            $res = $this->db->prepare($query);
            $res->execute([$_POST['delid']]);
        }

        function delbyIdBerita($id){
            $query = "DELETE FROM news WHERE id=?";
            $res = $this->db->prepare($query);
            $res->execute([$_POST['delid']]);
        }

        function getLastLogin($username){
            $query = "SELECT date FROM `akun` WHERE username = ? ";
            $res = $this->db->prepare($query);
            $res->execute([ $username ]);
            return $res;
        } 
        
        function updateLastAccess($username){
            $query = "UPDATE `akun` SET last_access=? WHERE username=?";
            $res = $this->db->prepare($query);
            $res->execute([ date("Y-m-d"), $username ]);
        }

        function insertNews($title, $description, $date) {
            $query = "INSERT INTO news (title, description, date) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $date]);
        }

        function editNews($title, $description, $date, $id) {
            $query = "UPDATE news SET title = ?, description = ?, date = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $date, $id]);
        }

    }

?>