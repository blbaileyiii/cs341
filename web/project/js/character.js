const characters = document.querySelectorAll('.character');

characters.forEach(character => character.addEventListener("click", getCharacter));

function getCharacter(elem){
    let character = elem.currentTarget.getAttribute('data-character');
    window.location.href = '?action=character-info&character=' + character;
}