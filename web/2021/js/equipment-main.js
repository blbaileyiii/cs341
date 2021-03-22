import Equipment from './Equipment.js';

//let equipment = new Equipment();






loadJSON();

function loadJSON() {
    let url = "/2021/equipment/?action=getEquipment";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        //do stuff with data...
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            console.log(myObj);
        } else {
            console.log("failed");
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

/*
function loadJSON() {
    let file = document.getElementById("file").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            

            let div = document.getElementById("json-data"); 
            if(div.childNodes[0]){
                div.removeChild(div.childNodes[0]);
            }

            let container = document.createElement("div");

            for (i in myObj.students) {
                let card = document.createElement('section');
                let first = document.createElement("p");
                let last = document.createElement("p");
                let address = document.createElement("p");
                let major = document.createElement("p");
                let gpa = document.createElement("p");

                first.innerHTML = "<span>First Name:</span>" + myObj.students[i].first;
                last.innerHTML = "<span>Last Name:</span>" + myObj.students[i].last;
                address.innerHTML = "<span>Address:</span>" + myObj.students[i].address.city + ", " + myObj.students[i].address.state + " " + myObj.students[i].address.zip;
                major.innerHTML = "<span>Major:</span>" + myObj.students[i].major;
                gpa.innerHTML = "<span>GPA:</span>" + myObj.students[i].gpa;

                card.appendChild(first);
                card.appendChild(last);
                card.appendChild(address);
                card.appendChild(major);
                card.appendChild(gpa);

                container.appendChild(card);
            }
            
            div.appendChild(container);
        } else if (this.readyState == 4 && this.status == 404) {

            let div = document.getElementById("json-data"); 
            if(div.childNodes[0]){
                div.removeChild(div.childNodes[0]);
            }

            let container = document.createElement("div");
            
            let card = document.createElement('section');
            let err404 = document.createElement("p");
            err404.className = "err404";

            err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."

            card.appendChild(err404);
            container.appendChild(card);
            div.appendChild(container);

        }
    };
    xmlhttp.open("GET", file, true);
    xmlhttp.send();
}
*/
