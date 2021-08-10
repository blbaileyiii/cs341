let checkedInList = document.querySelector('.checkedin');
let reviewedList = document.querySelector('.reviewed');
let leaderList = document.querySelector('.leader');
let inactiveList = document.querySelector('.inactive');

checkedInList.forEach(input => {
    input.addEventListener('change', function() {
        alert(this.dataset.pid);
    })
})