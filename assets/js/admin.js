ready(function(){
    document.querySelectorAll(".link_remove").forEach(element => {
        element.addEventListener("click",link_remove)
    });
    document.querySelectorAll(".links_add").forEach(element => {
        element.addEventListener("click",link_add)
    });
    document.querySelectorAll(".section_remove").forEach(element => {
        element.addEventListener("click",section_remove)
    });
    document.querySelectorAll(".section_add").forEach(element => {
        element.addEventListener("click",section_add)
    });
    document.querySelectorAll(".paragraphs_remove").forEach(element => {
        element.addEventListener("click",paragraphs_remove)
    });
    document.querySelectorAll(".paragraphs_add").forEach(element => {
        element.addEventListener("click",paragraphs_add)
    });
    
})
function parseForm(){
    $project = new Object()
}