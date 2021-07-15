let myAlertX = document.querySelector('.close-alert');

myAlertX.addEventListener('click', closeAlert, false);

if(sessionStorage.getItem('alert') == 'hidden'){
    closeAlert();
}

function closeAlert()  {
    let myAlert = document.querySelector('.site-alert');
    myAlert.classList.add('hidden');
    sessionStorage.setItem('alert', 'hidden');
}