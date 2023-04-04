// Document.ready is important for the script to work in modify-recipes when loading one recipe after another
$(document).ready(function(){
    
    // Settings
    
// Number of inputs in a column
let inpColLen = $(".calc:first .name-calc-col").children("input").length;

// Number of sub selects and sub weight inputs in a column 
let subColLen = $(".calc:first .name-calc-col").children("select").length;

// Array with the names of nutreints
let calcArray = [
    "kcal",
    "fat",
    "carb",
    "fiber",
    "protein"
];

// I'm stupid, I used carbs and carbohydrates interchangeably - too lazy to change
let calcArray2 = [
    "kcal",
    "fat",
    "carbohydrates",
    "fiber",
    "protein"
];

// Array with functions
const calcFunctions = {
    kcal: kcal,
    fat: fat,
    carb: carb,
    fiber: fiber,
    protein: protein,
};
    
    // Calc Expand

const calcBtn = document.querySelector('.calc-expand');

calcBtn.addEventListener('click', () => {
    $(".calc-expand").toggleClass("calc-expanded");
    $(".calc").toggleClass("calc-expanded");
    const content = document.querySelector('.calculator');
    expandElement(content, 'calc-expanded');
});

function expandElement(elem, collapseClass) {
    elem.style.height = '';
    elem.style.transition = 'none';

    const startHeight = window.getComputedStyle(elem).height;
    elem.classList.toggle(collapseClass);
    const height = window.getComputedStyle(elem).height;
    elem.style.height = startHeight;

    requestAnimationFrame(() => {
        elem.style.transition = '';

        requestAnimationFrame(() => {
            elem.style.height = height;
        })
    })

    elem.addEventListener('transitionend', () => {
        elem.style.height = '';
        elem.removeEventListener('transitionend', arguments.callee);
    }); 
}

    // Insert igredient weight

$(".weight-calc-col").children().on('input', function(){
    let weight = $(this).val();
    let targetClass = $(this).attr('data-target');
    $("." + targetClass).val(weight);
    $("." + targetClass).removeClass('error');
}); 

    // Insert ingredient name

$(".name-calc-col").children().on('input', function(){
    let name = $(this).val();
    let targetClass = $(this).attr('data-target');
    $("." + targetClass).val(name);
    $("." + targetClass).removeClass('error');
});


let result = 0;

    // Sum kcal

function kcal(){
    result = 0;
    var kcal = [];
    var kcal_sub = [];
    var weight = [];
    var weight_sub = [];


    for (let x = 1; x <= inpColLen; x++){
        kcal[x] = parseFloat($(".kcal-calc" + x).val());
        kcal[x] = kcal[x] ? kcal[x] : 0;

        weight[x] = parseFloat($(".weight-calc" + x).val());
        weight[x] = weight[x] ? weight[x] : 0;

        result += (kcal[x] / 100 * weight[x]);
    }

    let nutriInput = ".kcal-calc";

    for (let i = 1; i <= subColLen; i++){
        let nameSub = $(".calc-sub-select" + i).val();

        let weightSub = parseFloat($(".weight-calc-sub" + i).val());
        weightSub = weightSub ? weightSub : 0;

        let weightCalc = parseFloat($(".weight-calc" + nameSub).val());

        let nutriCalc = parseFloat($(nutriInput + nameSub).val());
        nutriCalc = nutriCalc ? nutriCalc : 0;

        if ($.isNumeric(nameSub)){
            result = result - (nutriCalc / 100 * weightSub);
        }
    }
}

    // Sum fat

function fat(){
    result = 0;
    var fat = [];
    var fat_sub = [];
    var weight = [];
    var weight_sub = [];

    for (let x = 1; x <= inpColLen; x++) {
        fat[x] = parseFloat($(".fat-calc" + x).val());
        fat[x] = fat[x] ? fat[x] : 0;

        weight[x] = parseFloat($(".weight-calc" + x).val());
        weight[x] = weight[x] ? weight[x] : 0;

        result += (fat[x] / 100 * weight[x]);
    }

    let nutriInput = ".fat-calc";

    for (let i = 1; i <= subColLen; i++){
        let nameSub = $(".calc-sub-select" + i).val();

        let weightSub = parseFloat($(".weight-calc-sub" + i).val());
        weightSub = weightSub ? weightSub : 0;

        let weightCalc = parseFloat($(".weight-calc" + nameSub).val());

        let nutriCalc = parseFloat($(nutriInput + nameSub).val());
        nutriCalc = nutriCalc ? nutriCalc : 0;

        if ($.isNumeric(nameSub)){
            result = result - (nutriCalc / 100 * weightSub);
        }
    }
}

    // Sum carbs

function carb(){
    result = 0;
    var carb = [];
    var carb_sub = [];
    var weight = [];
    var weight_sub = [];

    for (let x = 1; x <= inpColLen; x++) {
        carb[x] = parseFloat($(".carb-calc" + x).val());
        carb[x] = carb[x] ? carb[x] : 0;

        weight[x] = parseFloat($(".weight-calc" + x).val());
        weight[x] = weight[x] ? weight[x] : 0;

        result += (carb[x] / 100 * weight[x]);
    }

    let nutriInput = ".carb-calc";

    for (let i = 1; i <= subColLen; i++){
        let nameSub = $(".calc-sub-select" + i).val();

        let weightSub = parseFloat($(".weight-calc-sub" + i).val());
        weightSub = weightSub ? weightSub : 0;

        let weightCalc = parseFloat($(".weight-calc" + nameSub).val());

        let nutriCalc = parseFloat($(nutriInput + nameSub).val());
        nutriCalc = nutriCalc ? nutriCalc : 0;

        if ($.isNumeric(nameSub)){
            result = result - (nutriCalc / 100 * weightSub);
        }
    }
}

    // Sum fiber

function fiber(){
    result = 0;
    var fiber = [];
    var fiber_sub = [];
    var weight = [];
    var weight_sub = [];

    for (let x = 1; x <= inpColLen; x++) {
        fiber[x] = parseFloat($(".fiber-calc" + x).val());
        fiber[x] = fiber[x] ? fiber[x] : 0;

        weight[x] = parseFloat($(".weight-calc" + x).val());
        weight[x] = weight[x] ? weight[x] : 0;

        result += (fiber[x] / 100 * weight[x]);
    }

    let nutriInput = ".fiber-calc";

    for (let i = 1; i <= subColLen; i++){
        let nameSub = $(".calc-sub-select" + i).val();

        let weightSub = parseFloat($(".weight-calc-sub" + i).val());
        weightSub = weightSub ? weightSub : 0;

        let weightCalc = parseFloat($(".weight-calc" + nameSub).val());

        let nutriCalc = parseFloat($(nutriInput + nameSub).val());
        nutriCalc = nutriCalc ? nutriCalc : 0;

        if ($.isNumeric(nameSub)){
            result = result - (nutriCalc / 100 * weightSub);
        }
    }
}

    // Sum protein

function protein(){
    result = 0;
    var protein = [];
    var protein_sub = [];
    var weight = [];
    var weight_sub = [];

    for (let x = 1; x <= inpColLen; x++){
        protein[x] = parseFloat($(".protein-calc" + x).val());
        protein[x] = protein[x] ? protein[x] : 0;

        weight[x] = parseFloat($(".weight-calc" + x).val());
        weight[x] = weight[x] ? weight[x] : 0;

        result += (protein[x] / 100 * weight[x]);
    }

    let nutriInput = ".protein-calc";

    for (let i = 1; i <= subColLen; i++){
        let nameSub = $(".calc-sub-select" + i).val();

        let weightSub = parseFloat($(".weight-calc-sub" + i).val());
        weightSub = weightSub ? weightSub : 0;

        let weightCalc = parseFloat($(".weight-calc" + nameSub).val());

        let nutriCalc = parseFloat($(nutriInput + nameSub).val());
        nutriCalc = nutriCalc ? nutriCalc : 0;

        if ($.isNumeric(nameSub)){
            result = result - (nutriCalc / 100 * weightSub);
        }
    }
}

    // Calculate inputs on weight inputs, calc-expand and sub-select click

for (let c = 0; c < calcArray.length; c++){

    let cItem = calcArray[c];
    let cItem2 = calcArray2[c];

    // Calculate inputs on calc-expand and sub-select click
    $(".calc-expand, .calc-sub-select").on('click', function(){

        // Call the calc function
        calcFunctions[cItem]();

        // Insert the result to the column calc-result
        let resultx = Math.round(result * 10) / 10;
        $("."+cItem+"-result").val(resultx);

        // If the calc-result is more thatn 0, insert the value to the nutrition input and remove the error class
        if ($("."+cItem+"-result").val() > 0){
            $("."+cItem2).val(resultx);
            $("."+cItem2).removeClass('error');
        }
    });

    // Calculate inputs on entering an input value
    $("."+cItem+"-calc-col").children().on('input', function(){

        // Call the calc function
        calcFunctions[cItem]();

        // Insert the result to the column calc-result
        let resultx = Math.round(result * 10) / 10;
        $("."+cItem+"-result").val(resultx);

        // If the result and the nutrition input are not equal to 0, insert the result to the nutrition input
        if($("."+cItem+"-result").val() == 0 && $("."+cItem2).val(0)){
           $("."+cItem2).val("");
        } else {
            $("."+cItem2).val(resultx);
        }

        // Remove the error class
        if ($("."+cItem+"-result").val() > 0){
            $("."+cItem2).removeClass('error');
        }
    });

    // Calculate inputs and replace the nutrition input value on weight column inputs
    $(".weight-calc-col").children().on('input', function(){
        if ($("."+cItem2).val() == 0 || $("."+cItem+"-result").val() != 0){

            // Call the calc function
            calcFunctions[cItem]();

            // Insert the result to the column calc-result
            let resultx = Math.round(result * 10) / 10;
            $("."+cItem+"-result").val(resultx);

            // If any of the calc inputs has a value and the nutrition input is not equal to 0, insert the result
            let emptyCalc = 0;
            $("."+cItem+"-calc").each(function(){
                if ($(this).val() != 0){
                    emptyCalc += 1;
                }
            });
            if(emptyCalc == 0 && $("."+cItem2).val(0)){
               $("."+cItem2).val("");
            } else {
                $("."+cItem2).val(resultx);
            }

            // Remove the error class
            if ($("."+cItem+"-result").val() > 0){
                $("."+cItem2).removeClass('error');
            }
        }
    });

            // Reset all of the values in the row

    for (let nr = 1; nr <= inpColLen; nr++){
        $(".reset-calc-row"+nr).on("click", function(){
            $(".weight-calc"+nr).val("");
            $(".name-calc"+nr).val("");
            $("."+cItem+"-calc"+nr).val("");

            // Call the calc function
            calcFunctions[cItem]();

            // Insert the result to the column calc-result
            let resultx = Math.round(result * 10) / 10;
            $("."+cItem+"-result").val(resultx);

            // If any of the calc inputs has a value and the nutrition input is not equal to 0, insert the result
            let emptyCalc = 0;
            $("."+cItem+"-calc").each(function(){
                if ($(this).val() != 0){
                    emptyCalc += 1;
                }
            });
            if(emptyCalc == 0 && $("."+cItem2).val(0)){
               $("."+cItem2).val("");
            } else {
                $("."+cItem2).val(resultx);
            }
        });
    }

    for (let nr = 1; nr <= subColLen; nr++){
        $(".reset-calc-row-sub"+nr).on("click", function(){
            $(".weight-calc-sub"+nr).val("");
            let defOption = $(".calc-sub-select"+nr+" option:first").val();
            $(".calc-sub-select"+nr).val(defOption);

            // Call the calc function
            calcFunctions[cItem]();

            // Insert the result to the column calc-result
            let resultx = Math.round(result * 10) / 10;
            $("."+cItem+"-result").val(resultx);

            // If any of the calc inputs has a value and the nutrition input is not equal to 0, insert the result
            let emptyCalc = 0;
            $("."+cItem+"-calc").each(function(){
                if ($(this).val() != 0){
                    emptyCalc += 1;
                }
            });
            if(emptyCalc == 0 && $("."+cItem2).val(0)){
               $("."+cItem2).val("");
            } else {
                $("."+cItem2).val(resultx);
            }
        });
    }
}

    // Take name-calc input values and insert them to the selects

let select = $('.calc-sub-select');
let nameColumn = $(".name-calc-col").children("input");

function insertName(){
    var name = [];
    for (let x = 1; x <= inpColLen; x++){
        name[x] = $(".name-calc" + x).val();
        let option = $(".name-calc-option" + x);

        if (name[x] != "") {
            option.css("display", "block");
            option.html(x + ". " + name[x]);
            option.val(x);
        } else {
            option.css("display", "none");
        }
    }

    // Disable pointer events (clicking) when there are no input name values
    let emptyOption = inpColLen;
    for (let x = 1; x <= inpColLen; x++){
        if ($(".name-calc" + x).val() == ""){
            emptyOption--;
        } else {
            emptyOption++;
        }
    }

    if (emptyOption > 0){
        select.css("pointer-events", "auto");
    } else {
        select.css("pointer-events", "none");
    }
}

$(window).on('load', function() {
    insertName();
});

nameColumn.on('input', function() {
    insertName();
});

$(document).ready(function(){
    insertName();

    // Take database value and mark option with that value as "selected"
    for (let i = 1; i <= subColLen; i++){
        for (let o = 1; o <= inpColLen; o++){

            let selectVal = $('.calc-sub-select' + i).attr("dbval");
            let selectOptionVal = $(".calc-sub-select" + i + " .name-calc-option" + o).val();
            let selectOption = $(".calc-sub-select" + i + " .name-calc-option" + o);

            if (selectOptionVal == selectVal &&
               selectOption.html() != ""){
                selectOption.attr("selected","selected");
            }

        }
    }
});

        // Move focus on ctrl + arrow keys click

$(document).on("keydown", "input", function(e) {
    
    let ctrl = e.ctrlKey;
    
    // Change focus + prevent from focusing on the calc result inputs
    if ($(".calculator div input").is(":focus") &&     !$(this).next().hasClass("calc-result") &&
    ctrl){
        
        // Down arrow
        if (e.keyCode == 40){
            $(this).next("input").focus();
        }
    }
    
    // Change focus
    if ($(".calculator div input").is(":focus") &&
    ctrl){
        let inputParent = $(this).parent();
        let index = inputParent.children('input').index($(this));
        
        // Up arrow
        if (e.keyCode == 38){
            $(this).prev("input").focus();
        }  
        
        // Left arrow
        if (e.keyCode == 37){
            inputParent.prev().children('input:eq('+index+')').focus();
        }
        
        // Right arrow
        if (e.keyCode == 39){
            inputParent.next().children('input:eq('+index+')').focus();
        }
    }
});

});




