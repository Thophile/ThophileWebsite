var images
var label
var index = 0
var modalTrigger = null
var modal

ready(function (){
    modal = document.getElementById('modal')
    displayImage(0)
    document.querySelector('#modal .far').onclick = function (){
        modal.style.display ="none"
    }
})

function displayImage(index){
    images = document.querySelectorAll('#images img.merry')
    label = document.getElementById('img_label')
    
    images.forEach(element => {
        element.className = "merry"
    });
    document.querySelectorAll(".dots").forEach(element => {
        element.className = "dots"
    })
    modalTrigger = images[index]
    modalTrigger.onclick =function(){
        modal.style.display = "block";
        document.getElementById('modalImg').src = this.src;
    }
    images[index].className = "merry active"
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
