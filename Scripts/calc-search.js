requestAnimationFrame(() => {



// ---/---|---\---/ Icons \---/---|---\--- \\



const magGlassIcon = "<svg class='search-icon mag-glass-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><circle cx='67.8' cy='67.9' r='62.8'/><path d='M145.7,159,178,191.3c4.3,4.3,10.8,4.8,14.5,1.2h0c3.6-3.7,3.1-10.2-1.1-14.5L159,145.7c-22.1-22.1-43-37.1-46.7-33.4S123.6,136.9,145.7,159Z'/><path d='M41.8,29.6a45.7,45.7,0,0,1,26-8,46.4,46.4,0,0,1,32.3,13'/></svg>";

const loadingIcon = "<svg class='search-icon loading-icon' height='100' width='100' viewBox='0 0 100 100'><circle class='loading-circle loading-bg' cx='50' cy='50' r='45'></circle><circle class='loading-circle loading-loader' cx='50' cy='50' r='45'></circle></svg>";

const searchIcon = (elem, icon) => {
    $(elem).empty();
    $(elem).append(icon);
}

$(document).ready(function(){

    // Insert the search button loading icon on page load
    $(".search-btn").each(function(){
        searchIcon($(this), magGlassIcon);
    });

});



// ---/---|---\---/ Search Checkboxes \---/---|---\--- \\



// Save the checkbox Value
$(".search-box").on("input", function(){
    localStorage.setItem($(this).attr("id"), $(this).prop("checked"));
});

$(document).ready(function(){

    // Load the checkboxes' values
    $(".search-box").each(function(){

        let checkboxState = localStorage.getItem($(this).attr("id"));
        
        if ($(this).attr("id") !== "search-box-auto"){

            // Check if there is a value in the localcStorage
            if (checkboxState == null | checkboxState === undefined){
                localStorage.setItem($(this).attr("id"), "true");
                checkboxState = localStorage.getItem($(this).attr("id"));
            }

            // Set the checkbox state
            $(this).prop("checked",
                checkboxState === null ? true : checkboxState === "true"
            );

        } else {
            $(this).prop("checked", checkboxState === "true");
        }
        
    });

});



// ---/---|---\---/ API Fetch \---/---|---\--- \\



// Input value validation
const valid = (nameInp) => {

    const inputVal = nameInp.val();
    const searchBtn = nameInp.siblings(".search-btn");

    const regex = /^[a-zA-Z0-9,.()\- \p{L}]+$/u;

    if (regex.test(inputVal) &&
        inputVal.length > 2 &&
        inputVal.length < 420
    ){
        searchBtn.addClass("btn-active");
        return true;
    } else {
        searchBtn.removeClass("btn-active");
        return false;
    }

};

// Nutrient value / 100g
const nutriVal = (data, attrId) => {

    if (data.full_nutrients && data.serving_weight_grams){

        const nutriVal = data.full_nutrients.find(
            nutrient => nutrient.attr_id === attrId
        )?.value;

        const servingWeight = data.serving_weight_grams;

        let nutriVal100 = "0";

        if (nutriVal && servingWeight){
            nutriVal100 =(Math.round(
                (nutriVal / servingWeight) * 100 * 10) / 10
            ).toString()
        }

        return nutriVal100;

    }
    
}

// Net Carbs
const netCarbs = (total, fiber) => {
    if (total && fiber){
        return Math.round((total - fiber) * 10) / 10;
    } else {
        return 0;
    }
}

const useData = (data, searchList) => {

    // Remove everything from the search list
    searchList.empty();

    const dataset = data.common;

    if (dataset.length > 0){
        dataset.forEach((data) => {
            
            // Element
            const listElem = document.createElement("button");
            listElem.classList.add("list-elem");
            listElem.setAttribute('name', data.food_name);
            listElem.setAttribute('kcal', nutriVal(data, 208));
            listElem.setAttribute('fat', nutriVal(data, 204));
            listElem.setAttribute('fiber', nutriVal(data, 291));
            listElem.setAttribute('protein', nutriVal(data, 203));
            listElem.setAttribute('carbs',
                netCarbs(nutriVal(data, 205), nutriVal(data, 291))
            );

            // Image
            const elemImg = document.createElement("img");
            elemImg.classList.add("list-img");

            const photoCheck = "nix-apple-grey";

            if (!data.photo.thumb.includes(photoCheck)){
                elemImg.src = data.photo.thumb;
            } else {
                elemImg.src = './Images/no-img.svg';
            }

            elemImg.setAttribute('alt', `${data.food_name} photo`);

            // Item Name
            const elemName = document.createElement("p");
            elemName.classList.add("list-name");
            elemName.innerHTML = data.food_name;

            // Item Calorie val / 100g
            const elemKcal = document.createElement("p");
            elemKcal.classList.add("list-kcal");
            elemKcal.innerHTML = `${nutriVal(data, 208)} kcal`;

            // Append elements
            listElem.append(elemImg);
            listElem.append(elemName);
            listElem.append(elemKcal);

            searchList.append(listElem);

        });
    } else {
        displayError("Brak wyników", 0, searchList);
    }

}

const displayError = (msg, error, searchList) => {

    // Remove everything from the search list
    searchList.empty();

    // Element
    const listElem = document.createElement("div");
    listElem.classList.add("list-elem");

    // Error code
    if (msg === "error" && error && /\d/.test(error)){
        const errorCode = document.createElement("p");
        errorCode.classList.add("error-code");
        errorCode.innerHTML = error;
        listElem.append(errorCode);
    }

    // Error
    const errorElem = document.createElement("p");
    errorElem.classList.add("list-error");

    // Error codes
    let errorMsg = "";

    if (msg === "error" && error !== 0){
        switch (error){
            case 400:
                errorMsg = "Niepoprawne dane, sprawdź wyszukiwane hasło";
                break;
            case 401:
                errorMsg = "Nieautoryzowany dostęp";
                break;
            case 403:
                errorMsg = "Dostęp zabroniony";
                break;
            case 404:
                errorMsg = "Wyszukiwanie nie znalezione";
                break;
            case 409:
                errorMsg = "Konflikt wyszukiwania";
                break;
            case 500:
                errorMsg = "Błąd serwera, spróbuj ponownie później";
                break;
            default:
                errorMsg = "Nieznany błąd, spróbuj ponownie później";
        }
    } else {
        errorMsg = msg;
    }

    errorElem.innerHTML = errorMsg;

    // Append elements
    listElem.append(errorElem);
    searchList.append(listElem);

}

// Fetch the API data
const searchFetch = (searchVal, iconElem) => {

    // Fetch settings
    const apiLang = "pl_PL";
    const apiID = "1b78231c";
    const apiKey = "96466c5ac8b6d102fbd2df8e169ca060";

    const dataUrl = `https://trackapi.nutritionix.com/v2/search/instant/?query=${searchVal}&locale=${apiLang}&branded=false&detailed=true`;

    // Display the loading icon
    searchIcon(iconElem, loadingIcon);

    // Search list
    const searchList = $(iconElem)
        .siblings(".search-list-outer")
        .children(".search-list");

    // Display a message if the API response takes too long
    const longFetch = setTimeout(() => {
        displayError(
            "Ładowanie...<br> Już chyba farba schnie szybciej",
            0, searchList
        );
    }, 8000);

    // API fetch request
    fetch(dataUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'x-app-id': apiID,
            'x-app-key': apiKey
        }
    })
    .then(response => {
        if (!response.ok){
            displayError("error", response.status, searchList);
        }
        return response.json();
    })
    .then(data => {
        useData(data, searchList);
    })
    .catch(error => {
        displayError("error", error, searchList);
    })
    .finally(() => {
        clearTimeout(longFetch);
        searchIcon(iconElem, magGlassIcon);
    });

};

