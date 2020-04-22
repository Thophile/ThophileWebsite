ready(function () {
    if (document.getElementsByClassName("error").length !== 0) {

        setTimeout(function () {
            document.getElementById('landing').innerHTML = '<iframe height="100%" src="https://www.youtube.com/embed/oHg5SJYRHA0?autoplay=1&mute=0"></iframe>'
        }, 4000)
    }
})