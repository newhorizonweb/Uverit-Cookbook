
    /* Copy <a href='products.php'></a> to clipboard */

let copyLink = $("#copy-link");
let linkIcon = "<img src='Images/link.svg' class='copy-icon' alt='copy icon'>";
let checkmarkIcon = "<img src='Images/checkmark.svg' class='copy-icon' alt='copy icon'>";

copyLink.on("click", function(){

    let temp = $("<input>");
    $("body").append(temp);
    temp.val("<a href='products.php'></a>").select(); // copy this value
    document.execCommand("copy");
    temp.remove();
    
    copyLink.html(checkmarkIcon);
    copyLink.addClass("copy-checked");
    setTimeout(function(){ 
        copyIcon() 
    }, 1000);

});

function copyIcon() {
    copyLink.html(linkIcon);
    copyLink.removeClass("copy-checked");
}

/*

Saved for copying a link to the product

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

<p id="p1">P1: I am paragraph 1</p>
<p id="p2">P2: I am a second paragraph</p>
<button onclick="copyToClipboard('#p1')">Copy P1</button>
<button onclick="copyToClipboard('#p2')">Copy P2</button>

OR

function copyToClipboard(){
  var temp = $("<input>");
  $("body").append(temp);
  temp.val($("#p1").text()).select();
  document.execCommand("copy");
  temp.remove();
}


*/















