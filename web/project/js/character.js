const characters = document.querySelectorAll('.character');

characters.forEach(character => character.addEventListener("click", getCharacter));

function getCharacter(elem){
    console.log(elem.target);
    let charid = elem.target.getAttribute(characterid);
    console.log(charid);
}