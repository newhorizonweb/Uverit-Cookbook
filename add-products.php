<!doctype html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Dodaj Produkt</title>
        <meta name="description" content="Zautomatyzowany system dodawania produktów i szczegółowych informacji.">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/add-products.css">
        
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
            $('.kcal, .fat, .carbohydrates, .fiber, .protein, .weight, .portion').each(function(){
                if ($(this).val() != "" || $(this).val() != 0){
                    if (isNaN($(this).val())){
                        $(this).addClass('error');
                        $('#placeholder-text').html("Pola powinny zawierać tylko liczby");
                        addError();
                    }
                }
            });
            
            // Check if there are any shops selected
            if ($('.sl-checkbox').filter(':checked').length < 1){
                $(".sl-btn").addClass('error');
                $('#placeholder-text').html("Dodaj sklep");
                addError();
            }
            
            // Check if the image has been uploaded (return error class)
            $('.required2').each(function(){
                if ($(this).val() == ''){
                    $('#file_style').addClass('error');
                    $('.form-s1-image').addClass('error');
                    $('#placeholder-text').html("Dodaj zdjęcie");
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
            if (sendForm){
                $.ajax({
                    type: "post",
                    url: 'Php/add-products.php',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(){
                        $("#placeholder-text").html("Produkt został dodany!");
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
        <script src="Scripts/image-drop.js" defer></script>
        <script src="Scripts/product-tags.js" defer></script>
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
                    <h3>Dodaj Produkt</h3>
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
                    <h2>Dodaj Produkt</h2>
                </div>
                
                <div class="main-module">
                    <div class="main-module-content">
                        <form method="POST" action="Php/add-recipes.php" enctype="multipart/form-data" id="add_recipes_form" class="add-form">
                            
                        <div class="form-s1 form-section">
                            <div class="form-s1-left">
                                <div class="input-div s1-brand">
                                    <label for="brand">Marka*</label>
                                    <input type="text" name="brand" id="brand" class="required" maxlength="32">
                                </div>
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
                                        <option value="drinks" title="Energetyki, kawa rozpuszczalna, herbata">Napoje</option>
                                        <option value="sweets_snacks" title="Batony, ciastka, chipsy">Słodycze i Przekąski</option>
                                        <option value="baked_goods_pastry" title="Bułki, omlety, ciasta">Pieczywo i Ciasta</option>
                                        <option value="grains_pasta" title="Ryż, spaghetti, ciecierzyca">Zboża i Makarony</option>
                                        <option value="fruits_vegetables" title="Jabłka, śliwki suszone, orzechy">Owoce i Warzywa</option>
                                        <option value="meat_dairy" title="Szynka, mleko, jajka">Mięso i Nabiał</option>
                                        <option value="vege_vegan" title="Kotlety vege, mleko owsiane - vege i vegańskie odpowiedniki mięsa i nabiału">Vege i Vegan</option>
                                        <option value="ready_meals" title="Lasagne, gołąbki, pizza mrożona - wymagają tylko obróbki cieplnej">Gotowe Dania</option>
                                        <option value="semi_finished" title="Budyń w proszku, ciasto francuskie, zupki chińskie - wymagają obróbki cieplnej lub / i dodatkowych składników">Półprodukty</option>
                                        <option value="sauces_spices" title="Sos do spaghetti, ketchup, cynamon">Sosy i Przyprawy</option>
                                        <option value="other" title="Mąka, olej, mleko skondensowane">Inne</option>
                                    </select>
                                </div>
                                <div class="shop-list">
                                    <label for="sl-btn">Sklepy*</label>
                                    <p class="sl-btn" id="sl-btn">Wybierz sklep</p>
                                    <div class="sl-items">
                                        <div class="sl-items-inner">
                                            <!-- Content generated from JS at the bottom -->
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
                                            echo "<option value='$v'>$v / 10</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-s1-right">
                                <div class="form-s1-image">
                                    <img id="output" src="Images/placeholder-image.svg" alt="Image upload error">
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
                                    <input type="text" name="shelf_life">
                                </div>
                                <div class="form-s4-input">
                                    <label for="kcal" title="Kcal / 100g" class="s4-help">Kalorie (kcal)*</label>
                                    <input type='tel' name="kcal" class="kcal required">
                                </div>
                            </div>
                            <div class="form-s4-b form-s4-div">
                                <div class="form-s4-input">
                                    <label for="fat" title="W gramach / 100g" class="s4-help">Tłuszcz (g)*</label>
                                    <input type='tel' name="fat" class="fat required">
                                </div>
                                <div class="form-s4-input">
                                    <label for="carbohydrates" title="Węglowodany przyswajalne w gramach / 100g" class="s4-help">Węglow. netto (g)*</label>
                                    <input type='tel' name="carbohydrates" class="carbohydrates required">
                                </div>
                            </div>
                            <div class="form-s4-c form-s4-div">
                                <div class="form-s4-input">
                                    <label for="fiber" title="W gramach / 100g" class="s4-help">Błonnik (g)*</label>
                                    <input type='tel' name="fiber" class="fiber required">
                                </div>
                                <div class="form-s4-input">
                                    <label for="protein" title="W gramach / 100g" class="s4-help">Białko (g)*</label>
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
                            <div class="form-s4-info">
                                <label for="info">Dod. informacje</label>
                                <input type="text" name="info" maxlength="256">
                            </div>
                        </div>
                            
                        <div class="form-s5 form-section"> 
                            <label for="tags" title="Dodaj tagi opisujące potrawę, np. śniadanie, jajka, zupa, polska, low-carb. Wszystkie tagi z niestandardowymi znakami są niewidoczne na stronie przepisu.">Tagi*</label>
                            <input type="text" name="tags" placeholder="Tanie, duża porcja...">
                            
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

    <!-- FOOTER3 -->
            <div class="footer">
                <div class="wrapper">
                    <div class="brand">
                        <div id="brand-logo" onclick="scrollToTop()">
                            <img src="Images/uverit-w.svg" alt="Business logo" oncontextmenu="window.event.returnValue=false;" id="footer-scrolltop">
                        </div>

                        <div id="socials">

                            <h6>Usługi na Fiverr:</h6>

                            <a href="https://www.fiverr.com/new_horizon_web" class="social-btn" target="_blank" rel="noreferrer">
                                <img src="Images/fiicon.svg" alt="Fiverr icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div id="credits">
                    <a href="https://www.fiverr.com/new_horizon_web" target="_blank" rel="noreferrer">
                    <script>
                        let currentYear = new Date().getFullYear();
                        $("#credits a").html("© Cookbook created by uverit " + currentYear);
                    </script>
                    </a>
                </div>
            </div>
    <!-- /FOOTER3 -->

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
                $(".form-s1-image").removeClass('error');
            });
            $(document).on('click', '.sl-checkbox, .sl-item label', function(){
                $(".sl-btn").removeClass('error');
                
            });
            $(document).on('click', '.check-div input, .check-div label', function(){
                $(".check-div input").each(function(){
                    $(this).removeClass('error');
                });
            });

                // Shop list custom select list

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
            for (let nr = 0; nr < SLlength; nr++){
                $(".sl-items-inner").append(
                    "<div class='sl-item'>" +
                        "<input type='checkbox' name='slcheckbox[]' id='slcheck"+nr+"' class='sl-checkbox' value='"+shopList[nr]+"'>" +
                    "</div>");
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
            $(".sl-checkbox").on("click", function(){
                let slChckbox = $(".sl-checkbox:checked").map(function(){
                    return $(this).val();
                }).get();
                let slChckboxArray = slChckbox.join(", ")
                $(".sl-btn").html(slChckboxArray);

                if ($(".sl-btn").html() === ""){
                    $(".sl-btn").html("Wybierz sklepy")
                }
            });
            
            // Create labels and insert the checkbox value into them
            $(".sl-item").each(function(){
                let slCheckVal = $(this).children(".sl-checkbox").val();
                let slCheckId = $(this).children(".sl-checkbox").attr("id");
                $(this).append("<label for='"+slCheckId+"'>" + slCheckVal + "</label>")
            });
            
                // Tags
            
            // Generate tags after choosing the product type
            $("#type").on("input", function(){
                let type = $(this).val();
                let tagLabels = [];
                let tagList = [];

                switch(type){
                    case "drinks":
                        tagLabels = drinksLabels;
                        tagList = drinksList;
                    break;
                    case "sweets_snacks":
                        tagLabels = sweets_snacksLabels;
                        tagList = sweets_snacksList;
                    break;
                    case "baked_goods_pastry":
                        tagLabels = baked_goods_pastryLabels;
                        tagList = baked_goods_pastryList;
                    break;
                    case "grains_pasta":
                        tagLabels = grains_pastaLabels;
                        tagList = grains_pastaList;
                    break;
                    case "fruits_vegetables":
                        tagLabels = fruits_vegetablesLabels;
                        tagList = fruits_vegetablesList;
                    break;
                    case "meat_dairy":
                        tagLabels = meat_dairyLabels;
                        tagList = meat_dairyList;
                    break;
                    case "vege_vegan":
                        tagLabels = vege_veganLabels;
                        tagList = vege_veganList;
                    break;
                    case "ready_meals":
                        tagLabels = ready_mealsLabels;
                        tagList = ready_mealsList;
                    break;
                    case "semi_finished":
                        tagLabels = semi_finishedLabels;
                        tagList = semi_finishedList;
                    break;
                    case "sauces_spices":
                        tagLabels = sauces_spicesLabels;
                        tagList = sauces_spicesList;
                    break;
                    case "other":
                        tagLabels = otherLabels;
                        tagList = otherList;
                    break;
                }

                let TLlength = tagLabels.length;
                $(".form-s6").children().remove();

                for (let nr = 0; nr < TLlength; nr++){
                    if (tagLabels[nr].indexOf("--group--") != -1){
                        let group = tagLabels[nr].replace('--group--','');
                        $(".form-s6").append(
                            "<div class='check-div check-div-group'>" +
                                "<div class='cdg-line'></div>" +
                                "<label>" + group + "</label>" +
                            "</div>"
                        );
                    } else if (tagLabels[nr].indexOf("--subgroup--") != -1){
                        let subGroup = tagLabels[nr].replace('--subgroup--','');
                        $(".form-s6").append(
                            "<div class='check-div check-div-group'>" +
                                "<div class='cdg-line'></div>" +
                                "<label>" + subGroup + "</label>" +
                            "</div>"
                        );
                    } else {
                        $(".form-s6").append(
                            "<div class='check-div'>" +
                                "<input type='checkbox' name='checkbox[]' id='check"+nr+"' class='checkbox' value='" + tagList[nr] + "'>" +
                                "<label for='check"+nr+"'>" + tagLabels[nr] + "</label>" +
                            "</div>"
                        );
                    }
                }
            });
        </script>
    </body>
</html>
