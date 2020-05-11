/**
 * Landing page script
 * @Author Thophile
 * @license MIT
 */

/**
 * Rickroll user after 4 seconds if a wrong password is typed in
 * @see main.js
 */
ready(function () {
    if (document.getElementsByClassName("error").length !== 0) {

        setTimeout(function () {
            document.getElementById('landing').innerHTML = '<iframe height="100%" src="https://www.youtube.com/embed/oHg5SJYRHA0?autoplay=1&mute=0"></iframe>'
        }, 4000)
    }
});