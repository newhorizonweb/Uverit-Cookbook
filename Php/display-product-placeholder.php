<?php

require('svg.php');
global $date_svg, $mod_date_svg;

$star = "<svg id='Capa_1' data-name='Capa 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 487.2 465.2'><defs><style>.cls-1{fill:none;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M251.7,14.6,317,147.2a8.9,8.9,0,0,0,6.8,4.9l146.3,21.3a8.9,8.9,0,0,1,5,15.2L369.2,291.9a9.3,9.3,0,0,0-2.6,7.9l25,145.8a8.9,8.9,0,0,1-12.9,9.4L247.8,386.1a9.3,9.3,0,0,0-8.3,0L108.5,455a9,9,0,0,1-13-9.4l25.1-145.8a9.3,9.3,0,0,0-2.6-7.9L12.1,188.6a8.9,8.9,0,0,1,5-15.2l146.3-21.3a8.9,8.9,0,0,0,6.8-4.9L235.6,14.6A9,9,0,0,1,251.7,14.6Z'/></svg>";
        
$link_icon = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280' class='link-icon'><defs><style>.cls-1{fill:none;;stroke-miterlimit:10;}</style></defs><g id='Layer_3' data-name='Layer 3'><rect class='cls-1' x='129.5' y='91' width='19.6' height='98.16' rx='8.7' transform='translate(139.9 -57.5) rotate(45)'/><path class='cls-1' d='M122,206.3l20.4-20.4a9.8,9.8,0,0,1,13.8,0h0a9.7,9.7,0,0,1,0,13.9l-20.3,20.4a53.8,53.8,0,0,1-76.1-76.1l20.4-20.3a9.7,9.7,0,0,1,13.9,0h0a9.8,9.8,0,0,1,0,13.8L73.7,158A34.2,34.2,0,0,0,122,206.3Z'/><path class='cls-1' d='M206.3,122l-20.4,20.4a9.8,9.8,0,0,0,0,13.8h0a9.7,9.7,0,0,0,13.9,0l20.4-20.3a53.8,53.8,0,0,0-76.1-76.1L123.8,80.2a9.7,9.7,0,0,0,0,13.9h0a9.8,9.8,0,0,0,13.8,0L158,73.7A34.2,34.2,0,1,1,206.3,122Z'/></g></svg>";
        
$checkmark_icon = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280' class='checkmark-icon'><defs><style>.cls-2{fill:none;;stroke-miterlimit:10;}</style></defs><g id='Layer_2' data-name='Layer 2'><path class='cls-2' d='M234,51.5h0A13.2,13.2,0,0,0,212.3,50L114.9,170a5.7,5.7,0,0,1-9.2-.4L82.4,136.3A21,21,0,0,0,49,134.9h0a20.7,20.7,0,0,0-1.1,25.5l47.8,68.3a14.5,14.5,0,0,0,23.8,0l13.7-19.6L233.4,66A12.8,12.8,0,0,0,234,51.5Z'/></g></svg>";
        
$weight_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{stroke-linecap:round;stroke-miterlimit:10;}</style></defs><circle class='cls-1' cx='100' cy='24.6' r='20.5'/><path class='cls-1' d='M53.3,196H180.7c13.5,0,16.5-4.5,14.8-15.5L175,68.6a30,30,0,0,0-29.3-23.4H54.3A30,30,0,0,0,25,68.6L4.5,180.5C2.8,191.5,5.8,196,19.3,196h93'/><path class='cls-1' d='M64.2,164.2h98.6c7.8,0,13.7-8.4,12.2-17.5l-9.9-53.2C163.1,83,154.9,77,145.4,77H54.6c-9.5,0-17.7,6-19.7,16.5L25,146.7c-1.5,9.1,4.4,17.5,12.2,17.5Z'/></svg>";
        
