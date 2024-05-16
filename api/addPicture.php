<?php
include "../utils.php";
include "../utils/resize_image.php";
define('UPLOAD_DIR','../asset/pp/');

$db = new myDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Upload profile picture ke directory lalu get directory name
    // Get the tmp file from server as image
    $image = file_get_contents($_FILES["imageChooser"]["tmp_name"]);

    // Make file with name uniqid().jpg
    $file_name = uniqid().'.jpg';
    // $foto = 'poster/'.$file_name;
    $file = UPLOAD_DIR.$file_name;
    $success = file_put_contents($file, $image);
    // echo var_dump($success);

    //Resize and Compress Image
    $img = resize_image($file, 160, 160, TRUE);
    imagejpeg($img, $file, 90);
    // echo "test";

    $profilePictureDirectory = $file;
    

    // Get birth date
    // $inputDate = $_POST["datepicker"];
    // $formattedDate = date(strtotime($inputDate));

    // Insert new user
        // $sql = "INSERT INTO `images`(`path_picture`, `input_date`) VALUES (?, ?)";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute([$profilePictureDirectory, $formattedDate]);
        $db->insertGambar($profilePictureDirectory);
        // Move to login page
        header("location: ../showGambar.php");

    // Buat error checking
    // echo var_dump($stmt->errorInfo());
    // echo "Tes";

// } else {
//     echo "Method is not post";
}
?>