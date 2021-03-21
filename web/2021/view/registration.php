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
            <h1>Registration</h1>
            <p>All Adult and Youth Participants are required to register by submitting a valid Permission and Medical Release Form.</p>
            <ul>
                <li>Please fill out all required fields below. Note: Gray fields will be filled out automatically.</li>
                <li>If the participant is under 19 years of age then the form must also be signed by the youth's legal parent/guardian.</li>
                <li>A single form can not be used to register more than one participant or a single participant for multiple events.</li>
                <li>Each participant must register individually for each event.</li>
            </ul>
            <h2>Permission and Medical Release Form</h2>
            <div class="message">            
                <?php
                    if (isset($_SESSION['message'])) { 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                    }
                ?>
            </div>
            <form class="form" method="post">
                <fieldset>
                    <legend>Event Details</legend>
                    <div class="fields">
                        <label for="eventId"><span>Event</span><span class="field-tip">Required</span></label>
                        <select id="eventId" name="eventId" required>
                            <option value="" selected disabled>Choose an event</option>
                            <?php echo $eventList; ?>
                        </select>
                    </div>
                    <div class="fields">
                        <label for="eventDate"><span>Date(s) of event</span></label> 
                        <input id="eventDate" name="eventDate" type="date" readonly>
                    </div>
                    <div class="fields">
                        <label for="eventDesc"><span>Describe event and activities (please be specific):</span></label>
                        <textarea id="eventDesc" name="eventDesc" readonly></textarea>
                    </div>
                    <div class="fields">
                        <label for="stake"><span>Stake</span></label> 
                        <input id="stake" name="stake" type="text" value="Hacienda Heights California Stake" readonly>
                    </div>
                    <div class="fields">
                        <label for="eventLeaderName"><span>Event or activity leader</span></label> 
                        <input id="eventLeaderName" name="eventLeaderName" type="text" readonly>
                    </div>
                    <div class="fields">
                        <label for="eventLeaderPhone"><span>Event or activity leader’s phone number</span></label> 
                        <input id="eventLeaderPhone" name="eventLeaderPhone" type="tel" readonly>
                    </div>
                    <div class="fields">
                        <label for="eventLeaderEmail"><span>Event or activity leader’s email</span></label> 
                        <input id="eventLeaderEmail" name="eventLeaderEmail" type="email" readonly>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Participant Information</legend>
                    <div class="fields">
                        <label for="participantName"><span>Participant</span><span class="field-tip">Required</span></label> 
                        <input id="participantName" name="participantName" type="text" required>
                    </div>
                    <div class="fields">
                        <label for="ward"><span>Ward</span><span class="field-tip">Required</span></label>
                        <select id="ward" name="ward" required>
                            <option value="" selected disabled>Choose your ward</option>
                            <option value="cs">Creekside</option>
                            <option value="hh1">Hacienda Heights 1st</option>
                            <option value="hh5">Hacienda Heights 5th</option>
                            <option value="la">Los Altos</option>
                            <option value="rh">Rowland Heights</option>
                            <option value="tc">Turnbull Canyon</option>
                            <option value="wv">Walnut Valley</option>
                            <option value="ws">Woodside</option>
                        </select>
                    </div>
                    <div class="fields">
                        <label for="participantDOB"><span>Date of birth</span></label> 
                        <input id="participantDOB" name="participantDOB" type="date" max="2008-01-01" required>
                    </div>
                    <div class="fields">
                        <label for="participantAge"><span>Age</span></label> 
                        <input id="participantAge" name="participantAge" type="number" min="11" placeholder="Invalid Birthday" readonly>
                    </div>
                    <div class="fields">
                        <label for="primTel"><span>Primary telephone number</span><span class="field-tip">Required</span></label>
                        <input id="primTel" name="primTel" type="tel" required> 
                    </div>
                    <div class="fields-radio-alt">
                        <input id="primTelCell" name="primTelType" type="radio" value="cell" checked required>
                        <label for="primTelCell"><span>Cell</span></label>
                        <input id="primTelHome" name="primTelType" type="radio" value="home">
                        <label for="primTelHome"><span>Home</span></label>                    
                        <input id="primTelWork" name="primTelType" type="radio" value="work">
                        <label for="primTelWork"><span>Work</span></label>
                    </div>
                    <div class="fields">
                        <label for="secTel"><span>Secondary telephone number</span></label> 
                        <input id="secTel" name="secTel" type="tel">
                    </div>
                    <div class="fields-radio-alt">
                        <input id="secTelCell" name="secTelType" type="radio" value="cell" checked>
                        <label for="secTelCell"><span>Cell</span></label>
                        <input id="secTelHome" name="secTelType" type="radio" value="home">
                        <label for="secTelHome"><span>Home</span></label>                    
                        <input id="secTelWork" name="secTelType" type="radio" value="work">
                        <label for="secTelWork"><span>Work</span></label>
                    </div>                
                    <div class="fields">
                        <label for="participantAddress"><span>Address</span><span class="field-tip">Required</span></label> 
                        <input id="participantAddress" name="participantAddress" type="text" required>
                    </div>
                    <div class="fields">
                        <label for="participantCity"><span>City</span><span class="field-tip">Required</span></label> 
                        <input id="participantCity" name="participantCity" type="text" required>
                    </div>
                    <div class="fields">
                        <label for="participantState"><span>State or province</span><span class="field-tip">Required</span></label> 
                        <input id="participantState" name="participantState" type="text" required>
                    </div>
                    <div class="fields">
                        <label for="emergencyContact"><span>Emergency contact (If under 19, must be legal parent or guardian)</span><span class="field-tip">Required</span></label> 
                        <input id="emergencyContact" name="emergencyContact" type="text" required>
                    </div>
                    <div class="fields">
                        <label for="emerPrimTel"><span>Primary telephone number</span><span class="field-tip">Required</span></label> 
                        <input id="emerPrimTel" name="emerPrimTel" type="tel" required>
                    </div>
                    <div class="fields-radio-alt">
                        <input id="emerPrimTelCell" name="emerPrimTelType" type="radio" value="cell" checked required>
                        <label for="emerPrimTelCell"><span>Cell</span></label>
                        <input id="emerPrimTelHome" name="emerPrimTelType" type="radio" value="home">
                        <label for="emerPrimTelHome"><span>Home</span></label>                    
                        <input id="emerPrimTelWork" name="emerPrimTelType" type="radio" value="work">
                        <label for="emerPrimTelWork"><span>Work</span></label>
                    </div>
                    <div class="fields">
                        <label for="emerSecTel"><span>Secondary telephone number</span></label> 
                        <input id="emerSecTel" name="emerSecTel" type="tel">
                    </div>
                    <div class="fields-radio-alt">
                        <input id="emerSecTelCell" name="emerSecTelType" type="radio" value="cell" checked>
                        <label for="emerSecTelCell"><span>Cell</span></label>
                        <input id="emerSecTelHome" name="emerSecTelType" type="radio" value="home">
                        <label for="emerSecTelHome"><span>Home</span></label>                    
                        <input id="emerSecTelWork" name="emerSecTelType" type="radio" value="work">
                        <label for="emerSecTelWork"><span>Work</span></label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Medical Information</legend>
                    <div class="fields-radio">
                        <div>
                            <span>Does the participant require a special diet?</span>
                            <input id="specialDietY" name="specialDiet" type="radio" value="y" required>
                            <label for="specialDietY"><span>Yes</span></label>
                            <input id="specialDietN" name="specialDiet" type="radio" value="n">
                            <label for="specialDietN"><span>No</span></label>
                        </div>
                        <span class="field-tip">Required</span>
                    </div> 
                    <div class="fields">
                        <label for="specialDietTxt"><span>If yes, please explain the dietary restrictions:</span></label> 
                        <textarea id="specialDietTxt" name="specialDietTxt"></textarea>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <span>Does the participant have any allergies?</span>
                            <input id="allergiesY" name="allergies" type="radio" value="y" required>
                            <label for="allergiesY"><span>Yes</span></label>
                            <input id="allergiesN" name="allergies" type="radio" value="n">
                            <label for="allergiesN"><span>No</span></label>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields">
                        <label for="allergiesTxt"><span>If yes, please list the allergies:</span></label> 
                        <textarea id="allergiesTxt" name="allergiesTxt"></textarea>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <span>Is the participant taking any medication or over-the-counter (OTC) drugs?</span>
                            <input id="medicationY" name="medication" type="radio" value="y" required>
                            <label for="medicationY"><span>Yes</span></label>
                            <input id="medicationN" name="medication" type="radio" value="n">
                            <label for="medicationN"><span>No</span></label>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <span>If yes, can the participant self-administer his or her medication?</span>
                            <input id="selfMedicateY" name="selfMedicate" type="radio" value="y">
                            <label for="selfMedicateY"><span>Yes</span></label>
                            <input id="selfMedicateN" name="selfMedicate" type="radio" value="n">
                            <label for="selfMedicateN"><span>No</span></label>
                        </div>
                        <span class="field-tip">If no, please contact the event or activity leader directly.</span>
                    </div>
                    <div class="fields">
                        <label for="medicationList"><span>List all prescription or over-the-counter (OTC) medications the participant is taking:</span></label> 
                        <textarea id="medicationList" name="medicationList"></textarea>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Physical Conditions That Limit Activity</legend>
                    <div class="fields-radio">
                        <div>
                            <span>Does the participant have a chronic or recurring illness?</span>
                            <input id="chronicIllnessY" name="chronicIllness" type="radio" value="y" required>
                            <label for="chronicIllnessY"><span>Yes</span></label>
                            <input id="chronicIllnessN" name="chronicIllness" type="radio" value="n">
                            <label for="chronicIllnessN"><span>No</span></label>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields">
                        <label for="chronicIllnessTxt"><span>If yes, please explain:</span></label> 
                        <textarea id="chronicIllnessTxt" name="chronicIllnessTxt"></textarea>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <span>Has the participant had surgery or a serious illness in the past year?</span>
                            <input id="seriousY" name="serious" type="radio" value="y" required>
                            <label for="seriousY"><span>Yes</span></label>
                            <input id="seriousN" name="serious" type="radio" value="n">
                            <label for="seriousN"><span>No</span></label>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields">
                        <label for="seriousTxt"><span>If yes, please explain:</span></label> 
                        <textarea id="seriousTxt" name="seriousTxt"></textarea>
                    </div>
                    <div class="fields">
                        <label for="limitations"><span>Identify any other limits, restrictions, or disabilities that could prevent the participant from fully participating in the event or activity:</span></label> 
                        <textarea id="limitations" name="limitations"></textarea>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Other Accommodations or Special Needs</legend>
                    <div class="fields">
                        <label for="considerations"><span>Identify any other needs or considerations the participant has that the event or activity planner should be aware of:</span></label> 
                        <textarea id="considerations" name="considerations"></textarea>
                    </div>
                </fieldset>
                <div>
                    <fieldset>
                        <legend>Permission</legend>
                        <p>I give permission for my child or youth to participate in the event and activities listed above (unless noted) and authorize the adult leaders supervising this event to administer emergency treatment to the above named participant for any accident or illness and to act in my stead in approving necessary medical care. This authorization shall cover this event and travel to and from this event.</p>
                        <p>The participant is responsible for his or her own conduct and is aware of and agrees to abide by Church standards, camp or event safety rules, and other pertinent instructions. Participants’ conduct and interactions should abide by Church standards and exemplify Christlike behavior. Parents and participants should understand that participation in an activity is not a right but a privilege that can be revoked if they behave inappropriately or if they pose a risk to themselves or others.</p>
                        <div class="fields">
                            <label for="participantSig"><span>Participant’s signature</span><span class="field-tip">Required</span></label> 
                            <input id="participantSig" name="participantSig" type="text" required>
                        </div>
                        <div class="fields">
                            <label for="participantSigDate"><span>Date</span></label> 
                            <input id="participantSigDate" name="participantSigDate" type="date" value="<?php echo date('Y-m-d') ?>" readonly required>
                        </div>
                        <div class="fields">
                            <label for="guardianSig"><span>Parent or guardian's signature</span><span class="field-tip">Required</span></label> 
                            <input id="guardianSig" name="guardianSig" type="text" required>
                        </div>
                        <div class="fields">
                            <label for="guardianSigDate"><span>Date</span></label> 
                            <input id="guardianSigDate" name="guardianSigDate" type="date" value="<?php echo date('Y-m-d') ?>" readonly required>
                        </div>
                    </fieldset>
                    <p class="legal-sm"><a href="https://www.churchofjesuschrist.org/bc/content/shared/content/english/pdf/callings/young-men/parental-permission-medical-release.pdf" title="Permission and Medical Release Form">Permission and Medical Release Form</a> © 2017, 2019 by Intellectual Reserve, Inc. All rights reserved. 5/19. PD60004035 000</p>
                    <p class="legal-sm"><a href="http://neverssl.com">TEST</a></p>

                </div>
                <div class="non-fields">
                        <button name="action" type="submit" value="Register"><span>Register Participant</span></button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <?php //var_dump($events); ?>
    <?php //echo $_SESSION['particpantid']; ?>
    <script>
        <?php echo $eventScript; ?>
    </script>
    <script type="module" src="/2021/js/registration.js"></script>
    <script>
        <?php
                    if (isset($_SESSION['participantid']) && isset($_SESSION['participant']) && isset($_SESSION['eventid'])) {
                        echo "const participant = {'particpantid': '$_SESSION[participantid]', 'name': '$_SESSION[participant]', 'eventid': '$_SESSION[eventid]'};";
                        unset($_SESSION['participantid']);
                        unset($_SESSION['participant']);
                        unset($_SESSION['eventid']);
                    } else {
                        echo "const participant = null;";
                    }
        ?>
    </script>
</body>
</html>
