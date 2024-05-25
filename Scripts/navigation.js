


// Cookbook version
const appVersion = "v1.3.4";



// Icons
const mainIcon = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280'><defs><style>.cls-1{fill:none;stroke-miterlimit:10;}</style></defs><rect class='cls-1' x='44' y='44' width='80' height='80' rx='12'/><rect class='cls-1' x='156' y='44' width='80' height='80' rx='12'/><rect class='cls-1' x='44' y='156' width='80' height='80' rx='12'/><rect class='cls-1 nav-icon-accent' x='156' y='156' width='80' height='80' rx='12'/></svg>";

const calculatorIcon = "<svg id='Layer_1' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280'><defs><style>.cls-1{fill:none;}.cls-1,.cls-1,.cls-2,.cls-3{stroke-miterlimit:10;}.cls-2,.cls-3{fill:#fff;stroke-linecap:round;}</style></defs><rect class='cls-1' x='44' y='44' width='80' height='80' rx='12'/><rect class='cls-1' x='156' y='44' width='80' height='80' rx='12'/><rect class='cls-1' x='44' y='156' width='80' height='80' rx='12'/><rect class='cls-1 nav-icon-accent' x='156' y='156' width='80' height='80' rx='12'/><line class='cls-2' x1='84' y1='61.6' x2='84' y2='106.4'/><line class='cls-2' x1='61.6' y1='84' x2='106.4' y2='84'/><line class='cls-2' x1='173.6' y1='84' x2='218.4' y2='84'/><line class='cls-2' x1='68.2' y1='180.2' x2='99.8' y2='211.8'/><line class='cls-2' x1='68.2' y1='211.8' x2='99.8' y2='180.2'/><line class='cls-3 nav-icon-accent' x1='173.6' y1='196' x2='218.4' y2='196'/><line class='cls-2 nav-icon-accent' x1='196' y1='180.2' x2='196' y2='180.2'/><line class='cls-2 nav-icon-accent' x1='196' y1='211.8' x2='196' y2='211.8'/></svg>";

const recipeIcon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280'><defs><style>.cls-1,.cls-2{fill:none;stroke-miterlimit:10;}.cls-1{stroke-linecap:round;}</style></defs><line class='cls-1' x1='140' y1='135.1' x2='140' y2='163'/><path class='cls-1' d='M89.2,134.7c1.8,11.4,8.5,21.6,14.1,28.3'/><path class='cls-1' d='M70.5,150C20,125.5,48,49,99,64.2'/><line class='cls-1' x1='71.1' y1='217.8' x2='71.1' y2='150.3'/><line class='cls-1' x1='92' y1='236.3' x2='156' y2='236.3'/><path class='cls-1' d='M71.1,217.4c0,8.7,8.8,18.9,21.9,18.9'/><path class='cls-1' d='M89.5,93.9c3.1-36.8,29.7-52.3,55.8-50'/><path class='cls-1' d='M190.8,134.7c-1.8,11.4-8.5,21.6-14.1,28.3'/><path class='cls-1' d='M209.5,150C260,125.5,232,49,181,64.2'/><line class='cls-1' x1='208.9' y1='217.8' x2='208.9' y2='150.3'/><line class='cls-1' x1='188.1' y1='236.3' x2='124' y2='236.3'/><path class='cls-1' d='M208.9,217.4c0,8.7-8.8,18.9-21.9,18.9'/><path class='cls-1' d='M190.5,93.9c-2.3-32.2-24.4-48.5-46-50'/><line class='cls-2' x1='71.6' y1='198.7' x2='207.5' y2='198.7'/></svg>";

