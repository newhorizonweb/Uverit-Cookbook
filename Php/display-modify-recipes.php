<?php

function display_mod_form(){
    
$con = mysqli_connect("localhost", "root", "", "cookbook");

    $product = $_POST["id"];
    $sql = "SELECT * FROM recipes 
    LEFT JOIN ingredients ON recipes.id = ingredients.id 
    LEFT JOIN recipe_steps ON ingredients.id = recipe_steps.id 
    LEFT JOIN calc ON recipe_steps.id = calc.id
    LEFT JOIN calc_sub ON calc.id = calc_sub.id
    WHERE recipes.id = '$product'";
    
    $res = mysqli_query($con,$sql);

    while($row = mysqli_fetch_assoc($res)){
        
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $type = $row['type'];
        $difficulty = $row['difficulty'];
        
        // If the image doesn't exist in the folder, replace it with a placeholder
        $image = $row['image'];
        if (!file_exists("../Recipe_img/".$image) || $image == "") {
            $image = "Images/placeholder-image.svg";
        } else {
            $image = "Recipe_img/".$row['image'];
        }
        
            // Loop creating variables (arrays) $ingredient, $ing_weight, $recipe (1-24)

        for ($x = 1; $x <= 24; $x++){
            $ingredient["ingredient".$x] = $row["ingredient".$x];
            $ing_weight["ing_weight".$x] = $row["ing_weight".$x];
            $recipe["recipe".$x] = $row["recipe".$x];
        }

        extract($ingredient);
        extract($ing_weight);
        extract($recipe);
        
            // Loop creating variables (arrays) $weightcalc, $namecalc, $kcalcalc, $fatcalc, $carbcalc, $fibercalc, $proteincalc (1-24)
        
        for ($x = 1; $x <= 24; $x++){
            $weightcalc["weightcalc".$x] = $row["weight-calc".$x];
            $namecalc["namecalc".$x] = $row["name-calc".$x];
            $kcalcalc["kcalcalc".$x] = $row["kcal-calc".$x];
            $fatcalc["fatcalc".$x] = $row["fat-calc".$x];
            $carbcalc["carbcalc".$x] = $row["carb-calc".$x];
            $fibercalc["fibercalc".$x] = $row["fiber-calc".$x];
            $proteincalc["proteincalc".$x] = $row["protein-calc".$x];
        }

        extract($weightcalc);
        extract($namecalc);
        extract($fatcalc);
        extract($kcalcalc);
        extract($carbcalc);
        extract($fibercalc);
        extract($proteincalc);
        
        for ($x = 1; $x <= 6; $x++){
            $weightcalcsub["weightcalcsub".$x] = $row["weight-calc-sub".$x];
            $namecalcsub["namecalcsub".$x] = $row["name-calc-sub".$x];
        }

        extract($weightcalc);
        extract($namecalc);
        
        $kcal = $row['kcal'];
        $fat = $row['fat'];
        $carbohydrates = $row['carbohydrates'];
        $fiber = $row['fiber'];
        $protein = $row['protein'];
        $weight = $row['weight'];
        $portion = $row['portion'];
        $shelf_life = $row['shelf_life'];
        $active_time = $row['active_time'];
        $passive_time = $row['passive_time'];
        $info = $row['info'];
        $tags = $row['tags'];
?>

<input type="text" name="id" id="<?php echo $id ?>" value="<?php echo $id ?>" style="display:none;" class="take_id">

<div class="form-s1 form-section">

    <div class="form-s1-left">
        <div class="input-div s1-name">
            <label for="name">Nazwa*</label>
            <input type="text" name="name" id="name" class="required" maxlength="56" value='<?php echo $name ?>'>
        </div>
        <div class="input-div s1-desc">
            <label for="description">Opis*</label>
            <input type="text" name="description" id="description" class="required" maxlength="128" value='<?php echo $description ?>'>
        </div>
        <div class="input-div s1-type">
            <label for="type">Typ*</label>
            <select name="type" id="type" class="required">
                <option value="dishes" title="Całe danie, np. lasagne, burgery" <?php if($type == 'dishes') {echo "selected=selected"; } ?>>
                    Dania
                </option>
                
                <option value="desserts" title="Np. sernik, lody, pierniczki" <?php if($type == 'desserts') {echo "selected=selected"; } ?>>
                    Desery
                </option>
                
                <option value="snacks" title="Np. chipsy, kanapki, batony"<?php if($type == 'snacks') {echo "selected=selected"; } ?>>
                    Przekąski
                </option>
                
                <option value="other" title="Np. bułki, karmel, dżem" <?php if($type == 'other') {echo "selected=selected"; } ?>>
                    Inne
                </option>
            </select>
        </div>
        <div class="input-div s1-diff">
            <label for="difficulty">Poziom trudności*</label>
            <select name="difficulty" class="required">
                <option value="easy" <?php if($difficulty == 'easy') {echo "selected=selected"; } ?>>
                    Łatwy
                </option>
                <option value="moderate" <?php if($difficulty == 'moderate') {echo "selected=selected"; } ?>>
                    Średni
                </option>
                <option value="hard" <?php if($difficulty == 'hard') {echo "selected=selected"; } ?>>
                    Trudny
                </option>
            </select>
        </div>
        <div class="input-div s1-image">
            <label for="image">Obraz (jpg, png)*</label>
            <label for="upload_image" id="file_style">Wybierz obraz</label>
            <input type="file" style="display:none;" id="upload_image" name="image" accept="image/png, image/jpeg" class="required2">
        </div>
    </div>

    <div class="form-s1-right">
        <img id="output" src="<?php echo $image ?>" alt="No image">
    </div>
</div>

<div class="calc">           
    <div class="calc-expand">
        <img src="Images/list-arrow-b.svg" class="calc-arrow calc-arrow1" alt="expand arrow left">
        <p>KALKULATOR</p>
        <img src="Images/list-arrow-b.svg" class="calc-arrow calc-arrow2" alt="expand arrow right">
    </div>

    <div class="calculator">
    <?php
    // Generate a number list
    echo "<div class='list-calc-col'>";
    echo "<h5>&nbsp;</h5>";
    for ($x = 1; $x <= 24; $x++) {
        echo "<p>".$x.".</p>";
    }
    echo "</div>";

    // Generate reset values buttons
    echo "<div class='reset-calc-col'>";
    echo "<h5>&nbsp;</h5>";
    for ($x = 1; $x <= 24; $x++) {
        echo "<div class='reset-calc-row reset-calc-row".$x."'></div>";
    }
    for ($x = 1; $x <= 6; $x++) {
        echo "<div class='reset-calc-row reset-calc-row-sub reset-calc-row-sub".$x."'></div>";
    }
    echo "</div>";    
        
    // Generate calculator weight inputs
    echo "<div class='weight-calc-col'>";
    echo "<h5 title='Waga w gramach'>Waga</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $weight_calc = "<input type='tel' name='weight-calc".$x."' class='weight-calc weight-calc".$x." calc-num' value='".$row["weight-calc".$x]."' data-target='ing_weight".$x."' tabindex='-1'>";
        echo $weight_calc;
    }
    echo "<div class='sub-loss'>";
    echo "<p>Straty</p>";
    echo "<span></span>";
    echo "</div>";
    for ($x = 1; $x <= 6; $x++) {
        echo "<input type='tel' name='weight-calc-sub".$x."' class='weight-calc-sub weight-calc-sub".$x." calc-num' value='".$row["weight-calc-sub".$x]."' tabindex='-1'>";
    }
    echo "</div>";

    // Generate calculator name inputs
    echo "<div class='name-calc-col'>";
    echo "<h5>Nazwa</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $name_calc = "<input type='text' name='name-calc".$x."' class='name-calc".$x."' value='".$namecalc["namecalc".$x]."' data-target='ingredient".$x."' tabindex='-1'>";
        echo $name_calc;
    }
    echo "<div class='sub-line-div'>";
    echo "<span class='sub-line'></span>";
    echo "</div>";
    for ($x = 1; $x <= 6; $x++) {
        echo "<select name='name-calc-sub".$x."' class='calc-sub-select calc-sub-select".$x."' dbval='".$row["name-calc-sub".$x]."' tabindex='-1'>";
        echo "<option selected>Wybierz składnik</option>";
        for ($o = 1; $o <= 24; $o++) {
            echo "<option class='name-calc-option name-calc-option".$o."'></option>";
        }
        echo "</select>";
    } 
    echo "</div>";  

    // Generate calculator kcal inputs
    echo "<div class='kcal-calc-col'>";
    echo "<h5 title='Kcal / 100g'>Kcal</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $kcal_calc = "<input type='tel' name='kcal-calc".$x."' class='kcal-calc kcal-calc".$x." calc-num' value='".$kcalcalc["kcalcalc".$x]."' tabindex='-1'>";
        echo $kcal_calc;
    }
    echo "<input class='calc-result kcal-result' readonly>";
    echo "</div>";
        
    // Generate calculator fat inputs
    echo "<div class='fat-calc-col'>";
    echo "<h5 title='W gramach / 100g'>Tłuszcz</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $fat_calc = "<input type='tel' name='fat-calc".$x."' class='fat-calc fat-calc".$x." calc-num' value='".$fatcalc["fatcalc".$x]."' tabindex='-1'>";
        echo $fat_calc;
    }
    echo "<input class='calc-result fat-result' readonly>";
    echo "</div>";

    // Generate calculator carb inputs
    echo "<div class='carb-calc-col'>";
    echo "<h5 title='W gramach / 100g'>Węgle</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $carb_calc = "<input type='tel' name='carb-calc".$x."' class='carb-calc carb-calc".$x." calc-num' value='".$carbcalc["carbcalc".$x]."' tabindex='-1'>";
        echo $carb_calc;
    }
    echo "<input class='calc-result carb-result' readonly>";
    echo "</div>"; 

    // Generate calculator fiber inputs
    echo "<div class='fiber-calc-col'>";
    echo "<h5 title='W gramach / 100g'>Błonnik</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $fiber_calc = "<input type='tel' name='fiber-calc".$x."' class='fiber-calc fiber-calc".$x." calc-num' value='".$fibercalc["fibercalc".$x]."' tabindex='-1'>";
        echo $fiber_calc;
    }
    echo "<input class='calc-result fiber-result' readonly>";
    echo "</div>";

    // Generate calculator protein inputs
    echo "<div class='protein-calc-col'>";
    echo "<h5 title='W gramach / 100g'>Białko</h5>";
    for ($x = 1; $x <= 24; $x++) {
        $protein_calc = "<input type='tel' name='protein-calc".$x."' class='protein-calc protein-calc".$x." calc-num' value='".$proteincalc["proteincalc".$x]."' tabindex='-1'>";
        echo $protein_calc;
    }
    echo "<input class='calc-result protein-result' readonly>";
    echo "</div>";
    ?>
    </div> 