$portion_weight_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{stroke-linecap:round;stroke-linejoin:round;}.cls-2{stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M177,161.3a4.4,4.4,0,0,0,4.4-4.3V122A81.7,81.7,0,0,0,99.8,40.4h.4A81.7,81.7,0,0,0,18.6,122v35a4.4,4.4,0,0,0,4.4,4.3Z'/><circle class='cls-2' cx='100.2' cy='22.2' r='18.2'/><rect class='cls-2' x='4.1' y='173.3' width='191.9' height='22.63' rx='11.3'/><path class='cls-1' d='M110.5,56.1a75.9,75.9,0,0,0-10.7-.8h.4a65.2,65.2,0,0,0-53.7,28'/></svg>";
        
$portion_number_icon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{stroke-miterlimit:10;}</style></defs><circle class='cls-1' cx='100' cy='118.9' r='79.3'/><circle class='cls-1' cx='100' cy='118.9' r='62.4'/><path class='icon-mod' d='M111.4,35.5l5.3-5.2,5.7-5.8a1.7,1.7,0,0,0,0-2.6l-1.5-1.6a1.9,1.9,0,0,0-2.6,0l-9.8,9.8-1.3,1.3-11,11a1.9,1.9,0,0,1-2.6,0L92,40.9a2,2,0,0,1,0-2.7l12.4-12.3,9.7-9.7a2,2,0,0,0,0-2.7l-.8-.8-.7-.7a1.8,1.8,0,0,0-2.7,0l-9.7,9.7L98.9,23,87.8,34a1.9,1.9,0,0,1-2.6,0l-1.5-1.5a1.8,1.8,0,0,1,0-2.7L96,17.5l9.7-9.7a2,2,0,0,0,0-2.7l-1.5-1.5a2,2,0,0,0-2.7,0l-11,11L72.8,32.3A8.4,8.4,0,0,0,70,39.1a23.4,23.4,0,0,1-7.1,17.4L21.5,97.8,4.4,114.9a4.8,4.8,0,0,0,0,6.7A5.1,5.1,0,0,0,7.8,123a4.7,4.7,0,0,0,3.3-1.4l17.1-17.1L69.6,63.1a23.3,23.3,0,0,1,17.4-7,9,9,0,0,0,6.8-2.9l17.6-17.7'/><path class='icon-mod' d='M171.1,91.5,130.7,51.2l-9.2-9.3L91,11.4a1.3,1.3,0,0,0-2.2.7l-.2,1.2a45.6,45.6,0,0,0,12.5,40.6l3.5,3.4,7.4,7.4A21.3,21.3,0,0,0,128.6,71l5.3-.3a6.3,6.3,0,0,1,4.9,1.9l25.5,25.5L189,122.7a4.5,4.5,0,0,0,6.6,0h0a4.5,4.5,0,0,0,0-6.6L171.1,91.5'/></svg>";

$question_mark_icon = "<svg id='Layer_4' class='placeholder-icon' data-name='Layer 4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-1{stroke-miterlimit:10;}</style></defs><path class='cls-1' d='M97,195.9c-4.3,0-7.6-1.2-9.8-3.6s-3.4-5.8-3.4-10.2v-4.6c0-4.5,1.1-8,3.4-10.3s5.5-3.5,9.8-3.5h2.9c4.3,0,7.7,1.2,10,3.5s3.5,5.8,3.5,10.3v4.6c0,4.4-1.2,7.7-3.5,10.2s-5.7,3.6-10,3.6Z'/><path class='cls-1' d='M94.3,102.6h0a23,23,0,0,1,8.8-3c5.3-.8,10-2.8,14.7-4.8a30.3,30.3,0,0,0,14-11.7c3.5-5.2,5.2-11.8,5.2-19.6a33.7,33.7,0,0,0-4.5-17.4,33.5,33.5,0,0,0-12.4-11.8,35.4,35.4,0,0,0-17.3-4.2,38,38,0,0,0-15.9,3.3,50,50,0,0,0-13,8.9c-4.9,5-7.8,10.4-13,11.4s-12.7-1.3-15.5-6.1c-3.7-6.5-2.3-11,1.1-15.6A78.3,78.3,0,0,1,75.8,9.8a64.7,64.7,0,0,1,27-5.7,61.1,61.1,0,0,1,30.6,7.8,60.2,60.2,0,0,1,21.8,21c5.3,8.8,8,19,8,30.6a58.7,58.7,0,0,1-3.9,22,51.1,51.1,0,0,1-11.1,17,59.3,59.3,0,0,1-16.8,11.6,52.6,52.6,0,0,1-9.6,3.6l-2.7.9-2.2.8a7.7,7.7,0,0,0-4.3,4h0a14.7,14.7,0,0,0-1.5,6.5v5.8a13,13,0,0,1-3.8,9.3,12.3,12.3,0,0,1-9.2,3.9,12.4,12.4,0,0,1-9.4-3.9,13.2,13.2,0,0,1-3.6-9.3V121.3a27.5,27.5,0,0,1,2.8-12h0A15.3,15.3,0,0,1,94.3,102.6Z'/></svg>";
?>


<div class="product-header">
    <div class="ph-info">
        <div class="head-buttons">
            <div class="dp-close">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="prod-link-btn head-elem">
                <div class='head-elem-bg phl-bg'></div>
                <?php echo $link_icon; ?>
            </div>
        </div>
        
        <?php  
        
        echo "<div class='head-info'>";
            echo "<div class='p-rating head-elem'>";
                echo "<div class='head-elem-bg phl-bg'></div>";
                echo "<span class='p-rating-icon'>".$star."</span>";
                echo "<p>?</p>";
            echo "</div>";
        
            echo "<div class='p-type head-elem'>";
                echo "<div class='head-elem-bg phl-bg'></div>";
                echo "<span class='p-type-icon'>".$question_mark_icon."</span>";
            echo "</div>";
        echo "</div>";
        
        echo "<div class='date head-elem'>";
            echo "<div class='head-elem-bg phl-bg'></div>";
            echo "<div class='date-inner'>";
                echo $date_svg;
                echo "<p>??.??.????</p>";
            echo "</div>";
        echo "</div>";
        ?>
    </div>
    
    <div class="ph-content">
        <h5 class="phl-bg2">?</h5>
        <h3>Wybierz produkt</h3>
        <h5 class="phl-bg2">?</h5>
    </div>
</div>

<div class="p-image-div">
    <div class="p-image-div-inner">
        <img class="p-image " src="../Images/no-img.svg" alt="Image placeholder">
    </div>
</div>

<div class="nutrition-info">
    <div class="nutrition-tables">
        <table class="nt-all">
            <?php
                echo "<tr>";
                echo    "<th class='nt-content'><p>";
                echo        "Wartości odżywcze";
                echo    "</p></th>";                       
                echo    "<th class='nt-content'><p>";
                echo        "Całość";
                echo    "</p></th>";

                echo    "<th class='nt-content'><p>";
                echo        "100 g";
                echo    "</p></th>";

                echo    "<th class='nt-content nt-calc'><p class='nt-input nt-input-nohover'>Porcja</p></th>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Wartość energetyczna";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg2'></td>"; 
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Tłuszcz";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg'></td>"; 
                echo    "<td class='nt-content ntc phl-bg'></td>";
                echo    "<td class='nt-content ntc phl-bg'></td>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Węglowodany (netto)";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg2'></td>"; 
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Błonnik";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg'></td>"; 
                echo    "<td class='nt-content ntc phl-bg'></td>";
                echo    "<td class='nt-content ntc phl-bg'></td>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Białko";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg2'></td>"; 
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo "</tr>";
            ?>
        </table>

        <table class="nt-all">
            <?php
                echo "<tr>";
                echo    "<th class='nt-content'><p>";
                echo        "Wymienniki";
                echo    "</p></th>";                       
                echo    "<th class='nt-content'><p>";
                echo        "Całość";
                echo    "</p></th>";

                echo    "<th class='nt-content'><p>";
                echo        "100 g";
                echo    "</p></th>";

                echo    "<th class='nt-content'><p class='nt-weight'>";
                echo        "Porcja";
                echo    "</p></th>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Węglowodanowe";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg2'></td>"; 
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo    "<td class='nt-content ntc phl-bg2'></td>";
                echo "</tr>";

                echo "<tr class='nt-row'>";
                echo    "<td class='nt-content'><p>";
                echo        "Białkowo-tłuszczowe";
                echo    "</p></td>";

                echo    "<td class='nt-content ntc phl-bg'></td>"; 
                echo    "<td class='nt-content ntc phl-bg'></td>";
                echo    "<td class='nt-content ntc phl-bg'></td>";
                echo "</tr>";
            ?>
        </table>
    </div>
    
    <div class='nutri-percent'>
        <h4>Skład procentowy</h4>

        <div class='np-section np-weight'>
            <div class='pi-line'>
                <p>Waga</p>
            </div>

            <div class="np-desc">
                <div class="np-desc-txt">
                    <span class="np-ratio-fat"></span>
                    <p>Tłuszcz</p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-carb"></span>
                    <p>Węgle</p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-fiber"></span>
                    <p>Błonnik</p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-protein"></span>
                    <p>Białko</p>
                </div>
            </div>

            <div class='np-ratio-div np-weight-ratio'>
                <span class='np-ratio phl-bg2' style='flex:1'></span>
            </div>
        </div>

        <div class='np-section np-kcal'>
            <div class='pi-line'>
                <p>Kalorie</p>
            </div>

            <div class="np-desc">
                <div class="np-desc-txt">
                    <span class="np-ratio-fat"></span>
                    <p>Tłuszcz</p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-carb"></span>
                    <p>Węgle</p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-fiber"></span>
                    <p>Błonnik</p>
                </div>
                <div class="np-desc-txt">
                    <span class="np-ratio-protein"></span>
                    <p>Białko</p>
                </div>
            </div>

            <div class='np-ratio-div np-weight-ratio'>
                <span class='np-ratio phl-bg2' style='flex:1'></span>
            </div>
        </div>
    </div>
</div>

<div class="product-info">
    <h4>Informacje</h4>

    <?php
    echo "<div class='pi-group'>";
    echo    "<div class='pi-line'><p>Dane</p></div>";
    echo    "<div class='pi-data-icons'>";
        
    echo        "<div class='pi-data-item'>";
    echo            "<span class='pi-icon' title='Waga całkowita'>";
    echo                $weight_icon;
    echo                "<p class='pi-icon-txt'>?</p>";
    echo            "</span>";
    echo            "<p class='pi-icon-title'>Całość</p>";
    echo        "</div>";
        
    echo        "<div class='pi-data-item'>";
    echo            "<span class='pi-icon' title='Waga porcji'>";
    echo                $portion_weight_icon;
    echo                "<p class='pi-icon-txt'>?</p>";
    echo            "</span>";
    echo            "<p class='pi-icon-title'>Porcja</p>";
    echo        "</div>";
        
    echo        "<div class='pi-data-item'>";
    echo            "<span class='pi-icon' title='Ilość porcji'>";
    echo                $portion_number_icon;
    echo                "<p class='pi-icon-txt'>?</p>";
    echo            "</span>";
    echo            "<p class='pi-icon-title'>Ilość</p>";
    echo        "</div>";

    echo    "</div>";
    echo "</div>";

    echo "<div class='pi-group'>";
    echo    "<div class='pi-line'><p>Termin</p></div>";
    echo    "<p class='phl-bg2'>?</p>";
    echo "</div>";

    echo "<div class='pi-group'>";
    echo    "<div class='pi-line'><p>Info</p></div>";
    echo    "<p class='phl-bg2'>?</p>";
    echo "</div>";
    ?>            
</div>

<div class="tags shop-tags">
    <div class='pi-line'>
        <p>Sklepy</p>
    </div>
    <p class='tag phl-bg'>?????????</p>
    <p class='tag phl-bg'>???????????</p>
    <p class='tag phl-bg'>???????</p>
    <p class='tag phl-bg'>??????????</p>
    <p class='tag phl-bg'>???????????</p>
    <p class='tag phl-bg'>?????</p>
</div>

<div class="tags">
    <div class='pi-line'>
        <p>Tagi</p>
    </div>
    <p class='tag phl-bg'>???????????</p>
    <p class='tag phl-bg'>?????</p>
    <p class='tag phl-bg'>??????????????</p>
    <p class='tag phl-bg'>??????????</p>
    <p class='tag phl-bg'>???????</p>
    <p class='tag phl-bg'>??????????</p>
    <p class='tag phl-bg'>?????????????</p>
    <p class='tag phl-bg'>??????</p>
    <p class='tag phl-bg'>???????</p>
    <p class='tag phl-bg'>???????????????</p>
    <p class='tag phl-bg'>????????????</p>
    <p class='tag phl-bg'>??????</p>
    <p class='tag phl-bg'>?????????????</p>
    <p class='tag phl-bg'>???????</p>
</div>

<script>

        /* Disable closing on swipe */

    // Prevent from closing the details div when swiping over the tables && window <= 540
    function prevCloseEvent(){
        const nutritionTables = document.querySelector(".nutrition-tables");

        if (window.innerWidth <= 540){
            nutritionTables.ontouchstart = function(e){
                e.stopPropagation();
            }
        } else {
            nutritionTables.ontouchstart = null;
        }
    }

    prevCloseEvent();
    window.addEventListener("resize", prevCloseEvent);

</script>



