ready(function(){
    //initialise event 
    document.querySelectorAll(".link_remove").forEach(element => {
        element.addEventListener("click",linkRemove)
    });
    document.querySelectorAll(".link_add").forEach(element => {
        element.addEventListener("click",linkAdd)
    });
    document.querySelectorAll(".section_remove").forEach(element => {
        element.addEventListener("click",sectionRemove)
    });
    document.querySelectorAll(".section_add").forEach(element => {
        element.addEventListener("click",section_add)
    });
    document.querySelectorAll(".paragraphs_remove").forEach(element => {
        element.addEventListener("click",paragraphsRemove)
    });
    document.querySelectorAll(".paragraphs_add").forEach(element => {
        element.addEventListener("click",paragraphsAdd)
    });
    document.querySelectorAll(".image_add").forEach(element => {
        element.addEventListener("click",imageAdd)
    });
    document.querySelectorAll(".image_remove").forEach(element => {
        element.addEventListener("click",imageRemove)
    });
    document.querySelectorAll(".image_file").forEach(element => {
        element.addEventListener("change",previewImage)
    });
    
})

//turn form data into json
function parseForm(){
    var project = new Object()
}

//Images
function previewImage(event){
    //get the input that emitted the event
    var source = event.target || event.srcElement
    var file = source.files[0]
    const reader = new FileReader()

    //get the div parent
    while(source.className !== "image_preview"){
        source = source.parentElement
    }
    

    
    //swap img and placeholder visibility
    source.children[0].style.display = "block" //img
    source.children[1].style.display = "none" //placeholder

    //get the img of the div and load the image in it
    var preview = source.children[0]
    reader.addEventListener("load" ,function () {
        //convert file to string
        preview.src = reader.result
    }, false)

    if(file) reader.readAsDataURL(file);

}
function imageRemove(event){
    var source = event.target || event.srcElement

    //handle nested source
    while(source.className !== "image_preview"){
        source = source.parentElement
    }
    source.parentElement.removeChild(source) ;
}
function imageAdd(event){
    var source = event.target || event.srcElement
    while (source.tagName != "BUTTON") {
        source = source.parentElement
    }
    console.log(source)
    var div = create("DIV", {className: "image_preview"})
        div.appendChild(create("IMG"))

        let i = create("I", {className : "fas fa-6x fa-upload"})
        div.appendChild(i)

        let input = create("INPUT", {className : "image_file", type : "file"})
        input.addEventListener("change",previewImage)
        div.appendChild(input)

        input = create("INPUT", {type : "text", placeholder: "Label"})
        div.appendChild(input)

        i = create("I", {className : "fas fa-minus"})
        i.addEventListener("click",imageRemove)
        div.appendChild(i)

    console.log(div)
    console.log(document.getElementById("_image"))
    document.getElementById("_image").insertBefore(div,source)

}

//Link
function linkRemove(event){
    var source = event.target || event.srcElement

    //check if you click on the i or on the button itself
    while(source.tagName !== "DIV"){
        source = source.parentElement
    }
    source.parentElement.removeChild(source) ;
}
function linkAdd(){
    var source = event.target || event.srcElement

    var div = create("DIV")

        let input = create("INPUT", {type : "text", size: "1", placeholder: "Name"})
        div.appendChild(input)

        div.appendChild(document.createTextNode("to : "))

        input = create("INPUT", {type : "text", size: "1", placeholder: "Link"})
        div.appendChild(input)

        let button = create("BUTTON", {type : "button", className: "btn link_remove"})
            let i = create("I", {className : "fas fa-minus"})
        button.appendChild(i)
        button.addEventListener("click",linkRemove)

    div.appendChild(button)
    source.parentElement.insertBefore(div,source)
}

    var source = event.target || event.srcElement
    while(source.className !== "article_section"){
        source = source.parentElement
    }
    source.parentElement.removeChild(source) ;
}
function section_add(){
    var source = event.target || event.srcElement
    console.log(source)

    //create a section
    var div = document.createElement("DIV")
    div.className='article_section'

        var div_title = document.createElement("DIV")
        div_title.className='article_title'
        div_title.innerHTML='<input type="text" placeholder="Section title">'

            let button = document.createElement("BUTTON")
            button.type='button'
            button.className='btn section_remove'
            button.innerHTML='<i class="fas fa-minus"></i>'
            button.addEventListener("click",section_remove)

        div_title.appendChild(button)

    div.appendChild(div_title)

        let div_para = document.createElement("DIV")
        div_para.className='article_paragraphs'
        div_para.innerHTML = '<textarea></textarea>'
    div.appendChild(div_para)

        let div_action = document.createElement("DIV")
        div_action.className="row"

            button = document.createElement("BUTTON")
            button.type='button'
            button.className='btn paragraphs_remove'
            button.innerHTML='<i class="fas fa-minus"></i>'
            button.addEventListener("click",paragraphs_remove)

        div_action.appendChild(button)

            button = document.createElement("BUTTON")
            button.type='button'
            button.className='btn paragraphs_add'
            button.innerHTML='<i class="fas fa-plus"></i> Add paragraphs'
            button.addEventListener("click",paragraphs_add)

        div_action.appendChild(button)
    
    div.appendChild(div_action)

    source.parentElement.insertBefore(div,source)
}


function paragraphs_remove(event){
    var source = event.target || event.srcElement
    while(source.className !== "article_section"){
        source = source.parentElement
    }
    console.log(source.children[1].lastChild)
    source.children[1].removeChild(source.children[1].lastChild)
}
function paragraphs_add(event){
    var source = event.target || event.srcElement
    while(source.className !== "article_section"){
        source = source.parentElement
    }
    console.log(source.children[1].lastChild)
    source.children[1].appendChild(document.createElement("TEXTAREA"))
}
