<?php 
// Truncate table [table] - DELETE all of the rows and reset id count (begin counting from 1)
/* 
Truncate Table calc;
Truncate TABLE calc_sub;
Truncate TABLE ingredients;
Truncate TABLE recipes;
Truncate TABLE recipe_steps;
*/

$con = mysqli_connect("localhost", "root", "", "cookbook");
             
    $id = $_POST["id"];
    $brand = $_POST["brand"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $type = $_POST["type"];

    $shops = $_POST['slcheckbox'];
    $shop_list = implode(', ', $shops);

    $rating = $_POST["rating"];
                
    $kcal = $_POST["kcal"];
    $fat = $_POST["fat"];
    $carbohydrates = $_POST["carbohydrates"];
    $fiber = $_POST["fiber"];
    $protein = $_POST["protein"];
    $weight = $_POST["weight"];
    $portion = $_POST["portion"];
    $shelf_life = $_POST["shelf_life"];
    $info = $_POST["info"];
    $mod_date = date("d.m.Y, G:i");

        // Tags

    $visible_tags = $_POST["tags"];
    $hid_tags = $_POST["hidden_tags"];

    $htags = explode(',', $hid_tags);
    foreach ($htags as &$htag) {
      $htag .= ".ß";
    }
    $hidden_tags = implode(',', $htags);

    $tags = $visible_tags;
    if (!empty($hidden_tags)){
        $tags .= ", ".$hidden_tags;
    }

        // Upload the image

    $maxPx = 1280;
    $imgFilePath = '../Product_img/';

    $image = $_FILES['image']['name'];
    $imagePath = $_FILES['image']['tmp_name'];

    // Check if the image was modified (if so, delete the old one)
    $sql_var = "SELECT image FROM products where id = '$id'";
    $var = mysqli_query($con,$sql_var);

    while($row = mysqli_fetch_assoc($var)){
        $db_img = $row['image'];
        
        if ($_FILES['image']['name'] == ""){
            $_FILES['image']['name'] == $db_img;
            $image = $db_img;
        } else {
            $image = $_FILES['image']['name'];

            // Delete the old recipe image
            unlink($imgFilePath.$db_img);

            // Rotate the image based on its EXIF orientation value
            $dimensions = getimagesize($imagePath);
            $aspectRatio = $dimensions[0] / $dimensions[1];
            $imageType = exif_imagetype($imagePath);
            
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
 
        }
    }

        // Database query

    $sql = "
    UPDATE products SET 
        `brand` = '$brand', 
        `name` = '$name', 
        `description` = '$description',
        `type` = '$type',
        `shop_list` = '$shop_list',
        `rating` = '$rating',
        `image` = '$image',
        `last_mod_date` = '$mod_date',
        `kcal` = '$kcal',
        `fat` = '$fat',
        `carbohydrates` = '$carbohydrates',
        `fiber` = '$fiber',
        `protein` = '$protein',
        `weight` = '$weight',
        `portion` = '$portion', 
        `shelf_life` = '$shelf_life', 
        `info` = '$info',
        `tags` = '$tags'
    WHERE id = '$id';
    ";

    $var = mysqli_multi_query($con,$sql);

mysqli_close($con);
?>