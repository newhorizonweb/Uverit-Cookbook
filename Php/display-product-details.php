<?php

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
            $image = "Images/no-img.svg";
        } else {
            $image = "Product_img/".$row['image'];
        }
        
        $date = $row['date'];
        $mod_date = $row['last_mod_date'];
        
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
        
        $cp = $carbohydrates / 10; // Carbohydrate portion = 10g
        $wpts = ($fat * 9 + $protein * 4) / 100; // Warsaw Pump Therapy School = (fat kcal + protein kcal) / 100
        
            /* SVG */
        
        require('../Php/svg.php');
        global $date_svg, $mod_date_svg;
        
$star = "<svg id='Capa_1' data-name='Capa 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 487.2 465.2'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M251.7,14.6,317,147.2a8.9,8.9,0,0,0,6.8,4.9l146.3,21.3a8.9,8.9,0,0,1,5,15.2L369.2,291.9a9.3,9.3,0,0,0-2.6,7.9l25,145.8a8.9,8.9,0,0,1-12.9,9.4L247.8,386.1a9.3,9.3,0,0,0-8.3,0L108.5,455a9,9,0,0,1-13-9.4l25.1-145.8a9.3,9.3,0,0,0-2.6-7.9L12.1,188.6a8.9,8.9,0,0,1,5-15.2l146.3-21.3a8.9,8.9,0,0,0,6.8-4.9L235.6,14.6A9,9,0,0,1,251.7,14.6Z'/></svg>";
        
$link_icon = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280' class='link-icon'><defs><style>.cls-1{fill:none;;stroke-miterlimit:10;}</style></defs><g id='Layer_3' data-name='Layer 3'><rect class='cls-1' x='129.5' y='91' width='19.6' height='98.16' rx='8.7' transform='translate(139.9 -57.5) rotate(45)'/><path class='cls-1' d='M122,206.3l20.4-20.4a9.8,9.8,0,0,1,13.8,0h0a9.7,9.7,0,0,1,0,13.9l-20.3,20.4a53.8,53.8,0,0,1-76.1-76.1l20.4-20.3a9.7,9.7,0,0,1,13.9,0h0a9.8,9.8,0,0,1,0,13.8L73.7,158A34.2,34.2,0,0,0,122,206.3Z'/><path class='cls-1' d='M206.3,122l-20.4,20.4a9.8,9.8,0,0,0,0,13.8h0a9.7,9.7,0,0,0,13.9,0l20.4-20.3a53.8,53.8,0,0,0-76.1-76.1L123.8,80.2a9.7,9.7,0,0,0,0,13.9h0a9.8,9.8,0,0,0,13.8,0L158,73.7A34.2,34.2,0,1,1,206.3,122Z'/></g></svg>";
        
$checkmark_icon = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280' class='checkmark-icon'><defs><style>.cls-2{fill:none;;stroke-miterlimit:10;}</style></defs><g id='Layer_2' data-name='Layer 2'><path class='cls-2' d='M234,51.5h0A13.2,13.2,0,0,0,212.3,50L114.9,170a5.7,5.7,0,0,1-9.2-.4L82.4,136.3A21,21,0,0,0,49,134.9h0a20.7,20.7,0,0,0-1.1,25.5l47.8,68.3a14.5,14.5,0,0,0,23.8,0l13.7-19.6L233.4,66A12.8,12.8,0,0,0,234,51.5Z'/></g></svg>";
        
$weight_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M79.3,25.2V23.8A20.7,20.7,0,1,1,83.2,36'/><path class='cls-1' d='M52.8,197H181.6c13.6,0,16.7-4.5,14.9-15.7l-20.7-113a30.3,30.3,0,0,0-29.6-23.7H53.8A30.3,30.3,0,0,0,24.2,68.3L3.5,181.3C1.7,192.5,4.8,197,18.4,197h94'/><path class='cls-1' d='M28.8,122.3l-4.6,24.9c-1.5,9.1,4.4,17.6,12.3,17.6h127c7.9,0,13.8-8.5,12.3-17.6l-10-53.8c-2-10.6-10.3-16.7-19.9-16.7H54.1c-9.6,0-17.9,6.1-19.9,16.7l-1.4,7.3'/><line class='cls-1' x1='30.8' y1='111.6' x2='30.8' y2='111.8'/><path class='cls-1' d='M153.8,59.2a24.6,24.6,0,0,0-11.6-3.5'/><path class='cls-1' d='M164.6,71.9a24.9,24.9,0,0,0-3.3-6'/><line class='cls-1' x1='43.8' y1='186.2' x2='43.9' y2='186.2'/><path class='cls-1' d='M16.8,179.2c.8,5,4.5,7,13.1,7h4'/></svg>";
        
