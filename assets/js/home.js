var slideIndex = 0;
var animOut;
ready(function () {
    
    main = document.querySelector('main')
    main.children[0].className = "active"
    console.log(main.children[0])

})

window.addEventListener('wheel', function(event)
{
    //Block normal scrolling
    event.preventDefault();
    event.stopPropagation();

    if (event.deltaY < 0 & slideIndex > 0)
    {
        //Scroll Up
        main.children[slideIndex].className = ""
        slideIndex --
        main.children[slideIndex].className = "active"
    }
    else if (event.deltaY > 0 & slideIndex < 2)
    {
        //Scroll Down
        main.children[slideIndex].className = ""
        slideIndex ++
        main.children[slideIndex].className = "active"
    }
});

function changeSlide(){

}