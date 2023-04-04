<!doctype html>
<html lang="pl-PL">
        
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Lista Produktów</title>
        <meta name="description" content="Lista produktów ze szegółowymi informacjami o wratościach odżywczych i sklepach.">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/product-list.css">
        
        <!-- Scripts -->
        <script src="Scripts/jquery-3.6.0.min.js"></script>
        <script src="Scripts/ScriptPack-min.js" defer></script>
        <script>
        // Adjust window height when resizing the window
        $(window).on('resize', function(){
            var divHeight = ($('.recipe-list').height()); 
            $('.main-module-content').css('min-height', divHeight+'px');
        });
                                
        // Add a class when sorting  
        function currentSort(){
            let sortVal = $(".sort").val();

            switch (sortVal){
                    
                case "rating_low":
                case "rating_high":
                    $(".rating").addClass("current-sort");
                break;   
                //---------------------
                case "kcal_low_all":
                case "kcal_high_all":
                    $(".nutrition-div:nth-of-type(2) p:nth-child(2)").addClass("current-sort");
                break;  
                    
                case "protein_low_all":
                    $(".nutrition-div:nth-of-type(2) p:nth-child(3)").addClass("current-sort");
                break;
                    
                case "cp_low_all":
                case "cp_high_all":
                    $(".nutrition-div:nth-of-type(2) p:nth-child(4)").addClass("current-sort");
                break;
                    
                case "wpts_low_all":
                case "wpts_high_all":
                    $(".nutrition-div:nth-of-type(2) p:nth-child(5)").addClass("current-sort");
                break;
                //---------------------
                case "kcal_low_100":
                case "kcal_high_100":
                    $(".nutrition-div:nth-of-type(3) p:nth-child(2)").addClass("current-sort");
                break;  
                    
                case "protein_low_100":
                    $(".nutrition-div:nth-of-type(3) p:nth-child(3)").addClass("current-sort");
                break;
                    
                case "cp_low_100":
                case "cp_high_100":
                    $(".nutrition-div:nth-of-type(3) p:nth-child(4)").addClass("current-sort");
                break;
                    
                case "wpts_low_100":
                case "wpts_high_100":
                    $(".nutrition-div:nth-of-type(3) p:nth-child(5)").addClass("current-sort");
                break;
                //---------------------
                case "kcal_low_portion":
                case "kcal_high_portion":
                    $(".nutrition-div:nth-of-type(4) p:nth-child(2)").addClass("current-sort");
                break;  
                    
                case "protein_low_portion":
                    $(".nutrition-div:nth-of-type(4) p:nth-child(3)").addClass("current-sort");
                break;
                    
                case "cp_low_portion":
                case "cp_high_portion":
                    $(".nutrition-div:nth-of-type(4) p:nth-child(4)").addClass("current-sort");
                break;
                    
                case "wpts_low_portion":
                case "wpts_high_portion":
                    $(".nutrition-div:nth-of-type(4) p:nth-child(5)").addClass("current-sort");
                break;   
                    
            }
        }

        // Display a message when there is no recipes displayed + adjust window height
        function switchTypes(){
            requestAnimationFrame(() => {
                let recipeList = document.querySelector(".recipe-list");
                let mainHeader = document.querySelector(".main-module-header h3");
                let recipeListChildren = recipeList.querySelectorAll(':not(.empty-list, script)');

                if (recipeListChildren.length === 0) {
                    mainHeader.innerHTML = "Brak Produktów";
                    mainHeader.classList.add("header-no-results");
                } else {
                    let foodType = document.querySelector(".food_type").selectedOptions[0];
                    let foodName = foodType.textContent;

                    mainHeader.innerHTML = foodName || "Wszystkie typy";
                    mainHeader.classList.remove("header-no-results");
                }

                // Adjust the main-module-content height when typing after resizing the page
                document.querySelector('.main-module-content').style.minHeight = recipeList.offsetHeight + 'px';
            });
            currentSort();
        }
            
            // Load more results
            
        function loadResults(e){
            e.preventDefault();
            
            let data_number = $(".recipe-div").length;
            let result_number = parseFloat($(".result_number").val());
            
            // Check if there are more results to load
            if (result_number <= data_number){
                $(".result_number").val(result_number + 10);
            }
            displayResults(e);
        }

            // AJAX settings - send form
            
        var successFunc = function(response){
            $(".recipe-list").html(response);
            switchTypes();
        }
            
        function displayResults(e){
            e.preventDefault();

            // Create the form data object
            var formData = new FormData(document.getElementById('search-form'));

            // Append the search bar value if it has more than 1 char.
            let emptySB = "";
            if ($(".search-bar").val().length >= 2){
                emptySB = $(".search-bar").val();
            }
            formData.append('search-bar', emptySB);

            // Send the form
            $.ajax({
                type: "post",
                url: 'Php/display-product-list.php',
                data: formData,
                processData: false,
                contentType: false,
                success: successFunc
            });
            
        }
            
            // Send the serach form
            
        // On search form inputs
        $(function(){
            $('.search-bar, .sort, .food_type, .tf-items input, .rs-check').on('input', function(e){
                $(".result_number").val(10);
                successFunc = function(response){
                    $(".recipe-list").empty();
                    $(".recipe-list").append(response);
                    switchTypes();
                }
                displayResults(e);
            });
        });
            
        // On range slider click (so it won't update on every step)
        $(function(){
            $('.rs-input').on('click touchend', function(e){
                $(".result_number").val(10);
                successFunc = function(response){
                    $(".recipe-list").empty();
                    $(".recipe-list").append(response);
                    switchTypes();
                }
                displayResults(e);
            });
        });
            
        // One more form send is at the bottom of the page (tag list)
            
        // This window onload removes that bug when you scroll past the activation point, but not whole 1 page
        $(window).on("load", function(e){
            
                // Add results on scroll
            
            let canRun = true;
            $(window).on("scroll", function(e){
                requestAnimationFrame(function(){
                    if (canRun && parseFloat($(".result_number").val()) <= $(".recipe-div").length){

                        if($(document).height() <= $(window).scrollTop() + ($(window).height() * 2)){
                            requestAnimationFrame(function(){
                                successFunc = function(response){
                                    $(".recipe-list").append(response);
                                    switchTypes();
                                }
                                requestAnimationFrame(function(){
                                    loadResults(e);
                                });
                            });
                        }
                        canRun = false;
                        setTimeout(function(){
                            canRun = true;
                        }, 25);

                    }
                });
            });
        });
            
        function displayProductPlaceholder(){
            $.ajax({
                url: "Php/display-product-placeholder.php",
                success: function(response){
                    $(".product-details").html(response);
                }
            });
        }

        // Don't delete this, without it the first 10 results have no images on edge :c
        $(window).on("load", function(e){
            displayResults(e);
        });

        // Send the serach form when the page is loaded
        $(document).ready(function(){

            // Product placeholder text "Choose a product"
            displayProductPlaceholder();
            
                // Get the tag from the URL parameter and search it

            let urlTag = new URLSearchParams(window.location.search);
            let storedTag = urlTag.get('productLink');

            // Remove the tag parameter from the URL
            let noParamUrl = window.location.href.replace(/[?&]productLink=([^&#]*)/i, '');
            window.history.replaceState({}, document.title, noParamUrl);

            if(storedTag == undefined || storedTag == ""){
                storedTag = "";
                return;
            }

            let resultsFound = false;

            // Insert the product name to the search bar (via DB)
            // Then display the search results
            $.ajax({
                type: "post",
                url: 'Php/sb-product-name.php',
                data: {"id": storedTag},
                success: function(response){

                    // Check if there is a result
                    if (response != ""){
                        resultsFound = true;
                        responseResult = response;
                    } else {
                        responseResult = "Brak produktu w bazie danych";
                    }
                    
                    $("#search-bar").val(responseResult);
                    
                    // Search the product name
                    $.ajax({
                        type: "post",
                        url: 'Php/display-product-list.php',
                        data: {"search-bar": responseResult},
                        success: function(response){
                            $(".recipe-list").html(response);

                            // Scroll to the main header
                            $('html').animate({
                                scrollTop: $(".main-header h2").offset().top
                            }, 250);

                            switchTypes();
                            
                            // Display product details
                            $.ajax({
                                type: "post",
                                url: 'Php/display-product-details.php',
                                data: {"id": storedTag},
                                success: function(response){
                                    $(".product-details").html(response);

                                    // Display the placeholder if there are no results / open details when there are
                                    if (resultsFound){
                                        $(".dp-container").addClass("dp-open"); 
                                    } else {
                                        displayProductPlaceholder();
                                    }
                                }
                            });

                        }
                    });
                }
            });

            // Reset the result number
            if($(document).height() >= $(window).scrollTop() + ($(window).height() * 2)){
                $(".result_number").val(10);
            }

            // Display the product details / choose a product msg


        });
                        
            // Show the product details after clicking on it
            
        $(function(){
            $(".recipe-list").on('click', ".product-link", function(e){
                e.preventDefault();
                let product = $(this).attr('id');

                $.ajax({
                    type: "post",
                    url: 'Php/display-product-details.php',
                    data: {"id": product},
                    success: function(response){
                        $(".product-details").html(response);     
                    }
                });
            });
        });
        </script>
        <script src="Scripts/navigation.js"></script>
        <script src="Scripts/product-tags.js"></script>
        <!-- JS for "recipe-faded" is in display-product-list.php at the end-->
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
                    <h3>Lista Produktów</h3>
                </div>
            </div>
        </header>
    <!-- /BANNER-PARALLAX -->
        
    <!-- BACKGROUND -->
        <div class="main-bg-grad" id="main-bg-grad"></div>
        <div class="main-background"></div>
    <!-- /BACKGROUND -->
        
 <?php                                             
    $arrowIcon = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 426.3 255.4' xmlns:v='https://vecta.io/nano'><path d='M414 12.2l-.3-.2a43.13 43.13 0 0 0-29.4-12C373-.1 362.1 4.4 354 12.4L213.6 153.6h0 0 0L73.2 12.4C65.1 4.4 54.2-.1 42.9 0a43.13 43.13 0 0 0-29.4 12l-.3.2C-3.3 29-3.1 56 13.5 72.6l170.7 170.6c8.2 8 18.8 12.1 29.3 12.2h.1 0 0 0c10.6-.1 21.2-4.2 29.4-12.2L413.7 72.6c16.6-16.6 16.8-43.6.3-60.4z'/></svg>";
?>
        
        <main>
            
            <div class="display-product">
                <div class="dp-padding"></div>
                <div class="dp-container">
                    <div class="dp-button">
                        <?php echo $arrowIcon; ?>
                    </div>
                    <div class="dp-container-inner">
                        <div class="product-details"></div>
                    </div>
                </div>
            </div>
            
    <!-- MAIN-MODULE -->
            <div class="wrapper">
                
                <div class="space"></div>

                <div class="main-header">
                    <h2>Lista Produktów</h2>
                </div>
                
                <div class="main-module">
                    <div class="main-module-content" id="main-module-content">
                        
        <div class="toolbar">

            <form method="POST" enctype='multipart/form-data' id="search-form" class="search-form">

                <input type="hidden" class="result_number" name="result_number" value="10">

                <div class="search-bar-div">
                    <input type="text" class="search-bar" placeholder="Szukaj" id="search-bar">
                </div>
                
                <div class="search-form-lists">
                    <div class="sort-div sfl-div">
                        <input type="submit" id="sort_submit">
                        <label for="sort">Sortuj</label>
                        <select name="sort" id="sort" class="sort" onchange="$('#sort_submit').submit()" autocomplete='off'>
                            <optgroup label="Alfabetycznie">
                                <option value="alphabet"> 
                                    A-Z
                                </option>
                                <option value="alphabet_rev">
                                    Z-A
                                </option>
                            </optgroup>
                            <optgroup label="Ocena">
                                <option value="rating_low"> 
                                    Oceny rosnąco
                                </option>
                                <option value="rating_high">
                                    Oceny majeląco
                                </option>
                            </optgroup>
                            <optgroup label="Całość">
                                <option value="kcal_low_all">
                                    Kalorie (rosnąco, całość)
                                </option>
                                <option value="kcal_high_all">
                                    Kalorie (malejąco, całość)
                                </option>
                                <option value="protein_low_all">
                                    Białko (rosnąco, całość)
                                </option>
                                <option value="cp_low_all">
                                    WW (rosnąco, całość)
                                </option>
                                <option value="cp_high_all">
                                    WW (malejąco, całość)
                                </option>
                                <option value="wpts_low_all">
                                    WBT (rosnąco, całość)
                                </option>
                                <option value="wpts_high_all">
                                    WBT (malejąco, całość)
                                </option>
                            </optgroup>
                            <optgroup label="100g">
                                <option value="kcal_low_100">
                                    Kalorie (rosnąco, 100g)
                                </option>
                                <option value="kcal_high_100">
                                    Kalorie (malejąco, 100g)
                                </option>
                                <option value="protein_low_100">
                                    Białko (rosnąco, 100g)
                                </option>
                                <option value="cp_low_100">
                                    WW (rosnąco, 100g)
                                </option>
                                <option value="cp_high_100">
                                    WW (malejąco, 100g)
                                </option>
                                <option value="wpts_low_100">
                                    WBT (rosnąco, 100g)
                                </option>
                                <option value="wpts_high_100">
                                    WBT (malejąco, 100g)
                                </option>
                            </optgroup>
                            <optgroup label="Porcja/Sztuka">
                                <option value="kcal_low_portion">
                                    Kalorie (rosnąco, porcja)
                                </option>
                                <option value="kcal_high_portion">
                                    Kalorie (malejąco, porcja)
                                </option>
                                <option value="protein_low_portion">
                                    Białko (rosnąco, porcja)
                                </option>
                                <option value="cp_low_portion">
                                    WW (rosnąco, porcja)
                                </option>
                                <option value="cp_high_portion">
                                    WW (malejąco, porcja)
                                </option>
                                <option value="wpts_low_portion">
                                    WBT (rosnąco, porcja)
                                </option>
                                <option value="wpts_high_portion">
                                    WBT (malejąco, porcja)
                                </option>
                            </optgroup>
                        </select>
                    </div>
    
                    <div class="food-type-div sfl-div">
                        <input type="submit" id="food_type_submit">
                        <label for="food_type">Typ</label>
                        <select name="food_type" id="food_type" class="food_type" onchange="$('#food_type_submit').submit()" autocomplete='off'>
                            <option value="all_types">
                                Wszystkie typy
                            </option>
                            <option value="drinks">Napoje</option>
                            <option value="sweets_snacks">Słodycze i Przekąski</option>
                            <option value="baked_goods_pastry">Pieczywo i Ciasta</option>
                            <option value="grains_pasta">Zboża i Makarony</option>
                            <option value="fruits_vegetables">Owoce i Warzywa</option>
                            <option value="meat_dairy">Mięso i Nabiał</option>
                            <option value="vege_vegan">Vege i Vegan</option>
                            <option value="ready_meals">Gotowe Dania</option>
                            <option value="semi_finished">Półprodukty</option>
                            <option value="sauces_spices">Sosy i Przyprawy</option>
                            <option value="other">Inne</option>
                        </select>
                    </div>
                    
                    <div class='shop-list'>
                        <label for='sl-btn'>Sklepy</label>
                        <p class='sl-btn' id='sl-btn'>Wybierz sklepy</p>
                        <div class='sl-items'>
                            <div class='sl-items-inner'>
                                <div class='sl-item'>
                                    <div class='cdg-line'></div>
                                    <label class='sl-group-label'>Sklepy</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rating-range">
                        <div class="range-slider">
                            <input type="range" min="1" max="10" value="7" id="rs-min" class="rs-input">
                            <input type="range" min="1" max="10" value="10" id="rs-max" class="rs-input">

                            <div id='rs-markers' class='rs-markers'></div>

                            <span id="rs-label-min" class="rs-label"></span>
                            <p class="rating-label">Oceny</p>
                            <span id="rs-label-max" class="rs-label"></span>
                        </div>

                        <input type="checkbox" id="rs-check" class="rs-check">
                    </div>

                </div>
                
                <div class="tag-filters"></div>
                <div class="current-tags"></div>
            </form>

        </div>
                        <div class="main-module-header">
                            <h3>Wszystkie typy</h3>
                        </div>
                        <div class="recipe-list">
                            <?php
                                require "Php/display-product-list.php";
                            ?>
                        </div>
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
    // Something with page refresh after sending the form, don't remember what exactly
    if (window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
    }
    
        /* Shop List (tags) */

    // Array with the shop names
    let shopNames = [
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
    ]
    
    // Insert shops into the select element (function)
    function insertShops(){
        for (let item = 0; item < shopNames.length; item++){
            
            let shop = shopNames[item];
            
            $(".sl-items-inner").append(
                "<div class='sl-item'>" +
                    "<input type='checkbox'" + 
                        "name='slcheckbox[]'" + 
                        "id='shop"+item+"'" + 
                        "class='sl-checkbox'" +
                        "value='"+shop+"'>" +

                    "<label for='shop"+item+"'>" +
                        shop +
                    "</label>" +
                "</div>"
            );
        }
    }
    
    let currentShops = "";
    
    function removeCurrShop(currTag){
        if (currTag){

            let currTfItems;

            // Remove the "checked" attribute from the checkbox when clicking on the current tag
            $(".sl-checkbox").each(function(){
                if ($(this).prop('checked') && $(this).attr("id") == currTag.attr("id")){
                    $(this).prop('checked', false);
                    currTfItems = $(this).closest('.sl-items');
                }
            });

                // Remove the clicked current shop (tag) from the currentShops

            let removedShop = $(currentShops).filter(function(){
                return $(this).attr('id') === currTag.attr("id");
            }).prop('outerHTML');

            if (removedShop){
                removedShop = removedShop.replace(/"/g, "'");
                currentShops = currentShops.replace(removedShop, "");
            }

            // Update the tag filter button inner content (tags)
            if (currTfItems){
                let currTfBtn = currTfItems.siblings(".sl-btn");

                let tfChckbox = currTfItems.find(".sl-checkbox:checked").map(function(){
                    return $(this).siblings("label").html();
                }).get();

                let tfChckboxArray = tfChckbox.join(", ");

                currTag.remove();
                currTfBtn.html(tfChckboxArray);

                if (currTfBtn.html() === ""){
                    currTfBtn.html("Wybierz sklepy")
                }
            }
            
        }
    }
    
    $(document).ready(function(){
        insertShops();
        
            // Open / close shop list
        
        $('.sl-btn').on('click', function() {
            let tagFilter = $(this).parent('.shop-list');
            tagFilter.toggleClass('sl-open');
        });

        $(window).on("click", function(e){
            if($(".shop-list").has(e.target).length === 0){
                $(".shop-list").removeClass("sl-open");
            }
        });
        
            // Insert selected shops to the select
            
        $(".sl-checkbox").on("click", function(){
            let currSlItems = $(this).closest('.sl-items');
            let currSlBtn = currSlItems.siblings(".sl-btn");

            let slChckbox = currSlItems.find(".sl-checkbox:checked").map(function(){
                return $(this).siblings("label").html();
            }).get();

            let slChckboxArray = slChckbox.join(", ");

            currSlBtn.html(slChckboxArray);

            if (currSlBtn.html() === ""){
                currSlBtn.html("Wybierz sklepy")
            }
        });

            // Current shops (list of the chosen shops)

        $(".sl-checkbox").on("input", function(e){
            
            let currTags = $(".current-tags");
            let currChckId = $(this).attr("id");
            let currChckLabel = $(this).siblings("label").html();
            
            // Send the form
            $(".result_number").val(10);
            successFunc = function(response){
                $(".recipe-list").empty();
                $(".recipe-list").append(response);
                switchTypes();
            }
            displayResults(e);
            
            // Append / remove the selected tag from the current tags list
            let shopAdd = "<div class='current-tag' " +
                    "id='"+currChckId+"'>" + 
                        "<p>" +
                            currChckLabel +
                        "</p>" + 
                        "<div class='ct-remove'>" +
                            "<span></span><span></span>" +
                        "</div>" + 
                "</div>";
            
            if ($(this).prop('checked') && currTags.children("#"+currChckId).length === 0){
                currTags.append(shopAdd);
                currentShops += shopAdd;
            } else {
                currTags.children("#"+currChckId).remove();
                currentShops = currentShops.replace(shopAdd, "");
            }
            
            // Call the removeCurrShop function + send the form
            $(".current-tag").on("click", function(e){
                
                let currTag = $(this);
                removeCurrShop(currTag);
                
                // Send the form
                $(".result_number").val(10);
                successFunc = function(response){
                    $(".recipe-list").empty();
                    $(".recipe-list").append(response);
                    switchTypes();
                }
                displayResults(e);
            });
        });

    });
    
        /* Generate tag lists from the tag arrays (product-tags.js) */

    function generateTagLists(){
        
        // Remove previously generated select lists
        $(".tag-filter").remove();

        // Create variables for array names
        let foodType = $(".food_type").val();
        let arrayLabelNames = foodType + "Labels";
        let arrayListNames = foodType + "List";

        for (let arr = 0; arr < tagArrays.length; arr++){
            if (foodType == tagArrays[arr]){

                let tagLabels = eval(arrayLabelNames);
                let tagList = eval(arrayListNames);

                // Set the group number so the items can be assigned to the correct select
                let groupNr = 0;

                for (let item = 0; item < tagLabels.length; item++){

                    if (tagLabels[item].indexOf("--group--") != -1){

                        // Create the select from a group
                        let group = tagLabels[item].replace('--group--','');
                        groupNr += 1;

                        $(".tag-filters").append(
                            "<div class='tag-filter tag-filter"+groupNr+"'>" +
                                "<label for='tf-btn'>"+group+"</label>" +
                                "<p class='tf-btn' id='tf-btn'>Wybierz tagi</p>" +
                                "<div class='tf-items'>" +
                                    "<div class='tf-items-inner tf-items-inner"+groupNr+"'>"+
                                        "<div class='tf-item'>" +
                                            "<div class='cdg-line'></div>" +
                                            "<label class='tf-group-label'>" + group + "</label>" +
                            "</div></div></div></div>"
                        );

                    } else if (tagLabels[item].indexOf("--subgroup--") != -1){

                        // Create a subgroup
                        let subgroup = tagLabels[item].replace('--subgroup--','');

                        $(".tf-items-inner"+groupNr).append(
                            "<div class='tf-item'>" +
                                "<div class='cdg-line'></div>" +
                                "<label class='tf-group-label'>" + subgroup + "</label>" +
                            "</div>"
                        );

                    } else {
                        
                        // Create an item (tag)
                        $(".tf-items-inner"+groupNr).append(
                            "<div class='tf-item'>" +
                                "<input type='checkbox'" + 
                                    "name='tfcheckbox[]'" + "id='"+groupNr+"-tfcheck"+item+"'" + 
                                    "class='tf-checkbox'" +
                                    "value='"+tagList[item]+"'>" +
                            
                                "<label for='"+groupNr+"-tfcheck"+item+"'>" +
                                    tagLabels[item] +
                                "</label>" +
                            "</div>"
                        );
                    }

                }
            }
        }
    }
    
    $(".food_type").on("input", function(){
        generateTagLists();
        $(".current-tags").html(currentShops);
        
        // Send the form
        $('.tf-items input').on('input', function(e){
            $(".result_number").val(10);
            successFunc = function(response){
                $(".recipe-list").empty();
                $(".recipe-list").append(response);
                switchTypes();
            }
            displayResults(e);
        });
        
            // Tag filter custom "select" list
        
        // Toggle the tag list after tag-filter button click (select)
        $('.tf-btn').on('click', function() {
            let tagFilter = $(this).parent('.tag-filter');
            tagFilter.toggleClass('tf-open');
            tagFilter.siblings('.tag-filter').removeClass('tf-open');
        });

        $(window).on("click", function(e){
            if($(".tag-filter").has(e.target).length === 0){
                $(".tag-filter").removeClass("tf-open");
            }
        });

        // Insert tags to the select
        $(".tf-checkbox").on("click", function(){
            let currTfItems = $(this).closest('.tf-items');
            let currTfBtn = currTfItems.siblings(".tf-btn");
            
            let tfChckbox = currTfItems.find(".tf-checkbox:checked").map(function(){
                return $(this).siblings("label").html();
            }).get();
            
            let tfChckboxArray = tfChckbox.join(", ");

            currTfBtn.html(tfChckboxArray);

            if (currTfBtn.html() === ""){
                currTfBtn.html("Wybierz tagi")
            }
        });
        
            // Current tags (list of the chosen tags)

        $(".tf-checkbox").on("input", function(){
            
            let currTags = $(".current-tags");
            let currChckId = $(this).attr("id");
            let currChckLabel = $(this).siblings("label").html();
            
            // Append / remove the selected tag from the current tags list
            if ($(this).prop('checked') && currTags.children("#"+currChckId).length === 0){
                currTags.append(
                    "<div class='current-tag'" +
                        "id='"+currChckId+"'>" + 
                            "<p>" +
                                currChckLabel +
                            "</p>" + 
                            "<div class='ct-remove'>" +
                                "<span></span><span></span>" +
                            "</div>" + 
                    "</div>"
                );
            } else {
                currTags.children("#"+currChckId).remove();
            }
            
            $(".current-tag").on("click", function(e){

                let currTag = $(this);
                let currTfItems;

                // Remove the "checked" attribute from the checkbox when clicking on the current tag
                $(".tf-checkbox").each(function(){
                    if ($(this).prop('checked') && $(this).attr("id") == currTag.attr("id")){
                        $(this).prop('checked', false);
                        currTfItems = $(this).closest('.tf-items');
                    }
                });
                
                // Update the tag filter button inner content (tags)
                if (currTfItems){
                    let currTfBtn = currTfItems.siblings(".tf-btn");

                    let tfChckbox = currTfItems.find(".tf-checkbox:checked").map(function(){
                        return $(this).siblings("label").html();
                    }).get();

                    let tfChckboxArray = tfChckbox.join(", ");

                    currTag.remove();
                    currTfBtn.html(tfChckboxArray);

                    if (currTfBtn.html() === ""){
                        currTfBtn.html("Wybierz tagi")
                    }
                }
                
                // Send the form
                $(".result_number").val(10);
                successFunc = function(response){
                    $(".recipe-list").empty();
                    $(".recipe-list").append(response);
                    switchTypes();
                }
                displayResults(e);

            });

        });
           
        // Call the removeCurrShop function + send the form
        $(".current-tag").on("click", function(e){

            let currTag = $(this);
            removeCurrShop(currTag);

            // Send the form
            $(".result_number").val(10);
            successFunc = function(response){
                $(".recipe-list").empty();
                $(".recipe-list").append(response);
                switchTypes();
            }
            displayResults(e);
        });
  
    });
    
        // Rating slider

    // Slider rating range variables
    let rangeMin = document.getElementById("rs-min");
    let rangeMax = document.getElementById("rs-max");

    let labelMin = document.getElementById("rs-label-min");
    let labelMax = document.getElementById("rs-label-max");

    let rangeRating = document.querySelector('.rating-range');
    let rangeMarkers = document.getElementById("rs-markers");
    let rangeCheck = document.getElementById("rs-check");

    let rangeGap = 1;

    // Constant variables (don't change)
    let docElem = document.documentElement;
    let rangeLimit = rangeMin.max;
    let markerNum = rangeMax.max;

    // Enable / disable the range slider (and add a class)
    rangeCheck.addEventListener("click", function(){
        rangeRating.classList.toggle("range-active");

        if (rangeRating.classList.contains("range-active")){
            rangeMin.setAttribute("name", "rs_min");
            rangeMax.setAttribute("name", "rs_max");
        } else {
            rangeMin.removeAttribute("name");
            rangeMax.removeAttribute("name");
        }
    });

    // Set css variables for the range gap fill
    docElem.style.setProperty('--rangeLimit', rangeLimit);

    function rangeGapFill(){
        docElem.style.setProperty('--rangeMin', rangeMin.value);
        docElem.style.setProperty('--rangeMax', rangeMax.value);
    }

    // Insert current values into the labels
    function insertLabelValues(){
        labelMin.innerHTML = rangeMin.value;
        labelMax.innerHTML = rangeMax.value;
    }

    // Above functions on page load
    window.onload = insertLabelValues(), rangeGapFill();

    // Set the rangeMin thumb behavior
    rangeMin.oninput = function(){
        let rangeMinVal = parseFloat(rangeMin.value);
        let rangeMaxVal = parseFloat(rangeMax.value);

        if (rangeMinVal > rangeMaxVal - rangeGap){
            rangeMax.value = rangeMinVal + rangeGap;

            if (rangeMaxVal == rangeMax.max){
                rangeMin.value = parseInt(rangeMax.max) - rangeGap;
            }
        }
        rangeGapFill();
        insertLabelValues();
    }

    // Set the rangeMax thumb behavior
    rangeMax.oninput = function(){
        let rangeMinVal = parseFloat(rangeMin.value);
        let rangeMaxVal = parseFloat(rangeMax.value);

        if (rangeMaxVal < rangeMinVal + rangeGap){
            rangeMin.value = rangeMaxVal - rangeGap;

            if (rangeMinVal == rangeMin.min){
                rangeMax.value = rangeGap + 1;
            }
        }
        rangeGapFill();
        insertLabelValues();
    }

        // If the gap is set to 0, then make sum magic on click, so the slider is still usable

    rangeMax.onmousedown = function(){
        preventThumbHide();
        rangeGapFill();
        insertLabelValues();
    }

    function preventThumbHide(){
        let rangeMinVal = parseFloat(rangeMin.value);
        let rangeMaxVal = parseFloat(rangeMax.value);

        if (rangeMinVal == rangeMaxVal){
            if (rangeMaxVal == rangeLimit){
                rangeMin.value = rangeMaxVal - 1;
            }
            if (rangeMaxVal < rangeLimit){
                rangeMax.value = rangeMinVal + 1;
            }
        }
    }

    // If the range silder has gap set to 0, send the form on the max thumb click
    $(document).ready(function(){
        if (rangeGap == 0){
            $("#rs-max").on('click', function(e){
                $(".result_number").val(10);
                successFunc = function(response){
                    $(".recipe-list").empty();
                    $(".recipe-list").append(response);
                    switchTypes();
                }
                displayResults(e);
            });
        }
    });

    // Generate markers
    for (let rsm = 1; rsm <= markerNum; rsm++){
        rangeMarkers.innerHTML += "<span class='rs-marker rs-marker"+rsm+"'></span>";
    }

        /* Sticky container */

        // Sticky container variables
    
    let scBg = ".display-product"
    let scContainer = $(".dp-container");
    let scBtn = $(".dp-button");
    let scScrollBtn = 'dp-scroll-btn'
    let scClose = "dp-close";
    let scOpen = "dp-open";

        // Toggle the open class

    scBtn.on("click", function(e){
        scContainer.toggleClass(scOpen);
        e.stopPropagation();
    });
    
    $(".recipe-list").on("click", ".product-link", function(e){
        scContainer.addClass(scOpen);
        e.stopPropagation();
    });

    // Close the container when clicking outside (excl. product link)
    $(window).on("click", function(e){
        if(!$(e.target).is(scBg) && 
        $(scBg).has(e.target).length === 0 ||

        $(e.target).hasClass(scScrollBtn) ||

        $(e.target).hasClass(scClose)){
            scContainer.removeClass(scOpen);
        }
    });
    
    // Close the container when clicking the escape button
    document.addEventListener("keydown", function(e){
        if (e.keyCode === 27){
            scContainer.removeClass(scOpen);
        }
    });
    
        /* Close the product details on swipe gesture */

    function swipeClose(){  

            // Set these variables (all relative to innerWidth / innerHeight)

        // Min horizontal swipe distance 
        let minSwipeWidth = window.innerWidth * 0.45;

        // Max vertical swipe distance  
        let maxSwipeHeight = window.innerHeight * 0.15;

        // Min start point from the edge
        let swipeStartPoint = window.innerWidth * 0.05;

        // Max start point from the edge
        let swipeEndPoint = window.innerWidth * 0.35;

            // Don't change these

        // Set the swipe min and max start point from the right edge
        const swipeRightStartPoint = window.innerWidth - swipeStartPoint;
        const swipeRightEndPoint = window.innerWidth - swipeEndPoint;

            // Track touch start and end coordinates

        let touchStartX = null;
        let touchEndX = null;


        function handleTouchStart(e){
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }

            // Check the conditions and perform the action

        function handleTouchEnd(e){

            // Calculate the swipe X and Y lengths
            touchEndX = e.changedTouches[0].clientX;
            touchEndY = e.changedTouches[0].clientY;
            let swipeWidth = Math.abs(touchEndX - touchStartX);
            let swipeHeight = Math.abs(touchEndY - touchStartY);

            // check the requirements
            if (swipeWidth >= minSwipeWidth &&
                swipeHeight <= maxSwipeHeight){

                if (touchStartX >= swipeStartPoint && 
                touchStartX <= swipeEndPoint ||
                touchStartX <= swipeRightStartPoint && 
                touchStartX >= swipeRightEndPoint){

                    scContainer.removeClass(scOpen);

                }
            }

            // Reset touch start and end coordinates
            touchStartX = null;
            touchEndX = null;
        }

        // Listen for the swipe (if the window is <= 1024 px wide)
        let dpContainer = document.querySelector(".dp-container");
        
        if (window.innerWidth <= 1024){
            
            dpContainer.ontouchstart = function(e){
                handleTouchStart(e);
            } 
            dpContainer.ontouchend = function(e){
                handleTouchEnd(e);
            }
            
        } else {
            dpContainer.ontouchstart = null;
            dpContainer.ontouchend = null;
        }
    }

    // Call the function on load and window resize
    swipeClose();
    window.addEventListener("resize", swipeClose);
</script>
    </body>
</html>



