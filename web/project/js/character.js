const characters = document.querySelectorAll('.character');

characters.forEach(character => character.addEventListener("click", getCharacter));

function getCharacter(elem){
    let charid = elem.getAttribute(characterid);
    alert(charid);
}