const productIcon = "<svg id='Layer_2' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 280'><defs><style>.cls-1{fill:none;}.cls-2{stroke-linecap:round;stroke-miterlimit:10;}</style></defs><line class='cls-1' x1='140' y1='147.4' x2='140' y2='208.1'/><line class='cls-1' x1='98.2' y1='147.4' x2='105.6' y2='208.1'/><path class='cls-1' d='M222.8,129.8l-16.3,91.7C205,229.3,198.8,236,188,236H92c-10.8,0-17-6.6-18.5-14.4L57.2,129.8'/><line class='cls-1' x1='181.8' y1='147.5' x2='174.5' y2='208.2'/><path class='cls-1' d='M228,127.4a8,8,0,0,0,8-8h0a8,8,0,0,0-8-7.9H52a8,8,0,0,0-8,8h0a8,8,0,0,0,8,8Z'/><line class='cls-2' x1='81.6' y1='111.4' x2='131.7' y2='44'/><line class='cls-2' x1='198.4' y1='111.4' x2='148.3' y2='44'/></svg>";

const gearIcon = "<svg id='Layer_1' class='nav-icon-addon' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-2{fill:none;stroke-linecap:round;stroke-linejoin:round;}</style></defs><path class='cls-1' d='M183.3,145.8c-10.6,19.2-19.9,24.7-43.6,10.8l-1,.7a55.6,55.6,0,0,1-7.9,4.5l-1.4.8c-.8,26-6.9,33.6-28.8,33s-31.5-5.4-31.3-33.1l-1.2-.6a70.4,70.4,0,0,1-7.9-4.6l-.8-.4C36.6,169,27.3,167.1,17,148.4c-12-19.3-11.4-30.2,12.8-44-.2-3-.2-6-.1-9l-.6-.4c-22-13.6-25-22.7-13.7-41.1s20-25,43.8-10.9l.8-.7a69.5,69.5,0,0,1,7.9-4.5l1.4-.7C70.2,11,76.3,3.3,98.2,4s31.5,5.4,31.3,33.1l1.3.6a68,68,0,0,1,7.9,4.6l.6.5c22.9-12.2,32.2-10.3,42.5,8.6v.3c11.8,19,11,29.9-13,43.5v.2a43.1,43.1,0,0,1-.1,8.8v.2C191.1,118.1,195,126.9,183.3,145.8Zm-55-46a29,29,0,1,0-29,29h0A29,29,0,0,0,128.3,99.8Z'/><path class='cls-1' d='M99.3,70.8A29,29,0,1,1,70.4,99.9h0A29.1,29.1,0,0,1,99.3,70.8Z'/><path class='cls-2' d='M99.2,195.6h1.4c21.9.6,28-7,28.8-33l1.4-.8a55.6,55.6,0,0,0,7.9-4.5l1-.7c23.7,13.9,33,8.4,43.6-10.8l1-1.9-1.7,2.9a2.3,2.3,0,0,0,.7-1c11.7-18.9,7.8-27.7-14.5-41.4v-.2a43.1,43.1,0,0,0,.1-8.8v-.2c24-13.6,24.8-24.5,13-43.5v-.3l-1-1.5,1.6,2.9-.6-1.1v-.3c-10.3-18.9-19.6-20.8-42.5-8.6l-.6-.5a68,68,0,0,0-7.9-4.6l-1.3-.6C129.8,9.4,120.7,3.3,98.3,4h0c-21.9-.7-28,7-28.9,33.1l-1.4.7a70.7,70.7,0,0,0-8,4.5l-.8.7C35.4,28.9,26,34.4,15.4,53.9l-.9,1.7,1.6-3c-.2.5-.5.9-.7,1.3C4.1,72.3,7.1,81.4,29.1,95l.6.4c-.1,3-.1,6,.1,9C5.6,118.2,5,129.1,17,148.4l.9,1.4-1.7-2.9.8,1.5c10.3,18.7,19.6,20.6,42.4,8.5l.8.4a70.4,70.4,0,0,0,7.9,4.6l1.2.6c-.2,27.7,8.9,33.7,31.3,33.1h2'/><path class='cls-2' d='M128.3,99.8a29,29,0,1,1-29-29h0a29,29,0,0,1,29,29Z'/></svg>";

