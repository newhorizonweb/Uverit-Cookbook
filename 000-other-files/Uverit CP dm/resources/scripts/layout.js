
   /* Layout switch */

let switch1 = document.querySelector(".switch1");
let switch2 = document.querySelector(".switch2");
let switch3 = document.querySelector(".switch3");

let layout1 = document.querySelector(".layout1");
let layout2 = document.querySelector(".layout2");
let layout3 = document.querySelector(".layout3");

window.onload = function() {
    switch1.classList.add("switch-active");
    layout1.classList.add("layout-active");
    
    let divHeight = $('.layout1').height() + 60;
    $('.layout').css('min-height', divHeight+'px');
    
    window.onresize = function() {
        let divHeight = $('.layout1').height() + 60;
        $('.layout').css('min-height', divHeight+'px');
    }
}

switch1.onclick = function() {
    switch1.classList.add("switch-active");
    switch2.classList.remove("switch-active");
    switch3.classList.remove("switch-active");
    
    layout1.classList.add("layout-active");
    layout2.classList.remove("layout-active");
    layout3.classList.remove("layout-active");
    
    let divHeight = $('.layout1').height() + 60;
    $('.layout').css('min-height', divHeight+'px');
    
    window.onresize = function() {
        let divHeight = $('.layout1').height() + 60;
        $('.layout').css('min-height', divHeight+'px');
    }
}

switch2.onclick = function() {
    switch1.classList.remove("switch-active");
    switch2.classList.add("switch-active");
    switch3.classList.remove("switch-active");
    
    layout1.classList.remove("layout-active");
    layout2.classList.add("layout-active");
    layout3.classList.remove("layout-active");
    
    let divHeight = $('.layout2').height() + 60;
    $('.layout').css('min-height', divHeight+'px');
    
    window.onresize = function() {
        let divHeight = $('.layout2').height() + 60;
        $('.layout').css('min-height', divHeight+'px');
    }
}

switch3.onclick = function() {
    switch1.classList.remove("switch-active");
    switch2.classList.remove("switch-active");
    switch3.classList.add("switch-active");
    
    layout1.classList.remove("layout-active");
    layout2.classList.remove("layout-active");
    layout3.classList.add("layout-active");
    
    let divHeight = $('.layout3').height() + 60;
    $('.layout').css('min-height', divHeight+'px');
    
    window.onresize = function() {
        let divHeight = $('.layout3').height() + 60;
        $('.layout').css('min-height', divHeight+'px');
    }
}

   /* Scroll window to top/left before loading */

// Fixed an issue with window loading right to the content when refreshing while window is scrolled down

window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}






