const hambutton = document.querySelector('.ham');
const mainnav = document.querySelector('.nav-ul');

hambutton.addEventListener('click', toggleMenuTxt, false);

function toggleMenuTxt(x) {
    //mainnav.classList.toggle('nav-hide');
    let menu = document.getElementById("toggleMenu");


    if (mainnav.classList.contains('nav-hidden')) {
        menu.innerHTML = "☰ Menu";
        mainnav.classList.remove('nav-hidden');
        
        //setTimeout(function () {
        //    mainnav.classList.remove('visuallyhidden');
        //}, 20);
    } else {
        menu.innerHTML = "✖ Close";
        //mainnav.classList.add('visuallyhidden');    
        //mainnav.addEventListener('transitionend', function(e) {
            mainnav.classList.add('nav-hidden');
        //}, {
        //    capture: false,
        //    once: true,
        //    passive: false
        //});
    }
}

// To solve the mid resizing issue with responsive class on
window.onresize = toggleMenuResize;

function toggleMenuResize(x) {
    if (window.innerWidth > 800) {
        mainnav.classList.remove('nav-hidden');
        document.getElementById("toggleMenu").innerHTML = "☰ Menu";
    }            
}