const plusIcon = "<svg id='Layer_2' class='nav-icon-addon' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 199.8 200'><defs><style>.cls-3{stroke-linecap:round;stroke-miterlimit:10;}.cls-3{fill:none;}</style></defs><path class='cls-1' d='M128,115.7' transform='translate(-40.1 -40)'/><path class='cls-1' d='M170.2,128' transform='translate(-40.1 -40)'/><path class='cls-2' d='M235.9,142.2A14.8,14.8,0,0,1,221.2,157H171.7A14.7,14.7,0,0,0,157,171.7v49.6A14.8,14.8,0,0,1,142.2,236h-4.4A14.8,14.8,0,0,1,123,221.3V171.7A14.7,14.7,0,0,0,108.3,157H58.8a14.8,14.8,0,0,1-14.7-14.8v-4.4A14.8,14.8,0,0,1,58.8,123h49.5A14.7,14.7,0,0,0,123,108.3V58.8A14.8,14.8,0,0,1,137.8,44h4.4A14.8,14.8,0,0,1,157,58.8v49.5A14.7,14.7,0,0,0,171.7,123h49.5a14.8,14.8,0,0,1,14.7,14.8Z' transform='translate(-40.1 -40)'/><path class='cls-3' d='M189,123H171.7A14.7,14.7,0,0,1,157,108.3V58.8A14.8,14.8,0,0,0,142.2,44h-4.4A14.8,14.8,0,0,0,123,58.8v49.5A14.7,14.7,0,0,1,108.3,123H58.8a14.8,14.8,0,0,0-14.7,14.8v4.4A14.8,14.8,0,0,0,58.8,157h49.5A14.7,14.7,0,0,1,123,171.7v49.6A14.8,14.8,0,0,0,137.8,236h4.4A14.8,14.8,0,0,0,157,221.3V171.7A14.7,14.7,0,0,1,171.7,157h49.5a14.8,14.8,0,0,0,14.7-14.8v-4.4A14.8,14.8,0,0,0,221.2,123Z' transform='translate(-40.1 -40)'/></svg>";

const listIcon = "<svg id='Layer_2' class='nav-icon-addon' data-name='Layer 2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><defs><style>.cls-2{stroke-linecap:round;stroke-miterlimit:10;}.cls-2{fill:none;}</style></defs><path class='cls-1' d='M128,115.7' transform='translate(-40 -40)'/><path class='cls-1' d='M170.2,128' transform='translate(-40 -40)'/><rect class='cls-2' x='4' y='4' width='192' height='191.99' rx='30'/><rect class='cls-2' x='79.6' y='89' width='82.9' height='21.99' rx='7.7'/><circle class='cls-2' cx='48.4' cy='100' r='11'/><rect class='cls-2' x='79.6' y='41.5' width='82.9' height='21.99' rx='7.7'/><circle class='cls-2' cx='48.4' cy='52.5' r='11'/><rect class='cls-2' x='79.6' y='136.5' width='82.9' height='21.99' rx='7.7'/><circle class='cls-2' cx='48.4' cy='147.5' r='11'/></svg>";



// Close nav button
function closeNav(){

    const closeNavBtn = document.getElementsByClassName("close-nav")[0];

    closeNavBtn.addEventListener("click", () => {
        const navbar = document.getElementsByClassName("navbar")[0];
        const burgerBtn = document.getElementsByClassName("burger-btn")[0];
        
        navbar.classList.remove("extended");
        burgerBtn.classList.remove("open");
    });

}

// Nav Top Element
function navTopElem(){

    const navTop = document.createElement("div");
    navTop.classList.add("nav-top");

    const navTopContent =
    "<div class='close-nav'>" +
        "<span></span><span></span><span></span>" +
    "</div>" +
    "<div class='navbar-logo'></div>";

    navTop.innerHTML = navTopContent;

    return navTop;

}

