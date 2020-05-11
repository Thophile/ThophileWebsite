/**
 * Navbars script
 * @Author Thophile
 * @license MIT
 */

/** @type {bool} sidenav state indicator */
var sidenav = false;

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
    if ((currscroll > pastscroll) & !sidenav) {
        document.querySelector("#navbar").style.top = "-50px"
        document.querySelector("header").style.top = "0"
    } else {
        document.querySelector("#navbar").style.top = "0px"
        document.querySelector("header").style.top = "50px"
    }
    pastscroll = currscroll;
}

/**
 * Ready event
 * 
 * @see main.js
 */
ready(function () {
    window.onscroll = function () {
        hideNav()
    }
})