</div>

<div class="form-s2 form-section">
    <label for="ing_weight" title="Waga składnika w gramach (w tym: mleko, jajka, przyprawy, itp.) - w celu dokładnego obliczenia wartości odżywczych">
        Waga (g)* / Składnik*
    </label>
    <ol  class="form-s2-inner">
    <?php
        // Ing 1-2 (required)
        for ($x = 1; $x <= 2; $x++) {
            echo "<li>";
            echo "<input type='tel' name='ing_weight".$x."' value='".$ing_weight["ing_weight".$x]."' class='ing_weight".$x." ing_weight required'>";
            echo "<input type='text' name='ingredient".$x."' value='".$ingredient["ingredient".$x]."' class='ingredient".$x." required'>";
            echo "</li>";
        }
        // Ing 3-8
        for ($x = 3; $x <= 24; $x++) {
            echo "<li>";
            echo "<input type='tel' name='ing_weight".$x."' value='".$ing_weight["ing_weight".$x]."' class='ing_weight".$x." ing_weight'>";
            echo "<input type='text' name='ingredient".$x."' value='".$ingredient["ingredient".$x]."' class='ingredient".$x."'>";
            echo "</li>";
        }
    ?>
    </ol>
</div>

<div class="form-s3 form-section">
    <label for="recipe">
        Sposób przygotowania*
    </label>
    <ol>
    <div class="form-s3-left">
    <?php
        // Recipe 1-2 (required)
        for ($x = 1; $x <= 2; $x++) {
            echo "<li>";
            echo "<input type='text' name='recipe".$x."' value='".$recipe["recipe".$x]."' class='recipe".$x." required'>";
            echo "</li>";
        }
    ?>
    <?php
        // Recipe 3-12
        for ($x = 3; $x <= 12; $x++) {
            echo "<li>";
            echo "<input type='text' name='recipe".$x."' value='".$recipe["recipe".$x]."' class='recipe".$x."'>";
            echo "</li>";
        }
    ?>
    </div>
    <div class="form-s3-right">
    <?php
        // Recipe 13-25
        for ($x = 13; $x <= 24; $x++) {
            echo "<li>";
            echo "<input type='text' name='recipe".$x."' value='".$recipe["recipe".$x]."' class='recipe".$x."'>";
            echo "</li>";
        }
    ?>
    </div>
    </ol>
