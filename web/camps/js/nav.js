const hambutton = document.querySelector('.ham');
const mainnav = document.querySelector('.nav-ul');
const menu = document.getElementById("toggleMenu");

hambutton.addEventListener('click', toggleMenuTxt, false);

function toggleMenuTxt(x) {
    //mainnav.classList.toggle('nav-hide');  

    if (mainnav.classList.contains('nav-hidden')) {
        menu.innerHTML = "✖ Close";
        mainnav.classList.remove('nav-hidden');        
        setTimeout(function () {
            mainnav.classList.remove('nav-hide');
        }, 20);
    } else {
        menu.innerHTML = "☰ Menu";
        mainnav.classList.add('nav-hide');    
        mainnav.addEventListener('transitionend', function(e) {
            mainnav.classList.add('nav-hidden');
        }, {
            capture: false,
            once: true,
            passive: false
        });
    }
}

// To solve the mid resizing issue with responsive class on
window.onresize = toggleMenuResize;

function toggleMenuResize(x) {
    if (window.innerWidth > 800) {
        menu.innerHTML = "☰ Menu";
        mainnav.classList.add('nav-hidden');
        mainnav.classList.add('nav-hide'); 
        
    }            
}