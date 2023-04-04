<?php

function display_content($dish_type){
    $con = mysqli_connect("localhost", "root", "", "cookbook");
    require("svg.php");
    
    // Sort
    $sort = isset($_POST["sort"]) ? $sort = $_POST["sort"] : "alphabet";
    
    // Type
    $dish_type_list = implode("', '", $dish_type);
    $sql = "SELECT * FROM products WHERE type IN ('$dish_type_list') ORDER BY name";
    
    // Search
    $search = isset($_POST["search-bar"]) ? $search = $_POST["search-bar"] : "  ";
    $data = preg_split('/[, ]+/', $search);
    
    $sqlloop = "";
    $i = 1;
    while ($i < count($data)){
        if(!empty($data[$i])){
            $sqlloop .= " AND concat(brand, name, description, shop_list, tags) LIKE '%".$data[$i]."%' ";
        }
        $i++;
    }
    
    // Shops
    $slcheckbox = array();
    $slcheckbox = isset($_POST["slcheckbox"]) ? $slcheckbox = $_POST["slcheckbox"] : "";
    $shop_list = "";
    if(!empty($slcheckbox)){
        foreach($slcheckbox as $checkbox){
            $items = explode(",", $checkbox);
            foreach($items as $item){
                if(!empty($item)){
                    $shop_list .= " AND shop_list LIKE '%$item%' ";
                }
            }
        }
    }
    
    // Tags
    $tfcheckbox = array();
    $tfcheckbox = isset($_POST["tfcheckbox"]) ? $tfcheckbox = $_POST["tfcheckbox"] : "";
    $tag_filter = "";
    if(!empty($tfcheckbox)){
        foreach($tfcheckbox as $checkbox){
            $items = explode(",", $checkbox);
            foreach($items as $item){
                if(!empty($item)){
                    $tag_filter .= " AND tags LIKE '%$item%' ";
                }
            }
        }
    }

    // Rating
    if (isset($_POST["rs_min"]) && isset($_POST["rs_max"])){
        $range_min = $_POST["rs_min"];
        $range_max = $_POST["rs_max"];
        $between_range = "AND rating BETWEEN ".$range_min." AND ".$range_max;
    } else {
        $range_min = "";
        $range_max = "";
        $between_range = "";
    }

    // Nutrition values
    $kcal_query = "kcal * 1";
    $protein_query = "protein * 1";
    $carbohydrates = "carbohydrates / 10";
    $wpts_query = "(fat * 9 + protein * 4) / 100";
    
    // Load only the next 10 results
    $result_number = isset($_POST["result_number"]) ? $result_number = $_POST["result_number"] : 10;
    $limit = " LIMIT 10 OFFSET ".$result_number - 10;

    $order_query = "SELECT * FROM products 
    WHERE concat(brand, name, description, shop_list, tags) 
    LIKE '%$data[0]%'".$sqlloop." ".
    $shop_list.$tag_filter.$between_range
    ." AND type IN ('$dish_type_list') 
    ORDER BY";
    
    $order_query2 = "SELECT * FROM products 
    WHERE concat(brand, name, description, shop_list, tags) 
    LIKE '%$data[0]%'".$sqlloop." ".
    $shop_list.$tag_filter.$between_range
    ." AND type IN ('$dish_type_list')";
    
    // Change the query based on the toolbar value choices
$sort_options = array(
    "alphabet" => $order_query." name".$limit,
    "alphabet_rev" => $order_query." name DESC".$limit,
    //---------------------
    "rating_low" => $order_query2." AND rating REGEXP '^[0-9]+$' ORDER BY rating".$limit,
    "rating_high" => $order_query2." AND rating REGEXP '^[0-9]+$' ORDER BY rating DESC".$limit,
    //---------------------
    "kcal_low_all" => $order_query." ".$kcal_query.$limit,
    "kcal_high_all" => $order_query." ".$kcal_query." DESC".$limit,
    "protein_low_all" => $order_query." ".$protein_query.$limit,
    "cp_low_all" => $order_query." ".$carbohydrates.$limit,
    "cp_high_all" => $order_query." ".$carbohydrates." DESC".$limit,
    "wpts_low_all" => $order_query." ".$wpts_query.$limit,
    "wpts_high_all" => $order_query." ".$wpts_query." DESC".$limit,
    //---------------------
    "kcal_low_100" => $order_query." ".$kcal_query." / weight * 100".$limit,
    "kcal_high_100" => $order_query." ".$kcal_query." / weight * 100 DESC".$limit,
    "protein_low_100" => $order_query." ".$protein_query." / weight * 100".$limit,
    "cp_low_100" => $order_query." ".$carbohydrates." / weight * 100".$limit,
    "cp_high_100" => $order_query." ".$carbohydrates." / weight * 100 DESC".$limit,
    "wpts_low_100" => $order_query." ".$wpts_query." / weight * 100".$limit,
    "wpts_high_100" => $order_query." ".$wpts_query." / weight * 100 DESC".$limit,
    //---------------------
    "kcal_low_portion" => $order_query." ".$kcal_query." / `portion`".$limit,
    "kcal_high_portion" => $order_query." ".$kcal_query." / `portion` DESC".$limit,
    "protein_low_portion" => $order_query." ".$protein_query." / `portion`".$limit,
    "cp_low_portion" => $order_query." ".$carbohydrates." / `portion`".$limit,
    "cp_high_portion" => $order_query." ".$carbohydrates." / `portion` DESC".$limit,
    "wpts_low_portion" => $order_query." ".$wpts_query." / `portion`".$limit,
    "wpts_high_portion" => $order_query." ".$wpts_query." / `portion` DESC".$limit
);
    
$sql = $sort_options[$sort];

$star = "<svg id='Capa_1' data-name='Capa 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 487.2 465.2'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M251.7,14.6,317,147.2a8.9,8.9,0,0,0,6.8,4.9l146.3,21.3a8.9,8.9,0,0,1,5,15.2L369.2,291.9a9.3,9.3,0,0,0-2.6,7.9l25,145.8a8.9,8.9,0,0,1-12.9,9.4L247.8,386.1a9.3,9.3,0,0,0-8.3,0L108.5,455a9,9,0,0,1-13-9.4l25.1-145.8a9.3,9.3,0,0,0-2.6-7.9L12.1,188.6a8.9,8.9,0,0,1,5-15.2l146.3-21.3a8.9,8.9,0,0,0,6.8-4.9L235.6,14.6A9,9,0,0,1,251.7,14.6Z'/></svg>";

$res = mysqli_query($con,$sql);

while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];
    $brand = $row['brand'];
    $product_name = $row['name'];
    $description = $row['description'];
    $type = $row['type'];
    $shop_list = $row['shop_list'];
    $rating = $row['rating'];
    $kcal = intval($row['kcal']);
    $fat = intval($row['fat']);
    $carbohydrates = intval($row['carbohydrates']);
    $fiber = intval($row['fiber']);
    $protein = intval($row['protein']);
    $weight = intval($row['weight']);
    $portion = intval($row['portion']);

    $image = $row['image'];
    if (!file_exists("../Product_img/".$image)) {
        $image = "Images/no-img.svg";
    } else {
        $image = "Product_img/".$row['image'];
    }

    $cp = $carbohydrates / 10; // Carbohydrate portion = 10g carbs
    $wpts = ($fat * 9 + $protein * 4) / 100; // Warsaw Pump Therapy School = (fat kcal + protein kcal) / 100