$portion_weight_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-3{fill:none;}.cls-2{stroke-linecap:round;}.cls-1{stroke-linejoin:round;}.cls-3{stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M173,161.9a9.2,9.2,0,0,0,9.2-9.2V122.3A82.4,82.4,0,0,0,99.8,39.8h.4a82.4,82.4,0,0,0-82.4,82.5v30.4a9.2,9.2,0,0,0,9.2,9.2Z'/><path class='cls-2' d='M81.9,19.8a18.4,18.4,0,1,1,18.3,20,18.2,18.2,0,0,1-14.6-7.3'/><rect class='cls-3' x='3.1' y='174.1' width='193.9' height='22.86' rx='11.3'/><path class='cls-1' d='M149.7,77.2c1.6,1.9,3.2,3.9,4.6,5.9'/><path class='cls-1' d='M89.6,55.7a63.8,63.8,0,0,1,10.8-.9H100a65.9,65.9,0,0,1,38.8,12.6'/><line class='cls-1' x1='54.5' y1='185.5' x2='59.5' y2='185.5'/><line class='cls-1' x1='15.3' y1='185.5' x2='40.5' y2='185.5'/></svg>";
        
$portion_number_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-4{fill:none;}.cls-2{stroke-miterlimit:10;}.cls-4{stroke-linecap:round;}.cls-4{stroke-linejoin:round;}</style></defs><circle class='cls-1' cx='100' cy='118.9' r='79.3'/><path class='cls-2' d='M43.4,145.1a62,62,0,0,1-5.8-26.2,61.1,61.1,0,0,1,.6-8.6'/><path class='cls-2' d='M56.9,163.9a22.8,22.8,0,0,1-2.2-2.2'/><path class='cls-2' d='M133.6,171.4a62.2,62.2,0,0,1-33.6,9.9,61.4,61.4,0,0,1-33.9-10.1'/><path class='cls-2' d='M161.8,110.2a62.5,62.5,0,0,1-14.7,49.6'/><path class='icon-mod' d='M103.3,45l-8.7,8.7a8.9,8.9,0,0,1-6.8,2.9,23.1,23.1,0,0,0-17.6,7.1L28.4,105.5,11.2,122.7a4.9,4.9,0,0,1-3.4,1.4,4.7,4.7,0,0,1-3.3-1.4,4.7,4.7,0,0,1,0-6.7L21.7,98.7,63.5,56.9a23.6,23.6,0,0,0,7.1-17.5,9,9,0,0,1,2.9-6.9l8.6-8.6A7.5,7.5,0,0,0,92.7,34.5a7.4,7.4,0,0,0,0,10.5A7.5,7.5,0,0,0,103.3,45Z'/><path class='cls-4' d='M103,3.1,96.7,9.4,82.1,23.9l-8.6,8.6a9,9,0,0,0-2.9,6.9,23.6,23.6,0,0,1-7.1,17.5L21.7,98.7,4.5,116a4.7,4.7,0,0,0,0,6.7,4.7,4.7,0,0,0,3.3,1.4,4.9,4.9,0,0,0,3.4-1.4l17.2-17.2L70.2,63.7a23.1,23.1,0,0,1,17.6-7.1,8.9,8.9,0,0,0,6.8-2.9l8.7-8.7,9.2-9.2'/><polyline class='cls-4' points='112.5 35.8 117.8 30.5 124.1 24.2'/><path class='cls-4' d='M92.7,34.5A7.5,7.5,0,0,1,82.1,23.9'/><path class='cls-4' d='M103.3,45a7.5,7.5,0,0,1-10.6,0,7.4,7.4,0,0,1,0-10.5l20.8-20.9'/><path class='icon-mod' d='M169.1,89.5,125.7,46.2l-9.9-10L83.1,3.5a1.3,1.3,0,0,0-2.3.6l-.2,1.3c-2.3,15.2,3.1,31.1,14.5,42.4l3.8,3.8,7.9,7.9a23.7,23.7,0,0,0,17.4,7.1h5.6a7.7,7.7,0,0,1,5.1,2.1L162.3,96l26.4,26.5a4.9,4.9,0,0,0,6.9.2h0a4.9,4.9,0,0,0-.2-6.9L169,89.4'/></svg>";
        
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
?>

<div class="product-header">
    <div class="ph-info">
        <div class="head-buttons">
            <div class="dp-close">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="prod-link-btn">
                <?php echo $link_icon; ?>
            </div>
        </div>
        
        <?php  
        
        echo "<div class='head-info'>";
            if (is_numeric($rating)){
                echo "<div class='p-rating'>";
                    echo "<span class='p-rating-icon'>".$star."</span>";
                    echo "<p>".$rating."</p>";
                echo "</div>";
            }

            echo "<div class='p-type'>";
                echo "<span class='p-type-icon'>".$type_icon."</span>";
            echo "</div>";
        echo "</div>";
        
        echo "<div class='date'>";
            echo "<div class='date-inner'>";
                echo $date_svg;
                echo "<p>";
                    echo $date;
                echo "</p>";
            echo "</div>";

            if (!empty($mod_date)) {
                echo "<div class='date-inner mod-date'>";
                    echo $mod_date_svg;
                    echo "<p>";
                        echo $mod_date;
                    echo "</p>";
                echo "</div>";
            }
        echo "</div>";
        ?>
    </div>
    
    <div class="ph-content">
        <h5><?php echo $brand ?></h5>
        <h3><?php echo $name ?></h3>
        <h5><?php echo $description ?></h5>
    </div>
</div>

<div class="p-image-div">
    <div class="p-image-div-inner">
        <img class="p-image" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
    </div>
</div>

<div class="nutrition-info">
    <div class="nutrition-tables">
        <table class="nt-all">
            <?php
                echo "<tr>";
                echo    "<th class='nt-content'><p>";
                echo        "Wartości odżywcze";
                echo    "</p></th>";                       
                echo    "<th class='nt-content'><p>";
                echo        "Całość";
                echo    "</p></th>";

                echo    "<th class='nt-content'><p>";
                echo        "100 g";
                echo    "</p></th>";

                echo    "<th class='nt-content nt-calc'>
                            <input type='tel' class='nt-input' size='8' value='Por. ".round($weight / $portion, 1)." g' tabindex='-1'>";
                echo    "</th>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Wartość energetyczna";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-kcal'>";
                echo        round($kcal * $weight / 100, 0)." kcal";
                echo    "</p></td>"; 

                echo    "<td class='nt-content ntc'><p class='nt-kcal100'>";
                echo        round($kcal, 0)." kcal";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-kcal'>";
                echo        round($kcal / $portion, 0)." kcal";
                echo    "</p></td>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Tłuszcz";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-all'>";
                echo        round($fat * $weight / 100, 1)." g";
                echo    "</p></td>"; 

                echo    "<td class='nt-content ntc'><p class='nt-fat100'>";
                echo        round($fat, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-fat'>";
                echo        round($fat / $portion, 1)." g";
                echo    "</p></td>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Węglowodany (netto)";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-all'>";
                echo        round($carbohydrates * $weight / 100, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-carbs100'>";
                echo        round($carbohydrates, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-carbs'>";
                echo        round($carbohydrates / $portion, 1)." g";
                echo    "</p></td>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Błonnik";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-all'>";
                echo         round($fiber * $weight / 100, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-fiber100'>";
                echo        round($fiber, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-fiber'>";
                echo        round($fiber / $portion, 1)." g";
                echo    "</p></td>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Białko";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-all'>";
                echo         round($protein * $weight / 100, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-protein100'>";
                echo        round($protein, 1)." g";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-protein'>";
                echo        round($protein / $portion, 1)." g";
                echo    "</p></td>";
                echo "</tr>";
            ?>
        </table>

        <table class="nt-all">
            <?php
                echo "<tr>";
                echo    "<th class='nt-content'><p>";
                echo        "Wymienniki";
                echo    "</p></th>";                       
                echo    "<th class='nt-content'><p>";
                echo        "Całość";
                echo    "</p></th>";

                echo    "<th class='nt-content'><p>";
                echo        "100 g";
                echo    "</p></th>";

                echo    "<th class='nt-content'><p class='nt-weight'>";
                echo        "Por. ".round($weight / $portion, 1)." g";
                echo    "</p></th>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Węglowodanowe";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-cp'>";
                echo        round($cp * $weight / 100, 1)." WW";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-cp100'>";
                echo        round($cp, 1)." WW";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-cp'>";
                echo        round($cp / $portion, 1)." WW";
                echo    "</p></td>";
                echo "</tr>";



                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Białkowo-tłuszczowe";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-multi-wpts'>";
                echo        round($wpts * $weight / 100, 1)." WBT";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-wpts100'>";
                echo        round($wpts, 1)." WBT";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc'><p class='nt-wpts'>";
                echo        round($wpts / $portion, 1)." WBT";
                echo    "</p></td>";
                echo "</tr>";
            ?>
        </table>
    </div>
    
    <div class='nutri-percent'>
        <h4>Skład procentowy</h4>

        <div class='np-section np-weight'>
        <?php
            // Weight ratio
            $fat_ratio = round($fat / $weight * 100, 2);
            $carb_ratio = round($carbohydrates / $weight * 100, 2);
            $fiber_ratio = round($fiber / $weight * 100, 2);
            $protein_ratio = round($protein / $weight * 100, 2);

            require('calc-ratio.php');
        ?>

            <div class='pi-line'>
                <p>Waga</p>
            </div>

            <div class="np-desc">
                <div class="np-desc-txt">
                    <span class="np-ratio-fat"></span>
                    <p>
                        Tłuszcz <?php echo $fat_ratio."%" ?>
                    </p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-carb"></span>
                    <p>
                        Węgle <?php echo $carb_ratio."%" ?>
                    </p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-fiber"></span>
                    <p>
                        Błonnik <?php echo $fiber_ratio."%" ?>
                    </p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-protein"></span>
                    <p>
                        Białko <?php echo $protein_ratio."%" ?>
                    </p>
                </div>
            </div>

            <div class='np-ratio-div np-weight-ratio'>
            <?php
                if ($fat_ratio != 0){
                    echo "<span class='np-ratio np-ratio-fat' style='flex:".$fat_ratio."'></span>";
                }
                if ($carb_ratio != 0){
                    echo "<span class='np-ratio np-ratio-carb' style='flex:".$carb_ratio."'></span>";
                }
                if ($fiber_ratio != 0){
                    echo "<span class='np-ratio np-ratio-fiber' style='flex:".$fiber_ratio."'></span>";
                }
                if ($protein_ratio != 0){
                    echo "<span class='np-ratio np-ratio-protein' style='flex:".$protein_ratio."'></span>";
                }
            ?>
            </div>
        </div>

        <div class='np-section np-kcal'>
        <?php
            // Calorie ratio
            $fat_ratio = round(($fat * 9) / $kcal * 100, 2);
            $carb_ratio = round(($carbohydrates * 4) / $kcal * 100, 2);
            $fiber_ratio = round(($fiber * 2) / $kcal * 100, 2);
            $protein_ratio = round(($protein * 4) / $kcal * 100, 2);

            require('../Php/calc-ratio.php');
        ?>

            <div class='pi-line'>
                <p>Kalorie</p>
            </div>

            <div class="np-desc">
                <div class="np-desc-txt">
                    <span class="np-ratio-fat"></span>
                    <p>
                        Tłuszcz <?php echo $fat_ratio."%" ?>
                    </p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-carb"></span>
                    <p>
                        Węgle <?php echo $carb_ratio."%" ?>
                    </p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-fiber"></span>
                    <p>
                        Błonnik <?php echo $fiber_ratio."%" ?>
                    </p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-protein"></span>
                    <p>
                        Białko <?php echo $protein_ratio."%" ?>
                    </p>
                </div>
            </div>

            <div class='np-ratio-div np-calorie-ratio'>
            <?php
                if ($fat_ratio != 0){
                    echo "<span class='np-ratio np-ratio-fat' style='flex:".$fat_ratio."'></span>";
                }
                if ($carb_ratio != 0){
                    echo "<span class='np-ratio np-ratio-carb' style='flex:".$carb_ratio."'></span>";
                }
                if ($fiber_ratio != 0){
                    echo "<span class='np-ratio np-ratio-fiber' style='flex:".$fiber_ratio."'></span>";
                }
                if ($protein_ratio != 0){
                    echo "<span class='np-ratio np-ratio-protein' style='flex:".$protein_ratio."'></span>";
                }
            ?>
            </div>
        </div>
    </div>
</div>

<div class="product-info">
    <h4>Informacje</h4>

    <?php
    switch (true){
        case $weight < 100:
            $total_weight = round($weight, 1);
        break;
        case $weight >= 100:
            $total_weight = round($weight, 0);
        break;
    }
        
    $portion_weight = $weight / $portion;
    switch (true){
        case $portion_weight < 100:
            $portion_weight = round($portion_weight, 1);
        break;
        case $portion_weight >= 100:
            $portion_weight = round($portion_weight, 0);
        break;
    }
        
    echo "<div class='pi-group'>";
    echo    "<div class='pi-line'><p>Dane</p></div>";
    echo    "<div class='pi-data-icons'>";
        
    echo        "<div class='pi-data-item'>";
    echo            "<span class='pi-icon' title='Waga całkowita'>";
    echo                $weight_icon;
    echo                "<p class='pi-icon-txt'>".$total_weight." g</p>";
    echo            "</span>";
    echo            "<p class='pi-icon-title'>Całość</p>";
    echo        "</div>";
        
    echo        "<div class='pi-data-item'>";
    echo            "<span class='pi-icon' title='Waga porcji'>";
    echo                $portion_weight_icon;
    echo                "<p class='pi-icon-txt'>".$portion_weight." g</p>";
    echo            "</span>";
    echo            "<p class='pi-icon-title'>Porcja</p>";
    echo        "</div>";
        
    echo        "<div class='pi-data-item'>";
    echo            "<span class='pi-icon' title='Ilość porcji'>";
    echo                $portion_number_icon;
    echo                "<p class='pi-icon-txt'>".$portion."</p>";
    echo            "</span>";
    echo            "<p class='pi-icon-title'>Ilość</p>";
    echo        "</div>";

    echo    "</div>";
    echo "</div>";
        
    if (!empty($shelf_life)){
        echo "<div class='pi-group'>";
        echo    "<div class='pi-line'><p>Termin</p></div>";
        echo    "<p>".$shelf_life."</p>";
        echo "</div>";
    }

    if (!empty($info)){
        echo "<div class='pi-group'>";
        echo    "<div class='pi-line'><p>Info</p></div>";
        echo    "<p>".$info."</p>";
        echo "</div>";
    }
    ?>            
</div>

<div class="tags">
    <div class='pi-line'>
        <p>Sklepy</p>
    </div>
    <?php
        $shops_array = array_map('trim', explode(',', $shop_list));

        foreach($shops_array as $shop){
            echo "<p class='tag'>".$shop."</p>";
        }
    ?>
</div>

<div class="tags">
    <div class='pi-line'>
        <p>Tagi</p>
    </div>
    <?php
        $tags_array = array_map('trim', explode(',', $tags));
        $output = [];
        $regex = '/[^A-Za-z0-9\s\-\(\)\"\'\:\.\!\$\*\+\&\%\_\@\#]/';

        foreach ($tags_array as $array_tag){
            if (preg_match($regex, $array_tag)) {
                continue;
            }
            $tags_array_cleaned[] = $array_tag;
        }

        foreach($tags_array_cleaned as $tag){
            echo "<p class='tag'>".$tag."</p>";
        }
    ?>
</div>



<script>

    /* Disable closing on swipe */
    
// Prevent from closing the details div when swiping over the tables && window <= 540
function prevCloseEvent(){
    const nutritionTables = document.querySelector(".nutrition-tables");

    if (window.innerWidth <= 540){
        nutritionTables.ontouchstart = function(e){
            e.stopPropagation();
        }
    } else {
        nutritionTables.ontouchstart = null;
    }
}
    
prevCloseEvent();
window.addEventListener("resize", prevCloseEvent);
    
    /* Copy link */

$(document).ready(function(){
    // Copy this (string - link with the product ID)
    let copyContent = "<a href=\"../product-list.php\" id=\"<?php echo $id; ?>\" class=\"prod-link\"></a>";
    
    // The rest of the variables
    let copyLink = $(".prod-link-btn");
    let linkIcon = "<?php echo $link_icon; ?>";
    let checkmarkIcon = "<?php echo $checkmark_icon; ?>";

    function copyIcon() {
        copyLink.html(linkIcon);
    }

    copyLink.on("click", function(){
        // Create a temporary input
        let temp = $("<input>");
        $("body").append(temp);
        
        // Copy
        temp.val(copyContent).select();
        document.execCommand("copy");
        
        temp.remove();
        copyLink.html(checkmarkIcon);
        setTimeout(function(){ 
            copyIcon();
        }, 1000);
    });
    
});
    
    /* Nutrition table */

// Remove the value from the input on click
$(".nt-input").on('click', function(){
    $(this).val("");
});

    // Add "g" (grams) at the end of the input value
    
$(".nt-input").on('input', function(){
    let input = $(this).val();
    input = input.replace(/[^0-9.]/g, '').trim();
    $(this).val(input + " g");
});
    
$(".nt-input").on('keydown', function(e) {
    if (e.keyCode == 8) {
        let input = $(this).val();
        input = input.replace(/[^0-9.]/g, '').trim();
        input = input.substring(0, input.length - 1);
        $(this).val(input + " g");
    }
});

// Calculate nutrition values
$(".nt-input").on('input', function(){
    let ntinput = parseFloat($(".nt-input").val());
    $(".nt-weight").text(ntinput + " g");

    // Nutrition table
    let ntkcal100 = parseFloat($(".nt-kcal100").text());
    let ntfat100 = parseFloat($(".nt-fat100").text());
    let ntcarbs100 = parseFloat($(".nt-carbs100").text());
    let ntfiber100 = parseFloat($(".nt-fiber100").text());
    let ntprotein100 = parseFloat($(".nt-protein100").text());

    let ntkcal = Math.round((ntinput * ntkcal100 / 100) * 1) / 1;
    let ntfat = Math.round((ntinput * ntfat100 / 100) * 10) / 10;
    let ntcarbs = Math.round((ntinput * ntcarbs100 / 100) * 10) / 10;
    let ntfiber = Math.round((ntinput * ntfiber100 / 100) * 10) / 10;
    let ntprotein = Math.round((ntinput * ntprotein100 / 100) * 10) / 10;

    $(".nt-kcal").text(ntkcal + " kcal");
    $(".nt-fat").text(ntfat + " g");
    $(".nt-carbs").text(ntcarbs + " g");
    $(".nt-fiber").text(ntfiber + " g");
    $(".nt-protein").text(ntprotein + " g");

    // Diabetes table
    let ntcp100 = parseFloat($(".nt-cp100").text());
    let ntwpts100 = parseFloat($(".nt-wpts100").text());

    let ntcp = Math.round((ntinput * ntcp100 / 100) * 10) / 10;
    let ntwpts = Math.round((ntinput * ntwpts100 / 100) * 10) / 10;

    $(".nt-cp").text(ntcp + " WW");
    $(".nt-wpts").text(ntwpts + " WBT");

    // Prevent NaN output - change to "0 g"
    if (document.querySelector(".nt-input").value == " g"){
        $(".nt-weight").text("0 g");
        $(".nt-kcal").text("0 kcal");
        $(".nt-fat").text("0 g");
        $(".nt-carbs").text( "0 g");
        $(".nt-fiber").text("0 g");
        $(".nt-protein").text("0 g");
        $(".nt-cp").text("0 WW");
        $(".nt-wpts").text("0 WBT");
    }
});
    
    // Search the clicked tag
    
$(function(){ 
    $('.tag').on('click', function(e){
        let tag = $(this).text();
        let searchBar = $(".search-bar");

        searchBar.val(tag);
        $(".result_number").val(10);
        
        // Scroll to the header
        $('html').animate({
            scrollTop: $(".main-module-header h3").offset().top - 50
        }, 250);
                
        // Hide the details div 
        scContainer.removeClass(scOpen);
        
        // Send the form
        successFunc = function(response){
            $(".recipe-list").html(response);
            switchTypes();
        }

        displayResults(e);
    });
});
</script>

<?php
    }

mysqli_close($con);

?>

