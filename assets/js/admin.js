/**
 * Admin page script
 * @Author Thophile
 * @license MIT
 */

/**
 * Ready event
 * 
 * @see main.js
 */
ready(function() {
    //Tabs button event
    document.querySelectorAll('#tabs button').forEach(element => {
        element.addEventListener('click', displayTab)
    });
    //Display first tab by default by triggering an event
    document.querySelectorAll("#tabs button")[0].dispatchEvent(new Event('click'))

    //Display projet tabs if it's a reload with a get parameter
    if (window.location.search) {
        document.querySelector('button[data-target="#projectManager"]').dispatchEvent(new Event('click'))
    }
    //Initialise Project Manager events
    document.querySelectorAll(".link_remove").forEach(element => {
        element.addEventListener("click", linkRemove)
    });
    document.querySelectorAll(".link_add").forEach(element => {
        element.addEventListener("click", linkAdd)
    });
    document.querySelectorAll(".section_remove").forEach(element => {
        element.addEventListener("click", sectionRemove)
    });
    document.querySelectorAll(".section_add").forEach(element => {
        element.addEventListener("click", sectionAdd)
    });
    document.querySelectorAll(".paragraphs_remove").forEach(element => {
        element.addEventListener("click", paragraphsRemove)
    });
    document.querySelectorAll(".paragraphs_add").forEach(element => {
        element.addEventListener("click", paragraphsAdd)
    });
    document.querySelectorAll(".image_add").forEach(element => {
        element.addEventListener("click", imageAdd)
    });
    document.querySelectorAll(".image_preview i.fa-minus").forEach(element => {
        element.addEventListener("click", imageRemove)
    });
    document.querySelectorAll(".image_file").forEach(element => {
        element.addEventListener("change", previewImage)
    });
    document.querySelectorAll('.bodyline a.to-validate').forEach(element => {
        element.addEventListener('click', validate)
    });

    //Initialise CV Uploader events
    document.querySelector('#cvuploader button').addEventListener('click', uploadCV)

})

/**
 * Display the tab corresponding to the button calling the event and hide the other
 * @param {event} event 
 */
function displayTab(event) {
    var source = event.target || event.srcElement
        //handle nested source
    while (source.tagName !== "BUTTON") {
        source = source.parentElement
    }
    let selector = source.getAttribute("data-target")
    let header = source.innerHTML

    //Display off other tabs
    document.querySelectorAll("div[data-type=content]").forEach(element => {
        element.style.display = "none";
    })

    //Display the chosen tab and set the header
    document.querySelector(selector).style.display = "block"
    document.querySelector("#tabs_header h1").innerHTML = header;
}


/**
 * Prevent default on delete link unless browser validation occurs
 * @param {event} event 
 */
function validate(event) {
    var source = event.target || event.srcElement
        //handle nested source
    while (source.tagName !== "A") {
        source = source.parentElement
    }
    message = "Are you sur you want to delete PROJECT n°" + source.href.split('=')[1] + " ?"

    if (!confirm(message)) event.preventDefault();
}


/**
 * Parse inputs value into a form array that will be sent to the server for creation/update
 */
