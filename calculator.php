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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="Images/uverit-favicon-bbg.svg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="Styles/general.css">
        <link rel="stylesheet" type="text/css" href="Styles/calculator.css">
        
        <!-- Scripts -->
        <script src="Scripts/jquery-3.6.0.min.js"></script>
        <script src="Scripts/ScriptPack-min.js" defer></script>
        <script src="Scripts/navigation.js"></script>
        <script src='Scripts/calculator-calc.js' defer></script>
        <script src='Scripts/calc-search.js' defer></script>
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

                        <div class="calc-links"></div>

                        <div class="total-results">

                            <div class="total-ratio-section total-calories">
                                <h5 class="ratio-heading">Kalorie</h5>
                                <p class="total-kcal"></p>
                            </div>

                            <div class="total-ratio-section total-weight-ratio">

                                <h5 class="ratio-heading ratio-heading-border">Waga</h5>

                                <div class="ratio-values">
                                    <div class="ratio-val-elem fat-ratio">
                                        <span></span><p></p>
                                    </div>
                                    <div class="ratio-val-elem carb-ratio">
                                        <span></span><p></p>
                                    </div>
                                    <div class="ratio-val-elem fiber-ratio">
                                        <span></span><p></p>
                                    </div>
                                    <div class="ratio-val-elem protein-ratio">
                                        <span></span><p></p>
                                    </div>
                                </div>

                                <div class="ratio-bar">
                                    <div class="ratio-bar-elem fat-ratio"></div>
                                    <div class="ratio-bar-elem carb-ratio"></div>
                                    <div class="ratio-bar-elem fiber-ratio"></div>
                                    <div class="ratio-bar-elem protein-ratio"></div>
                                </div>

                            </div>

                            <div class="total-ratio-section total-calorie-ratio">

                                <h5 class="ratio-heading ratio-heading-border">Skład Procentowy</h5>

                                <div class="ratio-values">
                                    <div class="ratio-val-elem fat-ratio">
                                        <span></span><p></p>
                                    </div>
                                    <div class="ratio-val-elem carb-ratio">
                                        <span></span><p></p>
                                    </div>
                                    <div class="ratio-val-elem fiber-ratio">
                                        <span></span><p></p>
                                    </div>
                                    <div class="ratio-val-elem protein-ratio">
                                        <span></span><p></p>
                                    </div>
                                </div>

                                <div class="ratio-bar">
                                    <div class="ratio-bar-elem fat-ratio"></div>
                                    <div class="ratio-bar-elem carb-ratio"></div>
                                    <div class="ratio-bar-elem fiber-ratio"></div>
                                    <div class="ratio-bar-elem protein-ratio"></div>
                                </div>

                            </div>

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
                                    <input type='tel' name="ins-amount-early" class="ins-input ins-amount-early" tabindex="-1" aria-label="Insulin amount - Early Meal">
                                </div>
                                
                                <div class="ins-base-item">
                                    <p title="Ilość węglowodanów w gramach, które pokrywa 1j insuliny (na obiad)">Obiad</p>
                                    <input type='tel' name="ins-amount-mid" class="ins-input ins-amount-mid" tabindex="-1" aria-label="Insulin amount - Mid/Noon Meal">
                                </div>
                                    
                                <div class="ins-base-item">
                                    <p title="Ilość węglowodanów w gramach, które pokrywa 1j insuliny (na kolację)">Kolacja</p>
                                    <input type='tel' name="ins-amount-late" class="ins-input ins-amount-late" tabindex="-1" aria-label="Insulin amount - Late Meal">
                                </div>
                                    
                                <div class="ins-base-item">
                                    <p title="Ile mg/dl glukozy we krwi zbija 1j insuliny">Wart. korekcyjna</p>
                                    <input type='tel' name="bs-increase" class="ins-input bs-increase" tabindex="-1" aria-label="Insulin Impact (how much 1 insulin unit lowers the blood sugar)">
                                </div>

                                <h4 class="search-settings-title">
                                    Wyszukiwarka
                                </h4>

                                <div class="search-box-item">
                                    <input type="checkbox" class="search-box"
                                        id="search-box-auto" tabindex="-1">
                                    <label for="search-box-auto">
                                        Auto-search
                                    </label>
                                </div>

                                <div class="search-box-item">
                                    <input type="checkbox" class="search-box"
                                        id="search-box-kcal" tabindex="-1">
                                    <label for="search-box-kcal">
                                        Kalorie
                                    </label>
                                </div>

                                <div class="search-box-item">
                                    <input type="checkbox" class="search-box"
                                        id="search-box-fat" tabindex="-1">
                                    <label for="search-box-fat">
                                        Tłuszcz
                                    </label>
                                </div>

                                <div class="search-box-item">
                                    <input type="checkbox" class="search-box"
                                        id="search-box-carb" tabindex="-1">
                                    <label for="search-box-carb">
                                        Węgle
                                    </label>
                                </div>

                                <div class="search-box-item">
                                    <input type="checkbox" class="search-box"
                                        id="search-box-fiber" tabindex="-1">
                                    <label for="search-box-fiber">
                                        Błonnik
                                    </label>
                                </div>

                                <div class="search-box-item">
                                    <input type="checkbox" class="search-box"
                                        id="search-box-protein" tabindex="-1">
                                    <label for="search-box-protein">
                                        Białko
                                    </label>
                                </div>

                                <div class="search-box-logo"></div>
                                
                            </div>
                        </div>           
                        
