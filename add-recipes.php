<!doctype html>
<html lang="pl-PL">
        
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Dodaj Przepis</title>
        <meta name="description" content="Zautomatyzowany system dodawania przepisów i szczegółowych informacji.">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/add-recipes.css">
        
        <!-- Scripts -->
        <script src="Scripts/jquery-3.6.0.min.js"></script>
        <script src="Scripts/ScriptPack-min.js" defer></script>
        <script>
        $(function(){
        $('#add_recipes_form').on('click', '#add', function(e){
            e.preventDefault();
            
            let sendForm = true;
            
            function addError(){
                $('#add').addClass('error');
                $('#placeholder-text').addClass('error');
                sendForm = false;
            }
            
            // Check if at least 1 tag checkbox is checked
            if ($('.checkbox').filter(':checked').length < 1){
                $(".checkbox").addClass('error');
                $('#placeholder-text').html("Dodaj tagi");
                addError();
            }
            
            // Check if the portion has a decimal place (return error class)
            $('.portion').each(function(){
                if ($('.portion').val() % 1 != 0){
                    $(this).addClass('error');
                    $('#placeholder-text').html("Porcja powinna być liczbą całkowitą");
                    addError();
                }
            });
            
            // Check if the inputs contain a number (return error class)
            $('.kcal, .fat, .carbohydrates, .fiber, .protein, .weight, .portion, .active_time, .passive_time').each(function(){
                if ($(this).val() != "" || $(this).val() != 0){
                    if (isNaN($(this).val())){
                        $(this).addClass('error');
                        $('#placeholder-text').html("Pola powinny zawierać tylko liczby");
                        addError();
                    }
                }
            });
            
            // Check if the ingredient weight is a number (return error class)
            $('.ing_weight').each(function(){
                if ($(this).val() != "" || $(this).val() != 0){
                    if (isNaN($(this).val())){
                        $(this).addClass('error');
                        $('#placeholder-text').html("Waga powinna być liczbą");
                        addError();
                    }
                }
            });
            
            // Check if the ingredient weight is a number (return error class)
            $('.calc-num').each(function(){
                if ($(this).val() != "" || $(this).val() != 0){
                    if (isNaN($(this).val())){
                        $(this).addClass('error');
                        $('#placeholder-text').html("Waga powinna być liczbą");
                        addError();
                    }
                }
            });
            
            // Check if the image has been uploaded (return error class)
            $('.required2').each(function(){
                if ($(this).val() == ''){
                    $('#placeholder-text').html("Dodaj zdjęcie");
                    $('#file_style').addClass('error');
                    $('.form-s1-right').addClass('error');
                    addError();
                }
            });

            // Check if the form field is empty (return error class)
            $('.required').each(function(){
                if ($(this).val() == '' ||
                    $(this).val() == 'Wybierz typ' ||
                    $(this).val() == 'Wybierz poziom'){
                    
                    $(this).addClass('error');
                    $('#placeholder-text').html("Wypełnij formularz");
                    addError();
                }
            });
            
            // If all of the above are correct - remove the error class
            if (sendForm){
                $('#placeholder-text').removeClass('error');
                $('#add').removeClass('error');
            }

            // If all of the above are correct - send the form
            let form = document.querySelector('#add_recipes_form');
            if (sendForm) {
                $.ajax({
                    type: "post",
                    url: 'Php/add-recipes.php',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(){
                        $("#placeholder-text").html("Przepis został dodany!");
                        $("#placeholder-text").addClass('sent');
                        $("#add").addClass('sent');
                        $("#add").html("<p>Dodano</p>");
                        $(".send-block").css("display", "block");
                    },
                    error: function(){
                        $("#placeholder-text").html("Error");
                        $('#placeholder-text').addClass('error');
                        $("#add").addClass('error');
                    }
                });
            }
        });
        });
        </script>
        <script src="Scripts/navigation.js"></script>
        <script src="Scripts/copy.js" defer></script>
        <script src="Scripts/calc.js" defer></script>
        <script src="Scripts/image-drop.js" defer></script>
        <script src="Scripts/recipe-tags.js"></script>
    </head>
        
    <body>
        
        <div id="hidden-contents"> 
            
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
                <a href="index.php" id="nav-logo">
                    <img src="Images/uverit-w.svg" alt="Business logo" id="nav-logo-img" oncontextmenu="window.event.returnValue=false;">
                </a>

                <div class="nav-elements">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <script>
                                baseNav();
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
        <header class="banner">
            <div class="parallax-banner"></div>
            <div class="parallax-help"></div>
            <div class="wrapper">
                <div class="banner-text">
                    <h1>Uverit Cookbook</h1>
                    <h3>Dodaj Przepis</h3>
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
                
                <div class="main-header">
                    <h2>Dodaj Przepis</h2>
                </div>
                
                <div class="main-module">
                    <div class="main-module-content">
                        <form method="POST" action="Php/add-recipes.php" enctype="multipart/form-data" id="add_recipes_form" class="add-form">
                            
                        <div class="form-s1 form-section">
                            <div class="form-s1-left">
                                <div class="input-div s1-name">
                                    <label for="name">Nazwa*</label>
                                    <input type="text" name="name" id="name" class="required" maxlength="56">
                                </div>
                                <div class="input-div s1-desc">
                                    <label for="description">Opis*</label>
                                    <input type="text" name="description" id="description" class="required" maxlength="128">
                                </div>
                                <div class="input-div s1-type">
                                    <label for="type">Typ*</label>
                                    <select name="type" id="type" class="required">
                                        <option selected hidden>Wybierz typ</option>
                                        <option value="dishes" title="Całe danie, np. lasagne, burgery">Dania</option>
                                        <option value="desserts" title="Np. sernik, lody, pierniczki">Desery</option>
                                        <option value="snacks" title="Np. chipsy, kanapki, batony">Przekąski</option>
                                        <option value="other" title="Np. bułki, karmel, dżem">Inne</option>
                                    </select>
                                </div>
                                <div class="input-div s1-diff">
                                    <label for="difficulty">Poziom trudności*</label>
                                    <select name="difficulty" class="required">
                                        <option selected hidden>Wybierz poziom</option>
                                        <option value="easy">Łatwy</option>
                                        <option value="moderate">Średni</option>
                                        <option value="hard">Trudny</option>
                                    </select>
                                </div>
                                <div class="input-div s1-image">
                                    <label for="image">Obraz (jpg, png)*</label>
                                    <label for="upload_image" id="file_style">Wybierz obraz</label>
                                    <input type="file" style="display:none;" id="upload_image" name="image" accept="image/png, image/jpeg" class="required2">
                                </div>
                            </div>
                            
                            <div class="form-s1-right">
                                <img id="output" src="Images/placeholder-image.svg" alt="Image upload error">
                            </div>
                        </div>
                            
                        <div class="calc">
                            <div class="calc-expand">
                                <img src="Images/list-arrow-b.svg" class="calc-arrow calc-arrow1" alt="">
                                <p>KALKULATOR</p>
                                <img src="Images/list-arrow-b.svg" class="calc-arrow calc-arrow2" alt="">
                            </div>
                            
                            <div class="calculator">
                            <?php
                            // The number of inputs in a column is hardcoded, because of the database structure
                            
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
                                echo "<input type='tel' name='weight-calc".$x."' class='weight-calc weight-calc".$x." calc-num' data-target='ing_weight".$x."' tabindex='-1'>";
                            }
                            echo "<div class='sub-loss'>";
                            echo "<p>Straty</p>";
                            echo "<span></span>";
                            echo "</div>";
                            for ($x = 1; $x <= 6; $x++) {
                                echo "<input type='tel' name='weight-calc-sub".$x."' class='weight-calc-sub weight-calc-sub".$x." calc-num' tabindex='-1'>";
                            }
                            echo "</div>";

                            // Generate calculator name inputs
                            echo "<div class='name-calc-col'>";
                            echo "<h5>Nazwa</h5>";
                            for ($x = 1; $x <= 24; $x++) {
                                echo "<input type='text' name='name-calc".$x."' class='name-calc".$x."' data-target='ingredient".$x."' tabindex='-1'>";
                            }
                            echo "<div class='sub-line-div'>";
                            echo "<span class='sub-line'></span>";
                            echo "</div>";
                            for ($x = 1; $x <= 6; $x++) {
                                echo "<select name='name-calc-sub".$x."' class='calc-sub-select calc-sub-select".$x."' tabindex='-1'>";
                                echo "<option selected>Wybierz składnik</option>";
                                for ($o = 1; $o <= 24; $o++) {
                                    echo "<option class='name-calc-option".$o."'></option>";
                                }
                                echo "</select>";
                            } 
                            echo "</div>";  
                                
                            // Generate calculator kcal inputs
                            echo "<div class='kcal-calc-col'>";
                            echo "<h5 title='Kcal / 100g'>Kcal</h5>";
                            for ($x = 1; $x <= 24; $x++) {
                                echo "<input type='tel' name='kcal-calc".$x."' class='kcal-calc kcal-calc".$x." calc-num' tabindex='-1'>";
                            }
                            echo "<input class='calc-result kcal-result' readonly>";
                            echo "</div>";

                            // Generate calculator fat inputs
                            echo "<div class='fat-calc-col'>";
                            echo "<h5 title='W gramach / 100g'>Tłuszcz</h5>";
                            for ($x = 1; $x <= 24; $x++) {
                                echo "<input type='tel' name='fat-calc".$x."' class='fat-calc fat-calc".$x." calc-num' tabindex='-1'>";
                            }
                            echo "<input class='calc-result fat-result' readonly>";
                            echo "</div>";

                            // Generate calculator carb inputs
                            echo "<div class='carb-calc-col'>";
                            echo "<h5 title='W gramach / 100g'>Węgle</h5>";
                            for ($x = 1; $x <= 24; $x++) {
                                echo "<input type='tel' name='carb-calc".$x."' class='carb-calc carb-calc".$x." calc-num' tabindex='-1'>";
                            }
                            echo "<input class='calc-result carb-result' readonly>";
                            echo "</div>"; 

                            // Generate calculator fiber inputs
                            echo "<div class='fiber-calc-col'>";
                            echo "<h5 title='W gramach / 100g'>Błonnik</h5>";
                            for ($x = 1; $x <= 24; $x++) {
                                echo "<input type='tel' name='fiber-calc".$x."' class='fiber-calc fiber-calc".$x." calc-num' tabindex='-1'>";
                            }
                            echo "<input class='calc-result fiber-result' readonly>";
                            echo "</div>";

                            // Generate calculator protein inputs
                            echo "<div class='protein-calc-col'>";
                            echo "<h5 title='W gramach / 100g'>Białko</h5>";
                            for ($x = 1; $x <= 24; $x++) {
                                echo "<input type='tel' name='protein-calc".$x."' class='protein-calc protein-calc".$x." calc-num' tabindex='-1'>";
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
                            <ol class="form-s2-inner">
                            <?php
                                // Ing 1-2 (required)
                                for ($x = 1; $x <= 2; $x++) {
                                    echo "<li>";
                                    echo "<input type='tel' name='ing_weight".$x."' class=' ing_weight".$x." ing_weight required'>";
                                    echo "<input type='text' name='ingredient".$x."' class=' ingredient".$x." required'>";
                                    echo "</li>";
                                }
                                // Ing 3-8
                                for ($x = 3; $x <= 24; $x++) {
                                    echo "<li>";
                                    echo "<input type='tel' name='ing_weight".$x."' class=' ing_weight".$x." ing_weight'>";
                                    echo "<input type='text' name='ingredient".$x."' class=' ingredient".$x."'>";
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
                                    echo "<input type='text' name='recipe".$x."' class='recipe".$x." required'>";
                                    echo "</li>";
                                }
                            ?>
                            <?php
                                // Recipe 3-12
                                for ($x = 3; $x <= 12; $x++) {
                                    echo "<li>";
                                    echo "<input type='text' name='recipe".$x."' class='recipe".$x."'>";
                                    echo "</li>";
                                }
                            ?>
                            </div>
                            <div class="form-s3-right">
                            <?php
                                // Recipe 13-25
                                for ($x = 13; $x <= 24; $x++) {
                                    echo "<li>";
                                    echo "<input type='text' name='recipe".$x."' class='recipe".$x."'>";
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
                                    <input type="text" name="shelf_life">
                                </div>
                                <div class="form-s4-input">
                                    <label for="kcal" title="Ilość kalorii w całości" class="s4-help">Kalorie (kcal)*</label>
                                    <input type='tel' name="kcal" class="kcal required">
                                </div>
                            </div>
                            <div class="form-s4-b form-s4-div">
                                <div class="form-s4-input">
                                    <label for="fat" title="Ilość tłuszczu w całości" class="s4-help">Tłuszcz (g)*</label>
                                    <input type='tel' name="fat" class="fat required">
                                </div>
                                <div class="form-s4-input">
                                    <label for="carbohydrates" title="Ilość węglowodanów przyswajalnych w całości" class="s4-help">Węglow. netto (g)*</label>
                                    <input type='tel' name="carbohydrates" class="carbohydrates required">
                                </div>
                            </div>
                            <div class="form-s4-c form-s4-div">
                                <div class="form-s4-input">
                                    <label for="fiber" title="Ilość błonnika w całości" class="s4-help">Błonnik (g)*</label>
                                    <input type='tel' name="fiber" class="fiber required">
                                </div>
                                <div class="form-s4-input">
                                    <label for="protein" title="Ilość białka w całości" class="s4-help">Białko (g)*</label>
                                    <input type='tel' name="protein" class="protein required">
                                </div>
                            </div>
                            <div class="form-s4-d form-s4-div">
                                <div class="form-s4-input">
                                    <label for="weight">Waga - gotowe (g)*</label>
                                    <input type='tel' name="weight" class="weight required">
                                </div>
                                <div class="form-s4-input">
                                    <label for="portion">Ilość porcji / sztuk*</label>
                                    <input type='tel' name="portion" class="portion required">
                                </div>
                            </div>
                            <div class="form-s4-e form-s4-div">
                                <div class="form-s4-input">
                                    <label for="active_time" title="Mieszanie, krojenie składników, itp." class="s4-help">Czas aktyw. (min)*</label>
                                    <input type='tel' name="active_time" class="active_time required">
                                </div>
                                <div class="form-s4-input">
                                    <label for="passive_time" title="Wyrośnięcie ciasta, pieczenie, itp." class="s4-help">Czas bierny (min)*</label>
                                    <input type='tel' name="passive_time" class="passive_time required">
                                </div>
                            </div>
                            <div class="form-s4-info">
                                <label for="info">Dod. informacje</label>
                                <input type="text" name="info" maxlength="256">
                            </div>
                        </div>
                            
                        <div class="form-s5 form-section"> 
                            <label for="tags" title="Dodaj tagi opisujące potrawę, np. sezonowe, resztki, zupa, zapiekanka. Wszystkie tagi z niestandardowymi znakami są niewidoczne na stronie przepisu.">Tagi*</label>
                            <input type="text" name="tags" placeholder="Truskawki, duża porcja, ciastka...">
                            
                            <label for="hidden_tags" title="Dodaj tagi niewidoczne na stronie przepisu">Ukryte tagi</label>
                            <input type="text" name="hidden_tags" placeholder="Masło, winogrona...">
                        </div>   
                        <div class="form-s6 form-section">
                            <!-- Tags generated from JS -->
                        </div>
                            
                        <div class="send-btn">
                            <div class="space"></div>
                            <p id="placeholder-text"></p>
                            <div id="add"><p>Dodaj</p></div>
                            <div class="send-block"></div>
                        </div>
 
                        </form>
                    </div>
                </div>
                
            <div class="space"></div>
            </div>
    <!-- /MAIN-MODULE -->

        </main>
        
        <footer>
            <!-- navigation.js -->
        </footer>
        
    <script>

        // Remove the error class

    $('.required').on('keydown', function(){
        $(this).removeClass('error');
    });
    $('.required').on('change', function(){
        $(this).removeClass('error');
    });
    $('#upload_image').on('change', function(){
        $("#file_style").removeClass('error');
        $(".form-s1-right").removeClass('error');
    });
    // Remove error class from #file_style on drop in image-drop JS
    $('.calc-num').on('input', function(){
        $(this).removeClass('error');
    });
    $(document).on('click', '.check-div input, .check-div label', function(){
        $(".check-div input").each(function(){
            $(this).removeClass('error');
        });
    });
        
        // Tags
        
    $(window).on("load", function(){
        let TLlength = tagLabels.length;

        $(".form-s6").children().remove();

        for (let nr = 0; nr < TLlength; nr++){
            if (tagLabels[nr].indexOf("--group--") != -1){
                let group = tagLabels[nr].replace('--group--','');
                $(".form-s6").append(
                    "<div class='check-div check-div-group'>" +
                        "<div class='cdg-line'></div>" +
                        "<label>"+group+"</label>" +
                    "</div>"
                );
            } else {
                $(".form-s6").append(
                    "<div class='check-div'>" +
                        "<input type='checkbox' name='checkbox[]' id='check"+nr+"' class='checkbox' value='"+tagList[nr]+"'>" +
                        "<label for='check"+nr+"'>"+tagLabels[nr]+"</label>" +
                    "</div>"
                );
            }
        }
    });
    </script>
    </body>
</html>