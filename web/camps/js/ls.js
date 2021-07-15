function loadLS(get){
    return JSON.parse(localStorage.getItem(get));
}

function saveLS(set, item){
    localStorage.setItem(set, JSON.stringify(item));
}

export {
    loadLS,
    saveLS
}