<?php
// Total number of calculators
$calculators = 7;

// Number of inputs in a column
$inpColLen = 22;

// Calculator output string
$cos = "";

for ($c = 1; $c <= $calculators; $c++){
$cos .= "<div class='$c-calc-header calc-header' scroll-button='cs-scroll-btn".$c."'>".
            "<h2>Kalkulator ".$c."</h2>".
        "</div>".  

        "<div class='calc calc$c'>".
        
        "<div class='calc-head'>".
            "<input type='text' class='calc-input calculator-name calculator-name$c' name='calculator-name$c' maxlength='48' aria-label='Calculator Name'>".

            "<select class='select-calculator select-calculator$c' autocomplete='off' aria-label='Copy Calculators'>";
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

            // Generate attention toggle buttons
            "<div class='attention-calc-col'>".
                "<h5>&nbsp;</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='checkbox' name='$c-attention-calc".$x."'' class='calc-input attention-toggle $c-attention-calc".$x."' aria-label='Row Attention Toggle'>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".
    
            // Generate calculator multiplier inputs / buttons
            "<div class='multi-calc-col calc-col'>".
                "<h5>Mnożnik</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<div class='multi-calc-div'>".
                        "<div class='multi-change multi-sub $c-multi-sub'><span></span></div>".
                        
                        "<input type='tel' name='$c-multi-calc".$x."' class='calc-input multi-calc $c-multi-calc $c-multi-calc".$x."' aria-label='Multiplier'>".
                        
                        "<div class='multi-change multi-add $c-multi-add'><span></span><span></span></div>".
                    "</div>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".

            // Generate calculator weight inputs
            "<div class='weight-calc-col calc-col'>".
                "<h5 title='Waga w gramach (puste pole = 100g)'>Waga</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-weight-calc".$x."' class='calc-input weight-calc $c-weight-calc".$x." calc-num' aria-label='Weight Input'>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".

            // Generate calculator name inputs & search buttons
            "<div class='name-calc-col calc-col'>".
                "<h5>Nazwa</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<div class='calc-input name-elem'>".

                        "<input type='text' name='$c-name-calc".$x."' class='name-calc $c-name-calc $c-name-calc".$x."' aria-label='Name Input'>".
                        
                        "<div class='search-btn'></div>".

                        "<div class='search-list-outer'>".
                            "<div class='search-list'></div>".
                        "</div>".

                    "</div>";
                }
$cos .=         "<div class='cb-line-div'>".
                    "<span class='cb-line'></span>".
                "</div>".
            "</div>".

            // Generate calculator kcal inputs
            "<div class='kcal-calc-col calc-col'>".
                "<h5 title='Kcal / 100g'>Kcal</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-kcal-calc".$x."' class='calc-input kcal-calc $c-kcal-calc".$x." calc-num' aria-label='Kcal Input'>";
                }
$cos .=         "<input class='calc-input calc-result kcal-result $c-kcal-result'
                aria-label='Total Kcal' readonly>".
            "</div>".

            // Generate calculator fat inputs
            "<div class='fat-calc-col calc-col'>".
                "<h5 title='W gramach / 100g'>Tłuszcz</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-fat-calc".$x."' class='calc-input fat-calc $c-fat-calc".$x." calc-num' aria-label='Fat Input'>";
                }
$cos .=         "<input class='calc-input calc-result fat-result $c-fat-result'
                aria-label='Total Fat' readonly>".
            "</div>".

            // Generate calculator carb inputs
            "<div class='carb-calc-col calc-col'>".
                "<h5 title='W gramach / 100g'>Węgle</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-carb-calc".$x."' class='calc-input carb-calc $c-carb-calc".$x." calc-num' aria-label='Carbs Input'>";
                }
