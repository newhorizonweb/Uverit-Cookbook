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
    $name = $_POST["name"];
    $description = $_POST["description"];
    $type = $_POST["type"];
    $difficulty = $_POST["difficulty"];
                
    $kcal = $_POST["kcal"];
    $fat = $_POST["fat"];
    $carbohydrates = $_POST["carbohydrates"];
    $fiber = $_POST["fiber"];
    $protein = $_POST["protein"];
    $weight = $_POST["weight"];
    $portion = $_POST["portion"];
    $shelf_life = $_POST["shelf_life"];
    $active_time = $_POST["active_time"];
    $passive_time = $_POST["passive_time"];
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
    
    $maxPx = 1920;
    $imgFilePath = '../Recipe_img/';

    $image = $_FILES['image']['name'];
    $imagePath = $_FILES['image']['tmp_name'];

    // Check if the image was modified (if so, delete the old one)
    $sql_var = "SELECT image FROM recipes where id = '$id'";
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

        // Loops creating variables
    
    // Loop creating variables (arrays) $...calc1-24
    for ($x = 1; $x <= 24; $x++) {
        $weightcalc["weightcalc".$x] = $_POST["weight-calc".$x];
        $namecalc["namecalc".$x] = $_POST["name-calc".$x];
        $kcalcalc["kcalcalc".$x] = $_POST["kcal-calc".$x];
        $fatcalc["fatcalc".$x] = $_POST["fat-calc".$x];
        $carbcalc["carbcalc".$x] = $_POST["carb-calc".$x];
        $fibercalc["fibercalc".$x] = $_POST["fiber-calc".$x];
        $proteincalc["proteincalc".$x] = $_POST["protein-calc".$x];
    }

    extract($weightcalc);
    extract($namecalc);
    extract($kcalcalc);
    extract($fatcalc);
    extract($carbcalc);
    extract($fibercalc);
    extract($proteincalc);

    // Loop creating column names for ...-calc2-24
    $weightcalcloop = "`weight-calc1` = '$weightcalc1'";
    $namecalcloop = "`name-calc1` = '$namecalc1'";
    $kcalcalcloop = "`kcal-calc1` = '$kcalcalc1'";
    $fatcalcloop = "`fat-calc1` = '$fatcalc1'";
    $carbcalcloop = "`carb-calc1` = '$carbcalc1'";
    $fibercalcloop = "`fiber-calc1` = '$fibercalc1'";
    $proteincalcloop = "`protein-calc1` = '$proteincalc1'";

    for ($x = 2; $x <= 24; $x++) {
        $weightcalcloop .= ", `weight-calc".$x."` = '".$_POST["weight-calc".$x]."'";
        $namecalcloop .= ", `name-calc".$x."` = '".$_POST["name-calc".$x]."'";
        $kcalcalcloop .= ", `kcal-calc".$x."` = '".$_POST["kcal-calc".$x]."'";
        $fatcalcloop .= ", `fat-calc".$x."` = '".$_POST["fat-calc".$x]."'";
        $carbcalcloop .= ", `carb-calc".$x."` = '".$_POST["carb-calc".$x]."'";
        $fibercalcloop .= ", `fiber-calc".$x."` = '".$_POST["fiber-calc".$x]."'";
        $proteincalcloop .= ", `protein-calc".$x."` = '".$_POST["protein-calc".$x]."'";
    }

    // Loop creating variables (arrays) $...calcsub1-6
    for ($x = 1; $x <= 6; $x++) {
        $weightcalcsub["weightcalcsub".$x] = $_POST["weight-calc-sub".$x];
        $namecalcsub["namecalcsub".$x] = $_POST["name-calc-sub".$x];
    }

    extract($weightcalcsub);
    extract($namecalcsub);

    // Loop creating column names for ...calcsub2-6
    $weightcalcsubloop = "`weight-calc-sub1` = '$weightcalcsub1'";
    $namecalcsubloop = "`name-calc-sub1` = '$namecalcsub1'";

    for ($x = 2; $x <= 6; $x++) {
        $weightcalcsubloop .= ", `weight-calc-sub".$x."` = '".$_POST["weight-calc-sub".$x]."'";
        $namecalcsubloop .= ", `name-calc-sub".$x."` = '".$_POST["name-calc-sub".$x]."'";
    }
                
    // Loop creating variables (arrays) $ingredient, $ing_weight, $recipe (1-24)
    for ($x = 1; $x <= 24; $x++) {
        $ingredient["ingredient".$x] = $_POST["ingredient".$x];
        $ing_weight["ing_weight".$x] = $_POST["ing_weight".$x];
        $recipe["recipe".$x] = $_POST["recipe".$x];
    }

    extract($ingredient);
    extract($ing_weight);
    extract($recipe);

    // Loop creating column names for $ingredient, $ing_weight, $recipe (1-24)
    $ingredientloop = "ingredient1 = '$ingredient1'";
    $ingweightloop = "ing_weight1 = '$ing_weight1'";
    $recipeloop = "recipe1 = '$recipe1'";

    for ($x = 2; $x <= 24; $x++) {
        $ingredientloop .= ", ingredient".$x." = '".$_POST["ingredient".$x]."'";
        $ingweightloop .= ", ing_weight".$x." = '".$_POST["ing_weight".$x]."'";
        $recipeloop .= ", recipe".$x." = '".$_POST["recipe".$x]."'";
    }

        // Database queries

    $sql = "
    UPDATE recipes SET 
        `name` = '$name', 
        `description` = '$description',
        `type` = '$type',
        `difficulty` = '$difficulty',
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
        `active_time` = '$active_time',
        `passive_time` = '$passive_time',
        `info` = '$info',
        `tags` = '$tags'
    WHERE id = '$id';
    
    UPDATE calc SET 
        recipe_name = '$name',
        $weightcalcloop,
        $namecalcloop,
        $kcalcalcloop,
        $fatcalcloop,
        $carbcalcloop,
        $fibercalcloop,
        $proteincalcloop
    WHERE id = '$id';
    
    UPDATE calc_sub SET 
        recipe_name = '$name',
        $weightcalcsubloop,
        $namecalcsubloop
    WHERE id = '$id';

    UPDATE ingredients SET 
        recipe_name = '$name',
        $ingredientloop,
        $ingweightloop
    WHERE id = '$id';
    
    UPDATE recipe_steps SET 
        recipe_name = '$name',
        $recipeloop
    WHERE id = '$id'; 
    ";

    $var = mysqli_multi_query($con,$sql);

mysqli_close($con);
?>