<!doctype html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook</title>
        <meta name="description" content="Uverit Cookbook to przepisy w ich najlepszej wersji. Mniej kalorii i cukrów prostych przy ulepszeniu smaku i użyciu łatwo dostępnych składników.">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/main.css">
        
        <!-- Scripts -->
        <script src="Scripts/jquery-3.6.0.min.js"></script>
        <script src="Scripts/ScriptPack-min.js" defer></script>
        <script src="Scripts/navigation.js"></script>
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

                <div class="main-module">
                    <div class="main-module-content">
                        
                        <script>
                            mainTiles();
                        </script>

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
            
        /* Blob c: */

    const blobElem = document.createElement("span");
    blobElem.classList.add("cursor-blob");

    document.querySelectorAll(".main-link").forEach(link => {
        link.appendChild(blobElem.cloneNode());
    });

    const cursorBlob = document.getElementsByClassName("cursor-blob");
    
    let debounceTimer;
    
    let blobDuration = 0;

    if (navigator.userAgent.indexOf("Firefox") == -1){
        // Not Firefox
        blobDuration = 2000;
    } else {
        // Firefox (idk why, but on FF the animation looks much slower)
        blobDuration = 800;
    }
    
    function blobbyBlob(e){

        if (debounceTimer) {
            clearTimeout(debounceTimer);
        }
        
        debounceTimer = setTimeout(function(){
            window.requestAnimationFrame(function(){
                for (let item = 0; item < cursorBlob.length; item++){
                    
                    let blob = cursorBlob[item];

                    let thisBlob = blob.getBoundingClientRect();
                    let thisTile = blob.parentElement.getBoundingClientRect();

                    let posX = e.clientX - thisTile.left;
                    let posY = e.clientY - thisTile.top;
                    
                    if (!blob.dataset.initialized){
                        blob.style.top = posY + "px";
                        blob.style.left = posX + "px";
                        blob.dataset.initialized = true;
                    } else {
                        blob.animate({
                            top: posY + "px",
                            left: posX + "px"
                        }, {
                            duration: blobDuration,
                            fill: "forwards"
                        });
                    }
                }
            });
            
            debounceTimer = null;
        }, 10);
    }

    document.body.addEventListener("mousemove", blobbyBlob);
    
        /* Tile fade-in/out */
    
    const tiles = document.getElementsByClassName("main-link");

    function tileFade(){
        
        for (let item = 0; item < tiles.length; item++){
        
            let tile = tiles[item];
            let tilePos = tile.parentElement.getBoundingClientRect();

            let windowHeight = window.innerHeight;

            if (tilePos.top < windowHeight * 0.9){
                tile.classList.add("fade-in");
            } else {
                tile.classList.remove("fade-in");
            }

            if (tilePos.top < -windowHeight * 0.2){
                tile.classList.remove("fade-in");
            }

        }
        
    }

    window.addEventListener("load", tileFade);
    window.addEventListener("scroll", tileFade);
    window.addEventListener("resize", tileFade);

</script>
    </body>
        
</html>
        
        
        
        
        
        
        
        
     
        
        
        
        