$cos .=         "<input class='calc-input calc-result carb-result $c-carb-result'
                aria-label='Total Carbs' readonly>".
            "</div>".

            // Generate calculator fiber inputs
            "<div class='fiber-calc-col calc-col'>".
                "<h5 title='W gramach / 100g'>Błonnik</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-fiber-calc".$x."' class='calc-input fiber-calc $c-fiber-calc".$x." calc-num' aria-label='Fiber Input'>";
                }
$cos .=         "<input class='calc-input calc-result fiber-result $c-fiber-result'
                aria-label='Total Fiber'readonly>".
            "</div>".

            // Generate calculator protein inputs
            "<div class='protein-calc-col calc-col'>".
                "<h5 title='W gramach / 100g'>Białko</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<input type='tel' name='$c-protein-calc".$x."' class='calc-input protein-calc $c-protein-calc".$x." calc-num' aria-label='Protein Input'>";
                }
$cos .=         "<input class='calc-input calc-result protein-result $c-protein-result'
                aria-label='Total Protein' readonly>".
            "</div>".

            // Generate reset values buttons
            "<div class='reset-calc-col'>".
                "<h5>&nbsp;</h5>";
                for ($x = 1; $x <= $inpColLen; $x++){
                    $cos .= "<div class='reset-calc-row $c-reset-calc-row".$x."'></div>";
                }
