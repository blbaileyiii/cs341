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
            let ids = [];
            this.list.forEach(participant => {
                console.log(participant);                
                ids.push(participant.id);
            });
            this.getParticipantByIds(master, ids);
        } 
    }

    getParticipantByIds(master, ids) {
        console.log(ids);
        let url = "/2021/query/?action=getParticipants";
        ids.forEach(id => {
            url = url + "&ids[]=" + id;
        });        
        //console.log(url);
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            //do stuff with data...
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                let myDBRes = JSON.parse(this.responseText);
                console.log(myDBRes);
                //master.validationComplete();
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
