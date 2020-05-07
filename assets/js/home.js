var slideIndex = 0;
var pos;

ready(function () {
})

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
    console.log(pos);

    smoothScrollTo(pos, 500); //function under

});

window.smoothScrollTo = function(endY, duration) {
    startY = window.scrollY || window.pageYOffset,
    distanceY = endY - startY,
    startTime = new Date().getTime();

    // Easing function
    let easeInOutQuart = function(time, from, distance, duration) {
        if ((time /= duration / 2) < 1) return distance / 2 * time * time * time * time + from;
        return -distance / 2 * ((time -= 2) * time * time * time - 2) + from;
    };

    let timer = window.setInterval(function() {
        let time = new Date().getTime() - startTime,
        newY = easeInOutQuart(time, startY, distanceY, duration);
        if (time >= duration) {
            window.clearInterval(timer);
        }
        window.scrollTo(0, newY);
    }, 1000 / 60); // 60 fps
};