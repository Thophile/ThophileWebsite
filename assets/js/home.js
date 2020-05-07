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


}