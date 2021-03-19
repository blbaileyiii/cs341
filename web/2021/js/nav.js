const hambutton = document.querySelector('.ham');
const mainnav = document.querySelector('.nav-ul');

hambutton.addEventListener('click', toggleMenuTxt, false);

function toggleMenuTxt(x) {
    //mainnav.classList.toggle('nav-hide');
    let menu = document.getElementById("toggleMenu");


    if (box.classList.contains('nav-hidden')) {
        box.classList.remove('nav-hidden');
        setTimeout(function () {
            box.classList.remove('visuallyhidden');
        }, 20);
    } else {
        box.classList.add('visuallyhidden');    
        box.addEventListener('transitionend', function(e) {
            box.classList.add('nav-hidden');
        }, {
            capture: false,
            once: true,
            passive: false
        });
    }


    if (menu.innerHTML === "☰ Menu" || menu.innerHTML == "&#9776; Menu") {
        menu.innerHTML = "✖ Close";
    } else {
        menu.innerHTML = "☰ Menu";
    }
}

// To solve the mid resizing issue with responsive class on
window.onresize = toggleMenuResize;

function toggleMenuResize(x) {
    if (window.innerWidth > 800) {
        mainnav.classList.remove('nav-hide');
        document.getElementById("toggleMenu").innerHTML = "☰ Menu";
    }            
}