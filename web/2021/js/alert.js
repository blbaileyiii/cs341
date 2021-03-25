let myAlert = document.getElementById('close-alert');

myAlert.addEventListener('click', closeAlert, false);

if(sessionStorage.getItem('alert') == 'hidden'){
    closeAlert();
}

function closeAlert()  {
    myAlert.classList.add('hidden');
    sessionStorage.setItem('alert', 'hidden');
}