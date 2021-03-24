import {loadLS, saveLS} from './ls.js';

export default class Participants {
    constructor() {
        this.list = this.getParticipants();
        // Validate the list...loop through it and if the participant is gone, remove and update...
        this.validateList(this);
    }

    getParticipants() {
        let list = loadLS('participants');
        if(!list) {
            list = [];
        }
        return list;
    }

    validateList(master){
        if (this.list.length > 0) {
            this.list.forEach(participant => {
                console.log(participant);
                this.getParticipantById(master, participant.id);
                //this.displayItemCheckList(participant);
            });            
        } 
    }

    getParticipantById(master, id) {
        console.log(id);
        let url = "/2021/query/?action=getParticipant&id=" + id;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                let myDBRes = JSON.parse(this.responseText);
                console.log(myDBRes);
                //master.convertEquipmentList(myDBRes, id);
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

    

}