// Main Page Tiles (index.php)
function mainTiles(){

    const elements = [
        "<div class='main-title'>" +
            "<h2 class='main-title-txt'>Cookbook</h2>" +
        "</div>" +
        "<div class='main-tiles'>" +
            "<a href='index.php' class='main-link' aria-label='Main Page'>" +
                mainIcon +
            "</a>" +
            "<a href='calculator.php' class='main-link' aria-label='Calculator'>" +
                calculatorIcon +
            "</a>" +
        "</div>",

        "<div class='main-title'>" +
            "<h2 class='main-title-txt'>Przepisy</h2>" +
        "</div>" +
        "<div class='main-tiles'>" +
            "<a href='recipe-list.php' class='main-link' aria-label='Recipe List'>" +
                recipeIcon +
                listIcon +
            "</a>" +
            "<a href='add-recipes.php' class='main-link' aria-label='Add Recipes'>" +
                recipeIcon +
                plusIcon +
            "</a>" +
            "<a href='modify-recipes.php' class='main-link' aria-label='Modify Recipes'>" +
                recipeIcon +
                gearIcon +
            "</a>" +
        "</div>",

        "<div class='main-title'>" +
            "<h2 class='main-title-txt'>Produkty</h2>" +
        "</div>" +
        "<div class='main-tiles'>" +
            "<a href='product-list.php' class='main-link' aria-label='Product List'>" +
                productIcon +
                listIcon +
            "</a>" +
            "<a href='add-products.php' class='main-link' aria-label='Add Products'>" +
                productIcon +
                plusIcon +
            "</a>" +
            "<a href='modify-products.php' class='main-link' aria-label='Modify Products'>" +
                productIcon +
                gearIcon +
            "</a>" +
        "</div>"
    ]

    const mainModuleContent = document.querySelector(".main-module-content");
        
    elements.forEach((element) => {
        const mainRow = document.createElement("div");
        mainRow.classList.add("main-row");
        mainRow.innerHTML = element;
        mainModuleContent.appendChild(mainRow);
    });

}

function createNav(elements){

    const navbarInner = document.querySelector(".navbar-inner");
    navbarInner.appendChild(navTopElem());
        
    elements.forEach((element) => {
        const mainRow = document.createElement("div");
        mainRow.classList.add("nav-row");
        mainRow.innerHTML = element;
        navbarInner.appendChild(mainRow);
    });

}

// Base Nav (for the pages in the root folder)
function baseNav(){

    const elements = [
        "<div class='nav-title'>" +
            "<h4 class='nav-title-txt'>Cookbook</h4>" +
        "</div>" +
        "<a href='index.php' class='nav-link' aria-label='Main Page'>" +
            mainIcon +
        "</a>" +
        "<a href='calculator.php' class='nav-link' aria-label='Calculator'>" +
            calculatorIcon +
        "</a>",

        "<div class='nav-title'>" +
            "<h4 class='nav-title-txt'>Przepisy</h4>" +
        "</div>" +
        "<a href='recipe-list.php' class='nav-link' aria-label='Recipe List'>" +
            recipeIcon +
            listIcon +
        "</a>" +
        "<a href='add-recipes.php' class='nav-link' aria-label='Add Recipes'>" +
            recipeIcon +
            plusIcon +
        "</a>" +
        "<a href='modify-recipes.php' class='nav-link' aria-label='Modify Recipes'>" +
            recipeIcon +
            gearIcon +
        "</a>",

        "<div class='nav-title'>" +
            "<h4 class='nav-title-txt'>Produkty</h4>" +
        "</div>" +
        "<a href='product-list.php' class='nav-link' aria-label='Product List'>" +
            productIcon +
            listIcon +
        "</a>" +
        "<a href='add-products.php' class='nav-link' aria-label='Add Products'>" +
            productIcon +
            plusIcon +
        "</a>" +
        "<a href='modify-products.php' class='nav-link' aria-label='Modify Products'>" +
            productIcon +
            gearIcon +
        "</a>"
    ];

    // Create the nav
    createNav(elements);
    
    // Compare the anchor href attribute to the page url name
    // and add a class to the current page (indicator)
    const pageName = window.location.pathname.slice(1, -4);
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach((navLink) => {
        const navHref = navLink.getAttribute("href");
        if (navHref.slice(0, -4) === pageName){
            navLink.classList.add("current-page");
        }
    });
    
    // Close button
    closeNav();
    
}

