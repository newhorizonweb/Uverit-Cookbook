<!doctype html>
<html lang="pl-PL">
        
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Lista Przepisów</title>
        <meta name="description" content="Lista przepisów ze szegółowymi informacjami. Znajdź najlepszą wersję ulubionego dania.">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/recipe-list.css">
        
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
                case "time_low_active":
                case "time_high_active":
                    $(".time-div:nth-of-type(1) p").addClass("current-sort");
                break;
                
                case "time_low_total":
                case "time_high_total":
                    $(".time-div:nth-of-type(3) p").addClass("current-sort");
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
                    mainHeader.innerHTML = "Brak Przepisów";
                    mainHeader.style.paddingBottom = "80px";
                } else {
                    let foodType = document.querySelector(".food_type").selectedOptions[0];
                    let foodName = foodType.textContent;

                    mainHeader.innerHTML = foodName || "Wszystkie typy";
                    mainHeader.style.paddingBottom = "20px";
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
                url: 'Php/display-recipe-list.php',
                data: formData,
                processData: false,
                contentType: false,
                success: successFunc
            });
        }
            
            // Send the serach form
            
        $(function(){
            $('#search-form').on('input', function(e){
                $(".result_number").val(10);
                successFunc = function(response){
                    $(".recipe-list").empty();
                    $(".recipe-list").append(response);
                    switchTypes();
                }
                displayResults(e);
            });
        });

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
            
            // Get the tag from the URL parameter and search it
            
        let urlTag = new URLSearchParams(window.location.search);
        let storedTag = urlTag.get('storedTag');
            
        // Remove the tag parameter from the URL
        let noParamUrl = window.location.href.replace(/[?&]storedTag=([^&#]*)/i, '');
        window.history.replaceState({}, document.title, noParamUrl);

        // Send the serach form when the page is loaded
        $(document).ready(function(){
                    
            // Don't delete this, without it the first 10 results have no images on edge :c
            $(window).on("load", function(e){
                displayResults(e);
            });
            
            // Insert the storedTag value into the search-bar
            let searchBarVal = "";
            if (storedTag != ""){
                searchBarVal = storedTag;
            } else {
                searchBarVal = "Brak przepisów";
            }
            
            document.getElementById("search-bar").value = searchBarVal;

            // Reset the search result number
            if($(document).height() >= $(window).scrollTop() + ($(window).height() * 2)){
                $(".result_number").val(10);
            }

            // The search-bar should be the only data c:
            $.ajax({
                type: "post",
                url: 'Php/display-recipe-list.php',
                data: {"search-bar": storedTag},
                success: function(response){
                    $(".recipe-list").html(response);
                    switchTypes();
                    
                    // Scroll to the main header
                    if (storedTag != null){
                        $('html').animate({
                            scrollTop: $(".main-header h2").offset().top - 50
                        }, 250);
                    }
                }
            });
        });
        </script>
        <script src="Scripts/navigation.js"></script>
        <script src="Scripts/recipe-tags.js"></script>
        <!-- JS for "recipe-faded" is in display-recipe-list.php at the end-->
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
                    <h3>Lista Przepisów</h3>
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
                    <h2>Lista Przepisów</h2>
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
                            <optgroup label="Czas">
                                <option value="time_low_active">
                                    Aktywny (rosnąco)
                                </option>
                                <option value="time_high_active">
                                    Aktywny (malejąco)
                                </option>
                                <option value="time_low_total">
                                    Całkowity (rosnąco)
                                </option>
                                <option value="time_high_total">
                                    Całkowity (malejąco)
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
                            <option value="dishes">
                                Dania
                            </option>
                            <option value="desserts">
                                Desery
                            </option>
                            <option value="snacks">
                                Przekąski
                            </option>
                            <option value="other">
                                Inne
                            </option>
                        </select>
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
                                require "Php/display-recipe-list.php";
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

        // Generate the tag lists from the tag arrays (product-tags.js)

    function generateTagLists(){

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
    
    $(window).on("load", function(){
        generateTagLists();
        $(".current-tags").html("");
        
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
  
    });
</script>
    </body>
</html>
