let checkedInList = document.querySelectorAll('.checkedin');
let reviewedList = document.querySelectorAll('.reviewed');
let leaderList = document.querySelectorAll('.leader');
let inactiveList = document.querySelectorAll('.inactive');

checkedInList.forEach(input => {
    input.addEventListener('change', function() {
        // alert(this.dataset.pid);
        // alert(this.checked);

        // Prepare Post FormData
        let data = new FormData();
        data.append('action', 'postCheckedIn');
        data.append('p_id', this.dataset.pid);
        data.append('isChecked', this.checked);
        // post the Data
        post(data);
    })
})

function post(data){
    let url = "/query/";

    for (let pair of data.entries()){
        console.log(pair[0]+ ', ' + pair[1]); 
    }

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        //do stuff with data...
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
            let myDBRes = JSON.parse(this.responseText);
            if(myDBRes) {
                // SUCCESSFUL...
            }
        } else if (this.readyState == 4 && this.status == 404) {
            /*
            let err404 = document.createElement("p");
            err404.className = "err404";
            err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."
            */
        } else {
            // console.log("failed");
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.send(data);
}