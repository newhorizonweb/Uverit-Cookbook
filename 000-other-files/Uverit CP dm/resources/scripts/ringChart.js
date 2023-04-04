    /* Set aspect ratio for colors */

var ucp1ratio = 20;
var ucp2ratio = 20;
var ucp3ratio = 40;
var ucp4ratio = 10;
var ucp5ratio = 10;

    /* Ratio to classes */

document.querySelector(".ucp1ratio").innerHTML = "Ratio: " + ucp1ratio + "%";
document.querySelector(".ucp2ratio").innerHTML = "Ratio: " + ucp2ratio + "%";
document.querySelector(".ucp3ratio").innerHTML = "Ratio: " + ucp3ratio + "%";
document.querySelector(".ucp4ratio").innerHTML = "Ratio: " + ucp4ratio + "%";
document.querySelector(".ucp5ratio").innerHTML = "Ratio: " + ucp5ratio + "%";

    /* Chart */

var ucp1 = window.getComputedStyle(document.querySelector(".ucp1"), null).getPropertyValue('background-color');
var ucp2 = window.getComputedStyle(document.querySelector(".ucp2"), null).getPropertyValue('background-color');
var ucp3 = window.getComputedStyle(document.querySelector(".ucp3"), null).getPropertyValue('background-color');
var ucp4 = window.getComputedStyle(document.querySelector(".ucp4"), null).getPropertyValue('background-color');
var ucp5 = window.getComputedStyle(document.querySelector(".ucp5"), null).getPropertyValue('background-color');

var ucptxt1 = window.getComputedStyle(document.querySelector('.ucptxt1'), ':after').getPropertyValue('content').slice(1, -1);
var ucptxt2 = window.getComputedStyle(document.querySelector('.ucptxt2'), ':after').getPropertyValue('content').slice(1, -1);
var ucptxt3 = window.getComputedStyle(document.querySelector('.ucptxt3'), ':after').getPropertyValue('content').slice(1, -1);
var ucptxt4 = window.getComputedStyle(document.querySelector('.ucptxt4'), ':after').getPropertyValue('content').slice(1, -1);
var ucptxt5 = window.getComputedStyle(document.querySelector('.ucptxt5'), ':after').getPropertyValue('content').slice(1, -1);
            
const ctx = document.getElementById('myChart').getContext('2d');

Chart.defaults.font.size = 16;
const myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
                " " + ucptxt1,
                " " + ucptxt2,
                " " + ucptxt3,
                " " + ucptxt4,
                " " + ucptxt5
                ],
        datasets: [{
            data: [ucp1ratio, ucp2ratio, ucp3ratio, ucp4ratio, ucp5ratio],
            backgroundColor: [
                ucp1,
                ucp2,
                ucp3,
                ucp4,
                ucp5,
            ],
            /* borderWidth:0, */
            cutout:"50%"
        }]
    },           
    options: {
        plugins: {
            legend: {
                display:false
            }
        }
    }
});









