const characters = document.querySelectorAll('.character');

characters.forEach(character => character.addEventListener("click", getCharacter));

function getCharacter(elem){
    console.log(elem.currentTarget);
    let charid = elem.currentTarget.data('charid');
    console.log(charid);
}