/**
 * Home page script
 * @Author Thophile
 * @license MIT
 */

/**  @type {int} the current slide index */
var slideIndex = 0;

/** @type {int} the wanted Y offset to top */
var pos;

/**
 * Change the slide index according top mouse wheel event , then calculate pos and smoothScroll to it
 * @param {event} event
 */
window.addEventListener('wheel', function(event)
{
    //Block normal scrolling
    event.preventDefault();
    event.stopPropagation();

    if (event.deltaY < 0 & slideIndex > 0)
    {
        //Scroll Up
        slideIndex--
    }
    else if (event.deltaY > 0 & slideIndex < 2)
    {
        //Scroll Down
        slideIndex++ 
    }
    pos = slideIndex * window.innerHeight;
    smoothScrollTo(pos, 750);

});

/**
 * Scroll smoothly to a desired Y offset in a dertain duration
 * 
 * @param {int} endY wanted Y offset
 * @param {int} duration time in ms the scroll should last
 */
window.smoothScrollTo = function(endY, duration) {
    // Initialisation
    startY = window.scrollY || window.pageYOffset,
    distanceY = endY - startY,
    startTime = new Date().getTime();

    // Easing function
    let easeInOutQuart = function(time, from, distance, duration) {
        if ((time /= duration / 2) < 1) return distance / 2 * time * time * time * time + from;
        return -distance / 2 * ((time -= 2) * time * time * time - 2) + from;
    };

    // Asynchronous loop to scroll
    let timer = window.setInterval(function() {
        let time = new Date().getTime() - startTime,
        newY = easeInOutQuart(time, startY, distanceY, duration);
        if (time >= duration) {
            window.clearInterval(timer);
        }
        window.scrollTo(0, newY);
    }, 1000 / 60); // 60 fps
};