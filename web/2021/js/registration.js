document.getElementById('participantDOB').addEventListener('change', function() {
    let dOB = new Date(this.valueAsNumber);
    let ageInput = document.getElementById('participantAge');
    
    let diff_ms = Date.now() - dOB.getTime();
    let age_dt = new Date(diff_ms);

    if(isNaN(age_dt)){
        ageInput.value = "INVALID BIRTHDAY";
    } else {
        ageInput.value = Math.abs(age_dt.getUTCFullYear() - 1970);
    }
    
    
});