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
    </style>
</head>

<body>
<div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
                <form action="api/addPicture.php" method="post" enctype="multipart/form-data">
                    <!-- untuk sekarang image uploadnya gini -->
                    <div class="mb-3">
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
        </div>
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
    </script>
</html>