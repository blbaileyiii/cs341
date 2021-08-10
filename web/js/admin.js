let checkedInList = document.querySelectorAll('.checkedin');
let reviewedList = document.querySelectorAll('.reviewed');
let leaderList = document.querySelectorAll('.leader');
let inactiveList = document.querySelectorAll('.inactive');

checkedInList.forEach(input => {
    input.addEventListener('change', function() {
        alert(this.dataset.pid);
    })
})