var elements;

function showAll(){
    elements = document.querySelectorAll('.projects');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
function showDev(){
    elements = document.querySelectorAll('.Other, .Network');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.Developpement');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
function showNet(){
    elements = document.querySelectorAll('.Developpement, .Other');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.Network');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
function showOth(){
    elements = document.querySelectorAll('.Developpement, .Network');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "none";
    }
    elements = document.querySelectorAll('.Other');
    for (var i = 0, max = elements.length; i < max; i++) {
        elements[i].style.display = "flex";
    }
}