// For the pages that are "1 lvl deep" from the root folder
function backNav(){

    const elements = [
        "<div class='nav-title'>" +
            "<h4 class='nav-title-txt'>Cookbook</h4>" +
        "</div>" +
        "<a href='../index.php' class='nav-link' aria-label='Main Page'>" +
            mainIcon +
        "</a>" +
        "<a href='../calculator.php' class='nav-link' aria-label='Calculator'>" +
            calculatorIcon +
        "</a>",

        "<div class='nav-title'>" +
            "<h4 class='nav-title-txt'>Przepisy</h4>" +
        "</div>" +
        "<a href='../recipe-list.php' class='nav-link' aria-label='Recipe List'>" +
            recipeIcon +
            listIcon +
        "</a>" +
        "<a href='../add-recipes.php' class='nav-link' aria-label='Add Recipes'>" +
            recipeIcon +
            plusIcon +
        "</a>" +
        "<a href='../modify-recipes.php' class='nav-link' aria-label='Modify Recipes'>" +
            recipeIcon +
            gearIcon +
        "</a>",

        "<div class='nav-title'>" +
            "<h4 class='nav-title-txt'>Produkty</h4>" +
        "</div>" +
        "<a href='../product-list.php' class='nav-link' aria-label='Product List'>" +
            productIcon +
            listIcon +
        "</a>" +
        "<a href='../add-products.php' class='nav-link' aria-label='Add Products'>" +
            productIcon +
            plusIcon +
        "</a>" +
        "<a href='../modify-products.php' class='nav-link' aria-label='Modify Products'>" +
            productIcon +
            gearIcon +
        "</a>"
    ]

    // Create the nav
    createNav(elements);

    // Close button
    closeNav();
}

function insertFooter(){

    // Set the correct image path
    const footerElem = document.getElementsByTagName("footer")[0];
    let imgPath = "Images/";

    if (footerElem.classList.contains("recipe-footer")){
        imgPath = "../Images/";
    };

    // Footer HTML content
    const footerContent =
        "<div class='wrapper'>" +
            "<div class='brand'>" +

                "<div id='brand-logo' onclick='scrollToTop()'>" +
                    `<img src='${imgPath}uverit-w.svg' alt='Business logo' oncontextmenu='window.event.returnValue=false;' id='footer-scrolltop'>` +
                "</div>" +

                "<div id='socials'>" +
                    "<h6>Usługi na Fiverr:</h6>" +

                    "<a href='https://www.fiverr.com/new_horizon_web' class='social-btn' target='_blank' rel='noreferrer'>" +
                        `<img src='${imgPath}fiicon.svg' alt='Fiverr icon'>` +
                    "</a>" +
                "</div>" +

            "</div>" +
        "</div>" +

        "<div id='credits'>" +
            "<a href='https://www.fiverr.com/new_horizon_web' target='_blank' rel='noreferrer'>" +
                `© Uverit 2024 - Cookbook ${appVersion}` +
            "</a>" +
        "</div>";

    // Append the footer HTML content to the footer
    const innerFooter = document.createElement("div");
    innerFooter.classList.add("footer");
    innerFooter.innerHTML = footerContent;

    footerElem.appendChild(innerFooter);

}

window.addEventListener("load", insertFooter);