switch ($type){
    case "drinks":
        $type_icon = $drink_icon;
    break;
    case "sweets_snacks":
        $type_icon = $sweets_snacks_icon;
    break;
    case "baked_goods_pastry":
        $type_icon = $baked_goods_icon;
    break;
    case "grains_pasta":
        $type_icon = $grains_icon;
    break;
    case "fruits_vegetables":
        $type_icon = $fruits_vegetables_icon;
    break;
    case "meat_dairy":
        $type_icon = $meat_dairy_icon;
    break;
    case "vege_vegan":
        $type_icon = $vege_icon;
    break;
    case "ready_meals":
        $type_icon = $ready_meals_icon;
    break;
    case "semi_finished":
        $type_icon = $semi_finished_icon;
    break;
    case "sauces_spices":
        $type_icon = $spice_icon;
    break;
    case "other":
        $type_icon = $pastry_bag_icon;
    break;
}

echo "<div class='recipe-div'>";

    echo "<div id='".$id."' class='product-link'></div>";

    echo "<div class='recipe-top'>";

        echo "<div class='recipe-top-head'>";
            echo "<p class='recipe-brand'>".$brand."</p>";
            echo "<p class='recipe-name'>".$product_name."</p>";
        echo "</div>";

    echo "</div>"; // recipe-top
    
    echo "<div class='recipe-img'>";
        echo "<img src='".$image."' loading='lazy' alt='Recipe Image'>";
    echo "</div>";

    echo "<div class='recipe-tables'>";
        echo "<div class='nutrition-table'>";
            echo "<div class='nutrition-div'>";
                echo "<p>------</p>";
                echo "<p>Kcal</p>";
                echo "<p>Błk g</p>";
                echo "<p>WW</p>";
                echo "<p>WBT</p>";
            echo "</div>";
            echo "<div class='nutrition-div'>";
                echo "<p>Całość</p>";
                echo "<p>".round($kcal, 0)."</p>";
                echo "<p>".round($protein, 1)."</p>";
                echo "<p>".round($cp, 1)."</p>";
                echo "<p>".round($wpts, 1)."</p>";
            echo "</div>";
            echo "<div class='nutrition-div'>";
                echo "<p>100g</p>";
                echo "<p>".round($kcal / $weight * 100, 0)."</p>";
                echo "<p>".round($protein / $weight * 100, 1)."</p>";
                echo "<p>".round($cp / $weight * 100, 1)."</p>";
                echo "<p>".round($wpts / $weight * 100, 1)."</p>";
            echo "</div>";
            echo "<div class='nutrition-div'>";    
                echo "<p>Porcja</p>";
                echo "<p>".round($kcal / $portion, 0)."</p>";
                echo "<p>".round($protein / $portion, 1)."</p>";
                echo "<p>".round($cp / $portion, 1)."</p>";
                echo "<p>".round($wpts / $portion, 1)."</p>";
            echo "</div>";
        echo "</div>"; // nutrition-table
    
        if (is_numeric($rating)){
            echo "<div class='rating rating-tables'>";
                echo "<span class='rating-icon'>".$star."</span>";
                echo "<p>".$rating."</p>";
            echo "</div>";
        }
    
        echo "<div class='recipe-type'>";
        echo    $type_icon;
        echo "</div>";
    
    echo "</div>"; //recipe-tables

