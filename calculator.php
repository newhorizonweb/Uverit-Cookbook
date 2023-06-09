<!doctype html>
<html lang="pl-PL">
        
    <head>
        <meta charset="UTF-8">
        <!-- Site -->
        <!-- In-page -->
        <title>Uverit Cookbook - Kalkulator</title>
        <meta name="description" content="Kalkulator wartości odżywczych składników">
        <meta name="keywords" content="diabetes, recipes, tasty, simple, sugar free, no sugar, healthy">
        <meta name="author" content="Uverit">
        <link rel="preload" href="Images/banner1.svg" as="image">
        
        <!-- Settings -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/calculator.css">
        
        <!-- Scripts -->
        <script src="Scripts/jquery-3.6.0.min.js"></script>
        <script src="Scripts/ScriptPack-min.js" defer></script>
        <script src="Scripts/navigation.js"></script>
        <script src="Scripts/loop.js" defer></script>
        <script src='Scripts/calculator-calc.js' defer></script>
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
                    <h3>Kalkulator Wartości Odżywczych</h3>
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
    
    $gear_icon = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-2{fill:none;stroke-linecap:round;stroke-linejoin:round;}</style></defs><path class='cls-1' d='M183.3,145.8c-10.6,19.2-19.9,24.7-43.6,10.8l-1,.7a55.6,55.6,0,0,1-7.9,4.5l-1.4.8c-.8,26-6.9,33.6-28.8,33s-31.5-5.4-31.3-33.1l-1.2-.6a70.4,70.4,0,0,1-7.9-4.6l-.8-.4C36.6,169,27.3,167.1,17,148.4c-12-19.3-11.4-30.2,12.8-44-.2-3-.2-6-.1-9l-.6-.4c-22-13.6-25-22.7-13.7-41.1s20-25,43.8-10.9l.8-.7a69.5,69.5,0,0,1,7.9-4.5l1.4-.7C70.2,11,76.3,3.3,98.2,4s31.5,5.4,31.3,33.1l1.3.6a68,68,0,0,1,7.9,4.6l.6.5c22.9-12.2,32.2-10.3,42.5,8.6v.3c11.8,19,11,29.9-13,43.5v.2a43.1,43.1,0,0,1-.1,8.8v.2C191.1,118.1,195,126.9,183.3,145.8Zm-55-46a29,29,0,1,0-29,29h0A29,29,0,0,0,128.3,99.8Z'/><path class='cls-1' d='M99.3,70.8A29,29,0,1,1,70.4,99.9h0A29.1,29.1,0,0,1,99.3,70.8Z'/><path class='cls-2' d='M99.2,195.6h1.4c21.9.6,28-7,28.8-33l1.4-.8a55.6,55.6,0,0,0,7.9-4.5l1-.7c23.7,13.9,33,8.4,43.6-10.8l1-1.9-1.7,2.9a2.3,2.3,0,0,0,.7-1c11.7-18.9,7.8-27.7-14.5-41.4v-.2a43.1,43.1,0,0,0,.1-8.8v-.2c24-13.6,24.8-24.5,13-43.5v-.3l-1-1.5,1.6,2.9-.6-1.1v-.3c-10.3-18.9-19.6-20.8-42.5-8.6l-.6-.5a68,68,0,0,0-7.9-4.6l-1.3-.6C129.8,9.4,120.7,3.3,98.3,4h0c-21.9-.7-28,7-28.9,33.1l-1.4.7a70.7,70.7,0,0,0-8,4.5l-.8.7C35.4,28.9,26,34.4,15.4,53.9l-.9,1.7,1.6-3c-.2.5-.5.9-.7,1.3C4.1,72.3,7.1,81.4,29.1,95l.6.4c-.1,3-.1,6,.1,9C5.6,118.2,5,129.1,17,148.4l.9,1.4-1.7-2.9.8,1.5c10.3,18.7,19.6,20.6,42.4,8.5l.8.4a70.4,70.4,0,0,0,7.9,4.6l1.2.6c-.2,27.7,8.9,33.7,31.3,33.1h2'/><path class='cls-2' d='M128.3,99.8a29,29,0,1,1-29-29h0a29,29,0,0,1,29,29Z'/></svg>";
