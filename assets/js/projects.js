/** @type {Array <Element>} */
var elements;

/**
 * Show all projects
 */
function showAll() {
    elements = document.querySelectorAll('.projects');
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
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
