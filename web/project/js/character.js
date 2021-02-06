const characters = document.querySelectorAll('.character');

characters.forEach(character => character.addEventListener("click", getCharacter));

function getCharacter(elem){
    let charid = elem.target.getAttribute(characterid);
    alert(charid);
}