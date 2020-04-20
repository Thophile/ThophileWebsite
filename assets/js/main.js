function ready(f) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(f, 1);
    } else {
        document.addEventListener("DOMContentLoaded", f);
    }
}
//shortcut for document.createElement and attribut association
function create(element, properties){
    //create element
    var element = document.createElement(element);
    //assign properties
    for (var prop in properties) {
        element[prop] = properties[prop];
    }
    return element;

}