$cos .=     "</div>".

        "</div>".

        "<div class='ins-calc'>".

            "<div class='ins-section'>".

                "<div class='ins-div'>".
                    "<p title='Poziom glukozy we krwi, mg/dl' class='c-help'>Poz. glukozy</p>".
                    "<input type='tel' name='$c-cur-bs' class='calc-input cur-bs $c-cur-bs' placeholder='min. 30, max. 350' aria-label='Current Blood Sugar'>".
                "</div>".

                "<div class='ins-div'>".
                    "<p>IG</p>".

                    "<select name='$c-cur-gi' class='cur-gi $c-cur-gi'  aria-label='Glycemic Index'>".
                        "<option value='wpts' hidden>WBT</option>".
                        "<option value='very-low-gi'>B. niski (gł. b+t)</option>".
                        "<option value='low-gi'>Niski</option>".
                        "<option value='med-gi' selected>Średni</option>".
                        "<option value='high-gi'>Wysoki</option>".
                    "</select>".

                    "<input class='calc-input cur-gi-wpts $c-cur-gi-wpts' value='WBT' readonly aria-label='Fat & Protein Info'>".
                "</div>".

                "<div class='ins-div'>".
                    "<p>Typ posiłku</p>".
                    "<select name='$c-ins-meal-type' class='ins-meal-type $c-ins-meal-type' aria-label='Meal Type'>".
                        "<option value='early'>Śniadanie</option>".
                        "<option value='mid' selected>Obiad</option>".
                        "<option value='late'>Kolacja</option>".
                    "</select>".
                "</div>".

            "</div>".
    
            "<div class='ins-section'>".

                "<div class='ins-div'>".
                    "<p title='Insulina na pokrycie posiłku' class='c-help'>Ins. posiłkowa</p>".
                    "<input class='calc-input calc-readonly ins-meal $c-ins-meal' readonly aria-label='Meal Insulin'>".
                "</div>".

                "<div class='ins-div'>".
                    "<p title='Korekcja dawki w celu osiągnięcia optymalnego poz. gluk.' class='c-help'>Ins. korekcyjna</p>".
                    "<input class='calc-input calc-readonly ins-correction $c-ins-correction' readonly aria-label='Correction Insulin'>".
                "</div>".

                "<div class='ins-div'>".
                    "<p title='Insulina posiłkowa, korekcyjna oraz dostosowanie dawki' class='c-help'>Ins. całkowita</p>".
                    "<div class='total-ins-change'>".
                        "<div class='ins-adjust ins-sub $c-ins-sub'><span></span></div>".
                        "<input class='calc-input calc-readonly ins-total $c-ins-total' readonly aria-label='Total Insulin'>".
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
                    "<input class='calc-input calc-readonly expected-bs $c-expected-bs' readonly aria-label='Expected Blood Sugar'>".
                "</div>".

                "<div class='ins-div'>".
                    "<p title='Czas iniekcji insuliny w odniesieniu do rozpoczącia posiłku' class='c-help'>Czas iniekcji</p>".
                    "<input class='calc-input calc-readonly time-before-meal $c-time-before-meal' readonly aria-label='Injection Time Before Meal'>".
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
                
            </div>
    <!-- /MAIN-MODULE -->

        </main>
        
        <footer>
            <!-- navigation.js -->
        </footer>

        <script defer>
            
            /* Elements */

        // Sticky container
        const scBg = ".calc-scroll"
        const scContainer = $(".cs-container");
        const calcLinks = $(".calc-links");
        const scBtn = $(".cs-button");
        const scScrollBtn = 'cs-scroll-btn'
        const scClose = "cs-close";
        const scOpen = "cs-open";

        // Total Results
        const totalResults = $(".total-results");
        const totalCalories = $(".total-calories");
        const totalWeightRatio = $(".total-weight-ratio");
        const totalCalorieRatio = $(".total-calorie-ratio");

        // Arrays
        let currCalcs = [];

        let mergedResults = {
            kcal: 0,
            fat: 0,
            carbs: 0,
            fiber: 0,
            protein: 0
        };

        const nutriElems = [
            ".fat-ratio",
            ".carb-ratio",
            ".fiber-ratio",
            ".protein-ratio"
        ]

        const nutriNamesPl = [
            "kalorie",
            "tłuszcz",
            "węgle",
            "błonnik",
            "białko"
        ]

        // Reset button
        const holdTime = 1000; // The same as in the calculator-calc.js
        let timerResetBtn;

        // Scroll to the set element + or - this value
        const addPx = 50;

        // Scrolling animation time
        const scrollTime = 350;


        
            /* Slide-in */

        let wasScBtnClicked = false;

        scBtn.on("click", function(e){
            insertCalcNames();
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

        // Detect the closest calculator
        function detectClosestSection(){

            let scrollPos = $(window).scrollTop();
            let windowHeight = $(window).height();

            $('.calc-header').each(function(index){
                let headerPos = $(this).position().top + (windowHeight * 0.35);
                let scrollBtn = $(this).attr("scroll-button");

                if ((index === 0 && scrollPos === 0) || headerPos <= scrollPos){
                    $("."+scScrollBtn).removeClass('closest-calc');
                    $("."+scrollBtn).addClass('closest-calc');
                }
            });

        }

        // Append the calculator buttons
        function insertCalcButtons(){

            for (let sc = 1; sc <= $(".calc").length; sc++){

                const calcName = $("."+sc+"-calc-header h2").html();

                calcLinks.append(
                    "<div class='cs-elem'>" +
                        "<div class='cs-scroll-div'>" +
                            `<p class='${scScrollBtn} ${scScrollBtn + sc}'` +
                            `container='.${sc}-calc-header'></p>` +
                        "</div>" +

                        `<input type='checkbox' class='cs-scroll-check' data-link='${sc}' aria-label='Calculate the total nutritional values - calculator${sc}'>` +
                    "</div>"
                );

            }

            insertCalcNames();

        }

        function insertCalcNames(){
            for (let sc = 1; sc <= $(".calc").length; sc++){
                const calcName = $("."+sc+"-calc-header h2").html();
                $(`.${scScrollBtn + sc}`).html(calcName)
            }
        }

        $(document).ready(function(){



                /* Calculator Slide-in */

            $(document).ready(function(){

                insertCalcButtons();

                // Add a class to the button related to the closest calc
                requestAnimationFrame(detectClosestSection);
                
                $(window).on("scroll resize", function(){
                    requestAnimationFrame(detectClosestSection);
                });

                // Smooth scrolling
                $("."+scScrollBtn).on("click", function(){
                    let scrollToElem = $(this).attr("container");
                    $('html,body').animate({scrollTop: $(scrollToElem).offset().top - 50}, scrollTime);
                });

                    /* Merge Calculator Results */

                // Choose calculators
                function chooseCalcData(){

                    const dataLink = parseInt($(this).attr("data-link"));

                    if ($(this).is(':checked')){
                        currCalcs.push(dataLink);
                    } else {
                        currCalcs = currCalcs.filter(item => item !== dataLink);
                    }

                    mergeCalcResults();

                }

                // Sum the calculator results
                function mergeCalcResults(){

                    // Resel the values before recalculating
                    mergedResults = {
                        kcal: 0,
                        fat: 0,
                        carbs: 0,
                        fiber: 0,
                        protein: 0
                    };

                    $.each(currCalcs, function(index, val){

                        const calculator = $(`.calc${val}`);

                        mergedResults.kcal +=
                            parseFloat(calculator.find(".kcal-result").val()) || 0;
                        mergedResults.fat += 
                            parseFloat(calculator.find(".fat-result").val()) || 0;
                        mergedResults.carbs +=
                            parseFloat(calculator.find(".carb-result").val()) || 0;
                        mergedResults.fiber +=
                            parseFloat(calculator.find(".fiber-result").val()) || 0;
                        mergedResults.protein +=
                            parseFloat(calculator.find(".protein-result").val()) || 0;

                    });

                    showCalculatedResults();

                }

                // Show the results
                function showCalculatedResults(){

                    let index = 0;
                    let firstBarElem;
                    let lastBarElem;

                    const totalWeight = mergedResults.fat + mergedResults.carbs + mergedResults.fiber + mergedResults.protein;

                    $.each(mergedResults, function(key, value){
                        
                        if (key !== "kcal"){

                            // Variables
                            const i = index - 1;

                            const totalRatioVal = $(`.ratio-values ${nutriElems[i]} p`);
                            const totalRatioBar = $(`.ratio-bar ${nutriElems[i]}`);

                            // Remove the classes (removing left-right borders)
                            totalRatioBar.removeClass("first-bar last-bar");

                            // If the value is 0, hide the bar
                            if (value != 0){

                                totalRatioBar.removeClass("hide-bar");

                                if (!firstBarElem){
                                    firstBarElem = totalRatioBar;
                                }
                                lastBarElem = totalRatioBar;

                            } else {
                                totalRatioBar.css("width", "0");
                                totalRatioBar.addClass("hide-bar");
                            }

                            // Weight
                            const weightWidth = Math.round((value / totalWeight) * 100 * 10) / 10;

                            totalWeightRatio.find(`.ratio-values ${nutriElems[i]} p`).html(`${nutriNamesPl[index]} ${Math.round(value * 10) / 10}g`);

                            totalWeightRatio.find(`.ratio-bar ${nutriElems[i]}`).css("width", `${weightWidth}%`);

                            // Calorie Percentage
                            let valueMulti = 0;
                            switch (key){
                                case "fat":
                                    valueMulti = 9;
                                    break;

                                case "carbs":
                                case "protein":
                                    valueMulti = 4;
                                    break;

                                case "fiber":
                                    valueMulti = 2;
                                    break;
                            }

                            let calorieValPercent = 0;

                            if (mergedResults.kcal){
                                calorieValPercent =
                                    Math.round(
                                        (value * valueMulti) / mergedResults.kcal * 100 * 10
                                    ) / 10 || 0;
                            }

                            totalCalorieRatio.find(`.ratio-values ${nutriElems[i]} p`).html(`${nutriNamesPl[index]} ${calorieValPercent}%`);
                            
                            totalCalorieRatio.find(`.ratio-bar ${nutriElems[i]}`).css("width", `${calorieValPercent}%`);
                    
                        } else {
                            $(".total-kcal").text(`${Math.round(value * 10) / 10} kcal`);
                        }

                        index++;

                    });

                    if (firstBarElem){
                        firstBarElem.addClass("first-bar");
                    }
                    if (lastBarElem){
                        lastBarElem.addClass("last-bar");
                    }

                }

                    /* Run the total results code */

                // On load
                chooseCalcData();

                // On checkbox click
                $(".cs-scroll-check").on("click", chooseCalcData);
                
                // When fetching API data
                $(document).on('fetchedSearch', chooseCalcData);

                // When the user inputs a new value
                // calculator-calc.js - line ~100 (calculating columns)
                $(document).on('mergeCalc', chooseCalcData);

                // Changing the calculator (select dropdown)
                $(".select-calculator").on("input", mergeCalcResults);

                // Clicking buttons
                $(".multi-change, .reset-calc-row").on("click", mergeCalcResults);

                // Clicking reset (touch events for mobile)
                $(".calc-reset").on("mousedown touchstart", function(){
                    timerResetBtn = setTimeout(mergeCalcResults, holdTime);
                }).on("mouseup mouseleave touchend touchcancel", function(){
                    clearTimeout(timerResetBtn);
                });

            });
            


                /* Calculator Slide Pop-up names */
           
            // Change the calculator names dynamically on input
            // Debounce to prevent compatibility issues
            $(".calculator-name").on("input", debounce(function(){
                for (let sc = 1; sc <= $(".calc").length; sc++){
                    let calcName = $("."+sc+"-calc-header h2").html();
                    $("."+scScrollBtn+sc).html(calcName)
                }
            }, 40));



                /* Insulin Slide Pop-up */

            // Insulin base settings
            const slideContainer = ".ins-calc-base";
            const slideBtn = $(".ins-base-btn");
            const slideOpenClass = "ins-base-open";
            const slideExtClass = "ins-base-extended";

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