const characters = document.querySelectorAll('.character');

characters.forEach(character => character.addEventListener("click", getCharacter));

function getCharacter(elem){
    let character = elem.currentTarget.getAttribute('data-character');
    if (character == "+new"){
        window.location.href = '?action=char-create';
    } else {
        window.location.href = '?action=char-info&character=' + character;
    }
    
}