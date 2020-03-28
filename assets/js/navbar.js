var sidenav = false;

function toggleNav(){
    if (sidenav) {
        document.getElementById('side-nav').style.marginLeft = "-250px"
        document.getElementById('main').style.marginLeft = "0px"
        console.log(sidenav)
        sidenav = !sidenav
    }else{
        document.getElementById('side-nav').style.marginLeft = "0"
        document.getElementById('main').style.marginLeft = "250px"
        console.log(sidenav)
        sidenav = !sidenav

    }
}