<?php
include 'utils.php';
session_start();

$db = new myDB();
$images = $db->getGambar();
// echo $images;
$path_pictures = [];

// Loop through the result and extract the path_picture values
foreach ($images as $item) {
    $path_pictures[] = [
        'path_picture' => $item['path_picture'],
        'id' => $item['id']
    ];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "layout/stylejquerynbs5.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Document</title>
    <style>
        #display-image {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }
        .gallery-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; 
            margin-top: 20px;
        }
        .foto {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            object-fit: cover; 
        }
    </style>
</head>

<body>
<div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            <div class="main">
            <?php include 'nav2.php' ?>
            <div class="pad" style="padding-top:0">

            
            <div>
                <form action="api/addGaleri.php" method="post" enctype="multipart/form-data">
                    <!-- untuk sekarang image uploadnya gini -->
                    <div class="mb-3">
                        <h1>Galeri</h1>
                        <label for="imageInput" class="form-label">
                            </svg> Upload Galeri Foto</label>
                        <input class="form-control mb-3" type="file" id="image-input" accept="image/jpeg, image/jpg, image/png"
                            name="imageChooser">
                        <div id="display-image"></div>
                        <!-- <small id="imageHelp" class="form-text text-muted">Profile picture for others to see (Suggested: aspect ratio
                            1:1 and 160px x 160px, Only accept jpeg/jpg)</small> -->
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-primary btn-checkout" id="submit">Submit</button>
                        </div>
                </form>
                </div>
                <div class="gallery-row">
                <?php foreach ($path_pictures as $image): ?>
                        <!-- <img class="foto" src="<?= $image ?>" alt="Image" /> -->
                        <div class="image-container" style="display: flex; flex-direction:column">
                    <img class="foto" src="<?= $image['path_picture']  ?>" alt="Image" />
                    <button type="button" class="btn btn-danger btn-checkout delete-button" data-id="<?= $image['id'] ?>">Hapus Foto</button>
                </div>
                        <?php
                      endforeach; ?>
                </div>
            </div>
            </div>
        </div>
        </div>

        <script>
        document.getElementById('mybtn').addEventListener('click', function() {
            var holder = document.querySelector('.holder');
            holder.classList.toggle('open');
        });
    </script>
</body>
    <script>
          // untuk image upload yang sekarang
  const image_input = document.querySelector("#image-input");
  image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      const uploaded_image = reader.result;
      document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
  });

  document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-button");
        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                const imageId = this.getAttribute("data-id");
                if (confirm("Are you sure you want to delete this photo?")) {
                    fetch(`delete_image.php?id=${imageId}`, {
                        method: "GET",
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === "success") {
                            this.parentElement.remove();
                            window.location.reload();
                        } else {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
    </script>
</html>