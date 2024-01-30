<?php
function topContent(){
    global $rc_id;
    
    $con = mysqli_connect("localhost", "root", "", "cookbook");
    $sql = "SELECT * FROM recipes
        WHERE recipes.id = '$rc_id' ";
    
    $res = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($res)){
        $name = $row['name'];
        $description = $row['description'];
        $tags = $row['tags'];
    }
?>
<!doctype html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title><?php echo $name; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $tags; ?>">
        <meta name="author" content="Uverit">
        <link rel="preload" href="../Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../Styles/general.css">
        <link rel="stylesheet" type="text/css" href="../Styles/recipe.css">
        
        <!-- Scripts -->
        <script src="../Scripts/jquery-3.6.0.min.js"></script>
        <script src="../Scripts/ScriptPack-min.js" defer></script>
        <script src="../Scripts/jquery.cookie-1.4.1.min.js"></script>
        <script src="../Scripts/navigation.js"></script>
    </head>
        
    <body>
        
        <div id="hidden-contents" class="pdfNoPrint"> 
            
    <!-- SCROLLTOP -->
            <div id="scrolltop" onclick="scrollToTop()">
                <div class="scrollarrow"></div>
            </div>
    <!-- /SCROLLTOP -->
        
        </div>
        
        <nav>

    <!-- NAVBAR -->
            <div id="nav2">
            <div class="nav-help">
                <a href="../index.php" id="nav-logo">
                    <img src="../Images/uverit-w.svg" alt="Business logo" id="nav-logo-img" oncontextmenu="window.event.returnValue=false;">
                </a>

                <div class="nav-elements">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <script>
                                backNav();
                            </script>
                        </div>
                    </div>

                    <div class="dark-mode-div">
                        <input type="checkbox" class="dm-btn" id="dmtoggle">
                        <label for="dmtoggle" class="dm-label"></label>
                    </div>

                    <div class="burger-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            </div>
    <!-- /NAVBAR -->
            
        </nav>
        
    <!-- BANNER-PARALLAX -->
        <header class="banner pdfNoPrint">
            <div class="parallax-banner"></div>
            <div class="parallax-help"></div>
            <div class="wrapper">
                <div class="banner-text">
                    <h1>Uverit Cookbook</h1>
                    <h3><?php echo $name; ?></h3>
                </div>
            </div>
        </header>
    <!-- /BANNER-PARALLAX -->
        
    <!-- BACKGROUND -->
        <div class="main-bg-grad" id="main-bg-grad"></div>
        <div class="main-background"></div>
    <!-- /BACKGROUND -->
        
        <main>

    <!-- MAIN-MODULE -->
            <div class="wrapper">
            <div class="space"></div>
<?php
    mysqli_close($con);
}
?>



