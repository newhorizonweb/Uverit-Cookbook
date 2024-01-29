


// ---/---|---\---/ INCULIN CALCULATOR - BASE \---/---|---\--- \\



// Set and get the localStorage input values
$(".ins-input").on("input", function(){
    localStorage.setItem($(this).attr("name"), $(this).val());
});

$(document).ready(function(){
    $(".ins-input").each(function(){
        $(this).val(localStorage.getItem($(this).attr("name")));
    });
});



// ---/---|---\---/ CALCULATOR \---/---|---\--- \\


// Total number of calculators
let calcCount = $(".calc").length;

// Number of inputs in a column
let inpColLen = $(".calc:first .name-calc-col").children("input").length;

// Input class names
let inputNames = [
    "weight-calc",
    "name-calc",
    "kcal-calc",
    "fat-calc",
    "carb-calc",
    "fiber-calc",
    "protein-calc"
]
let inpNamesLength = inputNames.length;

for (let c = 1; c <= calcCount; c++){

    // Sum each column input values
    
function inputCalc(chngName){
    let nType = [];
    let weight = [];
    let multi = [];
    let result = 0;

    for (let x = 1; x <= inpColLen; x++){
        nType[x] = parseFloat($("."+c+"-"+chngName+"-calc"+x).val());
        nType[x] = nType[x] ? nType[x] : 0;

        weight[x] = parseFloat($("."+c+"-weight-calc"+x).val());
        weight[x] = weight[x] ? weight[x] : 100;
        
        // It can be 0 to temporarily "remove" the item
        multi[x] = parseFloat($("."+c+"-multi-calc"+x).val());
        multi[x] = multi[x] ? multi[x] : 0;
        
        result += (nType[x] / 100 * (weight[x] * multi[x]));
    }

    $("."+c+"-"+chngName+"-result").val(Math.round(result * 10) / 10);
}
    
    // Sum the column values - function calls
    
function inputCalcAll(){
    inputCalc("kcal");
    inputCalc("fat");
    inputCalc("carb");
    inputCalc("fiber");
    inputCalc("protein");
}

$(".kcal-calc-col input").on('input', function(){
    inputCalc("kcal");
});
$(".fat-calc-col input").on('input', function(){
    inputCalc("fat");
});
$(".carb-calc-col input").on('input', function(){
    inputCalc("carb");
});
$(".fiber-calc-col input").on('input', function(){
    inputCalc("fiber");
});
$(".protein-calc-col input").on('input', function(){
    inputCalc("protein");
});
$(".weight-calc-col input, .multi-calc-col input").on('input', function(){
    inputCalcAll();
});
    
    // Multiplier
    
let multiInp;
    
// Add the multi-not-default or multi-zero class if the input val != 1
function multiNotDefault(){
    if (multiInp.val() > 1){
        multiInp.removeClass("multi-zero");
        multiInp.addClass("multi-not-default");
    } else if (multiInp.val() == 0){
        multiInp.removeClass("multi-not-default");
        multiInp.addClass("multi-zero");
    } else {
        multiInp.removeClass("multi-not-default");
        multiInp.removeClass("multi-zero");
    }
}

// Limit the range between 0 and 10 when entering the value manually
$("."+c+"-multi-calc").on("input", function(){
    multiInp = $(this);
    let multiVal = parseInt($(this).val());
    if (multiVal > 10){
        $(this).val(10);
    } else if (multiVal < 0){
        $(this).val(0);
    }
    
    // Calculate everything
    inputCalcAll();
    insCalc();
    
    // Add the multi-not-default class if the input val != 1
    multiNotDefault();
});
           
// Subtract 1 on multi button click
$("."+c+"-multi-sub").on('click', function(){
    multiInp = $(this).closest('.multi-calc-div').find('.multi-calc');
    let multiVal = multiInp.val();
    
    if (!multiVal) {
        multiVal = 0;
        multiInp.val(multiVal);
    } else {
        multiVal = parseInt(multiVal);
    }

    if (multiVal > 0){
        multiVal -= 1;
        multiInp.val(multiVal);
        
        // Save the input value to the localStorage
        localStorage.setItem(multiInp.attr("name"), multiVal);
        
        // Calculate everything
        inputCalcAll();
        insCalc();
    }
    
    if (multiVal == 0){
        $(this).addClass("multi-stop");
    } else {
        $(this).removeClass("multi-stop");
        $(this).closest('.multi-calc-div').find('.multi-add').removeClass("multi-stop");
    }
    
    // Add the multi-not-default class if the input val != 1
    multiNotDefault();
});
    
// Add 1 on multi button click
$("."+c+"-multi-add").on('click', function(){
    multiInp = $(this).closest('.multi-calc-div').find('.multi-calc');
    let multiVal = multiInp.val();
    
    if (!multiVal) {
        multiVal = 0;
    } else {
        multiVal = parseInt(multiVal);
    }
    
    if (multiVal < 10){
        multiVal += 1;
        multiInp.val(multiVal);
        
        // Save the input value to the localStorage
        localStorage.setItem(multiInp.attr("name"), multiVal);
        
        // Calculate everything
        inputCalcAll();
        insCalc();
    }
    
    if (multiVal == 10){
        $(this).addClass("multi-stop");
    } else {
        $(this).removeClass("multi-stop");
        $(this).closest('.multi-calc-div').find('.multi-sub').removeClass("multi-stop");
    }
    
    // Add the multi-not-default class if the input val != 1
    multiNotDefault();
}); 
    
// Add the stop class to the multiplier buttons when out of range
$(document).ready(function(){
    $('.multi-add').each(function(){
        let multiName = $(this).closest('.multi-calc-div').find('.multi-calc').attr("name");
        
        if (localStorage.getItem(multiName) == 10){
            $(this).addClass("multi-stop");
        }
    });
    
    $('.multi-sub').each(function(){
        let multiName = $(this).closest('.multi-calc-div').find('.multi-calc').attr("name");
        
        if (localStorage.getItem(multiName) == 0){
            $(this).addClass("multi-stop");
        }
    });

    // Add the multi-not-default class if the input val != 1
    $("."+c+"-multi-calc").each(function(){
        multiInp = $(this);
        let multiInpVal = localStorage.getItem(multiInp.attr("name"));
  
        if (multiInpVal != null && multiInpVal > 1) {
            $(this).addClass("multi-not-default");
        } else if (multiInpVal != null && multiInpVal == 0){
            $(this).addClass("multi-zero");   
        }
    });
});



// ---/---|---\---/ LOCAL STORAGE \---/---|---\--- \\



// Set the stored calc input and calculator name values
$(document).ready(function(){
    
    // Get the calculator name values and set them
    let storedCalcName = localStorage.getItem("calculator-name"+c);
    $(".calculator-name"+c).val(storedCalcName);
      
    // Get the calculator multiplier values and set them
    for (let nr = 1; nr <= inpColLen; nr++){
        let storedCalcMulti = localStorage.getItem(c+"-multi-calc"+nr) ?? 1;
        $("."+c+"-multi-calc"+nr).val(storedCalcMulti);
    }

    // Get the calculator attention toggle state and set it
    for (let nr = 1; nr <= inpColLen; nr++){

        let storedCalcAtt = localStorage.getItem(c+"-attention-calc"+nr) ?? false;

        let setState = false;
        if (storedCalcAtt === "true"){
            setState = true;
        }

        $("."+c+"-attention-calc"+nr).prop("checked", setState);
        markAttentionRow($("."+c+"-attention-calc"+nr), setState);

    }

    // Get the calc input values and set them
    for (let inpNr = 0; inpNr < inpNamesLength; inpNr++){
        for (let nr = 1; nr <= inpColLen; nr++){
            $("."+c+"-"+inputNames[inpNr]+nr).val(localStorage.getItem(c+"-"+inputNames[inpNr]+nr));
        }
    }
    
        // Get the insulin input and select values and set them

    let curBsVal = localStorage.getItem(c+"-cur-bs");
    let curGiVal = localStorage.getItem(c+"-cur-gi");
    let MealTypeVal = localStorage.getItem(c+"-ins-meal-type");
    
    let option;
    let optionVal;
    
    $("."+c+"-cur-bs").val(curBsVal);
    
    for (let giOpt = 0; giOpt < $("."+c+"-cur-gi option").length; giOpt++){
        option = $("."+c+"-cur-gi option:eq("+giOpt+")");
        optionVal = option.val();

        if (curGiVal == optionVal){
            option.attr("selected","selected");
        }
    }

    for (let mtOpt = 0; mtOpt < $("."+c+"-ins-meal-type option").length; mtOpt++){
        option = $("."+c+"-ins-meal-type option:eq("+mtOpt+")");
        optionVal = option.val();

        if (MealTypeVal == optionVal){
            option.attr("selected","selected");
        }
    }
    
});
    
// Set the localStorage input and select values
function setLocalStorage(thisElem){
    let inputName = $(thisElem).attr("name");
    let inputVal = $(thisElem).val();
    localStorage.setItem(inputName, inputVal);
}
function setCheckboxStorage(thisElem){
    let inputName = $(thisElem).attr("name");
    let inputCheck = $(thisElem).is(":checked");

    localStorage.setItem(inputName, inputCheck);
    markAttentionRow($(thisElem), inputCheck);
}
$(".calculator-name").on("input", function(){
    setLocalStorage(this);
});
$(".calc input").on("input", function(){
    if (!$(this).is(':checkbox')){
        setLocalStorage(this);
    } else {
        setCheckboxStorage(this);
    }
});
$(".ins-calc select").on("input", function(){
    setLocalStorage(this);
});

// Mark the row based on the attention checkbox state
function markAttentionRow(elem, state){
    
    const inputParent = elem.parent();
    const inputCols = inputParent.siblings().addBack();
    const index = inputParent.children('input').index(elem);

    if (state === true){
       
        inputCols.each(function(){
            const inputInCurrentDiv = $(this).find('input:eq('+index+')');
            inputInCurrentDiv.addClass("attention-active");
        });

    } else {

        inputCols.each(function(){
            const inputInCurrentDiv = $(this).find('input:eq('+index+')');
            inputInCurrentDiv.removeClass("attention-active");
        });
        
    }

}

// ---/---|---\---/ RESET \---/---|---\--- \\

function markWarnRow(e, nr, state){
    
    const inputParent = $(e.target).parent();
    const inputCols = inputParent.siblings();
    const index = nr - 1;

    if (state === "add"){

        inputCols.each(function(){
            const inputInCurrentDiv = $(this).find('input:eq('+index+')');
            inputInCurrentDiv.addClass("warn-active");
        });

    } else if (state === "remove") {

        inputCols.each(function(){
            const inputInCurrentDiv = $(this).find('input:eq('+index+')');
            inputInCurrentDiv.removeClass("warn-active");
        });
        
    }

}

// Reset all of the values in the row
for (let nr = 1; nr <= inpColLen; nr++){

    $("."+c+"-reset-calc-row"+nr).on("click", function(){
        
        // Input calc values
        for (let inpNr = 0; inpNr < inpNamesLength; inpNr++){
            $("."+c+"-"+inputNames[inpNr]+nr).val("");
            localStorage.removeItem(c+"-"+inputNames[inpNr]+nr);
        }
        
        // Multiplier calc values
        $("."+c+"-multi-calc"+nr).val(1);
        localStorage.removeItem(c+"-multi-calc"+nr);

        // Attention Toggle
        $("."+c+"-attention-calc"+nr).prop("checked", false);
        localStorage.removeItem(c+"-attention-calc"+nr);
        markAttentionRow($("."+c+"-attention-calc"+nr), false);
        
        // Calculate the input values
        inputCalcAll();
        insCalc();
        
        // Remove the multi-not-default class
        multiInp = $("."+c+"-multi-calc"+nr);
        multiNotDefault();

    });

    $("."+c+"-reset-calc-row"+nr).on("mouseenter", function(e){
        markWarnRow(e, nr, "add");
    });

    $("."+c+"-reset-calc-row"+nr).on("mouseleave", function(e){
        markWarnRow(e, nr, "remove");
    });
    
}

    // Reset all of the values

// Messages 
const holdMsg = "Przytrzymaj";
const resetMsg = "Zresetowano";
    
    // Variables
    
// Time to hold the button in milliseconds
const holdTime = 1000;
    
// Time to display the "Reset" message after successful btn hold
const afterHoldTime = 1500; 
    
// Track whether the button is being held or not
let holdBtn = false; 
    
let timerResetBtn;
let originalText = $("."+c+"-calc-reset .cr-txt").text();

// Touch events for it to work on mobile devices
$("."+c+"-calc-reset").on("mousedown touchstart", function(){
    
    // Add the "Ноld" text and the hold class
    let resetBtn = $(this);
    let resetTxt = resetBtn.children(".cr-txt");
    
    resetTxt.text(holdMsg);
    resetBtn.addClass("calc-reset-hold");
    
    holdBtn = false;
    
    // When the button is held for x time, run this code
    timerResetBtn = setTimeout(function(){
        
        holdBtn = true;
        
            // Calculator values
        
        $("."+c+"-calc-reset").removeClass("calc-reset-hold");
        
        for (let nr = 1; nr <= inpColLen; nr++){

            // Input calc values
            for (let inpNr = 0; inpNr < inpNamesLength; inpNr++){
                $("."+c+"-"+inputNames[inpNr]+nr).val("");
                localStorage.removeItem(c+"-"+inputNames[inpNr]+nr);
            }

            // Multiplier calc values
            $("."+c+"-multi-calc"+nr).val(1);
            localStorage.removeItem(c+"-multi-calc"+nr);

            // Attention Toggle
            $("."+c+"-attention-calc"+nr).prop("checked", false);
            localStorage.removeItem(c+"-attention-calc"+nr);
            markAttentionRow($("."+c+"-attention-calc"+nr), false);

        }
        
        // Remove the multi-not-default and multi-zero class
        $("."+c+"-multi-calc").each(function(){
            $(this).removeClass("multi-not-default");
            $(this).removeClass("multi-zero");
        });

            // Calculator insulin values

        $("."+c+"-cur-bs").val("");

        let giDefOpt = $("."+c+"-cur-gi option").eq(3).val()
        let MtDefOpt = $("."+c+"-ins-meal-type option").eq(1).val()

        $("."+c+"-cur-gi").val(giDefOpt);
        $("."+c+"-ins-meal-type").val(MtDefOpt);

        localStorage.removeItem(c+"-cur-bs");
        localStorage.removeItem(c+"-cur-gi");
        localStorage.removeItem(c+"-ins-meal-type");
        localStorage.removeItem(c+"changeInsVal");
        
        // Remove the warning BS classes
        $("."+c+"-expected-bs").removeClass("ins-warning-crit");
        $("."+c+"-expected-bs").removeClass("ins-warning");

            // Button messages
        
        // Show the "Reset" message and add the after class
        resetTxt.text(resetMsg);
        resetBtn.addClass("calc-reset-after");
        
        // Show the default message and remove the after class
        setTimeout(function(){
            if (holdBtn){
                resetTxt.text(originalText);
                resetBtn.removeClass("calc-reset-after");
            }
            holdBtn = false;
        }, afterHoldTime);

        // Calculate the input and insulin values
        inputCalcAll();
        insCalc();
        
    }, holdTime);
    
}).on("mouseup mouseleave touchend touchcancel", function(){
    
        // When the button is released

    // Change the btn txt to the original and remove the hold class
    if (!holdBtn){
        $(this).children(".cr-txt").text(originalText);
        $(this).removeClass("calc-reset-hold");
    }

    // Clear the timer
    clearTimeout(timerResetBtn);
});



// ---/---|---\---/ COPY CALCULATORS \---/---|---\--- \\



// Get the stored calculator names and insert them into the calculator selects
function insertCalcOptions(){
    let calculators = $(".calc").length;

    for (let calcs = 1; calcs <= calculators; calcs++){
        let calcInputVal = $(".calculator-name"+calcs).val();
        let calcHeading = $("."+c+"-calc-header h2");
        let calcStoredName = localStorage.getItem("calculator-name"+calcs);
        let calculatorName;

        switch (true){
            case calcInputVal.length >= 18:
                calculatorName = calcStoredName.substring(0, 16)+"...";
            break;
            case calcInputVal.length == 0:
                calculatorName = "Kalkulator "+calcs;
            break;
            case calcInputVal.length < 18:
                calculatorName = calcStoredName;
            break;
        }
        
        // Mark the option with the current calculator name and change the calcultor title heading
        if (c == calcs){
            calculatorName += " &#x2714";
            
            if (calcStoredName != null && calcInputVal != ""){
                calcHeading.html(calcStoredName);
            } else {
                calcHeading.html("Kalkulator "+calcs);
            }
        }
        
        let calcOptName = $("."+c+"-sc-option"+calcs);

        calcOptName.html(calcs+". "+calculatorName);
        calcOptName.val(calcs);
        
        // Add class to the currently selected option
        calcOptName.removeClass("current-calc");
        $("."+c+"-sc-option"+calcs+":selected").addClass("current-calc");

    }
}

// Store the original input and select values
let originVal = {};
let originMultiVal = {};
let originAttState = {};
    
let originBsVal;
let originGiVal;
let originMtVal;
let originInsAdjVal;
    
function originalValues(){
    
    // Input calc values
    for (let nr = 1; nr <= inpColLen; nr++){
        // Calc input values
        originVal[nr] = {};
        for (let inpNr = 0; inpNr < inpNamesLength; inpNr++){
            originVal[nr][c+inputNames[inpNr]] = $("."+c+"-"+inputNames[inpNr]+nr).val();
        }
        
        // Calc multiplier values
        originMultiVal[nr] = {};
        originMultiVal[nr][c+"-multi-calc"] = $("."+c+"-multi-calc"+nr).val();

        // Attention Toggle State
        originAttState[nr] = {};
        originAttState[nr][c+"-attention-calc"] = $("."+c+"-attention-calc"+nr).prop("checked");
    }

    // Insulin input and select values
    originBsVal = $("."+c+"-cur-bs").val();
    originGiVal = $("."+c+"-cur-gi").val();
    originMtVal = $("."+c+"-ins-meal-type").val();
    originInsAdjVal = parseFloat(localStorage.getItem(c+"changeInsVal"));
}

// On document ready
$(document).ready(function(){
    inputCalcAll();
    insertCalcOptions();
    originalValues();
});
    
// On copying another calculator
$(".select-calculator").on("click", function(){
    insertCalcOptions();
});
        
// On calculator name input
$(".calculator-name").on("input", debounce(function(){
    insertCalcOptions();
}, 40));
    
// On calc-reset button, row-reset button, multiplier buttons and select click
$(".calc-reset, .reset-calc-row, .cur-gi, .ins-meal-type, .multi-change").on("click", function(){
    originalValues();
});
    
// On calc input
$(".calc input").on("input", function(){
    originalValues();
});

$(document).on("keydown", "input", function(e){

    if ($(".calculator div input").is(":focus") &&
        e.key === 'q' && e.ctrlKey){
        
        // The value is set after when using the shortcut
        // That's why there's a delay
        setTimeout(() => {
            for (let nr = 1; nr <= inpColLen; nr++){
                originAttState[nr] = {};
                originAttState[nr][c+"-attention-calc"] = $("."+c+"-attention-calc"+nr).prop("checked");
            }
        }, 100);
        
    }

});

    /* Current Calculator */

// Define the current calculator in a variable
let currCalc; 

// Get the input values from the localStorage or arrays / variables and insert them into the current calculator
function currSelectCalc(){
        
    let curBs = c+"-cur-bs";
    let curGi = c+"-cur-gi";
    let mealType = c+"-ins-meal-type";
    
        // Calc inputs
    
    for (let nr = 1; nr <= inpColLen; nr++){
        
        // Calc input values
        for (let inpNr = 0; inpNr < inpNamesLength; inpNr++){
            let inputVal = originVal[nr][c+inputNames[inpNr]];

            $("."+c+"-"+inputNames[inpNr]+nr).val(inputVal);

            // Set the calc input values to the localStorage
            let inputName = $("."+c+"-"+inputNames[inpNr]+nr).attr("name");
            localStorage.setItem(inputName, inputVal);
        }
        
        // Multiplier calc input values
        let multiVal = originMultiVal[nr][c+"-multi-calc"];
        $("."+c+"-multi-calc"+nr).val(multiVal);
        
        let multiName = $("."+c+"-multi-calc"+nr).attr("name");
        localStorage.setItem(multiName, multiVal);

        // Attention calc checkbox state
        let attState = originAttState[nr][c+"-attention-calc"];

        $("."+c+"-attention-calc"+nr).prop("checked", attState);
        markAttentionRow($("."+c+"-attention-calc"+nr), attState);
        
        let attName = $("."+c+"-attention-calc"+nr).attr("name");
        localStorage.setItem(attName, attState);
    }

        // Insulin

    // Set the values
    $("."+curBs).val(originBsVal);
    $("."+curGi).val(originGiVal);
    $("."+mealType).val(originMtVal);
    
    changeInsVal = originInsAdjVal;

    // Select the correct select option
    for (let giOpt = 0; giOpt < $("."+curGi+" option").length; giOpt++){
        let option = $("."+curGi+" option:eq("+giOpt+")");
        let optionVal = option.val();

        if (originGiVal == optionVal){
            option.attr("selected","selected");
        }
    }
    
    for (let mtOpt = 0; mtOpt < $("."+mealType+" option").length; mtOpt++){
        let option = $("."+mealType+" option:eq("+mtOpt+")");
        let optionVal = option.val();

        if (originMtVal == optionVal){
            option.attr("selected","selected");
        }
    }

    // Set the values to the localStorage
    localStorage.setItem(curBs, originBsVal);
    localStorage.setItem(curGi, originGiVal);
    localStorage.setItem(mealType, originMtVal);
    
    localStorage.setItem(c+"changeInsVal", parseFloat(originInsAdjVal));
}

    /* Different Calculator */
    
function diffSelectCalc(){
    let storedCurBs = localStorage.getItem(currCalc+"-cur-bs");
    let storedCurGi = localStorage.getItem(currCalc+"-cur-gi");
    let storedMealType = localStorage.getItem(currCalc+"-ins-meal-type");
    
    let curBs = c+"-cur-bs";
    let curGi = c+"-cur-gi";
    let mealType = c+"-ins-meal-type";

    // Insert the calc input values
    for (let nr = 1; nr <= inpColLen; nr++){
        for (let inpNr = 0; inpNr < inpNamesLength; inpNr++){
            // Insert the imported input values
            let storedVal = localStorage.getItem(currCalc+"-"+inputNames[inpNr]+nr);
            $("."+c+"-"+inputNames[inpNr]+nr).val(storedVal);

            // Save the new input values to the localStorage
            let inputName = $("."+c+"-"+inputNames[inpNr]+nr).attr("name");
            if (storedVal != null){
                localStorage.setItem(inputName, storedVal);
            } else {
                localStorage.setItem(inputName, "");
            }
        }

        // Multiplier calc input values (insert 1 if undefined)
        let multiStoredVal = localStorage.getItem(currCalc+"-multi-calc"+nr) ?? 1;
        $("."+c+"-multi-calc"+nr).val(multiStoredVal);
        
        // Save the new multiplier input values to the localStorage
        let multiStoredName = $("."+c+"-multi-calc"+nr).attr("name");
        
        if (multiStoredVal != null){
            localStorage.setItem(multiStoredName, multiStoredVal);
        } else {
            localStorage.setItem(multiStoredName, "");
        }

        // Multiplier calc input values (insert 1 if undefined)
        let attStoredState = localStorage.getItem(currCalc+"-attention-calc"+nr) ?? false;

        let attSetState = false;
        if (attStoredState === "true"){
            attSetState = true;
        }

        $("."+c+"-attention-calc"+nr).prop("checked", attSetState);
        markAttentionRow($("."+c+"-attention-calc"+nr), attSetState);
        
        // Save the new multiplier input values to the localStorage
        let attStoredName = $("."+c+"-attention-calc"+nr).attr("name");
        
        if (attSetState != null){
            localStorage.setItem(attStoredName, attSetState);
        } else {
            localStorage.setItem(attStoredName, "");
        }

    }

        // Insulin

    // If the value is undefined or is null - set it to the default option (defaule isn't the first option)
    if (storedCurGi === undefined || storedCurGi === null) {
        storedCurGi = $("."+curGi+" option").eq(3).val();
    }
    if (storedMealType === undefined || storedMealType === null) {
        storedMealType = $("."+mealType+" option").eq(1).val();
    }

    // Set the values
    $("."+curBs).val(storedCurBs);
    $("."+curGi).val(storedCurGi);
    $("."+mealType).val(storedMealType);

    changeInsVal = localStorage.getItem(currCalc+"changeInsVal");

    // Select the correct select option
    for (let giOpt = 0; giOpt < $("."+curGi+" option").length; giOpt++){
        let option = $("."+curGi+" option:eq("+giOpt+")");
        let optionVal = option.val();

        if ($("."+curGi).val() == optionVal){
            option.attr("selected","selected");
        }
    }
    for (let mtOpt = 0; mtOpt < $("."+mealType+" option").length; mtOpt++){
        let option = $("."+mealType+" option:eq("+mtOpt+")");
        let optionVal = option.val();

        if ($("."+mealType).val() == optionVal){
            option.attr("selected","selected");
        }
    }

    // Set the values to the localStorage
    localStorage.setItem(curBs, $("."+curBs).val());
    localStorage.setItem(curGi, $("."+curGi).val());
    localStorage.setItem(mealType, $("."+mealType).val());
    
    localStorage.setItem(c+"changeInsVal", parseFloat(changeInsVal));
}

    /* Multiplier */

// Add / remove the multiplier highlight class (if val != 1)
// Add / Remove the stop class
function multiClassChange(){

    $("."+c+"-multi-calc").each(function(){
        multiInp = $(this);
        let multiVal = multiInp.val();

        if (multiVal == 0){
            $(this).siblings('.multi-sub').addClass("multi-stop");
        } else {
            $(this).siblings('.multi-sub').removeClass("multi-stop");
        }
        
        if (multiVal == 10){
            $(this).siblings('.multi-add').addClass("multi-stop");
        } else {
            $(this).siblings('.multi-add').removeClass("multi-stop");
        }

        multiNotDefault();

    });

}

    /* Calculator Selection */

$(".select-calculator"+c).on("input", function(){
    // Get the value of the selected calculator
    currCalc = $(this).val();
    
    if (currCalc == c){
        // Set values if the chosen calculator is the current one (get values from the array)
        currSelectCalc();
    } else {
        // Set values if the chosen calculator is NOT the current one (get values from the localStorage)
        diffSelectCalc();
    }
    
    // Calculate the input values
    inputCalcAll();

    // Add / remove the multiplier highlight class (if val != 1)
    // Add / Remove the stop class
    multiClassChange();

});



// ---/---|---\---/ INSULIN CALCULATOR \---/---|---\--- \\
    
    
    
    // Settings 
    
// Calc will always aim for the bs to be the closest to this value    
let baseBs = 100;  
    
// Max blood sugar value  
let maxBsVal = 350;    
    
// Low BS
let lowBs = 80;
    
// Critically low BS
let critLowBs = 70;

// High BS
let highBs = 130;
    
// Critically high BS
let critHighBs = 140;
    
// Insulin offset (max change value)
let insulinOffset = 2;
    
// Minimal carb value (in grams) to calculate the insulin based on carbs
let calcCarbVal = 5;
    
// Minimal WPTS value to calculate the insulin based on WPTS
let calcWptsVal = 1;

    // Element variables

// Calculator outputs
let curGiSel = $("."+c+"-cur-gi");
let curGiWpts = $("."+c+"-cur-gi-wpts");
    
let insMealOutput = $("."+c+"-ins-meal");
let insCurrOutput = $("."+c+"-ins-correction");
let insTotalOutput = $("."+c+"-ins-total");

let insSub = $("."+c+"-ins-sub");
let insAdd = $("."+c+"-ins-add");

let expectedBsOutput = $("."+c+"-expected-bs");
let timeBeforeMealOutput = $("."+c+"-time-before-meal");
    
// Variable for adding / subtracting ins units / not defined == 0
let changeInsVal;
    
    // Replace the ins calc input value with "no value"
    
function noValInsCalc(){
    insMealOutput.val("-");
    insCurrOutput.val("-");
    insTotalOutput.val("-");

    expectedBsOutput.val("-");
    timeBeforeMealOutput.val("-");  
}
    
    // Insulin Calculator function
    
function insCalc(){
    // Variable for adding / subtracting ins units / not defined == 0
    changeInsVal = parseFloat(localStorage.getItem(c+"changeInsVal")) || 0;

    // For every additional or deficit bsIncrease value change the injection time before meal by this value (minutes) - best is 5
    let timeChangeUnit = 5;

    // Base input values
    let insEarly = $(".ins-amount-early").val();
    let insMid = $(".ins-amount-mid").val();
    let insLate = $(".ins-amount-late").val();
    let bsIncrease = $(".bs-increase").val();
    
    // Calculator input values
    let curBs = $("."+c+"-cur-bs").val();
    let curGi = curGiSel.val();
    let insMealType = $("."+c+"-ins-meal-type").val();
    
            
    // Enable / disable GI select
    curGiSel.css("display", "block");            
    curGiWpts.css("display", "none");

    if (insEarly != 0 &&
        insMid != 0 &&
        insLate != 0 &&
        bsIncrease != 0 &&
        curBs > 30){

        // Calculator nutrition values
        let carbVal = $("."+c+"-carb-result").val();
        let fatVal = $("."+c+"-fat-result").val();
        let proteinVal = $("."+c+"-protein-result").val();

            // Wariables used in calculating
        
        // WPTS (calories from fat and protein / 100) 
        let wpts = (fatVal * 9 + proteinVal * 4) / 100;
            
        // WPTS * 10 (to calculate the insulin amount)
        let wptsx = wpts * 10;
        
        // Carbohydrate portion (carbs / 10)
        let cp = carbVal / 10;
        
        // Variable used to change the carb / WPTS calculation units
        let insCalcUnit;
        
            // Don't change
        
        // The blood sugar difference between 100 and the current value
        let bsDiff = curBs - 100; // 100 instead of baseBs, otherwise it wouldn't make sense cuz of how it's calculated

        // It should be corrIns - correction insulin...
        let currIns = (curBs - baseBs) / bsIncrease;

            // Select switch

        // Switch the meal time type
        let curInsMealType;
        switch (insMealType){
            case "early":
                curInsMealType = insEarly;
            break;
            case "mid":
                curInsMealType = insMid;
            break;
            case "late":
                curInsMealType = insLate;
            break;
        }

        // Switch the GI level
        let timeBeforeMeal;
        switch (curGi){
            case "very-low-gi":
                timeBeforeMeal = 5;
            break;
            case "low-gi":
                timeBeforeMeal = 15;
            break;
            case "med-gi":
                timeBeforeMeal = 20;
            break;
            case "high-gi":
                timeBeforeMeal = 30;
            break;
        }

        if (carbVal >= calcCarbVal){
            
        // Calculate the values based on carbs
        // If there are enough carbs

            // Calculate carbs
            insCalcUnit = carbVal;

            switch (true){
                case bsDiff >= 60:
                    timeChangeUnit *= 1.25;
                break;
                case bsDiff <= -30:
                    timeChangeUnit *= 4.5;
                break;
                case bsDiff <= -20:
                    timeChangeUnit *= 4;
                break;
                case bsDiff <= -10:
                    timeChangeUnit *= 2.5;
                break;
            }
               
            // Calculate the time change for insulin application
            let timeChange = (bsDiff / bsIncrease) * timeChangeUnit;

            // Every correction unit = 2 min, every change unit = -2 min
            timeBeforeMeal += timeChange + (currIns * 2) - (changeInsVal * 2);
            
        } else if (cp < wpts && wpts >= calcWptsVal){
            
        // Calculate the values based on WPTS
        // If there are less carbs than WPTS
            
            // Calculate WPTS
            insCalcUnit = wptsx;
            
            // Enable / disable GI select
            curGiSel.css("display", "none");            
            curGiWpts.css("display", "block");

            // Adjust the timeChangeUnit based on the current BS value
            switch (true){
                case bsDiff >= 60:
                    timeChangeUnit *= 1.25;
                break;
                case bsDiff <= -30:
                    timeChangeUnit *= 2;
                break;
                case bsDiff <= -20:
                    timeChangeUnit *= 1.5;
                break;
            }
            
            // Change the fixed time before meal to -5 minutes no matter the selected option
            timeBeforeMeal = -5;
            
            // Calculate the time change for insulin application
            let timeChange = (bsDiff / bsIncrease) * timeChangeUnit;
            
            // Every correction unit = 2 min
            // Every change insulin unit = -2 min
            // Every 5 WPTS = -5 min
            timeBeforeMeal += timeChange + (currIns * 2) - (changeInsVal * 2) - (wpts / 5 * timeChangeUnit);
            
        }

            // Meal insulin

        let mealIns = insCalcUnit / curInsMealType;
        insMealOutput.val(Math.round(mealIns * 100) / 100);

            // Correction insulin

        insCurrOutput.val(Math.round(currIns * 100) / 100);

            // Total insulin

        let totalIns = mealIns + currIns;
        let totalInsRounded = Math.round(totalIns) + changeInsVal;
        let changeInsTxt = "";

        // Add info about added / subtracted insulin units
        switch (true){
            case changeInsVal > 0:
                changeInsTxt = " (+"+changeInsVal+")";
            break;
            case changeInsVal < 0:
                changeInsTxt = " ("+changeInsVal+")";
            break;
        }

        // If the total amount of insulin < 0, add info and a class
        if (totalInsRounded < 0){
            totalInsRounded = "< " + 0;
            insTotalOutput.parent(".total-ins-change").addClass("ins-warning-crit");
        } else {
            insTotalOutput.parent(".total-ins-change").removeClass("ins-warning-crit");
        }

        totalInsRounded += changeInsTxt;

        insTotalOutput.val(totalInsRounded);

            // Expected blood sugar

        let expectedBs = baseBs - ((Math.round(totalIns) - totalIns) * bsIncrease);
        let totalInsOnly = Math.round(totalIns) + changeInsVal;

        // Prevent from changing the expected BS when there is <= 0 insulin units 
        // Who would've thought that u can't slurp sum insulin out of ur body...
        if (totalInsOnly <= 0){
            expectedBs = parseFloat(curBs) + (insCalcUnit / curInsMealType * bsIncrease);
        } else {
            expectedBs -= bsIncrease * changeInsVal;
        }

        expectedBsOutput.val(Math.round(expectedBs));

            // Injection time before meal

        // Round to the nearest 5
        timeBeforeMeal = Math.round(timeBeforeMeal / 5) * 5;

        // Add txt after / before / directly before and make the number always positive (absolute value)
        switch (true){
            case timeBeforeMeal < 0:
                timeBeforeMeal = Math.abs(timeBeforeMeal)+" min po";
            break;
            case timeBeforeMeal > 0:
                timeBeforeMeal = Math.abs(timeBeforeMeal)+" min przed";
            break;
            case timeBeforeMeal === 0:
                timeBeforeMeal = "bezpośred. przed";
            break;
        }

        // If there's no insulin, there's no injection time (genius)
        if (totalInsOnly <= 0){
            timeBeforeMeal = "brak";
        }

        timeBeforeMealOutput.val(timeBeforeMeal);
        
            // If the above if statement conditions weren't met
        
        if (carbVal < calcCarbVal && cp >= wpts ||
            carbVal < calcCarbVal && wpts < calcWptsVal){
            noValInsCalc();  
        }
        
            // Add / remove the stop class
        
        // If there's no insulin value ("-" is a placeholder)
        if ($("."+c+"-ins-total").val() == "-"){
            $("."+c+"-ins-sub").addClass("ins-total-stop");
            $("."+c+"-ins-add").addClass("ins-total-stop");
        } else {
            $("."+c+"-ins-sub").removeClass("ins-total-stop");
            $("."+c+"-ins-add").removeClass("ins-total-stop");
        }
        
        // If the offset is reached
        if (changeInsVal == insulinOffset){
            $("."+c+"-ins-add").addClass("ins-total-stop");
        }
        if (changeInsVal == -insulinOffset){
            $("."+c+"-ins-sub").addClass("ins-total-stop");
        }

    } else {
        noValInsCalc();
        
        // Add the stop class
        $("."+c+"-ins-sub").addClass("ins-total-stop");
        $("."+c+"-ins-add").addClass("ins-total-stop");
    }
    
    // Add sum classes to see if the expected BS is safe
    let expBsOpt = expectedBsOutput.val();

    switch (true){      
        case expBsOpt <= critLowBs:
        case expBsOpt >= critHighBs:
            expectedBsOutput.addClass("ins-warning-crit");
        break;

        case expBsOpt > critLowBs && expBsOpt < lowBs:
        case expBsOpt > highBs && expBsOpt < critHighBs:
            expectedBsOutput.removeClass("ins-warning-crit");
            expectedBsOutput.addClass("ins-warning");
        break;

        default:
            expectedBsOutput.removeClass("ins-warning-crit");
            expectedBsOutput.removeClass("ins-warning");
    }

}
    
    // Change insulin offset value
    
function storeInsAdj(){
    localStorage.setItem(c+"changeInsVal", parseFloat(changeInsVal));
}
    
insSub.on("click", function(){
    let totalVal = $(this).closest('.total-ins-change').find('.ins-total').val();

    if(totalVal != "-"){
        if (changeInsVal > -insulinOffset){
            changeInsVal -= 1;
            storeInsAdj();
            insCalc();
        }
        if (changeInsVal == -insulinOffset){
            $(this).addClass("ins-total-stop");
        } else {
            $(this).removeClass("ins-total-stop");
            $(this).closest('.total-ins-change').find('.ins-add').removeClass("ins-total-stop");
        }
    }
})
    
insAdd.on("click", function(){
    let totalVal = $(this).closest('.total-ins-change').find('.ins-total').val();

    if(totalVal != "-"){
        if (changeInsVal < insulinOffset){
            changeInsVal += 1;
            storeInsAdj();
            insCalc();
        }
        if (changeInsVal == insulinOffset){
            $(this).addClass("ins-total-stop");
        } else {
            $(this).removeClass("ins-total-stop");
            $(this).closest('.total-ins-change').find('.ins-sub').removeClass("ins-total-stop");
        }
    }
})
    
    // Calculate insulin (event handlers)

$(document).ready(function(){
    insCalc();
    
        // Add the stop class if the offset limit has been reached
    
    if (changeInsVal == insulinOffset){
        $("."+c+"-ins-add").addClass("ins-total-stop");
    }
    
    if (changeInsVal == -insulinOffset){
        $("."+c+"-ins-sub").addClass("ins-total-stop");
    } 
});

// On copying another calculator
$(".select-calculator").on("click", function(){
    insCalc();
});

// Set the max BS value
$(".cur-bs").on("input", function(){
    if ($(this).val() > maxBsVal){
        $(this).val(maxBsVal);
    }
});
    
// On input / select (insulin section) and basic insulin settings
$(".cur-bs, .cur-gi, .ins-meal-type, .ins-input").on("input", function(){
    insCalc();
});

// On weight, fat, protein, carb value input
$(".weight-calc-col, .fat-calc-col, .protein-calc-col, .carb-calc-col").on("input", "input", function(){
    insCalc();
});

// On insulin adjust button click - save the current calculator settings
$(".ins-adjust").on("click", function(){
    originalValues();
}); 

} // <-- The end of the calculator loop



