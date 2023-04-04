<?php

function display_content($dish_type){
    $con = mysqli_connect("localhost", "root", "", "cookbook");
    require("svg.php");
    
    $sort = isset($_POST["sort"]) ? $sort = $_POST["sort"] : "alphabet";
    
    $dish_type_list = implode("', '", $dish_type);
    $sql = "SELECT * FROM recipes WHERE type IN ('$dish_type_list') ORDER BY name";

    $kcal_query = "kcal * 1";
    $protein_query = "protein * 1";
    $carbohydrates = "carbohydrates / 10";
    $wpts_query = "(fat * 9 + protein * 4) / 100";
    $active_time = "active_time * 1";
    $total_time = "active_time + passive_time";
    
    $search = isset($_POST["search-bar"]) ? $search = $_POST["search-bar"] : "  ";
    $data = explode(' ',$search);
    
    $sqlloop = "";
    $i = 1;
    while ($i < count($data)){
        if(!empty($data[$i])){
            $sqlloop .= " AND concat(name, description, tags) LIKE '%".$data[$i]."%' ";
        }
        $i++;
    }
    
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
    
    // Load only the next 10 results
    $result_number = isset($_POST["result_number"]) ? $result_number = $_POST["result_number"] : 10;
    $limit = " LIMIT 10 OFFSET ".$result_number - 10;

    $order_query = "SELECT * FROM recipes WHERE concat(name, description, tags) LIKE '%$data[0]%'".$sqlloop." ".$tag_filter." AND type IN ('$dish_type_list') ORDER BY";

$sort_options = array(
    "alphabet" => $order_query." name".$limit,
    "alphabet_rev" => $order_query." name DESC".$limit,
    //---------------------
    "time_low_active" => $order_query." ".$active_time.$limit,
    "time_high_active" => $order_query." ".$active_time ." DESC".$limit,
    "time_low_total" => $order_query." ".$total_time.$limit,
    "time_high_total" => $order_query." ".$total_time." DESC".$limit,
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
    
$active_time_svg = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 363.6 363.7'><defs><style>.class-1{fill:#07abdb;}</style></defs><path class='class-1' d='M280.2,236.6h0a43.9,43.9,0,0,1-43.8-43.8V177.1a44,44,0,0,1,43.8-43.8h0A43.9,43.9,0,0,1,324,177.1v15.7A43.8,43.8,0,0,1,280.2,236.6Z'/><path class='class-1' d='M304.9,242.6a53.3,53.3,0,0,1-49.4,0,69.2,69.2,0,0,0-58.7,68.2v45.3a7.7,7.7,0,0,0,7.6,7.6H356.1a7.6,7.6,0,0,0,7.5-7.6V310.8A69.2,69.2,0,0,0,304.9,242.6Z'/><path d='M213.9,183l-17.1-9.9V90a15,15,0,0,0-30,0v91.2a15,15,0,0,0,7.5,13.6h0l49.9,28.8.6-.3A66.1,66.1,0,0,1,213.9,187Z'/><path d='M181.8,0C81.6,0,0,81.6,0,181.8c0,97.8,77.5,177.7,174.3,181.7V333.4C94.1,329.5,30,263,30,181.8,30,98.1,98.1,30,181.8,30a152,152,0,0,1,137.7,87.9c11.8,2.1,25.5,9,38.7,19.7C338.4,58.6,266.8,0,181.8,0Z'/></svg>";

$passive_time_svg = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 366.6 366.6'><defs><style>.class-1{fill:#07abdb;}</style></defs><path class='class-1' d='M323.9,258l2.5-2.2c14.8-12.6,33.1-28.4,34.8-67.6a6.5,6.5,0,0,0,5.4-6.4V167.7a6.4,6.4,0,0,0-6.4-6.4H240.9a6.4,6.4,0,0,0-6.4,6.4v14.1a6.5,6.5,0,0,0,5.4,6.4c1.7,39.2,20,54.9,34.8,67.6l2.5,2.2a5.4,5.4,0,0,1,1.5,1.5,7.7,7.7,0,0,1-1.5,10.8l-2.5,2.1c-14.8,12.7-33,28.3-34.8,67.3a6.5,6.5,0,0,0-5.4,6.4v14.1a6.4,6.4,0,0,0,6.4,6.4H360.2a6.4,6.4,0,0,0,6.4-6.4V346a6.4,6.4,0,0,0-5.4-6.3c-1.8-39-20.1-54.6-34.8-67.3l-2.5-2.1a7.1,7.1,0,0,1-1.5-1.5A7.7,7.7,0,0,1,323.9,258Zm-12.6-14.6a21.9,21.9,0,0,0-3.4,3.4,27,27,0,0,0,3.4,38.1l2.6,2.2c13,11.2,25.4,21.8,27.8,49.3H259.4c2.4-27.5,14.8-38.1,27.8-49.3l2.6-2.2a28.9,28.9,0,0,0,3.5-3.5,27,27,0,0,0-3.5-38l-2.6-2.2c-13-11.2-25.4-21.9-27.8-49.4h82.3c-2.4,27.5-14.8,38.2-27.8,49.4Z'/><path d='M181.8,75a15,15,0,0,0-15,15v91.2a15,15,0,0,0,7.5,13.6h0l49.1,28.3v-.3a149.1,149.1,0,0,1-6-15.7,162.7,162.7,0,0,1-6.1-25.7l-14.4-8.3V90A15,15,0,0,0,181.8,75Z'/><path d='M181.8,0C81.6,0,0,81.6,0,181.8S81.6,363.6,181.8,363.6a178.1,178.1,0,0,0,30.1-2.5V330.6a152.1,152.1,0,0,1-30.1,3C98.1,333.6,30,265.5,30,181.8S98.1,30,181.8,30c68.8,0,127.1,46,145.7,109h31C339.2,59.3,267.3,0,181.8,0Z'/></svg>";

$total_time_svg = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 363.6 363.6'><defs><style>.class-1{fill:#07abdb;}</style></defs><path class='class-1' d='M361.5,159.6h0a14.7,14.7,0,0,0-20.3-5.2,15.9,15.9,0,0,0-3.9,3.4L229,291.4a6.3,6.3,0,0,1-8.9.9,4.9,4.9,0,0,1-1.2-1.3l-26-37.1a23.5,23.5,0,0,0-32.7-5.7,28.5,28.5,0,0,0-4.4,4.1h0a23.6,23.6,0,0,0-1.3,28.5l53.2,75.9a16.3,16.3,0,0,0,22.6,4,16.9,16.9,0,0,0,4-4l15.2-21.9L360.9,175.6A14.5,14.5,0,0,0,361.5,159.6Z' transform='translate(0 0)'/><path d='M196.8,90a15,15,0,0,0-30,0v91.2a15,15,0,0,0,7.5,13.6h0l70.9,40.9,19.1-23.6-67.5-38.9Z' transform='translate(0 0)'/><path d='M181.8,0C81.6,0,0,81.6,0,181.8S81.6,363.6,181.8,363.6H185l-21.8-31.1C88.2,323.3,30,259.2,30,181.8,30,98.1,98.1,30,181.8,30c68.1,0,125.9,45.1,145.1,107a36.7,36.7,0,0,1,24.6-7l4.8.6C334.1,55.2,264.3,0,181.8,0Z' transform='translate(0 0)'/></svg>";

$res = mysqli_query($con,$sql);

while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];
    $recipename = $row['name'];
    $description = $row['description'];
    $type = $row['type'];
    $difficulty = $row['difficulty'];
    $kcal = $row['kcal'];
    $fat = $row['fat'];
    $carbohydrates = $row['carbohydrates'];
    $fiber = $row['fiber'];
    $protein = $row['protein'];
    $weight = $row['weight'];
    $portion = $row['portion'];
    $active_time = $row['active_time'];
    $passive_time = $row['passive_time'];

    $image = $row['image'];
    if (!file_exists("../Recipe_img/".$image)) {
        $image = "Images/no-img.svg";
    } else {
        $image = "Recipe_img/".$row['image'];
    }

    $cp = $carbohydrates / 10; // Carbohydrate portion = 10g carbs
    $wpts = ($fat * 9 + $protein * 4) / 100; // Warsaw Pump Therapy School = (fat kcal + protein kcal) / 100
            
echo "<div class='recipe-div'>";

    echo "<a href='Recipes/$id.php' id='".$id."' class='recipe-link' rel='noreferrer'></a>";

    echo "<div class='recipe-top'>";

        echo "<div class='recipe-top-head'>";
            echo "<p class='recipe-name'>".$recipename."</p>";
            echo "<p class='recipe-desc'>".$description."</p>";
        echo "</div>";

        echo "<div class='diff-stars'>";
            switch ($difficulty){
                case "easy":
                    echo "<div class='star full-star'>".$star."</div>";
                    echo "<div class='star'>".$star."</div>";
                    echo "<div class='star'>".$star."</div>";
                break;
                case "moderate":
                    echo "<div class='star full-star'>".$star."</div>";
                    echo "<div class='star full-star'>".$star."</div>";
                    echo "<div class='star'>".$star."</div>";
                break;
                case "hard":
                    echo "<div class='star full-star'>".$star."</div>";
                    echo "<div class='star full-star'>".$star."</div>";
                    echo "<div class='star full-star'>".$star."</div>";
                break;
            } 
        echo "</div>"; // diff-stars

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
        
        echo "<div class='recipe-time'>";

            // Active Time
            echo "<div class='time-div'>";
                $hours = floor($active_time / 60);
                $min = $active_time - ($hours * 60);
                echo $active_time_svg;
                if ($hours != 0 && $min != 0){
                    echo "<p>".$hours." h ".$min." min</p>";
                }
                if ($hours != 0 && $min == 0){
                    echo "<p>".$hours." h</p>";
                } 
                if ($hours == 0 && $min != 0){
                    echo "<p>".$min." min</p>";
                }
            echo "</div>";
    
            // Passive Time
            echo "<div class='time-div'>";
                $hours = floor($passive_time / 60);
                $min = $passive_time - ($hours * 60);
                echo $passive_time_svg;
                if ($hours != 0 && $min != 0){
                    echo "<p>".$hours." h ".$min." min</p>";
                }
                if ($hours != 0 && $min == 0){
                    echo "<p>".$hours." h</p>";
                } 
                if ($hours == 0 && $min != 0){
                    echo "<p>".$min." min</p>";
                }
            echo "</div>";
    
            // Total Time
            echo "<div class='time-div'>";
                $total_time = $active_time + $passive_time; 
                $hours = floor($total_time / 60);
                $min = $total_time - ($hours * 60);
                echo $total_time_svg;
                if ($hours != 0 && $min != 0){
                    echo "<p>".$hours." h ".$min." min</p>";
                }
                if ($hours != 0 && $min == 0){
                    echo "<p>".$hours." h</p>";
                } 
                if ($hours == 0 && $min != 0){
                    echo "<p>".$min." min</p>";
                }
            echo "</div>";
        echo "</div>"; // recipe-time
    
        echo "<div class='recipe-type'>";
        echo    "<div class='type-other recipe-type-icon'>";
                switch ($type){
                    case "dishes":
                        echo $type_dishes;
                    break;
                    case "desserts":
                        echo $type_desserts;
                    break;
                    case "snacks":
                        echo $type_snacks;
                    break;
                    case "other":
                        echo $type_other;
                    break;
                }
        echo    "</div>";
        echo "</div>";
    
    echo "</div>"; //recipe-tables

echo "</div>"; //recipe=div
}
    mysqli_close($con);
}

