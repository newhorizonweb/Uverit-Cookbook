<?php 
$con = mysqli_connect("localhost", "root", "", "cookbook");
                    
    $brand = $_POST["brand"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $type = $_POST["type"];

    $shops = $_POST['slcheckbox'];
    $shop_list = implode(', ', $shops);

    $rating = $_POST["rating"];
    $date = date("d.m.Y, G:i");

    $kcal = $_POST["kcal"];
    $fat = $_POST["fat"];
    $carbohydrates = $_POST["carbohydrates"];
    $fiber = $_POST["fiber"];
    $protein = $_POST["protein"];
    $weight = $_POST["weight"];
    $portion = $_POST["portion"];

    $shelf_life = $_POST["shelf_life"];
    $info = $_POST["info"];

        // Upload the image

    $maxPx = 1280;
    $imgFilePath = '../Product_img/';

    $image = $_FILES['image']['name'];
    $imagePath = $_FILES['image']['tmp_name'];

    $dimensions = getimagesize($imagePath);
    $aspectRatio = $dimensions[0] / $dimensions[1];
    $imageType = exif_imagetype($imagePath);

    // Rotate the image based on its EXIF orientation value
    $exif = exif_read_data($imagePath);

    if ($imageType == IMAGETYPE_JPEG) {
        $originalImage = imagecreatefromjpeg($imagePath);
    } elseif ($imageType == IMAGETYPE_PNG) {
        $originalImage = imagecreatefrompng($imagePath);
    }

    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3:
                $originalImage = imagerotate($originalImage, 180, 0);
                break;
            case 6:
                $originalImage = imagerotate($originalImage, -90, 0);
                break;
            case 8:
                $originalImage = imagerotate($originalImage, 90, 0);
                break;
        }
    }

    $dimensions = array(imagesx($originalImage), imagesy($originalImage));

    // Resize the image if it's wider or higher than 1920px
    if ($dimensions[0] > $maxPx || $dimensions[1] > $maxPx){
        $aspectRatio = $dimensions[0] / $dimensions[1];
        if ($dimensions[0] > $dimensions[1]) {
            $newWidth = $maxPx;
            $newHeight = $newWidth / $aspectRatio;
        } else {
            $newHeight = $maxPx;
            $newWidth = $newHeight * $aspectRatio;
        }
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($originalImage), imagesy($originalImage));

        if ($imageType == IMAGETYPE_JPEG){
            imagejpeg($newImage, $imgFilePath.$image);
        } elseif ($imageType == IMAGETYPE_PNG){
            imagepng($newImage, $imgFilePath.$image);
        }

        imagedestroy($newImage);
        imagedestroy($originalImage);
    } else {
        // Don't resize the image
        move_uploaded_file($imagePath, $imgFilePath.$image);
    }

        // Tags

    $tags = $_POST["tags"];
    $hidden_tags = $_POST["hidden_tags"];
    $htags = str_replace(", ", ".ß, ", $hidden_tags);

    $checkbox = $_POST['checkbox'];
    $checkboxes = implode(', ', $checkbox);

    $alltags = $checkboxes;
    if (!empty($tags)){
        $alltags .= ', '.$tags;
    }
    if (!empty($htags)){
        $alltags .= ', '.$htags.".ß";
    }

        // Queries

    $sql = "
    INSERT INTO
    products(`brand`, `name`, `description`, `type`, `shop_list`, `rating`, `image`, `date`, `kcal`, `fat`, `carbohydrates`, `fiber`, `protein`, `weight`, `portion`, `shelf_life`, `info`, `tags`) 
    VALUES('$brand', '$name', '$description', '$type', '$shop_list', '$rating', '$image', '$date', '$kcal', '$fat', '$carbohydrates', '$fiber', '$protein', '$weight', '$portion', '$shelf_life', '$info', '$alltags');
    ";

    $var = mysqli_multi_query($con,$sql);

mysqli_close($con);
?>