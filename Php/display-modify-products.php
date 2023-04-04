<?php

function display_mod_form(){
    
$con = mysqli_connect("localhost", "root", "", "cookbook");

    $product = $_POST["id"];
    $sql = "SELECT * FROM products WHERE products.id = '$product'";
    
    $res = mysqli_query($con,$sql);

    while($row = mysqli_fetch_assoc($res)){
        
        $id = $row['id'];
        $brand = $row['brand'];
        $name = $row['name'];
        $description = $row['description'];
        $type = $row['type'];
        $shop_list = $row['shop_list'];
        $rating = $row['rating'];
        
        // If the image doesn't exist in the folder, replace it with a placeholder
        $image = $row['image'];
        if (!file_exists("../Product_img/".$image) || $image == "") {
            $image = "Images/placeholder-image.svg";
        } else {
            $image = "Product_img/".$row['image'];
        }
        
        $kcal = $row['kcal'];
        $fat = $row['fat'];
        $carbohydrates = $row['carbohydrates'];
        $fiber = $row['fiber'];
        $protein = $row['protein'];
        $weight = $row['weight'];
        $portion = $row['portion'];
        $shelf_life = $row['shelf_life'];
        $info = $row['info'];
        $tags = $row['tags'];
?>

<input type="text" name="id" id="<?php echo $id ?>" value="<?php echo $id ?>" style="display:none;" class="take_id">

<div class="form-s1 form-section">
    <div class="form-s1-left">
        <div class="input-div s1-brand">
            <label for="brand">Marka*</label>
            <input type="text" name="brand" id="brand" class="required" maxlength="32" value='<?php echo $brand ?>'>
        </div>
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
                <option value="drinks" title="Energetyki, kawa rozpuszczalna, herbata" <?php if($type == 'drinks') {echo "selected=selected"; } ?>>Napoje</option>
                
                <option value="sweets_snacks" title="Batony, ciastka, chipsy" <?php if($type == 'sweets_snacks') {echo "selected=selected"; } ?>>Słodycze i Przekąski</option>
                
                <option value="baked_goods_pastry" title="Bułki, omlety, ciasta" <?php if($type == 'baked_goods_pastry') {echo "selected=selected"; } ?>>Pieczywo i Ciasta</option>
                
                <option value="grains_pasta" title="Ryż, spaghetti, ciecierzyca" <?php if($type == 'grains_pasta') {echo "selected=selected"; } ?>>Zboża i Makarony</option>
                
                <option value="fruits_vegetables" title="Jabłka, śliwki suszone, orzechy" <?php if($type == 'fruits_vegetables') {echo "selected=selected"; } ?>>Owoce i Warzywa</option>
                
                <option value="meat_dairy" title="Szynka, mleko, jajka" <?php if($type == 'meat_dairy') {echo "selected=selected"; } ?>>Mięso i Nabiał</option>
                
                <option value="vege_vegan" title="Kotlety vege, mleko owsiane - vege i vegańskie odpowiedniki mięsa i nabiału" <?php if($type == 'vege_vegan') {echo "selected=selected"; } ?>>Vege i Vegan</option>
                
                <option value="ready_meals" title="Lasagne, gołąbki, pizza mrożona - wymagają tylko obróbki cieplnej" <?php if($type == 'ready_meals') {echo "selected=selected"; } ?>>Gotowe Dania</option>
                
                <option value="semi_finished" title="Budyń w proszku, ciasto francuskie, zupki chińskie - wymagają obróbki cieplnej lub / i dodatkowych składników" <?php if($type == 'semi_finished') {echo "selected=selected"; } ?>>Półprodukty</option>
                
                <option value="sauces_spices" title="Sos do spaghetti, ketchup, cynamon" <?php if($type == 'sauces_spices') {echo "selected=selected"; } ?>>Sosy i Przyprawy</option>
                
                <option value="other" title="Mąka, olej, mleko skondensowane" <?php if($type == 'other') {echo "selected=selected"; } ?>>Inne</option>
            </select>
        </div>
        <div class="shop-list">
            <label for="sl-btn">Sklepy*</label>
            <p class="sl-btn" id="sl-btn">Wybierz sklep</p>
            <div class="sl-items">
                <div class="sl-items-inner">
                    <!-- Content generated from JS at the bottom -->
                    <?php 
                        echo "<input type='text' class='hidden-shop-list' value='$shop_list' hidden>";
                    ?>
                </div>
            </div>
        </div>
        <div class="input-div s1-rating">
            <label for="rating">Ocena</label>
            <select name="rating" id="rating">
                <option selected>
                    Wybierz ocenę
                </option>

                <?php
                for($v = 1; $v <= 10; $v++){
                    if ($v != $rating){
                        echo "<option value='$v'>$v / 10</option>";
                    } else {
                        echo "<option value='$v' selected>$v / 10</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-s1-right">
        <div class="form-s1-image">
            <img id="output" src="<?php echo $image ?>" alt="Image upload error">
        </div>
        <div class="input-div s1-image">
            <label for="image">Obraz (jpg, png)*</label>
            <label for="upload_image" id="file_style">Wybierz obraz</label>
            <input type="file" style="display:none;" id="upload_image" name="image" accept="image/png, image/jpeg" class="required2">
        </div>
    </div>
</div>

<div class="form-s4 form-section"> 
    <div class="form-s4-a form-s4-div">
        <div class="form-s4-input">
            <label for="shelf_life">Termin ważności</label>
            <input type="text" name="shelf_life" value='<?php echo $shelf_life ?>'>
        </div>
        <div class="form-s4-input">
            <label for="kcal" title="Kcal (w całości)" class="s4-help">Kalorie (kcal)*</label>
            <input type='tel' name="kcal" class="kcal required" value='<?php echo $kcal ?>'>
        </div>
    </div>
    <div class="form-s4-b form-s4-div">
        <div class="form-s4-input">
            <label for="fat" title="W gramach (w całości)" class="s4-help">Tłuszcz (g)*</label>
            <input type='tel' name="fat" class="fat required" value='<?php echo $fat ?>'>
        </div>
        <div class="form-s4-input">
            <label for="carbohydrates" title="Węglowodany przyswajalne w gramach (w całości)" class="s4-help">Węglow. netto (g)*</label>
            <input type='tel' name="carbohydrates" class="carbohydrates required" value='<?php echo $carbohydrates ?>'>
        </div>
    </div>
    <div class="form-s4-c form-s4-div">
        <div class="form-s4-input">
            <label for="fiber" title="W gramach (w całości)" class="s4-help">Błonnik (g)*</label>
            <input type='tel' name="fiber" class="fiber required" value='<?php echo $fiber ?>'>
        </div>
        <div class="form-s4-input">
            <label for="protein" title="W gramach (w całości)" class="s4-help">Białko (g)*</label>
            <input type='tel' name="protein" class="protein required" value='<?php echo $protein ?>'>
        </div>
    </div>
    <div class="form-s4-d form-s4-div">
        <div class="form-s4-input">
            <label for="weight">Waga - gotowe (g)*</label>
            <input type='tel' name="weight" class="weight required" value='<?php echo $weight ?>'>
        </div>
        <div class="form-s4-input">
            <label for="portion">Ilość porcji / sztuk*</label>
            <input type='tel' name="portion" class="portion required" value='<?php echo $portion ?>'>
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
                    <input type="submit" name="delete" id="delete" value="Usuń produkt" class="" tabindex="-1">
                </form>
            </div>
        </div>
        
    </div>
    <div class="send-block"></div>
</div>

<script src="Scripts/image-drop.js" defer></script>
<script defer>
    
        // Shop list custom select list
    
    $(function(){
        
        // Create the shop list element
        let shopList = [
            "Action",
            "Aldi",
            "Auchan",
            "Bi1",
            "Biedronka",
            "Carrefour",
            "Dealz",
            "Dino",
            "Intermarche",
            "Kaufland",
            "Lewiatan",
            "Lidl",
            "Netto",
            "Pepco",
            "Polomarket",
            "Rossmann",
            "Stokrotka",
            "Żabka",
            "Sklepy internetowe",
            "Inne"
        ];

        let SLlength = shopList.length;

        let hid_SL_all = $(".hidden-shop-list").val();
        let SL_selected_items = hid_SL_all.split(", ");

        for (let nr = 0; nr < SLlength; nr++){

            if (SL_selected_items.includes(shopList[nr])){
                $(".sl-items-inner").append(
                    "<div class='sl-item'>" +
                        "<input type='checkbox' name='slcheckbox[]' id='slcheck"+nr+"' class='sl-checkbox' value='"+shopList[nr]+"' checked>" +
                    "</div>");
            } else {
                $(".sl-items-inner").append(
                    "<div class='sl-item'>" +
                        "<input type='checkbox' name='slcheckbox[]' id='slcheck"+nr+"' class='sl-checkbox' value='"+shopList[nr]+"'>" +
                    "</div>");
            }

        }

        // Open / close the select
        $(".sl-btn").on("click", function(){
            $(".shop-list").toggleClass("sl-open");
        });

        $(window).on("click", function(e){
            if(!$(e.target).is(".shop-list") && 
               $(".shop-list").has(e.target).length === 0){
                $(".shop-list").removeClass("sl-open");
            }
        });

        // Insert the checked boxes into the select
        function insertSLcheckBoxes(){
            let slChckbox = $(".sl-checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            let slChckboxArray = slChckbox.join(", ");
            $(".sl-btn").html(slChckboxArray);

            if ($(".sl-btn").html() === ""){
                $(".sl-btn").html("Wybierz sklepy")
            }
        }

        $(".sl-checkbox").on("click", function(){
            insertSLcheckBoxes();
        });

        $(document).ready(function(){
            insertSLcheckBoxes();
        });

        // Create labels and insert the checkbox value into them
        $(".sl-item").each(function(){
            let slCheckVal = $(this).children(".sl-checkbox").val();
            let slCheckId = $(this).children(".sl-checkbox").attr("id");
            $(this).append("<label for='"+slCheckId+"'>" + slCheckVal + "</label>")
        });
    });
    
        // Delete selected product  

    $(function(){
        $('#delete_recipes').on('click', '#delete', function (e){
            e.preventDefault();

            var recipe = $(".take_id").attr('id');
            var password = document.getElementById("password").value;

            $.ajax({
                type: "post",
                url: 'Php/delete-products.php',
                data: { "id": recipe,
                        password: password },
                success: function(response) {
                    $(".delete-recipes").html(response);
                    if(response.includes("deleted-success")){
                        $(".send-block").css("display", "block");

                        $("#placeholder-text").addClass('sent');
                        $("#placeholder-text").html("Produkt został usunięty");

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
        let container = $(".recipe-container");
        let rcBtn = $(".rc-button");

        $(".rc-button").on("click", function slideContainer(e){
            container.toggleClass("rc-extended");
            rcBtn.toggleClass("rc-open");
            e.stopPropagation();
        });

        $(window).on("click", function(e){
            if(!$(e.target).is(".recipe-container") && 
               $(".recipe-container").has(e.target).length === 0){
                container.removeClass("rc-extended");
                rcBtn.removeClass("rc-open");
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