</div>

<div class="form-s4 form-section">
    <div class="form-s4-a form-s4-div">
        <div class="form-s4-input">
            <label for="shelf_life">Termin ważności</label>
            <input type="text" name="shelf_life" value='<?php echo $shelf_life ?>'>
        </div>
        <div class="form-s4-input">
            <label for="kcal" title="Ilość kalorii w całości" class="s4-help">Kalorie (kcal)*</label>
            <input type='tel' name="kcal" class="kcal required" value='<?php echo $kcal ?>'>
        </div>
    </div>
    <div class="form-s4-b form-s4-div">
        <div class="form-s4-input">
            <label for="fat" title="Ilość tłuszczu w całości" class="s4-help">Tłuszcz (g)*</label>
            <input type='tel' name="fat" class="fat required" value='<?php echo $fat ?>'>
        </div>
        <div class="form-s4-input">
            <label for="carbohydrates" title="Ilość węglowodanów przyswajalnych w całości" class="s4-help">Węglow. netto (g)*</label>
            <input type='tel' name="carbohydrates" class="carbohydrates required" value='<?php echo $carbohydrates ?>'>
        </div>
    </div>
    <div class="form-s4-c form-s4-div">
        <div class="form-s4-input">
            <label for="fiber" title="Ilość błonnika w całości" class="s4-help">Błonnik (g)*</label>
            <input type='tel' name="fiber" class="fiber required" value='<?php echo $fiber ?>'>
        </div>
        <div class="form-s4-input">
            <label for="protein" title="Ilość białka w całości" class="s4-help">Białko (g)*</label>
            <input type='tel' name="protein" class="protein required" value='<?php echo $protein ?>'>
        </div>
    </div>
    <div class="form-s4-d form-s4-div">
        <div class="form-s4-input">
            <label for="weight">Waga - gotowe (g)*</label>
            <input type='tel' name="weight" class="required" value='<?php echo $weight ?>'>
        </div>
        <div class="form-s4-input">
            <label for="portion">Ilość porcji / sztuk*</label>
            <input type='tel' name="portion" class="required portion" value='<?php echo $portion ?>'>
        </div>
    </div>
    <div class="form-s4-e form-s4-div">
        <div class="form-s4-input">
            <label for="active_time" title="Mieszanie, krojenie składników, itp." class="s4-help">Czas aktyw. (min)*</label>
            <input type='tel' name="active_time" value='<?php echo $active_time ?>'>
        </div>
        <div class="form-s4-input">
            <label for="passive_time" title="Wyrośnięcie ciasta, pieczenie, itp." class="s4-help">Czas bierny (min)*</label>
            <input type='tel' name="passive_time" value='<?php echo $passive_time ?>'>
        </div>
    </div>
    <div class="form-s4-info">
        <label for="info">Dod. informacje</label>
        <input type="text" name="info" maxlength="256" value='<?php echo $info ?>'>
    </div>