function parseForm() {
    //retrieve dta
    var PROJECT = new Object()

    //get PROJECT id from url
    var urlparameters = window.location.search //get full string
    var parameters = new URLSearchParams(urlparameters)
    PROJECT.ID = parameters.get('id')

    PROJECT.TITLE = document.querySelector('input[name=title]').value
    PROJECT.CATEGORY = document.querySelector('input[name=category]').value
    PROJECT.BANNER_IMAGE = document.querySelector('input[name=style]').value


    //image
    PROJECT.IMAGES = []
    var data = new FormData()
    document.querySelectorAll('#_image .image_preview').forEach(element => {

        //if an img has been loaded/selected
        if (element.querySelector('img').src != "") {
            var IMAGE = new Object()

            //save the filename
            if (element.querySelector('input[type=file]').files.length == 0) {
                //take the already existing filename to save it back 
                IMAGE.FILENAME = element.querySelector('img').src.split(/(\\|\/)/g).pop()
            } else {
                //save new filename
                IMAGE.FILENAME = element.querySelector('input[type=file]').files[0].name
                data.append('file[]', element.querySelector('input[type=file]').files[0])
            }

            IMAGE.LABEL = element.querySelectorAll('input')[1].value

            PROJECT.IMAGES.push(image)
        }
    });


    //links
    PROJECT.LINKS = []
    document.querySelectorAll('#_links div').forEach(element => {
        var LINK = new Object()
        LINK.TITLE = element.querySelectorAll('input')[0].value
        LINK.HREF = element.querySelectorAll('input')[1].value
        PROJECT.LINKS.push(LINK)
    });


    //article
    PROJECT.ARTICLE = []
    document.querySelectorAll('#_article .article_section').forEach(element => {
        var SECTION = new Object()
        SECTION.TITLE = element.querySelector('.article_title input[type=text').value
        SECTION.PARAGRAPHS = []
        element.querySelectorAll('.article_paragraphs textarea').forEach(p => {
            SECTION.PARAGRAPHS.push(p.value)
        })
        PROJECT.ARTICLE.push(SECTION)
    })

    data.append('PROJECT', JSON.stringify(PROJECT))

    //send to create or update
    var request = new XMLHttpRequest();
    request.open('post', '/upload');

    // AJAX request finished event
    request.addEventListener('load', function(e) {

        // Check the response
        if (request.status == 200) {

            //Display success message
            document.getElementById('status').innerHTML = "Successfuly saved"
            /*debug line*/
            console.log(request.response)
                //If a valid Id is returned, redirect to that location
            if (RegExp('^[0-9]+$').test(request.response)) window.location = "/admin?id=" + request.response;
        } else {
            document.getElementById('status').innerHTML = 'Status : ' + request.status + ', ' + request.statusText
        }

    });

    // send POST request to server side script
    request.send(data);
}

/**
 * Display image file as a preview for the input
 * @param {event} event 
 */
function previewImage(event) {
    //get the input that emitted the event
    var source = event.target || event.srcElement
    var file = source.files[0]
    const reader = new FileReader()

    //get the div parent
    while (source.className !== "image_preview") {
        source = source.parentElement
    }

    //swap img and placeholder visibility
    source.children[0].style.display = "block" //img
    source.children[1].style.display = "none" //placeholder

    //get the img of the div and load the image in it
    var preview = source.children[0]
    reader.addEventListener("load", function() {
        //convert file to string
        preview.src = reader.result
    }, false)

    if (file) reader.readAsDataURL(file);

}

/**
 * Remove an image
 * @param {event} event 
 */
function imageRemove(event) {
    var source = event.target || event.srcElement

    //handle nested source
    while (source.className !== "image_preview") {
        source = source.parentElement
    }
    source.parentElement.removeChild(source);
}

/**
 * Add an image field
 * @param {event} event 
 */
function imageAdd(event) {
    var source = event.target || event.srcElement
    while (source.tagName != "BUTTON") {
        source = source.parentElement
    }
    var div = create("DIV", { className: "image_preview" })
    div.appendChild(create("IMG"))

    let i = create("I", { className: "fas fa-6x fa-upload" })
    div.appendChild(i)

    let input = create("INPUT", { className: "image_file", type: "file" })
    input.addEventListener("change", previewImage)
    div.appendChild(input)

    input = create("INPUT", { type: "text", placeholder: "Label" })
    div.appendChild(input)

    i = create("I", { className: "fas fa-minus" })
    i.addEventListener("click", imageRemove)
    div.appendChild(i)

    document.querySelector("#_image .preview_row").append(div)

}

/**
 * Remove a link
 * @param {event} event 
 */
function linkRemove(event) {
    var source = event.target || event.srcElement

    //check if you click on the i or on the button itself
    while (source.tagName !== "DIV") {
        source = source.parentElement
    }
    source.parentElement.removeChild(source);
}

