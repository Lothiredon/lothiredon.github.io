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
    if ($(window).width() < 960) {
        if($(e.target).is(".overlay, .closebtn")) {
        // Do close stuff
            document.getElementById("cart-curtain").style.width = "0%";
            document.getElementById("shopping-cart").style.visibility = "visible";
        }
        else if($(e.target).is(".shopping-cart")) {
        // Do open staff
            document.getElementById("cart-curtain").style.width = "100%";
            document.getElementById("shopping-cart").style.visibility = "hidden";
        }
    }
    else {
        if($(e.target).is(".overlay, .closebtn")) {
            // Do close stuff
                document.getElementById("cart-curtain").style.width = "0%";
                document.getElementById("shopping-cart").style.visibility = "visible";
            }
            else if($(e.target).is(".shopping-cart")) {
            // Do open staff
                document.getElementById("cart-curtain").style.width = "20%";
                document.getElementById("shopping-cart").style.visibility = "hidden";
        }
    }
};