// ---/---|---\---/ Keyboard Shortcuts \---/---|---\--- \\



// Toggle the attention checkbox & mark the row
function attentionShortcut(e){

    if ($(".calculator div input").is(":focus") &&
        e.key === 'q' && e.ctrlKey){
        
        const eTarget = e.currentTarget;
        const inputParent = $(eTarget).parent();
        const index = inputParent.children('input').index($(eTarget));

        const thisAttToggle =
            inputParent.siblings(".attention-calc-col").children('.attention-toggle:eq('+index+')');
        const toggleState = thisAttToggle.prop("checked");

        // Set the new state
        thisAttToggle.prop("checked", !toggleState);

        // Mark the row & save the checkboc state to the localstorage
        setCheckboxStorage(thisAttToggle);
    }

}

// Move focus on ctrl + arrow keys click
function navigationShortcuts(e){

    const ctrl = e.ctrlKey;
    const eTarget = e.currentTarget;
    
    // Change focus + prevent from focusing on the calc result inputs
    if ($(".calculator div input").is(":focus") &&
        !$(eTarget).next().hasClass("calc-result") && ctrl){
        
        // Down arrow
        if (e.keyCode == 40){
            $(eTarget).next("input").focus();
        }
    }
    
    // Change focus
    if ($(".calculator div input").is(":focus") && ctrl){
        let inputParent = $(eTarget).parent();
        let index = inputParent.children('input').index($(eTarget));
        
        // Up arrow
        if (e.keyCode == 38){
            $(eTarget).prev("input").focus();
        }  
        
        // Left arrow (exclude attention toggle)
        if (e.keyCode == 37){
            inputParent.prev().children('input:not([type="checkbox"]):eq('+index+')').focus();
        }
        
        // Right arrow
        if (e.keyCode == 39){
            inputParent.next().children('input:eq('+index+')').focus();
        }
    }

}

$(document).on("keydown", "input", function(e){
    navigationShortcuts(e);
    attentionShortcut(e);
});