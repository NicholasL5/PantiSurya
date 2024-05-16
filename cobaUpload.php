<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #display-image {
            width: 100px;
            height: 100px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body>
<form action="api/addPicture.php" method="post" enctype="multipart/form-data">
    <!-- untuk sekarang image uploadnya gini -->
    <div class="mb-3">
        <label for="imageInput" class="form-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                <path
                    d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            </svg> Profile Picture</label>
        <input class="form-control mb-3" type="file" id="image-input" accept="image/jpeg, image/jpg, image/png"
            name="imageChooser">
        <div id="display-image"></div>
        <small id="imageHelp" class="form-text text-muted">Profile picture for others to see (Suggested: aspect ratio
            1:1 and 160px x 160px, Only accept jpeg/jpg)</small>
    </div>

    <div class="d-grid gap-2 col-12 mx-auto">
          <button type="submit" class="btn btn-primary btn-checkout" id="submit">Submit</button>
        </div>
    </form>
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