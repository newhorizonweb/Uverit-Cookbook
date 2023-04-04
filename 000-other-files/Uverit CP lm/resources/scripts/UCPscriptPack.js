    /* Scroll-to-top */

function scrollToTop() {
    window.scrollTo({
        top:0,
        left:0,
        behavior:'smooth'
});}

    /* Table-print */

function printDiv() {
    window.print();
    
};

    /* Uverit */

var version = window.getComputedStyle(document.querySelector(".version"), "::after").getPropertyValue('content').slice(1, -1);
console.log("Program created by Uverit");
console.log("Color Palette " + version);

    /* Color Converter */

// Converting colors from rgb to HEX and CMYK

// RGB Variables

var ucp1 = window.getComputedStyle(document.querySelector(".ucp1"), null).getPropertyValue('background-color').slice(4, -1);

var ucp2 = window.getComputedStyle(document.querySelector(".ucp2"), null).getPropertyValue('background-color').slice(4, -1);

var ucp3 = window.getComputedStyle(document.querySelector(".ucp3"), null).getPropertyValue('background-color').slice(4, -1);

var ucp4 = window.getComputedStyle(document.querySelector(".ucp4"), null).getPropertyValue('background-color').slice(4, -1);

var ucp5 = window.getComputedStyle(document.querySelector(".ucp5"), null).getPropertyValue('background-color').slice(4, -1);

// RGB to HEX

const componentToHex = c => (+c).toString(16).padStart(2,"0").toUpperCase();


const rgbToHex = (rgb) => {
  const [r, g, b] = rgb.split(",");
  return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b)
};

const getRgb = selector => window.getComputedStyle(document.querySelector(selector), null).getPropertyValue('background-color').match(/(\d+, \d+, \d+)/)[1];


// HEX Variables

var hexucp1 = rgbToHex(getRgb(".ucp1"));
var hexucp2 = rgbToHex(getRgb(".ucp2"));
var hexucp3 = rgbToHex(getRgb(".ucp3"));
var hexucp4 = rgbToHex(getRgb(".ucp4"));
var hexucp5 = rgbToHex(getRgb(".ucp5"));

// Export color names into the classes

window.onload = function (){
    showColor("ucp1-hex", hexucp1);
    showColor("ucp2-hex", hexucp2);
    showColor("ucp3-hex", hexucp3);
    showColor("ucp4-hex", hexucp4);
    showColor("ucp5-hex", hexucp5);

    showColor("ucp1-rgb", ucp1);
    showColor("ucp2-rgb", ucp2);
    showColor("ucp3-rgb", ucp3);
    showColor("ucp4-rgb", ucp4);
    showColor("ucp5-rgb", ucp5);
};

function showColor(className, color){
  document.querySelectorAll(`.${className}`).forEach(el => el.textContent = color);
}

// Console log colors

console.log("Color 1:" + "\n" + "HEX:", hexucp1 + "\n" + "RGB:", ucp1);
    
console.log("Color 2:" + "\n" + "HEX:", hexucp2 + "\n" + "RGB:", ucp2);
    
console.log("Color 3:" + "\n" + "HEX:", hexucp3 + "\n" + "RGB:", ucp3);
    
console.log("Color 4:" + "\n" + "HEX:", hexucp4 + "\n" + "RGB:", ucp4);
    
console.log("Color 5:" + "\n" + "HEX:", hexucp5 + "\n" + "RGB:", ucp5);























