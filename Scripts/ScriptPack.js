    
    /* Remove transition on page load (remove flash) */

document.getElementsByTagName("body")[0].classList.add("remove-transition");
setTimeout(function(){
    document.getElementsByTagName("body")[0].classList.remove("remove-transition");
}, 20);

    /* Dark Mode */

// It's not in order to maximize the performance (don't flash light theme on page load)

let dmBtn = document.getElementsByClassName("dm-btn")[0];
let body = document.getElementsByTagName("body")[0];

// Set visit counter
var visit = localStorage.getItem('visit');

// If user's device is set to dark mode, set it on the first page visit
if (visit == null){
    visit = 0;
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        dmBtn.checked = true;
        localStorage.setItem("dm-checkbox", dmBtn.checked);
    }
} 

// Get the dark mode state and set it to the dm toggle
let dmState = JSON.parse(localStorage.getItem("dm-checkbox"));    
if (dmState){
    body.classList.add("dark-mode");
}

// Check the dark-mode toggle
dmBtn.checked = dmState;

// Update the visit counter
visit++
localStorage.setItem('visit', visit);

// Set dark mode on toggle
dmBtn.addEventListener("click", function(){
    localStorage.setItem("dm-checkbox", dmBtn.checked);
    let dmState = JSON.parse(localStorage.getItem("dm-checkbox"));
    
    if (dmState){
        body.classList.add("dark-mode");
    } else {
        body.classList.remove("dark-mode");
    }
});

    /* Background gradient */

// Gradient speed (-0.1 slow, -10 fast as F) - currently 0.5 in (window.pageYOffset * ->0.5<-)...
// Gradient direction (L-R = speed positive, CSS style left:0;)
// Gradient direction (R-L = speed negative, CSS style left:-100%;)

let grad = document.getElementById('main-bg-grad');
let position = 0;
let mblDevice = 768;

// Calculate translate3D for the gradient image
function updateGradient(){
    position = (window.pageYOffset * 0.5) % grad.clientWidth / 2;
    grad.style.transform = `translate3d(${position}px, 0, 0)`;
}
updateGradient();

// Use this so the eventListener can be removed
let scrollListener = function(){
    requestIdleCallback(updateGradient);
}          
        
// If the screen is wider than 768px, add the updateGradient();
if (window.innerWidth > mblDevice){
    window.addEventListener("scroll", scrollListener, {passive: true});
}

// Add / remove the scroll eventListener
window.addEventListener("resize", function(){
    if (window.innerWidth > mblDevice){
        window.addEventListener("scroll", scrollListener, {passive: true});
    } else {
        grad.style.transform = `translate3d(0, 0, 0)`;
        window.removeEventListener("scroll", scrollListener);
    }        
});

    /* Set the page to always load at the left side */

function scrollToTopLeft(){
    setTimeout(function(){
        window.scrollTo(0, window.pageYOffset);
    }, 0);
}

window.addEventListener('load', scrollToTopLeft);
window.addEventListener('resize', scrollToTopLeft);

    /* Scroll-to-top */

function scrollToTop(){
    window.scrollTo({
        top:0,
        left:0,
        behavior:'smooth'
    });
}

// Debouncing function
function debounce(func, wait){
    let timeout;
    return function() {
        clearTimeout(timeout);
        timeout = setTimeout(func, wait);
    }
}

let scrollTopBtn = document.getElementById("scrolltop");

function scrollTopClass(){
    if (window.scrollY > window.innerHeight / 0.7){
        scrollTopBtn.classList.add("scrolltop-displayed");
    } else {
        scrollTopBtn.classList.remove("scrolltop-displayed");
    }
}
// When it doesn't detect this id on the page the nav isn't hiding after scroll
if (scrollTopBtn){ 
    scrollTopClass();
    window.addEventListener('scroll', debounce(scrollTopClass, 80));
}

    /* Parallax banner */

function parallaxBanner(){
    document.getElementsByClassName('parallax-banner')[0].style.backgroundPosition = 'center '+(-window.pageYOffset * 0.35)+'px';
}

parallaxBanner();

window.addEventListener('scroll', function(){
    requestAnimationFrame(parallaxBanner);
});

    /* Soften the bg height change (mobile browser address bar) */

function handleResize() {
  requestAnimationFrame(() => {
    let height = $(window).innerHeight();
    $('.main-background').css('height', height + 'px');
  });
}

$(window).on('scroll resize', handleResize);
handleResize();

    /* Navbar showing on mobile and burger animation */

var navbar = document.querySelector(".navbar");
var burger = document.querySelector(".burger-btn");

burger.addEventListener("click", function(e){
    navbar.classList.toggle("extended");
    burger.classList.toggle("open");
    e.stopPropagation();
});

window.addEventListener("click", function(e){
    if(!e.target.matches(".navbar") && !e.target.closest(".navbar")){
        navbar.classList.remove("extended");
        burger.classList.remove("open");
    }
});

window.addEventListener("scroll", function(){
    if (document.documentElement.scrollTop > 1){
        burger.classList.remove("open");
        navbar.classList.remove("extended");
    }
});


   /* Close the navigation on swipe gesture */

function navSwipeClose(){  

        // Set these variables (all relative to innerWidth / innerHeight)

    // Min horizontal swipe distance 
    let minSwipeWidth = window.innerWidth * 0.4;

    // Max vertical swipe distance  
    let maxSwipeHeight = window.innerHeight * 0.15;

    // Min start point from the edge
    let swipeStartPoint = window.innerWidth * 0.05;

    // Max start point from the edge
    let swipeEndPoint = window.innerWidth * 0.4;

        // Don't change these

    // Set the swipe min and max start point from the right edge
    const swipeRightStartPoint = window.innerWidth - swipeStartPoint;
    const swipeRightEndPoint = window.innerWidth - swipeEndPoint;

        // Track touch start and end coordinates

    let touchStartX = null;
    let touchEndX = null;


    function handleTouchStart(e){
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
    }

        // Check the conditions and perform the action

    function handleTouchEnd(e){

        // Calculate the swipe X and Y lengths
        touchEndX = e.changedTouches[0].clientX;
        touchEndY = e.changedTouches[0].clientY;
        let swipeWidth = Math.abs(touchEndX - touchStartX);
        let swipeHeight = Math.abs(touchEndY - touchStartY);

        // check the requirements
        if (swipeWidth >= minSwipeWidth &&
            swipeHeight <= maxSwipeHeight){

            if (touchStartX >= swipeStartPoint && 
            touchStartX <= swipeEndPoint ||
            touchStartX <= swipeRightStartPoint && 
            touchStartX >= swipeRightEndPoint){

                burger.classList.remove("open");
                navbar.classList.remove("extended");

            }
        }

        // Reset touch start and end coordinates
        touchStartX = null;
        touchEndX = null;
    }
    
    let navbar = document.querySelector(".navbar");

    // Listen for the swipe (if the window is <= 1024 px wide)
    if (window.innerWidth <= 440){

        navbar.ontouchstart = function(e){
            handleTouchStart(e);
        } 
        navbar.ontouchend = function(e){
            handleTouchEnd(e)
        }

    } else {
        navbar.ontouchstart = null;
        navbar.ontouchend = null;
    }
}

// Call the function on load and window resize
navSwipeClose();
window.addEventListener("resize", navSwipeClose);