/**
 * Add a link field
 * @param {event} event 
 */
function linkAdd() {
    var source = event.target || event.srcElement
    while (source.tagName !== "BUTTON") {
        source = source.parentElement
    }

    var div = create("DIV")

    let input = create("INPUT", { type: "text", size: "1", placeholder: "Name" })
    div.appendChild(input)

    div.appendChild(document.createTextNode("to : "))

    input = create("INPUT", { type: "text", size: "1", placeholder: "Link" })
    div.appendChild(input)

    let button = create("BUTTON", { type: "button", className: "btn link_remove" })
    let i = create("I", { className: "fas fa-minus" })
    button.appendChild(i)
    button.addEventListener("click", linkRemove)

    div.appendChild(button)
    source.parentElement.insertBefore(div, source)
}

/**
 * Remove an article section
 * @param {event} event 
 */
function sectionRemove(event) {
    var source = event.target || event.srcElement
    while (source.className !== "article_section col") {
        source = source.parentElement
    }
    source.parentElement.removeChild(source);
}

/**
 * Add an article section
 * @param {event} event 
 */
function sectionAdd() {
    var source = event.target || event.srcElement
    while (source.tagName !== "BUTTON") {
        source = source.parentElement
    }
    //create a section
    var div = create("DIV", { className: "article_section col" })

    var div_title = create("DIV", { className: "article_title" })
    let input = create("INPUT", { type: "text", placeholder: "Section title" })
    div_title.appendChild(input)

    let button = create("BUTTON", { type: "button", className: "btn section_remove" })
    let i = create("I", { className: "fas fa-minus" })
    button.appendChild(i)
    button.addEventListener("click", sectionRemove)

    div_title.appendChild(button)

    div.appendChild(div_title)

    let div_para = create("DIV", { className: "article_paragraphs col" })
    div_para.appendChild(create("textarea"))
    div.appendChild(div_para)

    let div_action = create("DIV", { className: "row" })
    button = create("BUTTON", { type: "button", className: "btn pills paragraphs_remove" })
    i = create("I", { className: "fas fa-minus" })
    button.appendChild(i)
    button.appendChild(document.createTextNode(" Remove paragraph"))
    button.addEventListener("click", paragraphsRemove)

    div_action.appendChild(button)

    button = create("BUTTON", { type: "button", className: "btn pills paragraphs_add" })
    i = create("I", { className: "fas fa-plus" })
    button.appendChild(i)
    button.appendChild(document.createTextNode(" Add paragraph"))
    button.addEventListener("click", paragraphsAdd)

    div_action.appendChild(button)

    div.appendChild(div_action)

    source.parentElement.insertBefore(div, source)
}

/**
 * Remove a section paragraph
 * @param {event} event 
 */
function paragraphsRemove(event) {
    var source = event.target || event.srcElement
    while (source.className !== "article_section col") {
        source = source.parentElement
    }
    source.children[1].removeChild(source.children[1].lastElementChild)
}

/**
 * Add a section paragraph
 * @param {event} event 
 */
function paragraphsAdd(event) {
    var source = event.target || event.srcElement
    while (source.className !== "article_section col") {
        source = source.parentElement
    }
    source.children[1].appendChild(document.createElement("TEXTAREA"))
}

/**
 * Send selected file to server as a CV
 */
function uploadCV() {
    var data = new FormData()
    if (document.querySelector('#cvuploader input[type=file]').files.length !== 0) {
        data.append('file[]', document.querySelector('#cvuploader input[type=file]').files[0])

        //send to create or update
        var request = new XMLHttpRequest();
        request.open('post', '/ul_cv');

        // AJAX request finished event
        request.addEventListener('load', function(e) {

            // Check the response
            if (request.status == 200) {
                alert("Successfuly uploaded")
            } else {
                alert(response.status + response.statusText)
            }
        });

        request.send(data);

    } else {
        alert("No file selected")
    }
}