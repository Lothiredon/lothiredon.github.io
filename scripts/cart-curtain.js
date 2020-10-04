/* Open when someone clicks on the span element */
/*window.onload=function(){

    var curtainOpen = 1
    var $notoverlay = $("div:not(.overlay-content)")

    /*function openNav() {
    document.getElementById("cart-curtain").style.width = "100%";
    curtainOpen++
    }*/

    /* Close when someone clicks on the "x" symbol inside the overlay
    function closeNav() {
    document.getElementById("cart-curtain").style.width = "0%";
    }
    $notoverlay.click(function(e) {
        if(curtainOpen == 0) {
                e.stopPropagation();
                document.getElementById("cart-curtain").style.width = "0%";
                curtainOpen++
                /*alert(curtainOpen);
            }
        else if(curtainOpen >= 1) {
            e.stopPropagation();
            document.getElementById("cart-curtain").style.width = "100%";
            curtainOpen--
            /*alert(curtainOpen);

        }
        else {
            /*alert(curtainOpen);
            return;
        }
    });
}*/

window.onclick = e => {
    if($(e.target).hasClass("overlay")) {
      // Do close stuff
        document.getElementById("cart-curtain").style.width = "0%";
    }
    else if($(e.target).hasClass("shopping-cart" || "closebtn")) {
      // Do open staff
        document.getElementById("cart-curtain").style.width = "25%";
    }
  };