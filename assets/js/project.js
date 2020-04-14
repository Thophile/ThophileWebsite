var images
var label
var index = 0

ready(function (){
    displayImage(0)
})

function displayImage(index){
    images = document.querySelectorAll('#images img')
    label = document.getElementById('img_label')
    
    images.forEach(element => {
        element.className = ""
    });
    document.querySelectorAll(".dots").forEach(element => {
        element.className = "dots"
    })

    images[index].className = "active"
    document.querySelectorAll(".dots")[index].className ="dots active"

    label.innerHTML = images[index].getAttribute('label')
}
function nextImage(){
    index = ( ++index ) % images.length
    displayImage(index)
}
function previousImage(){
    index = ( --index + images.length) % images.length
    displayImage(index)
}