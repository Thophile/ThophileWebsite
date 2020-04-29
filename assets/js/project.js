var images
var label
var index = 0
var modalTrigger = null
var modal

ready(function () {
    modal = document.getElementById('modal')
    displayImage(0)
    document.querySelector('#modal .far').onclick = function () {
        modal.style.display = "none"
    }
})

function displayImage(index) {
    images = document.querySelectorAll('.merry-go img[data-label]')
    label = document.querySelector('.middle label')


    document.querySelectorAll(".active").forEach(element => {
        element.className = ""
    })

    modalTrigger = images[index]
    modalTrigger.onclick = function () {
        modal.style.display = "block";
        document.getElementById('modalImg').src = this.src;
    }
    images[index].className = "active"
    document.querySelectorAll(".dots_group span")[index].className = "active"

    label.innerHTML = images[index].getAttribute('data-label')
}
function nextImage() {
    index = (++index) % images.length
    displayImage(index)
}
function previousImage() {
    index = (--index + images.length) % images.length
    displayImage(index)
}