?>
        
        <main>
            
            <div class="calc-scroll">
                <div class="cs-padding"></div>
                <div class="cs-container">
                    <div class="cs-button">
                        <?php echo $arrowIcon; ?>
                    </div>
                    <div class="cs-container-inner">
                        <h4 class="cs-title">Kalkulatory</h4>
                        <div class="cs-close">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            
    <!-- MAIN-MODULE -->
            <div class="wrapper">
                
                <div class="space"></div>
                
                <div class="main-module">
                    <div class="main-module-content"> 
                        
                        <div class="ins-base">
                            <div class="ins-base-btn">
                                <?php echo $gear_icon; ?>
                            </div>

                            <div class="ins-calc-base">
                                <h4 class="ins-base-title">Insulina</h4>
                                
                                <div class="ins-base-item">
                                    <p title="Ilość węglowodanów w gramach, które pokrywa 1j insuliny (na śniadanie)">Śniadanie</p>
                                    <input type='tel' name="ins-amount-early" class="ins-input ins-amount-early" tabindex="-1">
                                </div>
                                
                                <div class="ins-base-item">
                                    <p title="Ilość węglowodanów w gramach, które pokrywa 1j insuliny (na obiad)">Obiad</p>
                                    <input type='tel' name="ins-amount-mid" class="ins-input ins-amount-mid" tabindex="-1">
                                </div>
                                    
                                <div class="ins-base-item">
                                    <p title="Ilość węglowodanów w gramach, które pokrywa 1j insuliny (na kolację)">Kolacja</p>
                                    <input type='tel' name="ins-amount-late" class="ins-input ins-amount-late" tabindex="-1">
                                </div>
                                    
                                <div class="ins-base-item">
                                    <p title="Ile mg/dl glukozy we krwi zbija 1j insuliny">Wart. korekcyjna</p>
                                    <input type='tel' name="bs-increase" class="ins-input bs-increase" tabindex="-1">
                                </div>
                            </div>
                        </div>           
                        
<?php
// Total number of calculators
$calculators = 7;

// Number of inputs in a column
$inpColLen = 20;

// Calculator output string
$cos = "";

for ($c = 1; $c <= $calculators; $c++){
$cos .= "<div class='$c-calc-header calc-header' scroll-button='cs-scroll-btn".$c."'>".
            "<h2>Kalkulator ".$c."</h2>".
        "</div>".  

        "<div class='calc calc$c'>".
        
        "<div class='calc-head'>".
            "<input type='text' class='calculator-name calculator-name$c' name='calculator-name$c' maxlength='48'>".

            "<select class='select-calculator select-calculator$c' autocomplete='off'>";
                for ($o = 1; $o <= $calculators; $o++){
                    if ($o == $c){
                        $cos .= "<option class='$c-sc-option".$o."' value='$o' selected></option>";
                    } else {
                        $cos .= "<option class='$c-sc-option".$o."' value='$o'></option>";
                    }
                }
$cos .=     "</select>".
        "</div>".

        "<div class='calculator calculator$c'>".

            // Generate a number list
            "<div class='list-calc-col'>".
                "<h5>&nbsp;</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<p>".$x.".</p>";
                }
$cos .=     "</div>".

            // Generate reset values buttons
            "<div class='reset-calc-col'>".
                "<h5>&nbsp;</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<div class='reset-calc-row $c-reset-calc-row".$x."'></div>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".
    
            // Generate calculator multiplier inputs / buttons
            "<div class='multi-calc-col'>".
                "<h5>Mnożnik</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<div class='multi-calc-div'>".
                        "<div class='multi-change multi-sub $c-multi-sub'><span></span></div>".
                        
                        "<input type='tel' name='$c-multi-calc".$x."' class='multi-calc $c-multi-calc $c-multi-calc".$x."'>".
                        
                        "<div class='multi-change multi-add $c-multi-add'><span></span><span></span></div>".
                    "</div>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".

            // Generate calculator weight inputs
            "<div class='weight-calc-col'>".
                "<h5 title='Waga w gramach (puste pole = 100g)'>Waga</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-weight-calc".$x."' class='weight-calc $c-weight-calc".$x." calc-num'>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".

            // Generate calculator name inputs
            "<div class='name-calc-col'>".
                "<h5>Nazwa</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='text' name='$c-name-calc".$x."' class='$c-name-calc $c-name-calc".$x."'>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".

            // Generate calculator kcal inputs
            "<div class='kcal-calc-col'>".
                "<h5 title='Kcal / 100g'>Kcal</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-kcal-calc".$x."' class='kcal-calc $c-kcal-calc".$x." calc-num'>";
                }
$cos .=         "<input class='calc-result $c-kcal-result' readonly>".
            "</div>".

            // Generate calculator fat inputs
            "<div class='fat-calc-col'>".
                "<h5 title='W gramach / 100g'>Tłuszcz</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-fat-calc".$x."' class='fat-calc $c-fat-calc".$x." calc-num'>";
                }
