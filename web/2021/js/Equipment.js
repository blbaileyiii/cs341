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
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.innerHTML="";

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
                equipmentList[item.category] = [{'id': item.id, 'name': item.name, 'quantity': item.quantity, 'avg_price': item.avg_price, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek}];
            } else {
                equipmentList[item.category].push({'id': item.id, 'name': item.name, 'quantity': item.quantity, 'avg_price': item.avg_price, 'bring': item.bring, 'ywcamp': item.ywcamp, 'ymcamp': item.ymcamp, 'trek': item.trek});
            }
        });
        this.equipmentList = equipmentList;
        console.log(this.equipmentList);
        this.displayEquipment();
    }

    getEquipment(master) {
        let url = "/2021/query/?action=getEquipment";
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                let myDBRes = JSON.parse(this.responseText);
                console.log(myDBRes);
                master.convertEquipmentList(myDBRes);


            } else if (this.readyState == 4 && this.status == 404) {
                /*
                let err404 = document.createElement("p");
                err404.className = "err404";
                err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."
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

                li.innerHTML = item.name;

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

        equipDiv.appendChild(pDiv);
    }

    displayItemCheckList(participant) {
        console.log(this.equipmentList);
        let equipDiv = document.getElementById('equipment-lists');
        equipDiv.classList.add('equipment-lists-interactive');

        let pDiv = document.createElement('div');
        pDiv.classList.add(participant.id);

        let dnb;

        Object.keys(this.equipmentList).forEach(key => {

            let pCatDiv = document.createElement('div');
            pCatDiv.classList.add(participant.id + "-" + key.replace(/ /g,"-").toLowerCase());
            
            let h2 = document.createElement('h2');
            let ul = document.createElement('ul');

            h2.innerHTML = "<input type='checkbox' id='" + participant.id + "-" + key.replace(/ /g,"-").toLowerCase() + "' name='" + key.replace(/ /g,"-").toLowerCase() + "'><label for='" + participant.id + "-" + key.replace(/ /g,"-").toLowerCase() + "'>" + key + "</label>";
            ul.classList.add(key.replace(/ /g,"-").toLowerCase());            

            this.equipmentList[key].forEach(item => {
                let li = document.createElement('li');
                let labelTxt;
                if (item.quantity != '1'){
                    labelTxt = item.quantity + " " + item.name;
                } else {
                    labelTxt = item.name;
                }
                
                li.innerHTML = "<input type='checkbox' id='" + participant.id + "-item-" + item.id + "' name='" + participant.id + "-item-" + item.id + "'><label for='" + participant.id + "-item-" + item.id + "'>" + labelTxt + "</label>";

                ul.appendChild(li);
            });

            pCatDiv.appendChild(h2);
            pCatDiv.appendChild(ul);

            pDiv.appendChild(pCatDiv);

            equipDiv.appendChild(pDiv);

            //console.log(key);
            if (key == "DO NOT BRING") { 
                dnb = pCatDiv;
            }
        });

        dnb.remove()
        pDiv.appendChild(dnb);

    }
}
