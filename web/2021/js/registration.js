import Participants from './Participants.js';
import {saveLS} from './ls.js';

let participants = new Participants();

document.getElementById('participantDOB').addEventListener('change', function() {
    let dOB = new Date(this.valueAsNumber);
    let ageInput = document.getElementById('participantAge');
    
    let diff_ms = Date.now() - dOB.getTime();
    let age_dt = new Date(diff_ms);

    if(!isNaN(age_dt)){
        ageInput.value = Math.abs(age_dt.getUTCFullYear() - 1970);
    } else {
        ageInput.value = "";
    }
});

if(participant) {

    let pList = loadTasks('participant');
    if(!pList){
        pList = [];
    }
    
    pList[pList.length] = participant;    
    
    saveLS('participant', pList);

    console.log(pList);
}
