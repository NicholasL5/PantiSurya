<?php
    require 'utils.php';
    $db = new myDB();

    $images = $db->getGambar();
    var_dump($images);

    foreach ($images as &$image) {
        $image['path_picture'] = str_replace('../', '', $image['path_picture']);
    }
    var_dump($images);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Image Gallery</h1>
    <div>
        <?php if (!empty($images)): ?>
            <?php foreach ($images as $image): ?>
                <div>
                    <img src="<?= htmlspecialchars($image['path_picture']); ?>" alt="image">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>
</body>
</html>