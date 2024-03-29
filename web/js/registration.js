import Participants from './Participants.js';
import {saveLS, loadLS} from './ls.js';

let events;
getEvents();

document.getElementById('participantDOB').addEventListener('change', function() {
    let dOB = new Date(this.valueAsNumber);
    let ageInput = document.getElementById('participantAge');
    let guardianESig = document.getElementById('guardianESig');
    let guardianBlock = document.querySelectorAll('.guardianNA');
    
    let diff_ms = Date.now() - dOB.getTime();
    let age_dt = new Date(diff_ms);

    if(!isNaN(age_dt)){
        ageInput.value = Math.abs(age_dt.getUTCFullYear() - 1970);
    } else {
        ageInput.value = "";
    }

    if(ageInput.value >= 19) {
        guardianESig.value = "";
        //guardianSig.readOnly = true;
        changeTxtRequirement(guardianESig, false);
        //guardianSig.required = false;
        guardianBlock.forEach( (block) => {
            block.classList.add('hidden');
        });
    } else {
        guardianESig.value = "";
        //guardianSig.readOnly = false;
        changeTxtRequirement(guardianESig, true);
        //guardianSig.required = true;
        guardianBlock.forEach( (block) => {
            block.classList.remove('hidden');
        });
    }
});

let specialDietTxt = document.getElementById('specialDietTxt');
document.getElementById('specialDietY').addEventListener('change', () => { changeTxtRequirement(specialDietTxt, true); });
document.getElementById('specialDietN').addEventListener('change', () => { changeTxtRequirement(specialDietTxt, false); });

let allergiesTxt = document.getElementById('allergiesTxt');
document.getElementById('allergiesY').addEventListener('change', () => { changeTxtRequirement(allergiesTxt, true); });
document.getElementById('allergiesN').addEventListener('change', () => { changeTxtRequirement(allergiesTxt, false); });

let chronicIllnessTxt = document.getElementById('chronicIllnessTxt');
document.getElementById('chronicIllnessY').addEventListener('change', () => { changeTxtRequirement(chronicIllnessTxt, true); });
document.getElementById('chronicIllnessN').addEventListener('change', () => { changeTxtRequirement(chronicIllnessTxt, false); });

let seriousTxt = document.getElementById('seriousTxt');
document.getElementById('seriousY').addEventListener('change', () => { changeTxtRequirement(seriousTxt, true); });
document.getElementById('seriousN').addEventListener('change', () => { changeTxtRequirement(seriousTxt, false); });

let medicationList = document.getElementById('medicationList');
let selfMedicateY = document.getElementById('selfMedicateY');
let selfMedicateN = document.getElementById('selfMedicateN');
document.getElementById('medicationY').addEventListener('change', () => { 
    selfMedicateY.disabled = false;
    selfMedicateN.disabled = false;
    changeRadioRequirement(selfMedicateY, true);
    changeTxtRequirement(medicationList, true);
});
document.getElementById('medicationN').addEventListener('change', () => { 
    selfMedicateY.disabled = true;
    selfMedicateN.disabled = true;
    selfMedicateY.checked = false;
    selfMedicateN.checked = false;
    changeRadioRequirement(selfMedicateY, false);
    changeTxtRequirement(medicationList, false);
});

function changeTxtRequirement(txtField, required) {
    let label = document.querySelector('label[for=' + txtField.id + ']');
    txtField.required = required;    
    if (label) {
        //console.log(label);
        if (required){
            let span = document.createElement("span");
            span.classList.add('field-tip');
            span.textContent = 'Required';
            label.appendChild(span);
        } else {
            let span = label.querySelector('.field-tip');
            if (span) {
                label.removeChild(span);
            }
        }
    }
}

