<!DOCTYPE html>
<html lang="en-us">
    
<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/alert.php'; ?>
    </aside>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/nav.php'; ?>
    </header>    
    <main>
        <section>
            <div class="registrantDiv"></div>            
            <h1>Confirmation</h1>
            <?php
                if (isset($_SESSION['message'])) { 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                }
            ?>
            <form <?php if(isset($validate)){echo "class='form validate'";} else { echo "class='form'"; } ?> method="post">
            <img id="participant-image" <?php if(isset($participantESig)){echo "src='$participantESig'";} else { echo "src=''";} ?> alt="Your signature will go here!"/>
            <img id="guardian-image" <?php if(isset($guardianESig)){echo "src='$guardianESig'";} else { echo "src=''";} ?> alt="Your signature will go here!"/>
            
                <div class="non-fields">
                        <button name="action" type="submit" value="Register"><span>Register Participant</span></button>
                </div>
                <input id="participantSig" name="participantSig" type="hidden" <?php if(isset($participantSig)){echo "value='$participantSig'";} ?> >
                <input id="guardianSig" name="guardianSig" type="hidden" <?php if(isset($guardianSig)){echo "value='$guardianSig'";} ?> >
                <input id="eventId" name="eventId" type="hidden" <?php if(isset($eventId)){echo "value='$eventId'";} ?> >
                <input id="eventDate" name="eventDate" type="hidden" <?php if(isset($eventDate)){echo "value='$eventDate'";} ?> >
                <input id="eventDesc" name="eventDesc" type="hidden" <?php if(isset($eventDesc)){echo "value='$eventDesc'";} ?> >
                <input id="stake" name="stake" type="hidden" <?php if(isset($stake)){echo "value='$stake'";} ?> >
                <input id="eventLeaderName" name="eventLeaderName" type="hidden" <?php if(isset($eventLeaderName)){echo "value='$eventLeaderName'";} ?> >
                <input id="eventLeaderPhone" name="eventLeaderPhone" type="hidden" <?php if(isset($eventLeaderPhone)){echo "value='$eventLeaderPhone'";} ?> >
                <input id="eventLeaderEmail" name="eventLeaderEmail" type="hidden" <?php if(isset($eventLeaderEmail)){echo "value='$eventLeaderEmail'";} ?> >
                <input id="participantName" name="participantName" type="hidden" <?php if(isset($participantName)){echo "value='$participantName'";} ?> >
                <input id="ward" name="ward" type="hidden" <?php if(isset($ward)){echo "value='$ward'";} ?> >
                <input id="participantDOB" name="participantDOB" type="hidden" <?php if(isset($participantDOB)){echo "value='$participantDOB'";} ?> >
                <input id="participantAge" name="participantAge" type="hidden" <?php if(isset($participantAge)){echo "value='$participantAge'";} ?> >
                <input id="email" name="email" type="hidden" <?php if(isset($email)){echo "value='$email'";} ?> >
                <input id="primTel" name="primTel" type="hidden" <?php if(isset($primTel)){echo "value='$primTel'";} ?> >
                <input id="primTelType" name="primTelType" type="hidden" <?php if(isset($primTelType)){echo "value='$primTelType'";} ?> >
                <input id="secTel" name="secTel" type="hidden" <?php if(isset($secTel)){echo "value='$secTel'";} ?>>
                <input id="secTelType" name="secTelType" type="hidden" <?php if(isset($secTelType)){echo "value='$secTelType'";} ?>>
                <input id="participantAddress" name="participantAddress" type="hidden" <?php if(isset($participantAddress)){echo "value='$participantAddress'";} ?> >
                <input id="participantCity" name="participantCity" type="hidden" <?php if(isset($participantCity)){echo "value='$participantCity'";} ?> >
                <input id="participantState" name="participantState" type="hidden" <?php if(isset($participantState)){echo "value='$participantState'";} ?> >
                <input id="emergencyContact" name="emergencyContact" type="hidden" <?php if(isset($emergencyContact)){echo "value='$emergencyContact'";} ?> >
                <input id="emerPrimTel" name="emerPrimTel" type="hidden" <?php if(isset($emerPrimTel)){echo "value='$emerPrimTel'";} ?> >
                <input id="emerPrimTelType" name="emerPrimTelType" type="hidden" <?php if(isset($emerPrimTelType)){echo "value='$emerPrimTelType'";} ?> >
                <input id="emerSecTel" name="emerSecTel" type="hidden" <?php if(isset($emerSecTel)){echo "value='$emerSecTel'";} ?>>
                <input id="emerSecTelType" name="emerSecTelType" type="hidden" <?php if(isset($emerSecTelType)){echo "value='$emerSecTelType'";} ?>>
                <input id="specialDiet" name="specialDiet" type="hidden" <?php if(isset($specialDiet)){echo "value='$specialDiet'";} ?>>
                <input id="specialDietTxt" name="specialDietTxt" type="hidden" <?php if(isset($specialDietTxt)){echo "value='$specialDietTxt'";} ?>>
                <input id="allergies" name="allergies" type="hidden" <?php if(isset($allergies)){echo "value='$allergies'";} ?>>
                <input id="allergiesTxt" name="allergiesTxt" type="hidden" <?php if(isset($allergiesTxt)){echo "value='$allergiesTxt'";} ?>>
                <input id="medication" name="medication" type="hidden" <?php if(isset($medication)){echo "value='$medication'";} ?>>
                <input id="selfMedicate" name="selfMedicate" type="hidden" <?php if(isset($selfMedicate)){echo "value='$selfMedicate'";} ?>>
                <input id="medicationList" name="medicationList" type="hidden" <?php if(isset($medicationList)){echo "value='$medicationList'";} ?>>
                <input id="chronicIllness" name="chronicIllness" type="hidden" <?php if(isset($chronicIllness)){echo "value='$chronicIllness'";} ?>>
                <input id="chronicIllnessTxt" name="chronicIllnessTxt" type="hidden" <?php if(isset($chronicIllnessTxt)){echo "value='$chronicIllnessTxt'";} ?>>
                <input id="serious" name="serious" type="hidden" <?php if(isset($serious)){echo "value='$serious'";} ?>>
                <input id="seriousTxt" name="seriousTxt" type="hidden" <?php if(isset($seriousTxt)){echo "value='$seriousTxt'";} ?>>
                <input id="limitations" name="limitations" type="hidden" <?php if(isset($limitations)){echo "value='$limitations'";} ?>>
                <input id="considerations" name="considerations" type="hidden" <?php if(isset($considerations)){echo "value='$considerations'";} ?>>
            </form>
        </section>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
    </footer>
    <?php //var_dump($events); ?>
    <?php //echo $_SESSION['participantid']; ?>
    <script>
        <?php
                    if (isset($_SESSION['participantid']) && isset($_SESSION['participant']) && isset($_SESSION['eventid'])) {
                        echo "const participant = {'participantid': '$_SESSION[participantid]', 'name': '$_SESSION[participant]', 'eventid': '$_SESSION[eventid]'};";
                        unset($_SESSION['participantid']);
                        unset($_SESSION['participant']);
                        unset($_SESSION['eventid']);
                    } else {
                        echo "const participant = null;";
                    }
        ?>
    </script>
    <!-- <script type="module" src="/js/registration.js"></script> -->
</body>
</html>
