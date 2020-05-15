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
 * Show projects with category attribute as "Developpement"
 */
function showDev() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[data-category="Developpement"]');

    if(elements.length == 0)document.querySelector(".empty").style.display = "flex"

    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}

/**
 * Show projects with category attribute as "Network"
 */
function showNet() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[data-category="Network"]');
    
    if(elements.length == 0)document.querySelector(".empty").style.display = "flex"
    
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}

/**
 * Show projects with category attribute as "Other"
 */
function showOth() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[data-category="Other"]');
    
    if(elements.length == 0)document.querySelector(".empty").style.display = "flex"
    
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
