<!doctype html>
<html lang="pl-PL">
        
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Modyfikuj Produkty</title>
        <meta name="description" content="Popraw błędy, zmień właściwości, zmodyfikuj lub usuń dodany produkt.">
        <meta name="keywords" content="diabetes, products, tasty, simple, sugar free, no sugar, healthy, low kcal">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/add-products.css">
        <link rel="stylesheet" type="text/css" href="Styles/modify-content.css">
        
        <!-- Scripts -->
        <script src="Scripts/jquery-3.6.0.min.js"></script>
        <script src="Scripts/ScriptPack-min.js" defer></script>
        <script>
            
            // Remove the appear class from the search-bar
            
        $(window).on('click', function(){
            if ($(".search-form").hasClass("appear")){
                $(".search-form").removeClass("appear");
            }
        });
            
            // Set min-height to the main-content on window resize & click
            
        $(window).on('click', function(e){
            contentHeight();
            
            if(e.target.className !== 'search-list'){
                $(".search-list").removeClass("appear");
                document.getElementById('main-module-content').style.minHeight = "10px";
            }
        });
            
        $(window).on('resize', function(e){
            contentHeight();
        });

        function contentHeight(){
            if ($(".search-list").children("li").length > 0 && $(".search-list").hasClass("appear")){
                var divHeight = $('.search-list').height() + 40; 
                $('#main-module-content').css('min-height', divHeight+'px');
            } else {
                document.getElementById('main-module-content').style.minHeight = "10px";
            }
        }
            
        // Display a message when there is no results
        function nullList(){
            let searchList = $(".search-list");
            // Have to call for :not(script) too, since the display-list has a js script in it
            if (searchList.children("*:not(.empty-list)").length === 0){
                $(".search-list").append(
                    "<li class='empty-list'>" +
                        "<span class='el-line'></span>" +
                        "<h4>Brak Produktów</h4>" +
                        "<span class='el-line'></span>" +
                    "</li>");
            }
            $(".empty-list").on("mouseover", function(){
                $(".empty-list h4").html("Usuń Wyszukiwanie");
            });
            $(".empty-list").on("mouseout", function(){
                $(".empty-list h4").html("Brak Produktów");
            });
            $(".empty-list").on("click", function(){
                $(".search-bar").focus();
                $(".search-bar").val("");
            });
        }

            // Show search results
            
        $(function(){ 
        $('#search-form').on('input click', 'input.search-bar', function(e){
            // the onclick event has to be on the search-bar, otherwise it will reappear the search result list after clicking on the <li> (product)
            
            e.preventDefault();
            let searchBar = document.querySelector(".search-bar").value.length;
            let searchResult = $(this).val();

            if (searchBar > 1) {
                $.ajax({
                    type: "post",
                    url: 'Php/search-bar-modify-products.php',
                    data: { "search-bar": searchResult },
                    success: function(response) {
                        $(".search-results").html(response);
                        nullList();
                       
                        // Add or delete the appear class and set min-height to the main-content depending if there are any results
                        $(".search-form").removeClass("appear");
                        if($(".search-list").children().length > 0){
                            $(".search-form").addClass("appear");
                        }
                        
                        let divHeight = $('.search-list').height() + 40; 
                        $('.main-module-content').css('min-height', divHeight+'px');
                    }
                });
            } else {
                $(".search-results").html("");
                document.getElementById('main-module-content').style.minHeight = "10px";
                $(".search-form").removeClass("appear");
            }
        });
        });  
            
            // Show the product after clicking on the list
            
        $(function(){
        $("#search-form").on('click', 'li.recipe', function(e){
            e.preventDefault();
            let recipe = $(this).attr('id');

            $.ajax({
                type: "post",
                url: 'Php/display-modify-products.php',
                data: { "id": recipe },
                success: function(response) {
                    $(".modify-recipes").html(response);     
                }
            });
        })
        });
            
            // Send modified data to the database
            
        $(function(){
        $('#add_recipes_form').on('click', '#add', function(e){
            e.preventDefault();
            let sendForm = true;
            
            // Remove the error class
            $('.required').on('keydown', function(){
                $(this).removeClass('error');
            });
            $('.required').on('change', function(){
                $(this).removeClass('error');
            });
            $('#upload_image').on('change', function(){
                $("#file_style").removeClass('error');
                $('.form-s1-right').removeClass('error');
            });
            $('.calc-num').on('input', function(){
                $(this).removeClass('error');
            });
            $(document).on('click', '.sl-checkbox, .sl-item label', function(){
                $(".sl-btn").removeClass('error');
                
            });
            $('.tag-input').on('input', function(){
                $(this).removeClass('error');
            });
            
                // Form validation
            
            function addError(){
                $('#add').addClass('error');
                $('#placeholder-text').addClass('error');
                sendForm = false;
            }
            
            // Check if at least 1 tag checkbox is checked
            if ($('.tag-input').val() == '' ){
                $('.tag-input').addClass('error');
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
            })
            
            // Check if the inputs contain a number (return error class)
            $('.kcal, .fat, .carbohydrates, .fiber, .protein, .weight, .portion').each(function(){
                if ($(this).val() != "" || $(this).val() != 0){
                    if (isNaN($(this).val())){
                        $(this).addClass('error');
                        $('#placeholder-text').html("Pola powinny zawierać tylko liczby");
                        addError();
                    }
                }
            })

            // Check if the image exists on the server (return error class)
            let xhr = new XMLHttpRequest();
            let imageSrc = $("#output").attr("src");
            
            xhr.open("HEAD", imageSrc, true);
            xhr.onreadystatechange = function() {
                if (xhr.status === 404) {
                    $('#placeholder-text').html("Dodaj zdjęcie");
                    $('#file_style').addClass('error');
                    $('.form-s1-right').addClass('error');
                    addError();
                }
            };
            xhr.send();
            
            // Check if there are any shops selected
            if ($('.sl-checkbox').filter(':checked').length < 1){
                $(".sl-btn").addClass('error');
                $('#placeholder-text').html("Dodaj sklep");
                addError();
            }

            // Check if the form field is empty (return error class)
            $('.required').each(function(){
                if ($(this).val() == '' ||
                    $(this).val() == 'Wybierz typ' ||
                    $(this).val() == 'Wybierz poziom'){
                    
                    $(this).addClass('error');
                    $('#placeholder-text').html("Wypełnij formularz");
                    addError();
                }
            })
            
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
                    url: 'Php/modify-products.php',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(){
                        $(".send-block").css("display", "block");
                        
                        $("#placeholder-text").html("Produkt zaktualizowany!");
                        $("#placeholder-text").addClass('sent');
                        
                        $("#add").addClass('sent');
                        $("#add").html("<p>Zaktualizowano</p>");
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
        <!-- calc.js is in display-modify-recipes.php -->
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
                    <h3>Modyfikuj Produkty</h3>
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
                    <h2>Zmodyfikuj Produkt</h2>
                </div>
                
                <div class="main-module">
                    <div class="main-module-content" id="main-module-content">
                        <form method="POST" enctype='multipart/form-data' id="search-form" class="search-form">
                            <input type="text" name="search-bar" class="search-bar" placeholder="Szukaj..." id="search-bar">
                            <div class="search-results search-results-products"></div>
                        </form>

                        <form method='POST' enctype='multipart/form-data' id='add_recipes_form' class='add-form'>
                            <div class="modify-recipes"></div>
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
        
    </body>
</html>
        
