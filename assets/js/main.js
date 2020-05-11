/**
 * Main function list
 * @Author Thophile
 * @license MIT
 */

/**
 * Add a function to be called when document is ready
 * @param {function} f the function to be called when ready
 */
function ready(f) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(f, 1);
    } else {
        document.addEventListener("DOMContentLoaded", f);
    }
}
/**
 * Create a dom element with a list of properties to be set
 * 
 * @param {string} element 
 * @param {Object <string, string>} properties 
 */
function create(element, properties) {
    //create element
    var element = document.createElement(element);
    //assign properties
    for (var prop in properties) {
        element[prop] = properties[prop];
    }
    return element;

}
