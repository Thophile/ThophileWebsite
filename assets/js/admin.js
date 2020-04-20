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
    var project = new Object()
}

function link_remove(event){
    var source = event.target || event.srcElement

    //check if you click on the i or on the button itself
    while(source.tagName !== "DIV"){
        source = source.parentElement
    }
    source.parentElement.removeChild(source) ;
}
function link_add(){
    var source = event.target || event.srcElement

    var div = document.createElement("DIV")
    div.innerHTML='<input type="text" size=1 placeholder="Name"> to : <input type="text" size=1 placeholder="Link">'
        var button = document.createElement("BUTTON")
        button.type='button'
        button.className='btn link_remove'
        button.innerHTML='<i class="fas fa-minus"></i>'
        button.addEventListener("click",link_remove)

    div.appendChild(button)
    source.parentElement.insertBefore(div,source)
}


function section_remove(event){
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