</div>

<?php
        // Visible tags
        
    $pattern_vis = '/[^A-Za-z0-9\s\-\(\)\"\'\:\.\!\$\*\+\&\%\_\@\#]/';
    $tags_visible = preg_split('/,/', $tags, -1, PREG_SPLIT_NO_EMPTY);
        
    $visible_tags_array = array_filter($tags_visible, function($tag) use ($pattern_vis) {
      return !preg_match($pattern_vis, $tag);
    });
    $visible_tags = implode(',', $visible_tags_array);
    $visible_tags = trim($visible_tags);
        
        // Hidden tags
        
    $pattern_hid = '/^[A-Za-z0-9\s\-\(\)\"\'\:\.\!\$\*\+\&\%\_\@\#]+$/';
    $tags_hidden = preg_split('/,/', $tags, -1, PREG_SPLIT_NO_EMPTY);
        
    $hidden_tags_array = array_filter($tags_hidden, function($tag) use ($pattern_hid) {
      return !preg_match($pattern_hid, $tag);
    });
    $hidden_tags = implode(',', $hidden_tags_array);
    $hidden_tags = trim($hidden_tags); 
        
    $hidden_tags = str_replace(".ß", "", $hidden_tags);
?>

<div class="form-s5 form-section"> 
    <label for="tags" title="Dodaj tagi opisujące potrawę, np. sezonowe, resztki, zupa, zapiekanka. Wszystkie tagi z niestandardowymi znakami są niewidoczne na stronie przepisu.">Tagi*</label>
    <input type="text" name="tags" class="tag-input" id="tag-input" value='<?php echo $visible_tags ?>'>
    
    <label for="hidden_tags" title="Dodaj tagi niewidoczne na stronie przepisu">Ukryte tagi</label>
    <input type="text" name="hidden_tags" placeholder="Masło, winogrona..." value='<?php echo $hidden_tags ?>'>
