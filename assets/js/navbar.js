/**
 * Navbars script
 * @Author Thophile
 * @license MIT
 */

/** @type {bool} sidenav state indicator */
var sidenav = false;

/** @type {bool} sidenav state indicator */
var lang = false;

/** @type {int} current scroll value */
var currscroll;

/** @type {int} older scroll value */
var pastscroll = 0;

/**
 * Toggle the side navbar status
 */
function toggleNav() {
    if (sidenav) {
        document.getElementById('side-nav').style.left = "-250px"
        sidenav = !sidenav
    } else {
        document.getElementById('side-nav').style.left = "0"
        sidenav = !sidenav

    }
}

/**
 * Hide the top navbar when scrolling down unless the sidenav is active
 */
function hideNav() {
    currscroll = window.scrollY;
    if ((currscroll > pastscroll) & !sidenav & currscroll > 50) {
        document.querySelector("#navbar").style.top = "-50px"
        document.querySelector("header").style.top = "0"
    } else {
        document.querySelector("#navbar").style.top = "0px"
        document.querySelector("header").style.top = "50px"
    }
    pastscroll = currscroll;
}

/**
 * Change the site langue
 * @param {event} event 
 */
function setLangue(event){
    var source = event.target || event.srcElement;
    l = source.getAttribute("data-lang");
    r = window.location.href;
    window.location = window.location.protocol +"//"+ window.location.host + "/setlocale"  + "?l=" + l + "&r=" + r;

}

function toggleLangue(){
    if(lang) {
        document.querySelector("#lang-list").style.display = "none";
    }
    else {
        document.querySelector("#lang-list").style.display = "flex";
    }
    lang = !lang;

}

/**
 * Ready event
 * 
 * @see main.js
 */
ready(function () {
    window.onscroll = function () {
        hideNav()
        if(lang) toggleNav;
    }
    document.querySelectorAll("#lang-list a").forEach(e => { e.addEventListener("click", setLangue)});
    document.querySelector("#lang-toggle").addEventListener("click", toggleLangue);
})