/**
 * Project page script
 * @Author Thophile
 * @license MIT
 */

/** @type {Array <Element>} the images dom elements */ 
var images

/** @type {Element} the label dom element */
var label

/** @type {int} the */
var index = 0

/** @type {bool|null} the image that should trigger the modal when clicked on */
var modalTrigger = null

/** @type {Element} the modal element */
var modal

/** 
 * @see main.js 
 */
ready(function () {
    modal = document.getElementById('modal')
    displayImage(0)
    document.querySelector('#modal .far').onclick = function () {
        modal.style.display = "none"
    }
})

/**
 * Display the index-th image in the images array
 * @param {int} index 
 */
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

/**
 * Display the next image, display first if current is last
 */
function nextImage() {
    index = (++index) % images.length
    displayImage(index)
}

/**
 * Display the previous image, display last if current is first
 */
function previousImage() {
    index = (--index + images.length) % images.length
    displayImage(index)
}
