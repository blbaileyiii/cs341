<!DOCTYPE html>
<html lang="en-us">
    
<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
</head>

<body>
    <header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/header-nav.php'; ?>
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
                <div>
                    <fieldset>
                        <legend>Re-Affirm Permission</legend>
                        <ul class="re-affirm-details">
                            <li><span>Event: </span>
                                <select class='select-disabled' disabled>
                                    <?php
                                        if(isset($eventId)){
                                            echo "value='$eventId'";
                                            $eventList = str_replace("value='$eventId'", "value='$eventId' selected", $eventList);
                                        }
                                        echo $eventList; 
                                    ?>
                                </select>
                            </li>
                            <li><span>Date(s) of event: </span><?php if(isset($eventDate)){echo date('m/d/Y', $eventDate);} ?></li>
                            <li><span>Description of event and activities: </span><?php if(isset($eventDesc)){echo $eventDesc;} ?></li>
                            <li><span>Updates to be sent to: </span><?php if(isset($email)){echo $email;} ?></li>
                        </ul>
                        <p>By submitting this form, I affirm the following:</p>
                        <p class="chkbx-ind"><input id="adult" name="adult" type="checkbox" required><label for="adult">I am a legal adult (19 years or older).</label></p>
                        <p class="chkbx-ind"><input id="contact" name="contact" type="checkbox" required><label for="contact">I agree to receive updates via the email address provided.</label></p>
                        <p class="chkbx-ind"><input id="permission" name="permission" type="checkbox" required><label for="permission">I give permission for my child or youth to participate in the event and activities listed above (unless noted) and authorize the adult leaders supervising this event to administer emergency treatment to the above named participant for any accident or illness and to act in my stead in approving necessary medical care. This authorization shall cover this event and travel to and from this event.</label></p>
                        <p class="chkbx-ind"><input id="responsibility" name="responsibility" type="checkbox" required><label for="responsibility">The participant is responsible for his or her own conduct and is aware of and agrees to abide by Church standards, camp or event safety rules, and other pertinent instructions. Participants’ conduct and interactions should abide by Church standards and exemplify Christlike behavior. Parents and participants should understand that participation in an activity is not a right but a privilege that can be revoked if they behave inappropriately or if they pose a risk to themselves or others.</label></p>
                        <div class="fields">
                            <label for="participantESig"><span>Participant’s E-signature (Much match previous signature)</span><span class="field-tip">Required</span></label> 
                            <input id="participantESig" name="participantESig" type="text" <?php if(isset($participantSig)){echo "placeholder='$participantSig' pattern='$participantSig'";} ?> required>
                            <p class="sig"><?php if(isset($participantSig)){echo $participantSig;} ?></p>
                        </div>
                        <div class="fields">
                            <label for="participantSigDate"><span>Date</span></label> 
                            <input id="participantSigDate" name="participantSigDate" type="date" value="<?php echo date('Y-m-d') ?>" readonly required>
                        </div>
                        <div class="fields">
                            <label for="guardianESig"><span>Parent or guardian's E-signature (Much match previous signature)</span><?php if(isset($participantAge) && $participantAge >=19){ echo "";} else {echo "<span class='field-tip'>Required</span>";} ?></label> 
                            <input id="guardianESig" name="guardianESig" type="text" <?php if(isset($guardianSig)){echo "placeholder='$guardianSig' pattern='$participantSig'";} ?> <?php if(isset($participantAge) && $participantAge >= 19){echo "value='N/A - Adult Participant' readonly";} else { echo "required";} ?>>
                            <p class="sig"><?php if(isset($guardianSig)){echo $guardianSig;} ?></p>
                        </div>
                        <div class="fields">
                            <label for="guardianSigDate"><span>Date</span></label> 
                            <input id="guardianSigDate" name="guardianSigDate" type="date" value="<?php echo date('Y-m-d') ?>" readonly required>
                        </div>
                    </fieldset>
                    <p class="legal-sm"><a href="https://www.churchofjesuschrist.org/bc/content/shared/content/english/pdf/callings/young-men/parental-permission-medical-release.pdf" title="Permission and Medical Release Form" target="_blank" rel="noreferrer">Permission and Medical Release Form</a> © 2017, 2019 by Intellectual Reserve, Inc. All rights reserved. 5/19. PD60004035 000</p>
                </div>
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
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <?php //var_dump($events); ?>
    <?php //echo $_SESSION['participantid']; ?>
    <script>
        <?php echo $eventScript; ?>
    </script>    
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
    <!-- <script type="module" src="/2021/js/registration.js"></script> -->
</body>
</html>