$cos .=         "<input class='calc-result $c-fat-result' readonly>".
            "</div>".

            // Generate calculator carb inputs
            "<div class='carb-calc-col'>".
                "<h5 title='W gramach / 100g'>Węgle</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-carb-calc".$x."' class='carb-calc $c-carb-calc".$x." calc-num'>";
                }
$cos .=         "<input class='calc-result $c-carb-result' readonly>".
            "</div>".

            // Generate calculator fiber inputs
            "<div class='fiber-calc-col'>".
                "<h5 title='W gramach / 100g'>Błonnik</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-fiber-calc".$x."' class='fiber-calc $c-fiber-calc".$x." calc-num'>";
                }
$cos .=         "<input class='calc-result $c-fiber-result' readonly>".
            "</div>".

            // Generate calculator protein inputs
            "<div class='protein-calc-col'>".
                "<h5 title='W gramach / 100g'>Białko</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-protein-calc".$x."' class='protein-calc $c-protein-calc".$x." calc-num'>";
                }
$cos .=         "<input class='calc-result $c-protein-result' readonly>".
            "</div>".
    
        "</div>".

        "<div class='ins-calc'>".

            "<div class='ins-section'>".

                "<div class='ins-div'>".
                    "<p title='Poziom glukozy we krwi, mg/dl' class='c-help'>Poz. glukozy</p>".
                    "<input type='tel' name='$c-cur-bs' class='cur-bs $c-cur-bs' placeholder='min. 30, max. 350'>".
                "</div>".

                "<div class='ins-div'>".
                    "<p>IG</p>".

                    "<select name='$c-cur-gi' class='cur-gi $c-cur-gi'>".
                        "<option value='wpts' hidden>WBT</option>".
                        "<option value='very-low-gi'>B. niski (gł. b+t)</option>".
                        "<option value='low-gi'>Niski</option>".
                        "<option value='med-gi' selected>Średni</option>".
                        "<option value='high-gi'>Wysoki</option>".
                    "</select>".

                    "<input class='cur-gi-wpts $c-cur-gi-wpts' value='WBT' readonly>".
                "</div>".

                "<div class='ins-div'>".
                    "<p>Typ posiłku</p>".
                    "<select name='$c-ins-meal-type' class='ins-meal-type $c-ins-meal-type'>".
                        "<option value='early'>Śniadanie</option>".
                        "<option value='mid' selected>Obiad</option>".
                        "<option value='late'>Kolacja</option>".
                    "</select>".
                "</div>".

            "</div>".
    
            "<div class='ins-section'>".

                "<div class='ins-div'>".
                    "<p title='Insulina na pokrycie posiłku' class='c-help'>Ins. posiłkowa</p>".
                    "<input class='calc-readonly ins-meal $c-ins-meal' readonly>".
                "</div>".

                "<div class='ins-div'>".
                    "<p title='Korekcja dawki w celu osiągnięcia optymalnego poz. gluk.' class='c-help'>Ins. korekcyjna</p>".
                    "<input class='calc-readonly ins-correction $c-ins-correction' readonly>".
                "</div>".

                "<div class='ins-div'>".
                    "<p title='Insulina posiłkowa, korekcyjna oraz dostosowanie dawki' class='c-help'>Ins. całkowita</p>".
                    "<div class='total-ins-change'>".
                        "<div class='ins-adjust ins-sub $c-ins-sub'><span></span></div>".
                        "<input class='calc-readonly ins-total $c-ins-total' readonly>".
                        "<div class='ins-adjust ins-add $c-ins-add'><span></span><span></span></div>".
                    "</div>".
                "</div>".

            "</div>".

            "<div class='ins-section'>".
                "<div class='calc-reset $c-calc-reset'>".
                    "<p class='cr-txt'>Zresetuj wszystkie pola</p>".
                "</div>".
                "<div class='calc-reset-disable'></div>".
            "</div>".

            "<div class='ins-section'>".
                "<div class='ins-div'>".
                    "<p>Przew. gluk.</p>".
                    "<input class='calc-readonly expected-bs $c-expected-bs' readonly>".
                "</div>".

                "<div class='ins-div'>".
                    "<p title='Czas iniekcji insuliny w odniesieniu do rozpoczącia posiłku' class='c-help'>Czas iniekcji</p>".
                    "<input class='calc-readonly time-before-meal $c-time-before-meal' readonly>".
                "</div>".
            "</div>".

        "</div>".

    "</div>";
}
                        