echo "</div>"; //recipe=div
}
    mysqli_close($con);
}

// Display all results
function recipe_list_all(){
    $dish_types = ["drinks", "sweets_snacks", "baked_goods_pastry", "grains_pasta", "fruits_vegetables", "meat_dairy", "vege_vegan", "ready_meals", "semi_finished", "sauces_spices", "other"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "drinks"
function recipe_list_drinks(){
    $dish_types = ["drinks"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "sweets_snacks"
function recipe_list_sweets_snacks(){
    $dish_types = ["sweets_snacks"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "baked_goods_pastry"
function recipe_list_baked_goods_pastry(){
    $dish_types = ["baked_goods_pastry"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "grains_pasta"
function recipe_list_grains_pasta(){
    $dish_types = ["grains_pasta"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "fruits_vegetables"
function recipe_list_fruits_vegetables(){
    $dish_types = ["fruits_vegetables"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "meat_dairy"
function recipe_list_meat_dairy(){
    $dish_types = ["meat_dairy"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "vege_vegan"
function recipe_list_vege_vegan(){
    $dish_types = ["vege_vegan"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "ready_meals"
function recipe_list_ready_meals(){
    $dish_types = ["ready_meals"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "semi_finished"
function recipe_list_semi_finished(){
    $dish_types = ["semi_finished"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for ""
function recipe_list_sauces_spices(){
    $dish_types = ["sauces_spices"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "other"
function recipe_list_other(){
    $dish_types = ["other"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

$food_type = isset($_POST["food_type"]) ? $food_type = $_POST["food_type"] : "all_types";

switch ($food_type){
    case "all_types":
        recipe_list_all();
    break;
    
    case "drinks":
        recipe_list_drinks();
    break;

    case "sweets_snacks":
        recipe_list_sweets_snacks();
    break;

    case "baked_goods_pastry":
        recipe_list_baked_goods_pastry();
    break;

    case "grains_pasta":
        recipe_list_grains_pasta();
    break;

    case "fruits_vegetables":
        recipe_list_fruits_vegetables();
    break;

    case "meat_dairy":
        recipe_list_meat_dairy();
    break;

    case "vege_vegan":
        recipe_list_vege_vegan();
    break;

    case "ready_meals":
        recipe_list_ready_meals();
    break;

    case "semi_finished":
        recipe_list_semi_finished();
    break;

    case "sauces_spices":
        recipe_list_sauces_spices();
    break;

    case "other":
        recipe_list_other();
    break;
}

    // Add a "recipe-faded" class to the "recipe-link"

echo "<script>";
echo    "$('.product-link').on('mouseover', function(){
            $('.product-link').addClass('product-faded');
            $(this).removeClass('product-faded');
        });

        $('.product-link').on('mouseout', function(){
            $('.product-link').removeClass('product-faded');
        });";

echo    "if ($('.food_type').val() != 'all_types'){
            $('.recipe-div').addClass('single-rt');
        } else {
            $('.recipe-div').removeClass('single-rt');
        }";
echo "</script>";
?>

