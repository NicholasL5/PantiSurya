if (isset($_FILES['BPJS'])) {
            $uploadDirBPJS = 'images/'; // Directory to save the uploaded BPJS file
            $uploadFileBPJS = $uploadDirBPJS . basename($_FILES['BPJS']['name']);
            $imageFileTypeBPJS = strtolower(pathinfo($uploadFileBPJS, PATHINFO_EXTENSION));
            $uploadOBPJSK = 1;

            // Check if image file is a actual image or fake image
            $checBPJSK = getimagesize($_FILES['BPJS']['tmp_name']);
            if ($checBPJSK === false) {
                echo "File is not an image.";
                $uploadOBPJSK = 0;
            }

            // Check if file already exists
            if (file_exists($uploadFileBPJS)) {
                echo "Sorry, file already exists.";
                $uploadOBPJSK = 0;
            }

            // Allow certain file formats
            if ($imageFileTypeBPJS != 'jpg' && $imageFileTypeBPJS != 'png' && $imageFileTypeBPJS != 'jpeg') {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOBPJSK = 0;
            }

            if ($uploadOBPJSK == 1) {
                if (move_uploaded_file($_FILES['BPJS']['tmp_name'], $uploadFileBPJS)) {
                    // File uploaded successfully, update database
                    $db->updateGambarById($id, 'BPJS', $uploadFileBPJS);
                } else {
                    echo "Sorry, there was an error uploading your BPJS file.";
                }
            }
        }