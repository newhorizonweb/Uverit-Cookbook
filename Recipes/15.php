


<!doctype html>
    <html lang=en>
        
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Add Recipes</title>
        <meta name="description" content="Simple recipes for people with diabetes.">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        
        <!-- Settings -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../Styles/general.css">
        <link rel="stylesheet" type="text/css" href="../Styles/index.css">
        
        <!-- Scripts -->
        <script src="../Scripts/jquery-3.6.0.min.js"></script>
        <script src="../Scripts/ScriptPack-min.js" defer></script>
    </head>
        
    <body>
        
        <div id="hidden-contents"> 
            
    <!-- SCROLLTOP -->
            <div id="scrolltop" onclick="scrollToTop()">
                <img src="../Images/scrolltop-uparrow.svg" class="scrollarrow" alt="scroll arrow">
            </div>
    <!-- /SCROLLTOP -->
        
        </div>
        
        <nav>

    <!-- NAVBAR -->
            <div id="nav2">
            <div class="nav-help">
                <a href="index.html" id="nav-logo">
                    <img src="../Images/uverit-w.svg" alt="Business logo" id="nav-logo-img" oncontextmenu="window.event.returnValue=false;">
                </a>

                <div class="nav-elements">
                
                    <div class="navbar">
                        <div class="navbar-inner">
                        <ul>
                            <li>
                                <p>Length Units</p>
                            </li>
                            <li>
                                <a href="popular.html" class="nav-link">Popular</a>
                            </li>
                            <li>
                                <a href="sub.html" class="nav-link">Sub</a>
                            </li>
                            <li>
                                <a href="astronomy.html" class="nav-link">Astronomy</a>
                            </li>
                            <li>
                                <a href="marine.html" class="nav-link">Marine</a>
                            </li>
                            <li>
                                <a href="archaic.html" class="nav-link">Archaic</a>
                            </li>
                        </ul>
                    </div>
                    </div>
                    
                    <h5 class="toggle-text">Zmień Tryb</h5>

                    <div class="toggle1">
                        <input type="checkbox" onclick="themeToggle()" class="dmbtn" id="toggle">
                        <label for="toggle"></label>
                    </div>

                    <div class="burger-btn" onclick="navBurger(e)">
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
                        <h3>Dodaj swój przepis</h3>
                    </div>
                </div>
            </div>
    <!-- /BANNER1-PARALLAX -->
            
        </header>
        
        <main>
            
    <div class="space"></div>
            
    <!-- MAIN-MODULE -->
            <div class="wrapper">
                
                <div class="main-header">
                    <h2>Dodaj przepis</h2>
                </div>
                
                <div class="main-module">
                    <div class="main-module-content">

                    <?php                        
                    function display(){
                        $con = mysqli_connect("localhost", "root", "", "cookbook");

                        $sql = "SELECT * FROM recipes WHERE id = 
                            '15'                        ";
                        
                        $res = mysqli_query($con,$sql);

                        while($row = mysqli_fetch_assoc($res)) {
                            $name = $row['name'];
                            $description = $row['description'];
                            $date = $row['date'];
                            $image = $row['image'];
                            $fat = $row['fat'];

                            echo $name;
                            echo "<br>";
                            echo $description;
                            echo "<br>";
                            echo $date;
                            echo "<br>";
                            echo $image;
                            echo "<br>";
                            echo $fat;
                        }

                        mysqli_close($con);
                    }

                    display(); 
                        
                    ?>                        
                    </div>
                </div>

            </div>
    <!-- /MAIN-MODULE -->
            
    <div class="space"></div>

        </main>
        
        <footer>

    <!-- FOOTER3 -->
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
    <!-- /FOOTER3 -->

        </footer>
    </body>
        
</html>