function changeRadioRequirement(inputField, required) {
    inputField.required = required;
    let div = inputField.parentElement.parentElement.parentElement;
    //console.log(div);
    if (required) {
        let span = document.createElement("span");
        span.classList.add('field-tip');
        span.textContent = 'Required';
        div.append(span);
    } else {
        let span = div.lastElementChild;
        //console.log(span);
        //console.log(span.tagName);
        if (span.tagName) {
            if(span.tagName.toLowerCase() == 'span'){
                span.remove();
            }
        }
    }
}

document.getElementById('selfMedicateN').parentElement.addEventListener('mouseover', () => {
    document.querySelector('.special-instructions').classList.add('special-instructions-hover');
});

document.getElementById('selfMedicateN').parentElement.addEventListener('mouseout', () => {
    document.querySelector('.special-instructions').classList.remove('special-instructions-hover');
});

if(participant) {
    let pList = loadLS('participants');
    if(!pList){
        pList = [];
    }    
    pList[pList.length] = participant;
    
    saveLS('participants', pList);
}

let participants = new Participants(buildRegistrantDiv);

function buildRegistrantDiv(participantList){
    //console.log(loadLS('participants'));
    //console.log(participants);
    if (participantList.length > 0) {
        let registrantDiv = document.querySelector('.registrantDiv');
        let eventSelect = document.getElementById('eventId');

        let h1 = document.createElement("h1");
        h1.textContent = "My Registration";

        let registered = document.createElement("div");
        registered.classList.add('myRegistration');

        let ol = document.createElement('ol');

        participantList.forEach(participant => {
            let li = document.createElement('li');
            let eventTxt;
            Object.values(eventSelect.options).forEach(option=>{
                if (option.value == participant.event_id){ eventTxt = option.text; }
            });
            //let event = eventSelect.querySelector('option[value=' + participant.eventid + ']').textContent;
            li.innerHTML = participant.p_name + ' registered for ' + eventTxt;
            ol.appendChild(li);
        });

        registered.appendChild(ol);
        registrantDiv.appendChild(h1);
        registrantDiv.appendChild(registered);
    }
}


function getEvents() {
    let url = "/query/?action=getEvents";
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        //do stuff with data...
        if (this.readyState == 4 && this.status == 200) {
            let myDBRes = JSON.parse(this.responseText);
            //console.log(myDBRes);
            events = myDBRes;
            buildEventScript();

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

function buildEventScript() {
    //console.log(events);
    if (events.length > 0) {
        let eventId = document.getElementById('eventId');
        setMyEvent(eventId.value);
        
        eventId.addEventListener('change', function() { 
            //console.log(this.value);
            setMyEvent(this.value);
        });
    }
}

function setMyEvent(eventId){
    let myEvent;
    events.forEach( event => { if(event.id == eventId) { 
        myEvent = event; 
    
    } });
    if(myEvent){

        let dateStart = new Date(myEvent.date_start + "T00:00:00");
        let dateEnd = new Date(myEvent.date_end + "T00:00:00");

        let dateStartF = (dateStart.getMonth() + 1) + "/" + dateStart.getDate() + "/" + dateStart.getFullYear();
        let dateEndF = (dateEnd.getMonth() + 1) + "/" + dateEnd.getDate() + "/" + dateEnd.getFullYear();

        let year = new Date().getFullYear();
        let minDOBYear = new Date(myEvent.min_DOB + "T00:00:00").getFullYear();
        let turningAge = year - minDOBYear;

        console.log(dateStartF);
        console.log(dateEndF);

        console.log(year);
        console.log(minDOBYear);
        console.log(turningAge);

        document.getElementById('eventDate').value = dateStartF + " - " + dateEndF;
        document.getElementById('eventDesc').value = myEvent.desc;
        document.getElementById('eventLeaderName').value = myEvent.l_name;
        document.getElementById('eventLeaderPhone').value = myEvent.l_phone;
        document.getElementById('eventLeaderEmail').value = myEvent.l_email;
        document.getElementById('participantDOB').max = myEvent.min_DOB;
        document.getElementById('turningAge').textContent = turningAge;
    }
}