




<?php $con = mysqli_connect("localhost", "root", "", "cookbook");

$sql = "SELECT * FROM recipes
    LEFT JOIN ingredients ON recipes.id = ingredients.id
    LEFT JOIN recipe_steps ON ingredients.id = recipe_steps.id
    LEFT JOIN calc_sub ON recipe_steps.id = calc_sub.id
    WHERE recipes.id = '27' ";

$res = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $name = $row['name'];
    $description = $row['description'];
    $type = $row['type'];
    $difficulty = $row['difficulty'];
    $image = $row['image'];
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

    for ($x = 1; $x <= 24; $x++) {
        $ing_weight["ing_weight".$x] = $row["ing_weight".$x];
        $ingredient["ingredient".$x] = $row["ingredient".$x];
        $recipe["recipe".$x] = $row["recipe".$x];
    }
    extract($ing_weight);
    extract($ingredient);
    extract($recipe);

    for ($x = 1; $x <= 6; $x++) {
        $weight_calc_sub["weight_calc_sub".$x] = $row["weight-calc-sub".$x];
        $name_calc_sub["name_calc_sub".$x] = $row["name-calc-sub".$x];
    }
    extract($weight_calc_sub);
    extract($name_calc_sub);

    $cp = $carbohydrates / 10; // Carbohydrate portion = 10g
    $wpts = ($fat * 9 + $protein * 4) / 100; // Warsaw Pump Therapy School = (fat kcal + protein kcal) / 100
}
?>
<!doctype html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>
            <?php echo $name; ?>        </title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $tags; ?>">
        <meta name="author" content="Uverit">
        <link rel="preload" href="../Images/banner1.png" as="image" media="screen and (min-width:769px)">
        <link rel="preload" href="../Images/banner2.png" as="image" media="screen and (max-width:768px)">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../Styles/general.css">
        <link rel="stylesheet" type="text/css" href="../Styles/recipe.css">
        
        <!-- Scripts -->
        <script src="../Scripts/jquery-3.6.0.min.js"></script>
        <script src="../Scripts/ScriptPack-min.js" defer></script>
        <script src="../Scripts/jquery.cookie-1.4.1.min.js" defer></script>
        <script src="../Scripts/recipe.js" defer></script>
        <script src="../Scripts/nutrition-calc.js" defer></script>
        <script src="../Scripts/ing-sub.js" defer></script>
    </head>
        
    <body>
        
        <div id="hidden-contents" class="pdfNoPrint"> 
            
    <!-- SCROLLTOP -->
            <div id="scrolltop" onclick="scrollToTop()">
                <img src="../Images/list-arrow-b.svg" class="scrollarrow" alt="scroll arrow">
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
                        <?php                            require("../Php/navigation.php");
                            backNav();
                        ?>                        </div>
                    </div>
                    
                    <h5 class="toggle-text">Zmień Tryb</h5>

                    <div class="toggle1">
                        <input type="checkbox" class="dm-btn" id="dmtoggle">
                        <label for="dmtoggle"></label>
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
        
        <header>

    <!-- BANNER1-PARALLAX -->
            <div class="banner1">
                <div class="banner-bg"></div>
                <div class="banner-img">
                </div>
                <div class="wrapper">
                    <div class="banner-text">
                        <h1>Uverit Cookbook</h1>
                        <h3>
                            <?php echo $name; ?>                        </h3>
                    </div>
                </div>
            </div>
    <!-- /BANNER1-PARALLAX -->
            
        </header>
        
        <main>

    <!-- MAIN-MODULE -->
            <div class="wrapper">
                <div class="space pdfNoPrint"></div>

                <?php                    require "../Php/recipe-content.php";
                    require('../Php/svg.php');
                    getContent();
                
                    //Get the content for PDF Print to calculate the height - pdf-content-load
                    echo "<div class='pcl'>";
                        getContent();
                    echo "</div>";
                ?>
                <div class="space pdfNoPrint"></div>    
            </div>
    <!-- /MAIN-MODULE -->

        </main>
        
        <footer>

    <!-- FOOTER -->
            <div class="footer">
                <div class="wrapper">
                    
                    <div class="brand">
                        <div id="brand-logo" onclick="scrollToTop()">
                            <img src="../Images/uverit-w.svg" alt="Business logo" oncontextmenu="window.event.returnValue=false;" id="footer-scrolltop">
                        </div>

                        <div id="socials">

                            <h6>Usługi na Fiverr:</h6>

                            <a href="https://www.fiverr.com/new_horizon_web" class="social-btn" target="_blank" rel="noreferrer">
                                <img src="../Images/fiicon.png" alt="Fiverr icon">
                            </a>
                        </div>
                    </div>

                </div>

                <div id="credits">
                    <a href="https://www.fiverr.com/new_horizon_web" target="_blank" rel="noreferrer">
                        © Cookbook created by uverit 2022
                    </a>
                </div>
            </div>
    <!-- /FOOTER -->

        </footer>
        
        <script>
            /* Save the clicked tag */
            $(function () { 
                $('.tag').on('click auxclick', function(e){
                    let tag = $(this).text();
                    localStorage.searchTag = tag;
                })
            });
            
            /* Something with the footer, don't remember what */
            $(window).on('click scroll resize load change input', function(){
                var footerHeight = $('.footer').height(); 
                $('footer').css('min-height', footerHeight + 'px');
            });
            
            /* Remove recipe image when saving to PDF */
            $(".pdf-remove-img").on("click", function(){
                $(".pdf-remove-img").toggleClass("remove-img");
                $(".recipe-image").toggleClass("remove-img");
            });
            
            /* Save to PDF and set the PDF height */
            $(".pdf-btn-inner").on('click', function(){
                let pageHeight = $(".pcl").height() + 70 // 70 = paddings;
                
                var cssPagedMedia = (function () {
                    var style = document.createElement('style');
                    document.head.appendChild(style);
                    return function (rule) {
                        style.innerHTML = rule;
                    };
                }());

                cssPagedMedia.size = function (size) {
                    cssPagedMedia('@page {size: ' + size + '}');
                };
                cssPagedMedia.size('800px ' + pageHeight + 'px');
                
                window.print();
            });

        </script>
    </body>
</html>

<?php    mysqli_close($con);
?>