// Display all results
function recipe_list_all(){
    $dish_types = ["dishes", "desserts", "snacks", "other"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "dishes"
function recipe_list_dishes(){
    $dish_types = ["dishes"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "desserts"
function recipe_list_desserts(){
    $dish_types = ["desserts"];
    ob_start();
    display_content($dish_types);
    $content = ob_get_contents();
    ob_end_clean();

    if(!empty($content)){
        display_content($dish_types);
    }
}

// Display results for "snacks"
function recipe_list_snacks(){
    $dish_types = ["snacks"];
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
    
    case "dishes":
        recipe_list_dishes();
    break;
        
    case "desserts":
        recipe_list_desserts();
    break;
        
    case "snacks":
        recipe_list_snacks();
    break;
        
    case "other":
        recipe_list_other();
    break;
}

    // Add a "recipe-faded" class to the "recipe-link"

echo "<script>";
echo    "$('.recipe-link').on('mouseover', function(){
            $('.recipe-link').addClass('recipe-faded');
            $(this).removeClass('recipe-faded');
        });

        $('.recipe-link').on('mouseout', function(){
            $('.recipe-link').removeClass('recipe-faded');
        });";

echo    "if ($('.food_type').val() != 'all_types'){
            $('.recipe-div').addClass('sinlge-rt');
        } else {
            $('.recipe-div').removeClass('sinlge-rt');
        }";
echo "</script>";
?>




