ready(function () {
    //initialise event 
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
        element.addEventListener("click", section_add)
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
        element.addEventListener('click',validate)
    });

})

//ask user to confirm that he wants to delete a project
function validate(event) {
    var source = event.target || event.srcElement
    //handle nested source
    while (source.tagName !== "A") {
        source = source.parentElement
    }
    message = "Are you sur you want to delete project n°" + source.href.split('=')[1] + " ?"

    if(!confirm(message)) event.preventDefault();
}


//turn form data into json
function parseForm() {
    //retrieve dta
    var project = new Object()

    //get project id from url
    var urlparameters = window.location.search //get full string
    var parameters = new URLSearchParams(urlparameters)
    project.id = parameters.get('id')

    project.title = document.querySelector('input[name=title]').value
    project.category = document.querySelector('input[name=category]').value
    project.banner_image = document.querySelector('input[name=style]').value


    //image
    project.images = []
    var data = new FormData()
    document.querySelectorAll('#_image .image_preview').forEach(element => {

        //if an img has been loaded/selected
        if (element.querySelector('img').src != "") {
            var image = new Object()

            //save the filename
            if (element.querySelector('input[type=file]').files.length == 0) {
                image.filename = element.querySelector('img').src.split(/(\\|\/)/g).pop()
            } else {
                image.filename = element.querySelector('input[type=file]').files[0].name
                data.append('file[]', element.querySelector('input[type=file]').files[0])
            }

            image.label = element.querySelectorAll('input')[1].value

            project.images.push(image)
        }
    });


    //links
    project.links = []
    document.querySelectorAll('#_links div').forEach(element => {
        var link = new Object()
        link.title = element.querySelectorAll('input')[0].value
        link.href = element.querySelectorAll('input')[1].value
        project.links.push(link)
    });


    //article
    project.article = []
    document.querySelectorAll('#_article .article_section').forEach(element => {
        var section = new Object()
        section.title = element.querySelector('.article_title input[type=text').value
        section.paragraphs = []
        element.querySelectorAll('.article_paragraphs textarea').forEach(p => {
            section.paragraphs.push(p.value)
        })
        project.article.push(section)
    })

    data.append('project', JSON.stringify(project))

    //send to create or update
    var request = new XMLHttpRequest();
    request.open('post', '/upload');

    // AJAX request finished event
    request.addEventListener('load', function (e) {
        
        // Check the response
        if(request.status == 200) {

            //Display success message
            document.getElementById('status').innerHTML = "Successfuly saved"

            //If a valid Id is returned, redirect to that location
            if(RegExp('^[0-9]+$').test(request.response)) window.location = "/admin?id=" + request.response ;
        }
        else{
            document.getElementById('status').innerHTML = 'Status : ' + request.status + ', ' + request.statusText
        }

    });

    // send POST request to server side script
    request.send(data);
}

//Images
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
    reader.addEventListener("load", function () {
        //convert file to string
        preview.src = reader.result
    }, false)

    if (file) reader.readAsDataURL(file);

}
function imageRemove(event) {
    var source = event.target || event.srcElement

    //handle nested source
    while (source.className !== "image_preview") {
        source = source.parentElement
    }
    source.parentElement.removeChild(source);
}
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

//Link
function linkRemove(event) {
    var source = event.target || event.srcElement

    //check if you click on the i or on the button itself
    while (source.tagName !== "DIV") {
        source = source.parentElement
    }
    source.parentElement.removeChild(source);
}
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

//Articles
function sectionRemove(event) {
    var source = event.target || event.srcElement
    while (source.className !== "article_section col") {
        source = source.parentElement
    }
    source.parentElement.removeChild(source);
}
function section_add() {
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


function paragraphsRemove(event) {
    var source = event.target || event.srcElement
    while (source.className !== "article_section col") {
        source = source.parentElement
    }
    source.children[1].removeChild(source.children[1].lastElementChild)
}
function paragraphsAdd(event) {
    var source = event.target || event.srcElement
    while (source.className !== "article_section col") {
        source = source.parentElement
    }
    source.children[1].appendChild(document.createElement("TEXTAREA"))
}
