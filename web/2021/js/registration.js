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
        console.log(label);
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
    console.log(div);
    if (required) {
        let span = document.createElement("span");
        span.classList.add('field-tip');
        span.textContent = 'Required';
        div.append(span);
    } else {
        let span = div.lastElementChild;
        console.log(span);
        console.log(span.tagName);
        if (span.tagName) {
            if(span.tagName.toLowerCase() == 'span'){
                span.remove();
            }
        }
    }
}

document.getElementById('selfMedicateN').addEventListener('mousenter', () => {
    console.log('mouseenter...')
    let special = document.querySelector('.special-instructions');
    special.getElementsByClassName.style.transform = "scale(1.05) translateX(0.5rem)";
    special.getElementsByClassName.style.background = "var(--border-intense)";
    special.getElementsByClassName.style.color = "var(--on-nav-bg)";
    special.getElementsByClassName.style.padding = "0.1rem 0.35rem 0.325rem";
});

if(participant) {
    let pList = loadLS('participants');
    if(!pList){
        pList = [];
    }    
    pList[pList.length] = participant;
    
    saveLS('participants', pList);
}

console.log(loadLS('participants'));