</div>

<?php
    $delete_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:8px;}</style></defs><line class='cls-1' x1='95.5' y1='111.4' x2='110.1' y2='211.5'/><line class='cls-1' x1='140' y1='111.4' x2='140' y2='211.5'/><path class='cls-1' d='M60.6,87.6,83.1,217.9c2.7,12.2,8.8,18.1,24.8,18.1h64.3c15.9,0,22-5.9,24.7-18.1L219.4,87.6'/>
    <g class='bin-lid'><path class='cls-1' d='M135.4,86.9h92.2a8.6,8.6,0,0,0,8.4-8.4h0a8.4,8.4,0,0,0-8.4-8.3H52.4A8.4,8.4,0,0,0,44,78.5h0a8.6,8.6,0,0,0,8.4,8.4h83Z'/><path class='cls-1' d='M182,69.4l-8.9-16.9c-2.5-4.2-7.6-8.5-13.5-8.5H120.4c-5.9,0-11,4.3-13.4,8.5L98.1,69.4'/></g>
    <line class='cls-1' x1='184.5' y1='111.4' x2='169.9' y2='211.5'/><line class='cls-1' x1='221.4' y1='86.9' x2='58.7' y2='86.9'/></svg>";   
?>

<div class="send-btn">
    <div class="space"></div>
    <p id="placeholder-text"></p>
    <div class='send-inner'>
        
        <div class="add-left-padding"></div>
        
        <div id="add">
            <p>Modyfikuj</p>
        </div>
        
        <div class="rc-button">
            <?php echo $delete_icon; ?>
        </div>
        
        <div class="recipe-container">
            <div class="delete-div">
                <form method='POST' enctype='multipart/form-data' id='delete_recipes' class='delete-form'>
                    <div class="delete-recipes">
                        <p class="delete-info">Wpisz hasło</p>
                    </div>
                    <input type="password" name="password" id="password" class="" tabindex="-1">
                    <input type="submit" name="delete" id="delete" value="Usuń przepis" class="" tabindex="-1">
                </form>
            </div>
        </div>
        
    </div>
    <div class="send-block"></div>
</div>

<script src="Scripts/calc.js"></script>
<script src="Scripts/image-drop.js" defer></script>
<script defer>

        // Delete selected recipe  

    $(function(){
        $('#delete_recipes').on('click', '#delete', function (e) {
            e.preventDefault();

            var recipe = $(".take_id").attr('id');
            var password = document.getElementById("password").value;

            $.ajax({
                type: "post",
                url: 'Php/delete-recipes.php',
                data: { "id": recipe,
                        password: password },
                success: function(response) {
                    $(".delete-recipes").html(response);
                    if(response.includes("deleted-success")){
                        $(".send-block").css("display", "block");

                        $("#placeholder-text").addClass('sent');
                        $("#placeholder-text").html("Przepis został usunięty");

                        $("#add").addClass('sent');
                        $("#add").html("<p>Usunięto</p>");
                    }
                },
                error: function(){
                    $("#placeholder-text").html("Błąd podczas usuwania");
                    $(".delete-recipes").html("Error");
                    $("#add").addClass('error');
                }
            });
        });
    });
    
        // Slide-in
    
    $(document).ready(function(){
        let slideContainer = ".recipe-container";
        let slideBtn = $(".rc-button");
        let slideOpenClass = "rc-open";
        let slideExtClass = "rc-extended";

        slideBtn.on("click", function(e){
            $(slideContainer).toggleClass(slideExtClass);
            slideBtn.toggleClass(slideOpenClass);
            e.stopPropagation();
        });

        $(window).on("click", function(e){
            if(!$(e.target).is(slideContainer) && 
               $(slideContainer).has(e.target).length === 0){
                $(slideContainer).removeClass(slideExtClass);
                slideBtn.removeClass(slideOpenClass);
            }
        });
    });
</script>
    <?php
    }

mysqli_close($con);

}

display_mod_form();

?>




