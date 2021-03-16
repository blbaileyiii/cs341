document.getElementById('participantDOB').addEventListener('blur', function() {
    let dOB = new Date(this.valueAsNumber);
    let ageInput = document.getElementById('participantAge');
    
        let diff_ms = Date.now() - dOB.getTime();
        let age_dt = new Date(diff_ms); 
      
        ageInput.value = Math.abs(age_dt.getUTCFullYear() - 1970);
    }
});