<?php
function getContent(){
    global $rc_id, $date_svg, $mod_date_svg;
    
    $con = mysqli_connect("localhost", "root", "", "cookbook");
    $sql = "SELECT * FROM recipes
        LEFT JOIN ingredients ON recipes.id = ingredients.id 
        LEFT JOIN recipe_steps ON ingredients.id = recipe_steps.id 
        LEFT JOIN calc ON recipe_steps.id = calc.id
        LEFT JOIN calc_sub ON calc.id = calc_sub.id
        WHERE recipes.id = '$rc_id' ";
    
    $res = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($res)){
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $type = $row['type'];
        $difficulty = $row['difficulty'];
        $date = $row['date'];
        $mod_date = $row['last_mod_date'];

        $fat = $row['fat'];
        $kcal = $row['kcal'];
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
        
        // If the image doesn't exist in the folder, replace it with a placeholder
        $image = $row['image'];
        if (!file_exists("../Recipe_img/".$image)) {
            $image = "../Images/no-img.svg";
        } else {
            $image = "../Recipe_img/".$row['image'];
        }
        
        for ($x = 1; $x <= 24; $x++) {
            $ing_weight["ing_weight".$x] = $row["ing_weight".$x];
            $ingredient["ingredient".$x] = $row["ingredient".$x];
            $recipe["recipe".$x] = $row["recipe".$x];
        }
        extract($ing_weight);
        extract($ingredient);
        extract($recipe);
        
        for ($x = 1; $x <= 24; $x++) {
            $weight_calc["weight_calc".$x] = $row["weight-calc".$x];
            $name_calc["name_calc".$x] = $row["name-calc".$x];
            $kcal_calc["kcal_calc".$x] = $row["kcal-calc".$x];
            $fat_calc["fat_calc".$x] = $row["fat-calc".$x];
            $carb_calc["carb_calc".$x] = $row["carb-calc".$x];
            $fiber_calc["fiber_calc".$x] = $row["fiber-calc".$x];
            $protein_calc["protein_calc".$x] = $row["protein-calc".$x];
        }
        extract($weight_calc);
        extract($name_calc);
        extract($fat_calc);
        extract($kcal_calc);
        extract($carb_calc);
        extract($fiber_calc);
        extract($protein_calc);
        
        for ($x = 1; $x <= 6; $x++) {
            $weight_calc_sub["weight_calc_sub".$x] = $row["weight-calc-sub".$x];
            $name_calc_sub["name_calc_sub".$x] = $row["name-calc-sub".$x];
        }
        extract($weight_calc_sub);
        extract($name_calc_sub);

        $cp = $carbohydrates / 10; // Carbohydrate portion = 10g
        $wpts = ($fat * 9 + $protein * 4) / 100; // Warsaw Pump Therapy School = (fat kcal + protein kcal) / 100
?>
            
<div class="main-module">
    <div class="main-module-content">

        <div class="recipe-header">
            <div class="rh-left">
                <h3><?php echo $name ?></h3>
                <h5><?php echo $description ?></h5>
            </div>
            <div class="rh-right">
                <div class='diff-stars'>
                <?php       
$star = "<svg id='Capa_1' data-name='Capa 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 487.2 465.2'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M251.7,14.6,317,147.2a8.9,8.9,0,0,0,6.8,4.9l146.3,21.3a8.9,8.9,0,0,1,5,15.2L369.2,291.9a9.3,9.3,0,0,0-2.6,7.9l25,145.8a8.9,8.9,0,0,1-12.9,9.4L247.8,386.1a9.3,9.3,0,0,0-8.3,0L108.5,455a9,9,0,0,1-13-9.4l25.1-145.8a9.3,9.3,0,0,0-2.6-7.9L12.1,188.6a8.9,8.9,0,0,1,5-15.2l146.3-21.3a8.9,8.9,0,0,0,6.8-4.9L235.6,14.6A9,9,0,0,1,251.7,14.6Z'/></svg>";
        
$weight_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M79.3,25.2V23.8A20.7,20.7,0,1,1,83.2,36'/><path class='cls-1' d='M52.8,197H181.6c13.6,0,16.7-4.5,14.9-15.7l-20.7-113a30.3,30.3,0,0,0-29.6-23.7H53.8A30.3,30.3,0,0,0,24.2,68.3L3.5,181.3C1.7,192.5,4.8,197,18.4,197h94'/><path class='cls-1' d='M28.8,122.3l-4.6,24.9c-1.5,9.1,4.4,17.6,12.3,17.6h127c7.9,0,13.8-8.5,12.3-17.6l-10-53.8c-2-10.6-10.3-16.7-19.9-16.7H54.1c-9.6,0-17.9,6.1-19.9,16.7l-1.4,7.3'/><line class='cls-1' x1='30.8' y1='111.6' x2='30.8' y2='111.8'/><path class='cls-1' d='M153.8,59.2a24.6,24.6,0,0,0-11.6-3.5'/><path class='cls-1' d='M164.6,71.9a24.9,24.9,0,0,0-3.3-6'/><line class='cls-1' x1='43.8' y1='186.2' x2='43.9' y2='186.2'/><path class='cls-1' d='M16.8,179.2c.8,5,4.5,7,13.1,7h4'/></svg>";
        
$portion_weight_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-3{fill:none;}.cls-2{stroke-linecap:round;}.cls-1{stroke-linejoin:round;}.cls-3{stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M173,161.9a9.2,9.2,0,0,0,9.2-9.2V122.3A82.4,82.4,0,0,0,99.8,39.8h.4a82.4,82.4,0,0,0-82.4,82.5v30.4a9.2,9.2,0,0,0,9.2,9.2Z'/><path class='cls-2' d='M81.9,19.8a18.4,18.4,0,1,1,18.3,20,18.2,18.2,0,0,1-14.6-7.3'/><rect class='cls-3' x='3.1' y='174.1' width='193.9' height='22.86' rx='11.3'/><path class='cls-1' d='M149.7,77.2c1.6,1.9,3.2,3.9,4.6,5.9'/><path class='cls-1' d='M89.6,55.7a63.8,63.8,0,0,1,10.8-.9H100a65.9,65.9,0,0,1,38.8,12.6'/><line class='cls-1' x1='54.5' y1='185.5' x2='59.5' y2='185.5'/><line class='cls-1' x1='15.3' y1='185.5' x2='40.5' y2='185.5'/></svg>";
        
$portion_number_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-4{fill:none;}.cls-2{stroke-miterlimit:10;}.cls-4{stroke-linecap:round;}.cls-4{stroke-linejoin:round;}</style></defs><circle class='cls-1' cx='100' cy='118.9' r='79.3'/><path class='cls-2' d='M43.4,145.1a62,62,0,0,1-5.8-26.2,61.1,61.1,0,0,1,.6-8.6'/><path class='cls-2' d='M56.9,163.9a22.8,22.8,0,0,1-2.2-2.2'/><path class='cls-2' d='M133.6,171.4a62.2,62.2,0,0,1-33.6,9.9,61.4,61.4,0,0,1-33.9-10.1'/><path class='cls-2' d='M161.8,110.2a62.5,62.5,0,0,1-14.7,49.6'/><path class='icon-mod' d='M103.3,45l-8.7,8.7a8.9,8.9,0,0,1-6.8,2.9,23.1,23.1,0,0,0-17.6,7.1L28.4,105.5,11.2,122.7a4.9,4.9,0,0,1-3.4,1.4,4.7,4.7,0,0,1-3.3-1.4,4.7,4.7,0,0,1,0-6.7L21.7,98.7,63.5,56.9a23.6,23.6,0,0,0,7.1-17.5,9,9,0,0,1,2.9-6.9l8.6-8.6A7.5,7.5,0,0,0,92.7,34.5a7.4,7.4,0,0,0,0,10.5A7.5,7.5,0,0,0,103.3,45Z'/><path class='cls-4' d='M103,3.1,96.7,9.4,82.1,23.9l-8.6,8.6a9,9,0,0,0-2.9,6.9,23.6,23.6,0,0,1-7.1,17.5L21.7,98.7,4.5,116a4.7,4.7,0,0,0,0,6.7,4.7,4.7,0,0,0,3.3,1.4,4.9,4.9,0,0,0,3.4-1.4l17.2-17.2L70.2,63.7a23.1,23.1,0,0,1,17.6-7.1,8.9,8.9,0,0,0,6.8-2.9l8.7-8.7,9.2-9.2'/><polyline class='cls-4' points='112.5 35.8 117.8 30.5 124.1 24.2'/><path class='cls-4' d='M92.7,34.5A7.5,7.5,0,0,1,82.1,23.9'/><path class='cls-4' d='M103.3,45a7.5,7.5,0,0,1-10.6,0,7.4,7.4,0,0,1,0-10.5l20.8-20.9'/><path class='icon-mod' d='M169.1,89.5,125.7,46.2l-9.9-10L83.1,3.5a1.3,1.3,0,0,0-2.3.6l-.2,1.3c-2.3,15.2,3.1,31.1,14.5,42.4l3.8,3.8,7.9,7.9a23.7,23.7,0,0,0,17.4,7.1h5.6a7.7,7.7,0,0,1,5.1,2.1L162.3,96l26.4,26.5a4.9,4.9,0,0,0,6.9.2h0a4.9,4.9,0,0,0-.2-6.9L169,89.4'/></svg>";
        
$active_time_svg = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-2{stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='time-icon-mod' d='M154.3,130.4h0a24.2,24.2,0,0,1-24-24V97.8a24,24,0,0,1,24-23.9h0a23.9,23.9,0,0,1,24,23.8h0v8.6a23.9,23.9,0,0,1-23.8,24Z'/><path class='time-icon-mod' d='M167.8,133.7a28.7,28.7,0,0,1-27,0,38,38,0,0,0-32.2,37.4v24.8a4.4,4.4,0,0,0,4.2,4.2h83.1a4.2,4.2,0,0,0,4.1-4.2V171.1A38,38,0,0,0,167.8,133.7Z'/><path class='cls-2' d='M90.2,195.5a96.1,96.1,0,1,1,102.2-69.8'/><path class='cls-2' d='M98.9,45.9V99.8a1.1,1.1,0,0,0,.6.9l17.4,8.7'/></svg>";

$passive_time_svg = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M100,196A96,96,0,1,1,184.7,54.7'/><path class='cls-1' d='M98.9,45.9V99.8a1.1,1.1,0,0,0,.6.9l17.4,8.7'/><path class='time-icon-mod' d='M173.8,133.3l1.5-1.4c9.1-7.7,20.3-17.5,21.4-41.6a4,4,0,0,0,3.3-3.9V77.7a3.9,3.9,0,0,0-3.9-3.9H122.8a3.9,3.9,0,0,0-3.9,3.9v8.7a4,4,0,0,0,3.3,3.9c1,24.1,12.3,33.7,21.4,41.6l1.5,1.4a2.6,2.6,0,0,1,.9.9,4.6,4.6,0,0,1-.9,6.6h0l-1.5,1.3c-9.1,7.8-20.3,17.4-21.4,41.4a4,4,0,0,0-3.3,3.9v8.7a3.9,3.9,0,0,0,3.9,3.9h73.3a3.9,3.9,0,0,0,3.9-3.9v-8.7a4,4,0,0,0-3.3-3.9c-1.1-24-12.4-33.6-21.4-41.4l-1.5-1.3-.9-.9a4.7,4.7,0,0,1,.9-6.6Zm-7.8-8.9a10.4,10.4,0,0,0-2.1,2.1,16.6,16.6,0,0,0,2,23.4h0l1.6,1.4c8,6.9,15.6,13.4,17.1,30.3H134c1.5-16.9,9.1-23.4,17.1-30.3l1.6-1.4,2.2-2.2a16.6,16.6,0,0,0-2.2-23.4l-1.6-1.4c-8-6.9-15.6-13.5-17.1-30.4h50.6c-1.5,16.9-9.1,23.5-17.1,30.4Z'/></svg>";

$total_time_svg = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M195.9,100.5a95.8,95.8,0,0,1-62,89.3'/><path class='cls-1' d='M77.6,193.3A96,96,0,0,1,100,4a95.2,95.2,0,0,1,79.4,41.9'/><path class='cls-1' d='M98.9,45.9V99.8a1.1,1.1,0,0,0,.6.9l17.4,8.7'/><path class='time-icon-mod' d='M198.6,67h0a9.6,9.6,0,0,0-13.1-3.5.1.1,0,0,1-.1.1,13.8,13.8,0,0,0-2.6,2.2L112.2,153a4.1,4.1,0,0,1-5.8.6h0a3.4,3.4,0,0,1-.8-.9l-17-24.2a15.3,15.3,0,0,0-21.3-3.7,18.6,18.6,0,0,0-2.9,2.7h0a15.5,15.5,0,0,0-.8,18.6l34.7,49.5a10.6,10.6,0,0,0,14.7,2.6,10.7,10.7,0,0,0,2.6-2.6l9.9-14.3L198.2,77.4A9.4,9.4,0,0,0,198.6,67Z'/></svg>";

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
                ?> 
                </div>
                <div class="date">
                <?php
                    echo "<div class='date-inner'>";
                        echo $date_svg;
                        echo "<p>";
                            echo $date;
                        echo "</p>";
                    echo "</div>";
                ?>
                <?php
                    if (!empty($mod_date)) {
                        echo "<div class='date-inner'>";
                            echo $mod_date_svg;
                            echo "<p>";
                                echo $mod_date;
                            echo "</p>";
                        echo "</div>";
                    }
                ?>
                </div>
            </div>
        </div>

        <img src="<?php echo $image ?>" alt="Food Image" class="recipe-image">

        <div class="under-image pdfNoPrint">
            <div>
                <div class="type">
                    <p>TYP</p>
                    <p>
                        <?php
                        switch ($type) {
                            case "dishes":
                                echo "Dania";
                            break;
                            case "desserts":
                                echo "Desery";
                            break;
                            case "snacks":
                                echo "Przekąski";
                            break;                               
                            case "other":
                                echo "Inne";
                            break;
                        }
                        ?>
                    </p>
                </div>
            </div>

            <div class="under-image-border">
                <div class="ui-border-fill"></div>
            </div>

            <div class="time">
                <div class="time-child" title='Mieszanie, krojenie składników, itp.'>
                    <p>CZAS AKTYWNY</p>
                    <?php
                    $hours = floor($active_time / 60);
                    $min = $active_time - ($hours * 60);
                    if ($hours != 0 && $min != 0){
                        echo "<p>".$hours." h ".$min." min</p>";
                    }
                    if ($hours != 0 && $min == 0){
                        echo "<p>".$hours." h</p>";
                    } 
                    if ($hours == 0 && $min != 0){
                        echo "<p>".$min." min</p>";
                    }
                    ?>
                </div>
                <div class="time-child" title='Łączny czas wszystkich czynności (krojenie składników, rośnięcie ciasta, itp.)'>
                    <p>CZAS CAŁKOWITY</p>
                    <?php
                    $total_time = $active_time + $passive_time; 
                    $hours = floor($total_time / 60);
                    $min = $total_time - ($hours * 60);
                    if ($hours != 0 && $min != 0){
                        echo "<p>".$hours." h ".$min." min</p>";
                    }
                    if ($hours != 0 && $min == 0){
                        echo "<p>".$hours." h</p>";
                    } 
                    if ($hours == 0 && $min != 0){
                        echo "<p>".$min." min</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="under-image-border">
                <div class="ui-border-fill"></div>
            </div>

            <div>
                <div class="multiply">
                    <div class="portion-display">
                        <p>PORCJE</p>
                    </div>
                    <select class="multiply_ing">
                        <option value="0.5">0.5x</option>
                        <option value="1" selected>1x</option>
                        <option value="1.5">1.5x</option>
                        <option value="2">2x</option>
                        <option value="2.5">2.5x</option>
                        <option value="3">3x</option>
                        <option value="4">4x</option>
                        <option value="5">5x</option>
                        <option value="6">6x</option>
                        <option value="8">8x</option>
                        <option value="10">10x</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="recipe-content">
        <div class="ingredients">
            <?php
            for ($x = 1; $x <= 24; $x++){
                $weight_calcx = $weight_calc["weight_calc".$x];
                $name_calcx = $name_calc["name_calc".$x];
                if (!empty($weight_calcx) && !empty($name_calcx)){
            ?>
            
            <div class="calc-btn pdfNoPrint">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
                
            <div class="ing-calc pdfNoPrint">
            <div class="ing-calc-inner">
                <table>
                    <tr>
                        <th class="calc-btn-th">
                            <div class="calc-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </th>
                        <th>Waga</th>
                        <th>Nazwa</th>
                        <th title='Kcal / 100g'>Kalorie</th>
                        <th title='W gramach / 100g'>Tłuszcz</th>
                        <th title='W gramach / 100g'>Węgle</th>
                        <th title='W gramach / 100g'>Błonnik</th>
                        <th title='W gramach / 100g'>Białko</th>
                    </tr>
                <?php
                for ($x = 1; $x <= 24; $x++){
                    $weight_calcx = $weight_calc["weight_calc".$x];
                    $name_calcx = $name_calc["name_calc".$x];
                    $kcal_calcx = $kcal_calc["kcal_calc".$x];
                    $fat_calcx = $fat_calc["fat_calc".$x];
                    $carb_calcx = $carb_calc["carb_calc".$x];
                    $fiber_calcx = $fiber_calc["fiber_calc".$x];
                    $protein_calcx = $protein_calc["protein_calc".$x];
                    
                    if (empty($kcal_calcx)){
                        $kcal_calcx = 0;
                    }                    
                    if (empty($fat_calcx)){
                        $fat_calcx = 0;
                    }                    
                    if (empty($carb_calcx)){
                        $carb_calcx = 0;
                    }                    
                    if (empty($fiber_calcx)){
                        $fiber_calcx = 0;
                    }
                    if (empty($protein_calcx)){
                        $protein_calcx = 0;
                    }
                    if (!empty($weight_calcx) && !empty($name_calcx)){
                        echo "<tr>";
                            echo "<td>".$x.".</td>";
                            echo "<td class='ctd-weight' data-val='$weight_calcx'></td>";
                            echo "<td>".$name_calcx."</td>";
                            echo "<td class='ctd-kcal' data-val='$kcal_calcx'></td>";
                            echo "<td class='ctd' data-val='$fat_calcx'></td>";
                            echo "<td class='ctd' data-val='$carb_calcx'></td>";
                            echo "<td class='ctd' data-val='$fiber_calcx'></td>";
                            echo "<td class='ctd' data-val='$protein_calcx'></td>";
                        echo "</tr>";
                    }
                }
                ?>
                </table>
            </div>
            </div>
                
            <?php
                }
            }
            ?>
            <div class="ingredients-inner">

            <div class="ing-only">
                <h4 class="ing-title">Składniki</h4>
                <?php 
                for ($x = 1; $x <= 24; $x++){

                    $ing_weightx = $ing_weight['ing_weight'.$x];
                    $ingredientx = $ingredient['ingredient'.$x];


                    if (!empty($ing_weightx) && !empty($ingredientx)){
                        echo "<div class='ingredient'>";

                        echo "<input type='checkbox' class='ing_check' name='check".$x."'>";

                        echo "<div class='wght_div'>";
                        echo "<p class='ing_wght' data-val='$ing_weightx'></p>";

                        echo "<div class='wght_portion'>";
                        echo "<p>1 porcja</p>";
                        if($ing_weightx / $portion <= 50){
                            echo "<p>".round($ing_weightx / $portion, 1)."</p>";

                        } else {
                            echo "<p>".round($ing_weightx / $portion, 0)."</p>";
                        }
                        echo "</div>";

                        echo "</div>";

                        echo "<table><tr><td>";
                        echo "<ing class='ing_text'>";
                        echo $ingredientx;
                        echo "</ing>";
                        echo "</table></tr></td>";

                        echo "</div>";
                    }
                }
                ?>
            </div>

            <?php
            if (!empty($weight_calc_sub1) && !empty($name_calc_sub1)){
            ?>

            <div class="ing-sub">
                <div class="ing-sub-expand">
                    <img src="../Images/list-arrow-b.svg" class="ing-arrow ing-arrow1" alt="left arrow expand">
                    <p>Straty</p>
                    <img src="../Images/list-arrow-b.svg" class="ing-arrow ing-arrow2" alt="right arrow expand">
                </div>
                <div class="ing-sub-content">
                <?php 
                for ($x = 1; $x <= 6; $x++){
                    $ingsub_wghtx = $weight_calc_sub['weight_calc_sub'.$x];
                    $ingsub_name_dbx = $name_calc_sub['name_calc_sub'.$x];

                    if (is_numeric($ingsub_name_dbx)){
                        $ingsub_namex = $ingredient['ingredient'.$ingsub_name_dbx];
                    }

                    if (!empty($ingsub_wghtx) &&
                        !empty($ingsub_name_dbx) &&
                        is_numeric($ingsub_name_dbx)){
                        echo "<div class='ingredient-sub'>";

                        echo "<div class='ing-sub-line'>";
                        echo "<span></span>";
                        echo "</div>";

                        echo "<div class='wght_div'>";

                        echo "<p data-val='".$ingsub_wghtx."' class='ing_wght'></p>";

                        echo "<div class='wght_portion'>";
                        echo "<p>1 porcja</p>";
                        if($ingsub_wghtx / $portion <= 50){
                            echo "<p>".round($ingsub_wghtx / $portion, 1)."</p>";

                        } else {
                            echo "<p>".round($ingsub_wghtx / $portion, 0)."</p>";
                        }
                        echo "</div>";

                        echo "</div>";

                        echo "<table><tr><td>";
                        echo "<ing class='ing_text'>";
                        echo $ingsub_namex;
                        echo "</ing>";
                        echo "</table></tr></td>";

                        echo "</div>";
                    }
                }
                ?>
                </div>
            </div>

            <?php
            }
            ?>
            </div>
        </div>

        <div class="recipe">
            <h3 class="recipe-title">Przygotowanie</h3>
            <ol class="recipe-list">
                <?php 
                for ($x = 1; $x <= 24; $x++) {

                    $recipex = $recipe['recipe'.$x];

                    if (!empty($recipex)){
                        echo "<li>";

                        echo    "<div class='recipe-step'>";
                        echo        "<p class='recipe-step-txt'>KROK ".$x."</p>";
                        echo        "<div class='recipe-step-line'></div>";
                        echo    "</div>";
                        echo    "<p class='recipe-txt'>".$recipex."</p>";

                        echo "</li>";
                    }
                }
                ?>
            </ol>
        </div>
        </div>

        <div class="bottom-info">
            <div class="bi-left">

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
                                        <input type='tel' class='nt-input' size='8' value='Por. ".round($weight / $portion, 1)." g'>";
                            echo    "</th>";
                            echo "</tr>";



                            echo "<tr class='nt-row'>";
                            echo    "<td class='nt-content'><p>";
                            echo        "Wartość energetyczna";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-kcal' data-val='$kcal'></p>";
                            echo    "</td>"; 

                            echo    "<td class='nt-content ntc'><p class='nt-kcal100'>";
                            echo        round($kcal / $weight * 100, 0)." kcal";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'><p class='nt-kcal'>";
                            echo        round($kcal / $portion, 0)." kcal";
                            echo    "</p></td>";
                            echo "</tr>";



                            echo "<tr class='nt-row'>";
                            echo    "<td class='nt-content'><p>";
                            echo        "Tłuszcz";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-all' data-val='$fat'></p>";
                            echo    "</td>"; 

                            echo    "<td class='nt-content ntc'><p class='nt-fat100'>";
                            echo        round($fat / $weight * 100, 1)." g";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'><p class='nt-fat'>";
                            echo        round($fat / $portion, 1)." g";
                            echo    "</p></td>";
                            echo "</tr>";



                            echo "<tr class='nt-row'>";
                            echo    "<td class='nt-content'><p>";
                            echo        "Węglowodany (netto)";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-all' data-val='$carbohydrates'></p>";
                            echo    "</td>";

                            echo    "<td class='nt-content ntc'><p class='nt-carbs100'>";
                            echo        round($carbohydrates / $weight * 100, 1)." g";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'><p class='nt-carbs'>";
                            echo        round($carbohydrates / $portion, 1)." g";
                            echo    "</p></td>";
                            echo "</tr>";



                            echo "<tr class='nt-row'>";
                            echo    "<td class='nt-content'><p>";
                            echo        "Błonnik";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-all' data-val='$fiber'></p>";
                            echo    "</td>";

                            echo    "<td class='nt-content ntc'><p class='nt-fiber100'>";
                            echo        round($fiber / $weight * 100, 1)." g";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'><p class='nt-fiber'>";
                            echo        round($fiber / $portion, 1)." g";
                            echo    "</p></td>";
                            echo "</tr>";



                            echo "<tr class='nt-row'>";
                            echo    "<td class='nt-content'><p>";
                            echo        "Białko";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-all' data-val='$protein'></p>";
                            echo    "</td>";

                            echo    "<td class='nt-content ntc'><p class='nt-protein100'>";
                            echo        round($protein / $weight * 100, 1)." g";
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

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-cp' data-val='$cp'></p>";
                            echo    "</td>";

                            echo    "<td class='nt-content ntc'><p class='nt-cp100'>";
                            echo        round($cp / $weight * 100, 1)." WW";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'><p class='nt-cp'>";
                            echo        round($cp / $portion, 1)." WW";
                            echo    "</p></td>";
                            echo "</tr>";



                            echo "<tr class='nt-row'>";
                            echo    "<td class='nt-content'><p>";
                            echo        "Białkowo-tłuszczowe";
                            echo    "</p></td>";

                            echo    "<td class='nt-content ntc'>";
                            echo        "<p class='nt-multi-wpts' data-val='$wpts'></p>";
                            echo    "</td>";

                            echo    "<td class='nt-content ntc'><p class='nt-wpts100'>";
                            echo        round($wpts / $weight * 100, 1)." WBT";
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

                        require('../Php/calc-ratio.php');
                    ?>

                        <div class='ri-line'>
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

                        <div class='ri-line'>
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

            <div class="bi-right">
                <div class="recipe-info">
                    <h4>Informacje</h4>

<?php
echo "<div class='ri-group'>";
echo "<div class='ri-line'><p>Przepis</p></div>";

    require('svg.php');

    switch ($type){
        case "dishes":
            $type_icon = $type_dishes;
            $type_title = "Dania";
            break;
        case "desserts":
            $type_icon = $type_desserts;
            $type_title = "Desery";
            break;
        case "snacks":
            $type_icon = $type_snacks;
            $type_title = "Przekąski";
            break;                              
        case "other":
            $type_icon = $type_other;
            $type_title = "Inne";
            break;
    }
    
    switch ($difficulty){
        case "hard":
            $diff_txt = "Trudny";
            $diff_stars = "<span class='star-full'>".$star."</span>";
            $diff_stars .= "<span class='star-full'>".$star."</span>";
            $diff_stars .= "<span class='star-full'>".$star."</span>";
            break;
        case "moderate":
            $diff_txt = "Średni";
            $diff_stars = "<span class='star-full'>".$star."</span>";
            $diff_stars .= "<span class='star-full'>".$star."</span>";
            $diff_stars .= "<span>".$star."</span>";
            break;
        case "easy":
            $diff_txt = "Łatwy";
            $diff_stars = "<span class='star-full'>".$star."</span>";
            $diff_stars .= "<span>".$star."</span>";
            $diff_stars .= "<span>".$star."</span>";
            break;
    }
        
    echo "<div class='top-info'>";
    echo    "<div class='type-icon-div'>";
    echo        "<div class='recipe-type-icon'>";
    echo            $type_icon;
    echo        "</div>";
    echo        "<p class='pi-icon-title'>".$type_title."</p>";
    echo    "</div>";
        
    echo    "<div class='info-diff'>";
    echo        "<div class='info-diff-stars'>".$diff_stars."</div>";  
    echo        "<p class='pi-icon-title'>".$diff_txt."</p>";
    echo    "</div>";
    echo "</div>";

echo "</div>";

$portion_weight = $weight / $portion;

echo "<div class='ri-group'>";
echo    "<div class='ri-line'><p>Dane</p></div>";
echo    "<div class='pi-data-icons'>";

echo        "<div class='pi-data-item'>";
echo            "<span class='pi-icon' title='Waga całkowita'>";
echo                $weight_icon;
echo                "<p class='pi-icon-txt weight' data-val='$weight'></p>";
echo            "</span>";
echo            "<p class='pi-icon-title'>Całość</p>";
echo        "</div>";

echo        "<div class='pi-data-item'>";
echo            "<span class='pi-icon' title='Waga porcji'>";
echo                $portion_weight_icon;
echo                "<p class='pi-icon-txt portion-weight' data-val='$portion_weight'></p>";
echo            "</span>";
echo            "<p class='pi-icon-title'>Porcja</p>";
echo        "</div>";

echo        "<div class='pi-data-item'>";
echo            "<span class='pi-icon' title='Ilość porcji'>";
echo                $portion_number_icon;
echo                "<p class='pi-icon-txt portion' data-val='$portion'></p>";
echo            "</span>";
echo            "<p class='pi-icon-title'>Ilość</p>";
echo        "</div>";

echo    "</div>";
echo "</div>";

echo "<div class='ri-group'>";
echo "<div class='ri-line'><p>Czas</p></div>";
echo    "<div class='pi-data-icons'>";

    // Active Time

$hours = floor($active_time / 60);
$min = $active_time - ($hours * 60);
switch (true){
    case $hours != 0 && $min != 0:
        $time_content = $hours." h ".$min." min";
    break;
    case $hours != 0 && $min == 0:
        $time_content = $hours." h";
    break;
    case $hours == 0 && $min != 0:
        $time_content = $min." min";
    break;
    default:
        $time_content = "0";
}

echo        "<div class='pi-data-item'>";
echo            "<span class='time-icon' title='Czas aktywny - mieszanie, krojenie składników, itp.'>";
echo                $active_time_svg;
echo            "</span>";
echo            "<p class='pi-icon-title'>$time_content</p>";
echo        "</div>";

    // Passive Time

$hours = floor($passive_time / 60);
$min = $passive_time - ($hours * 60);
switch (true){
    case $hours != 0 && $min != 0:
        $time_content = $hours." h ".$min." min";
    break;
    case $hours != 0 && $min == 0:
        $time_content = $hours." h";
    break;
    case $hours == 0 && $min != 0:
        $time_content = $min." min";
    break;
    default:
        $time_content = "0";
}

echo        "<div class='pi-data-item'>";
echo            "<span class='time-icon' title='Czas pasywny - pieczenie w piekarniku, rośnięcie ciasta, itp.'>";
echo                $passive_time_svg;
echo            "</span>";
echo            "<p class='pi-icon-title'>$time_content</p>";
echo        "</div>";

    // Total Time

$total_time = $active_time + $passive_time; 
$hours = floor($total_time / 60);
$min = $total_time - ($hours * 60);
switch (true){
    case $hours != 0 && $min != 0:
        $time_content = $hours." h ".$min." min";
    break;
    case $hours != 0 && $min == 0:
        $time_content = $hours." h";
    break;
    case $hours == 0 && $min != 0:
        $time_content = $min." min";
    break;
    default:
        $time_content = "0";
}

echo        "<div class='pi-data-item'>";
echo            "<span class='time-icon' title='Czas całkowity - wszystkie czynności (krojenie składników, rośnięcie ciasta, itp.)'>";
echo                $total_time_svg;
echo            "</span>";
echo            "<p class='pi-icon-title'>$time_content</p>";
echo        "</div>";

echo    "</div>";

echo "</div>";

if (!empty($shelf_life)){
    echo "<div class='ri-group'>";
    echo    "<div class='ri-line'><p>Termin</p></div>";
    echo    "<p>".$shelf_life."</p>";
    echo "</div>";
}

if (!empty($info)){
    echo "<div class='ri-group'>";
    echo    "<div class='ri-line'><p>Info</p></div>";
    echo    "<p>".$info."</p>";
    echo "</div>";
}
?>            
                </div>  

                <div class="pdf-btn pdfNoPrint" id="pdf-btn">
                    <div class="pdf-btn-inner">
                        <img src="../Images/pdf-icon.svg" class="pdf-icon" alt="PDF icon">
                        <p>Zapisz przepis</p>
                    </div>

                    <div class="pdf-remove-img">
                        <img src="../Images/img-icon.svg" alt="Image Icon (remove image from the PDF)">
                    </div>
                </div>
            </div>

        </div>

        <div class="tags">
        <?php
            $tags_array = array_map('trim', explode(',', $tags));
            $output = [];
            $regex = '/[^A-Za-z0-9\s\-\(\)\"\'\:\.\!\$\*\+\&\%\_\@\#]/';

            foreach ($tags_array as $array_tag) {
                if (preg_match($regex, $array_tag)) {
                    continue;
                }
                $tags_array_cleaned[] = $array_tag;
            }
            foreach($tags_array_cleaned as $tag) {
                echo "<a href='../recipe-list.php' class='tag' tabindex='-1'>".$tag."</a>";
            }
        ?>
        </div>

    </div>
</div>

<?php
    mysqli_close($con);
    }
}
?>
    
    
    
<?php
function bottomContent(){
?>
            <div class="space"></div>    
        </div>
<!-- /MAIN-MODULE -->

    </main>

    <footer class='recipe-footer'>
        <!-- navigation.js -->
    </footer>

<script>

    // Multiply Recipe - Cookies (keeps selected value)

$(document).ready(function(e){
    var name = "multiply=";
    var ca = document.cookie.split(';');

    for(var i=0; i<ca.length; i++){
        var c = ca[i].trim();
        if (c.indexOf(name)==0){
            $('.multiply_ing').val(c.substring(name.length,c.length));
        }
    }
});

$('.multiply_ing').change(function(e){
    // Expire Cookies
    var d = new Date();
    d.setTime(d.getTime()+(3 * 60 * 60 * 1000));
    var expire = "expires="+d.toGMTString();

    var cookieVal = "multiply="+$(this).val();
    document.cookie = cookieVal+"; "+expire;
});

    // Ingredient Checkbox - Cookies (keeps selected checkbox)

$(".ing_check").each(function(){
    var currentPageUrl = window.location.pathname;
    var cookieName = currentPageUrl + $(this).attr('name');
    var mycookie = $.cookie(cookieName);

    if (mycookie && mycookie == "true"){
        $(this).prop('checked', mycookie);
    }
});

$(".ing_check").change(function() {
    var date = new Date();
    var currentPageUrl = window.location.pathname;
    var cookieName = currentPageUrl + $(this).attr('name');

    // Timer - 3h (3h | 60min | 60s | 1000ms)
    date.setTime(date.getTime()+(3 * 60 * 60 * 1000));

    // Save the cookie with the current page URL as a prefix
    $.cookie(cookieName, $(this).prop('checked'), {
        path: '/',
        expires: date
    });
});

    // Add a cross line to the marked ingredients

$(".ing_check").change(function(){
    var object = $(this).siblings("table").children("tbody").children("tr").children("td").children(".ing_text");
    var objectp = $(this).siblings(".wght_div").children(".ing_wght");

    if (this.checked == true){
        object.addClass("crossed");
        objectp.addClass("crossed");
    } else {
        object.removeClass("crossed");
        objectp.removeClass("crossed");
    }
}).change();

    // Multiply Recipe - calculate & display

$(function(){
    $(".multiply_ing").on("change", function(){

        // multiply ingredient weight
        let multiply_val =+ this.value;
        $('.ing_wght').each(function(){
            let ing =+ this.dataset.val;
            if (ing * multiply_val > 50) {
                this.innerHTML = Math.round(ing * multiply_val * 1) / 1; // round to 1 when the number is greater than 50
            } else {
                this.innerHTML = Math.round(ing * multiply_val * 10) / 10; // round to 1 decimal point when the number is equal or less than 50
            }
        });

        // multiply calc table values
        $('.ctd').each(function(){
            let ctd =+ this.dataset.val;
            this.innerHTML = Math.round(ctd * multiply_val * 10) / 10; 
        });

        // multiply calc table weight
        $('.ctd-weight').each(function(){
            let ctdWeight =+ this.dataset.val;
            if (ctdWeight * multiply_val > 50){
                this.innerHTML = Math.round(ctdWeight * multiply_val * 1) / 1; 
            } else {
                this.innerHTML = Math.round(ctdWeight * multiply_val * 10) / 10; 
            }
        });

        // multiply calc table values (round kcal to 0 decimals)
        $('.ctd-kcal').each(function(){
            let ctdKcal =+ this.dataset.val;
            this.innerHTML = Math.round(ctdKcal * multiply_val * 1); 
        });

        // multiply kcal in the nutrition table
        $('.nt-multi-kcal').each(function(){
            let ntkcal =+ this.dataset.val;
            this.innerHTML = Math.round(ntkcal * multiply_val * 1) / 1 + " kcal"; 
        });

        // multiply fat, carbs, fiber and protein in the nutrition table
        $('.nt-multi-all').each(function(){
            let ntall =+ this.dataset.val;
            this.innerHTML = Math.round(ntall * multiply_val * 10) / 10 + " g"; 
        });

        // multiply CP in the nutrition table
        $('.nt-multi-cp').each(function(){
            let ntall =+ this.dataset.val;
            this.innerHTML = Math.round(ntall * multiply_val * 10) / 10 + " WW"; 
        });

        // multiply WPTS in the nutrition table
        $('.nt-multi-wpts').each(function(){
            let ntall =+ this.dataset.val;
            this.innerHTML = Math.round(ntall * multiply_val * 10) / 10 + " WBT"; 
        });

        // change "porcja" (portion) word
        $('.multiply_ing option').each(function(){
            let multi_opt = $(this).val();
            let portion = parseFloat(document.querySelector(".portion").dataset.val);
            let portions = Math.round(multi_opt * portion * 10) / 10;
            let port_substr = portions.toString().slice(-1);

            let portion_word = "porcja";
            switch (true){
                case (port_substr < 1):
                    portion_word = "porcji";
                break;
                case (port_substr < 2):
                    portion_word = "porcja";
                break;
                case (port_substr < 5):
                    portion_word = "porcje";
                break;
                case (port_substr > 4):
                    portion_word = "porcji";
                break;
            }

            if (1 < port_substr < 5 && portions > 10){
                portion_word = "porcji";
            }
            if (port_substr > 1 && port_substr < 5 && portions > 20){
                portion_word = "porcje";
            }

            this.innerHTML = multi_opt + "x (" + portions + " " + portion_word + ")";
        });

            // Multiply total weight, portion weight and portion number
        
        // Total weight
        let weight = document.querySelector(".weight");
        let weightDataVal = weight.dataset.val;
        let weightMultiVal = weightDataVal * multiply_val;
        
        switch (true){
            case weightMultiVal < 100:
                weightMultiVal = Math.round(weightMultiVal * 10) / 10+" g";
            break;
            case weightMultiVal >= 100:
                weightMultiVal = Math.round(weightMultiVal * 1) / 1+" g";
            break;
        }
        
        weight.innerHTML = weightMultiVal;

        // Portion weight
        let portionWeight = document.querySelector(".portion-weight");
        let portionWeightDataVal = portionWeight.dataset.val;
        let portionWeightMultiVal = portionWeightDataVal * multiply_val;

        switch (true){
            case portionWeightMultiVal < 100:
                portionWeightMultiVal = Math.round(portionWeightMultiVal * 10) / 10+" g";
            break;
            case portionWeightMultiVal >= 100:
                portionWeightMultiVal = Math.round(portionWeightMultiVal * 1) / 1+" g";
            break;
        }
        
        portionWeight.innerHTML = portionWeightMultiVal;
        
        // Portion number
        let portion = document.querySelector(".portion");
        let portionDataVal = portion.dataset.val;
        
        portion.innerHTML = portionDataVal * multiply_val;

    }).change();
});

    // Weight for 1 portion on hover & click

$('.ing_wght').click(function(){
    if ($(this).siblings(".wght_portion").hasClass("vis")) {
        $(".wght_portion").removeClass("vis");
    } else {
        $(".wght_portion").removeClass("vis");
        $(this).siblings(".wght_portion").addClass("vis");
    }
});

$(document).click(function(e){
    if (!$(e.target).hasClass("ing_wght")) {
        $(".wght_portion").removeClass("vis");
    }
});

    // Adjust the width of the ing_wght, so that every element has the width of the widest one

$(".multiply_ing").on("click", function(){
    ingWidth();
});
$(window).on("resize", function(){
    ingWidth();
});
$(function(){
    ingWidth();
});

function ingWidth(){
    let maxWidth = 1;
    let widestIngWght = null;
    let ingWght;

    $(".ing_wght").each(function(){
        ingWght = $(this);
        ingWght.width("");

        if(ingWght.width() > maxWidth){
            maxWidth = ingWght.width();
            widestIngWght = ingWght; 
        }
    });
    $(".ing_wght").css("width", maxWidth);
}

    // Ingredient subtraction - expand

let ingBtn = document.querySelector('.ing-sub-expand');
    
if (ingBtn){
    ingBtn.addEventListener('click', () => {
        $(".ing-sub-expand").toggleClass("ing-expanded");
        $(".ing-arrow").toggleClass("ing-expanded");
        const content = document.querySelector('.ing-sub-content');
        expandElement(content, 'ing-expanded');
    });
    function expandElement(elem, collapseClass) {
        elem.style.height = '';
        elem.style.transition = 'none';

        const startHeight = window.getComputedStyle(elem).height;
        elem.classList.toggle(collapseClass);
        const height = window.getComputedStyle(elem).height;
        elem.style.height = startHeight;

        requestAnimationFrame(() => {
            elem.style.transition = '';

            requestAnimationFrame(() => {
                elem.style.height = height;
            })
        })
        elem.addEventListener('transitionend', () => {
            elem.style.height = '';
            elem.removeEventListener('transitionend', arguments.callee);
        }); 
    }
}

    // Nutrition calculator (table)

// Remove the value from the input on click
$(".nt-input").on('click', function(){
    $(this).val("");
});

// Add "g" (grams) at the end of the input value
$(".nt-input").on('input', function(){
    let input = $(this).val();
    input = input.replace(/[^0-9.]/g, '').trim();
    $(this).val(input + " g");
})
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
    
// Toggle displaying calc table
$(".calc-btn").on("click", function(){
    $(".calc-btn").toggleClass("calc-open");
    $(".ing-calc").toggleClass("calc-open");
});
$(window).on("click", function(e){
    if(!$(e.target).is(".ing-calc, .calc-btn") && 
       $(".ing-calc, .calc-btn").has(e.target).length === 0){
        $(".calc-btn").removeClass("calc-open");
        $(".ing-calc").removeClass("calc-open");
    }
});
    
// Don't show the calc button when there are no calc values (other than weight and name)
let emptyCallCells = 0;
$(".ctd, .ctd-kcal").each(function(){
    if ($(this).attr("data-val") != 0){
        emptyCallCells += 1;
    }
});
if (emptyCallCells < 1){
    $(".calc-btn").css("display", "none");
}
    
    // Save the clicked tag & product link
    
$(function(){ 
    $('.tag').on('click auxclick', function(e){
        e.preventDefault();

        let tag = $(this).text();
        let url = $(this).attr("href")+"?storedTag="+tag;

        if (e.type === "click"){
            window.open(url, "_self");
        } else if (e.type === "auxclick" && e.button === 1){
            window.open(url, "_blank");
        }
    });

    $('.prod-link').on('click auxclick', function(e){
        e.preventDefault();

        let product = $(this).attr("id");
        let url = $(this).attr("href")+"?productLink="+product;
        
        if (e.type === "click"){
            window.open(url, "_self");
        } else if (e.type === "auxclick" && e.button === 1){
            window.open(url, "_blank");
        }
    });
});

    // Something with the footer, don't remember what

$(window).on('click scroll resize load change input', function(){
    var footerHeight = $('.footer').height(); 
    $('footer').css('min-height', footerHeight + 'px');
});

    // PDF
    
// Remove recipe image when saving to PDF
$(".pdf-remove-img").on("click", function(){
    $(".pdf-remove-img").toggleClass("remove-img");
    $(".recipe-image").toggleClass("remove-img");
});

// Save to PDF and set the PDF height
$(".pdf-btn-inner").on('click', function(){
    let spaceHeight = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--wrapperPadding2')); // Space height
    let pageHeight = $(".pcl").height() + spaceHeight * 2 + 70 + 5; // 70 = body padding x2, 5px = idk what, but looks better

   let cssPagedMedia = (function(){
        let style = document.createElement('style');
        document.head.appendChild(style);
        return function (rule) {
            style.innerHTML = rule;
        };
    }());

    cssPagedMedia.size = function (size){
        cssPagedMedia('@page {size: ' + size + '}');
    };
    cssPagedMedia.size('800px ' + pageHeight + 'px');
    window.print();
});
</script>
    </body>
</html>
<?php
}
?>
                
                
