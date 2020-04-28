var sidenav = false;
var currscroll;
var pastscroll = 0;
function toggleNav() {
    if (sidenav) {
        document.getElementById('side-nav').style.left = "-250px"
        sidenav = !sidenav
    } else {
        document.getElementById('side-nav').style.left = "0"
        sidenav = !sidenav

    }
}

function hideNav() {
    currscroll = window.scrollY;
    if ((currscroll > pastscroll) & !sidenav) {
        document.querySelector("header").style.top = "-50px"
        document.querySelector("main").style.marginTop = "0"
    } else {
        document.querySelector("header").style.top = "0px"
        document.querySelector("main").style.marginTop = "50px"
    }
    pastscroll = currscroll;
}


ready(function () {
    window.onscroll = function () {
        hideNav()
    }
})