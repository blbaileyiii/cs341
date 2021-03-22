import Participants from './Participants.js';
import {saveLS, loadLS} from './ls.js';

let participants = new Participants();

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
        guardianSig.required = false;
    } else {
        guardianSig.value = "";
        guardianSig.readOnly = false;
        guardianSig.required = true;
    }
});

let specialDietTxt = document.getElementById('specialDietTxt');
document.getElementById('specialDietY').addEventListener('change', changeTxtRequirement(specialDietTxt, true));
document.getElementById('specialDietN').addEventListener('change', changeTxtRequirement(specialDietTxt, false));


function changeTxtRequirement(txtField, required) {
    txtField.required = required;
    console.log(txtField);
    console.log(required);
}

if(participant) {
    let pList = loadLS('participants');
    if(!pList){
        pList = [];
    }    
    pList[pList.length] = participant;
    
    saveLS('participants', pList);
}

console.log(loadLS('participants'));
