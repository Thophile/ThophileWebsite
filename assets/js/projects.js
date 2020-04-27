var elements;

function showAll() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
function showDev() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[category="Developpement"]');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
function showNet() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[category="Network"]');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
function showOth() {
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.projects[category="Other"]');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
