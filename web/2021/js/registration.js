import Participants from './Participants.js';
import {saveLS, loadLS} from './ls.js';

let events;
getEvents();

document.getElementById('participantDOB').addEventListener('change', function() {
    let dOB = new Date(this.valueAsNumber);
    let ageInput = document.getElementById('participantAge');
    let guardianSig = document.getElementById('guardianSig');
    
    let diff_ms = Date.now() - dOB.getTime();
    let age_dt = new Date(diff_ms);

    if(!isNaN(age_dt)){
        ageInput.value = Math.abs(age_dt.getUTCFullYear() - 1970);
    } else {
        ageInput.value = "";
    }

    if(ageInput.value >= 19) {
        guardianSig.value = "N/A - Adult Participant";
        guardianSig.readOnly = true;
        changeTxtRequirement(guardianSig, false);
        //guardianSig.required = false;
    } else {
        guardianSig.value = "";
        guardianSig.readOnly = false;
        changeTxtRequirement(guardianSig, true);
        //guardianSig.required = true;
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

let participants = new Participants();

//console.log(loadLS('participants'));
//console.log(participants.list);
if (participants.list.length > 0) {
    let registrantDiv = document.querySelector('.registrantDiv');
    let eventSelect = document.getElementById('eventId');

    let h1 = document.createElement("h1");
    h1.textContent = "My Registration";

    let registered = document.createElement("div");
    registered.classList.add('myRegistration');

    let ol = document.createElement('ol');

    participants.list.forEach(participant => {
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

function getEvents() {
    let url = "/2021/query/?action=getEvents";
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        //do stuff with data...
        if (this.readyState == 4 && this.status == 200) {
            let myDBRes = JSON.parse(this.responseText);
            console.log(myDBRes);
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
        document.getElementById('eventId').addEventListener('change', function() { 
            //console.log(this.value);
            let myEvent;
            events.forEach( event => { if(event.id == this.value) { 
                myEvent = event; 
            
            } });
            if(myEvent){
                document.getElementById('eventDate').value = myEvent.date_start;
                document.getElementById('eventDesc').value = myEvent.desc;
                document.getElementById('eventLeaderName').value = myEvent.l_name;
                document.getElementById('eventLeaderPhone').value = myEvent.l_phone;
                document.getElementById('eventLeaderEmail').value = myEvent.l_email;
            }
        });
    }
}