$(document).ready(function(){

    // Add the active search button class on page load
    $(".name-calc").each(function(){
        valid($(this));
    });

    let typeThrottle = null;
    let isFreshInp = true;

    // Typing auto-fetch (if checked in the settings)
    $(".name-calc").on("input", function(){

        if (valid($(this)) &&
            localStorage.getItem("search-box-auto") === "true"
        ){
            
            const inputVal = $(this).val();

            // Throttle the typing speed to prevent excessive fetch requests
            // When typing fast or holding a key
            if (isFreshInp){
                isFreshInp = false;
                searchFetch(
                    inputVal, $(this).siblings(".search-btn").get(0)
                );
            } else {
                clearTimeout(typeThrottle);
                typeThrottle = setTimeout(() => {
        
                    isFreshInp = true;
                    searchFetch(
                        inputVal, $(this).siblings(".search-btn").get(0)
                    );
        
                }, 200);
            }

        }
            
    });

    // Search button fetch
    $(".search-btn").on("click", function(){

        const nameInp = $(this).siblings(".name-calc");
        const inputVal = nameInp.val();

        // Value Validation
        if (!valid(nameInp)){
            $(this).addClass("btn-error");
            setTimeout(() => {
                $(this).removeClass("btn-error");
            }, 500);

            return;
        }

        nameInp.focus();
        searchFetch(inputVal, $(this).get(0));

    });

    // Toggle the search list visibility
    $(document).on("click focusin", function(e){

        const eType = e.type;
        const closestNameElem = $(e.target).closest('.name-elem');
        $(".name-elem").removeClass("search-open");

        // Check if the clicked or focused element is ".name-elem"
        // Or if ".name-elem" is a parent of the clicked element
        // Except when the clicked element is ".list-elem" or its children
        // EXCEPT when the ".list-elem" is on focus, then it's ok
        // What have I done with my life?
        if (
            (eType === "click" &&
            closestNameElem.length > 0 &&
            !$(e.target).closest('.list-elem').length) ||

            (eType === "focusin" &&
            closestNameElem.length > 0)
        ){
            closestNameElem.addClass("search-open");
        }

    });

});



// ---/---|---\---/ Insert Data \---/---|---\--- \\



const insertList = [
    "kcal",
    "fat",
    "carb",
    "fiber",
    "protein"
]

$(document).on("click", ".list-elem", function(){

    // Index
    const calc = $(this).closest('.calc');
    const index = calc.find('.name-elem').index($(this).closest('.name-elem'));

    // Searched item info
    const name = $(this).attr("name");
    const kcal = $(this).attr("kcal");
    const fat = $(this).attr("fat");
    const carb = $(this).attr("carbs");
    const fiber = $(this).attr("fiber");
    const protein = $(this).attr("protein");

    // Change the name input value
    $(this).closest('.search-list-outer').siblings('.name-calc').val(name);

    // Change the calculator input values (macronutrients)
    insertList.forEach((item) => {
        if (localStorage.getItem(`search-box-${item}`) === "true"){
            calc.find(`.${item}-calc`).eq(index).val(eval(item));
        }
    });

    // Collapse the search list
    $(".name-elem").removeClass("search-open");

    // Give the focus back to the input
    $(this).closest('.name-calc').focus();

    // Dispatch the custom event with index data
    const fetchedSearch = new CustomEvent('fetchedSearch', { detail: { index } });
    document.dispatchEvent(fetchedSearch);

});

});