echo $cos;
?>
                    </div>
                </div>
                
                <div class="space"></div>
                <!--
                <loop for="x" start="11" stop="15" influence="none">
                    <div class="x-x--xx">
                        <p id="hemlox_alaasd">hemlo!-xvx xx</p>
                        <p id="hemlox_alaasd">hemlo!-xvx xx</p>
                        <p id="hemlox_alaasd">hemlo!-xvx xx</p>
                        <div name="hemlo_x_"><input name="xax"></div>
                    </div>                    <div class="x-x--xx">
                        <p id="hemlox_alaasd">hemlo!-xvx xx</p>
                        <div name="hemlo_x_"><input name="xax"></div><div name="hemlo_x_"><input name="xax"><input name="xax"></div>
                    </div>
                </loop>
                <br>
                <loop for="x" start="1" stop="5">
                    <div class="hemlox">aaa</div>
                    <i class="divx">bbb</i>
                </loop>
                
                <loop for="num" start="1" stop="7" influence="none">
                    <h3 class="aaanum">Hey, neighbouououor! It's nice too meet ya for the num time this week!</h3>
                </loop>
                -->
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

            // Sticky container variables

        let scBg = ".calc-scroll"
        let scContainer = $(".cs-container");
        let scContInner = $(".cs-container-inner");
        let scBtn = $(".cs-button");
        let scScrollBtn = 'cs-scroll-btn'
        let scClose = "cs-close";
        let scOpen = "cs-open";

        // Scroll to the set element + or - this value
        let addPx = 50;

        // Scrolling animation time
        let scrollTime = 350;

            // Slide-in

        scBtn.on("click", function(e){
            scContainer.toggleClass(scOpen);
            e.stopPropagation();
        });

        $(window).on("click", function(e){
            if(!$(e.target).is(scBg) && 
            $(scBg).has(e.target).length === 0 ||
               
            $(e.target).hasClass(scScrollBtn) ||
               
            $(e.target).hasClass(scClose)){
                scContainer.removeClass(scOpen);
            }
        });

            // Scroll buttons
            
        // Yeah, double document ready - deal with it
        $(document).ready(function(){
            $(document).ready(function(){
                for (let sc = 1; sc <= $(".calc").length; sc++){
                    let calcName = $("."+sc+"-calc-header h2").html();
                    scContInner.append(
                        "<div class='cs-scroll-div'><p "+
                        "class='"+scScrollBtn+" "+scScrollBtn+sc+"'" +
                        "container='."+sc+"-calc-header'>"+calcName +
                        "</p></div>"
                    );
                }

                $("."+scScrollBtn).on("click", function(){
                    let scrollToElem = $(this).attr("container");
                    $('html,body').animate({scrollTop: $(scrollToElem).offset().top - 50}, scrollTime);
                });
            });
           
            $(".calculator-name").on("input", debounce(function(){
                for (let sc = 1; sc <= $(".calc").length; sc++){
                    let calcName = $("."+sc+"-calc-header h2").html();
                    $("."+scScrollBtn+sc).html(calcName)
                }
            }, 40));
        });

            // Add a class to the button related to the closest calc

        $(document).ready(function(){
            $(window).on("load scroll resize", debounce(function(){

                let scrollPos = $(window).scrollTop();
                let windowHeight = $(window).height();

                $('.calc-header').each(function(){
                    let headerPos = $(this).position().top + (windowHeight * 0.35);
                    let scrollBtn = $(this).attr("scroll-button");

                    if (headerPos <= scrollPos){
                        $("."+scScrollBtn).removeClass('closest-calc');
                        $("."+scrollBtn).addClass('closest-calc');
                    }
                });

            }, 50));
        });

            // Insulin base settings
            
        $(document).ready(function(){
            let slideContainer = ".ins-calc-base";
            let slideBtn = $(".ins-base-btn");
            let slideOpenClass = "ins-base-open";
            let slideExtClass = "ins-base-extended";

            slideBtn.on("click", function(e){
                $(slideContainer).toggleClass(slideExtClass);
                slideBtn.toggleClass(slideOpenClass);
                e.stopPropagation();
            });

            $(window).on("click", function(e){
                if(!$(e.target).is(slideContainer) && 
                   $(slideContainer).has(e.target).length === 0){
                    $(slideContainer).removeClass(slideExtClass);
                    slideBtn.removeClass(slideOpenClass);
                }
            });
        });
        </script>
    </body>
</html>