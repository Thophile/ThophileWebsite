/** @type {Array <Element>} */
var elements;

/**
 * @see main.js showw all on load
 */
ready(function(){
    showAll()
})

/**
 * Show all projects
 */
function showAll() {
    elements = document.querySelectorAll('.projects[data-category]');
    
    if(elements.length == 0)document.querySelector(".empty").style.display = "flex"
    
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}

/**
 * Show projects with category attribute as "cat"
 */
function show($cat) {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[data-category="' + $cat + '"]');

    if(elements.length == 0)document.querySelector(".empty").style.display = "flex"

    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
