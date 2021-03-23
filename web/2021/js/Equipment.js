import Participants from './Participants.js';
import {loadLS, saveLS} from './ls.js';

export default class Equipment {
    constructor() {
        this.participants = new Participants();
        this.equipmentList = {}; //this.convertEquipmentList();
        //this.displayEquipment();
    }

    displayEquipment() {
        console.log(this.participants.list);
        if (this.participants.list.length > 0) {
            this.participants.list.forEach(participant => {
                console.log(participant);
                this.displayItemCheckList(participant);
            });            
        } else {
            this.displayItemList();
        }
    }

    convertEquipmentList(dbEquipment) {
        let equipmentList = {};
        dbEquipment.forEach(item => {
            if(!equipmentList.hasOwnProperty(item.category)){
                equipmentList[item.category] = [{'equipmentid': item.equipmentid, 'equipmentname': item.equipmentname, 'quantity': item.quantity, 'avgprice': item.avgprice, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek}];
            } else {
                equipmentList[item.category].push({'equipmentid': item.equipmentid, 'equipmentname': item.equipmentname, 'quantity': item.quantity, 'avgprice': item.avgprice, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek});
            }
        });
        this.equipmentList = equipmentList;
        console.log(this.equipmentList);
        this.displayEquipment();
    }

    getEquipment(master) {
        let url = "/2021/equipment/?action=getEquipment";
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                let myObj = JSON.parse(this.responseText);
                console.log(myObj);
                master.convertEquipmentList(myObj);


            } else if (this.readyState == 4 && this.status == 404) {
                /*
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
                */
            } else {
                //console.log("failed");
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    displayItemList() {
        console.log(this.equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-standard');

        let pDiv = document.createElement('div');

        let xh2;
        let xul;

        Object.keys(this.equipmentList).forEach(key => {         
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            h2.innerHTML = key;
            ul.classList.add(key.replace(/ /g,"-"));            

            this.equipmentList[key].forEach(item => {
                let li = document.createElement('li');

                li.innerHTML = item.equipmentname;

                ul.appendChild(li);
            });

            
            pDiv.appendChild(h2);
            pDiv.appendChild(ul);

            if (key != "DO NOT BRING") { 
                pDiv.appendChild(h2);
                pDiv.appendChild(ul);
            } else {
                xh2 = h2;
                xul = ul;
            }
        });

        if(xh2 && xul){
            pDiv.appendChild(xh2);
            pDiv.appendChild(xul);
        }

        equipDiv.innerHTML="";
        equipDiv.appendChild(pDiv);
    }

    displayItemCheckList(participant) {
        console.log(this.equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-interactive');

        let pDiv = document.createElement('div');
        pDiv.classList.add(participant.participantid);

        let xh2;
        let xul;

        Object.keys(this.equipmentList).forEach(key => {
            
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            h2.innerHTML = "<input type='checkbox' id='" + participant.participantid + "-" + key.replace(/ /g,"-").toLowerCase() + "' name='" + key.replace(/ /g,"-").toLowerCase() + "'><label for='" + participant.participantid + "-" + key.replace(/ /g,"-").toLowerCase() + "'>" + key + "</label>";
            ul.classList.add(key.replace(/ /g,"-").toLowerCase());            

            this.equipmentList[key].forEach(item => {
                let li = document.createElement('li');
                let labelTxt;
                if (item.quantity != '1'){
                    labelTxt = item.quantity + " " + item.equipmentname;
                } else {
                    labelTxt = item.equipmentname;
                }
                
                li.innerHTML = "<input type='checkbox' id='" + participant.participantid + "-item-" + item.equipmentid + "' name='" + participant.participantid + "-item-" + item.equipmentid + "'><label for='" + participant.participantid + "-item-" + item.equipmentid + "'>" + labelTxt + "</label>";

                ul.appendChild(li);
            });

            if (key != "DO NOT BRING") { 
                pDiv.appendChild(h2);
                pDiv.appendChild(ul);
            } else {
                xh2 = h2;
                xul = ul;
            }
        });

        if(xh2 && xul){
            pDiv.appendChild(xh2);
            pDiv.appendChild(xul);
        }

        equipDiv.innerHTML="";
        equipDiv.appendChild(pDiv);

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

}

class Item {
    constructor(id, name, quantity, category, haveGot, avgPrice, actPrice) {
        this.id = id;
        this.itemName = name;
        this.quantity = quantity;
        this.category = category;
        this.haveGot = haveGot;
        this.avgPrice = avgPrice;
        this.actPrice = actPrice;
    }
}

