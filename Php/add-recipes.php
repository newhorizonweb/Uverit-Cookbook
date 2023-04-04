<?php 
$con = mysqli_connect("localhost", "root", "", "cookbook");
                    
    $name = $_POST["name"];
    $description = $_POST["description"];
    $type = $_POST["type"];
    $difficulty = $_POST["difficulty"];
    $date = date("d.m.Y, G:i");
    
    $fat = $_POST["fat"];
    $kcal = $_POST["kcal"];
    $carbohydrates = $_POST["carbohydrates"];
    $fiber = $_POST["fiber"];
    $protein = $_POST["protein"];
    $weight = $_POST["weight"];
    $portion = $_POST["portion"];
    $shelf_life = $_POST["shelf_life"];
    $active_time = $_POST["active_time"];
    $passive_time = $_POST["passive_time"];
    $info = $_POST["info"];

        // Upload the image

    $maxPx = 1920;
    $imgFilePath = '../Recipe_img/';

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

    $weightcalcloop = "`weight-calc1`";
    $namecalcloop = "`name-calc1`";
    $kcalcalcloop = "`kcal-calc1`";
    $fatcalcloop = "`fat-calc1`";
    $carbcalcloop = "`carb-calc1`";
    $fibercalcloop = "`fiber-calc1`";
    $proteincalcloop = "`protein-calc1`";

    for ($x = 2; $x <= 24; $x++) {
        $weightcalcloop .= ", `weight-calc".$x."`";
        $namecalcloop .= ", `name-calc".$x."`";
        $kcalcalcloop .= ", `kcal-calc".$x."`";
        $fatcalcloop .= ", `fat-calc".$x."`";
        $carbcalcloop .= ", `carb-calc".$x."`";
        $fibercalcloop .= ", `fiber-calc".$x."`";
        $proteincalcloop .= ", `protein-calc".$x."`";
    }

        // Loop creating variables list for ...-calc2-24

    $weightcalcvar = "'".$weightcalc1."'";
    $namecalcvar = "'".$namecalc1."'";
    $kcalcalcvar = "'".$kcalcalc1."'";
    $fatcalcvar = "'".$fatcalc1."'";
    $carbcalcvar = "'".$carbcalc1."'";
    $fibercalcvar = "'".$fibercalc1."'";
    $proteincalcvar = "'".$proteincalc1."'";

    for ($x = 2; $x <= 24; $x++) {
        $weightcalcvar .= ", '".$weightcalc["weightcalc".$x]."'";
        $namecalcvar .= ", '".$namecalc["namecalc".$x]."'";
        $kcalcalcvar .= ", '".$kcalcalc["kcalcalc".$x]."'";
        $fatcalcvar .= ", '".$fatcalc["fatcalc".$x]."'";
        $carbcalcvar .= ", '".$carbcalc["carbcalc".$x]."'";
        $fibercalcvar .= ", '".$fibercalc["fibercalc".$x]."'";
        $proteincalcvar .= ", '".$proteincalc["proteincalc".$x]."'";
    }

    // Loop creating variables (arrays) $...calcsub1-24

    for ($x = 1; $x <= 6; $x++) {
        $weightcalcsub["weightcalcsub".$x] = $_POST["weight-calc-sub".$x];
        $namecalcsub["namecalcsub".$x] = $_POST["name-calc-sub".$x];
    }

    extract($weightcalcsub);
    extract($namecalcsub);

        // Loop creating column names for ...calcsub2-24

    $weightcalcsubloop = "`weight-calc-sub1`";
    $namecalcsubloop = "`name-calc-sub1`";

    for ($x = 2; $x <= 6; $x++) {
        $weightcalcsubloop .= ", `weight-calc-sub".$x."`";
        $namecalcsubloop .= ", `name-calc-sub".$x."`";
    }

        // Loop creating variables list for ...-calcsub2-24

    $weightcalcsubvar = "'".$weightcalcsub1."'";
    $namecalcsubvar = "'".$namecalcsub1."'";

    for ($x = 2; $x <= 6; $x++) {
        $weightcalcsubvar .= ", '".$weightcalcsub["weightcalcsub".$x]."'";
        $namecalcsubvar .= ", '".$namecalcsub["namecalcsub".$x]."'";
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

    $ingredientloop = "`ingredient1`";
    $ingweightloop = "`ing_weight1`";
    $recipeloop = "`recipe1`";

    for ($x = 2; $x <= 24; $x++) {
        $ingredientloop .= ", `ingredient".$x."`";
        $ingweightloop .= ", `ing_weight".$x."`";
        $recipeloop .= ", `recipe".$x."`";
    }

        // Loop creating variables list for $ingredient, $ing_weight, $recipe (1-24)

    $ingredientvar = "'".$ingredient1."'";
    $ingweightvar = "'".$ing_weight1."'";
    $recipevar = "'".$recipe1."'";

    for ($x = 2; $x <= 24; $x++) {
        $ingredientvar .= ", '".$ingredient["ingredient".$x]."'";
        $ingweightvar .= ", '".$ing_weight["ing_weight".$x]."'";
        $recipevar .= ", '".$recipe["recipe".$x]."'";
    }

        // Queries

    $sql = "
    INSERT INTO
    recipes(`name`, `description`, `type`, `difficulty`, `image`, `date`, `kcal`, `fat`, `carbohydrates`, `fiber`, `protein`, `weight`, `portion`, `shelf_life`, `active_time`, `passive_time`, `info`, `tags`) 
    VALUES('$name', '$description', '$type', '$difficulty', '$image', '$date', '$kcal', '$fat', '$carbohydrates', '$fiber', '$protein', '$weight', '$portion', '$shelf_life', '$active_time', '$passive_time', '$info', '$alltags');
      
    INSERT INTO 
    calc(`recipe_name`, $weightcalcloop, $namecalcloop, $kcalcalcloop, $fatcalcloop, $carbcalcloop, $fibercalcloop, $proteincalcloop)
    VALUES('$name', $weightcalcvar, $namecalcvar, $kcalcalcvar, $fatcalcvar, $carbcalcvar, $fibercalcvar, $proteincalcvar);
      
    INSERT INTO 
    calc_sub(`recipe_name`, $weightcalcsubloop, $namecalcsubloop)
    VALUES('$name', $weightcalcsubvar, $namecalcsubvar);

    INSERT INTO 
    ingredients(`recipe_name`, $ingredientloop, $ingweightloop)
    VALUES('$name', $ingredientvar, $ingweightvar);
                    
    INSERT INTO 
    recipe_steps(`recipe_name`, $recipeloop) 
    VALUES('$name', $recipevar)
    ";

    $var = mysqli_multi_query($con,$sql);

mysqli_close($con);

require "create-file.php";
createFile();
?>