<!DOCTYPE html>
<html lang="en-us">
    
<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/alert.php'; ?>
    </aside>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/nav.php'; ?>
    </header>    
    <main>
        <section>
            <div class="registrantDiv"></div>            
            <h1>Register</h1>
            <?php
                if (isset($_SESSION['message'])) { 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                }
            ?>
            <p>All Adult and Youth Participants are required to register by submitting a valid Permission and Medical Release Form.</p>
            <ul>
                <li>Please fill out all required fields below. Note: Gray fields will be filled out automatically.</li>
                <li>If the participant is under 19 years of age then the form must also be signed by the youth's legal parent/guardian.</li>
                <li>A single form can not be used to register more than one participant or a single participant for multiple events.</li>
                <li>Each participant must register individually for each event.</li>
            </ul>
            <h2>Permission and Medical Release Form</h2>
            <form <?php if(isset($validate)){echo "class='form validate'";} else { echo "class='form'"; } ?> method="post">
                <fieldset>
                    <legend>Event Details</legend>
                    <div class="fields">
                        <label for="eventId"><span>Event</span><span class="field-tip">Required</span></label>
                        <select id="eventId" name="eventId" required>
                            <option value="" <?php if(!isset($eventId)){echo "selected";} ?> disabled>Choose an event</option>
                            <?php
                                if(isset($eventId)){
                                    $eventList = str_replace("value='$eventId'", "value='$eventId' selected", $eventList);
                                }
                                echo $eventList; 
                            ?>
                        </select>
                    </div>
                    <div class="fields">
                        <label for="eventDate"><span>Date(s) of event</span></label> 
                        <input id="eventDate" name="eventDate" type="text" <?php if(isset($eventDate)){echo "value='$eventDate'";} ?> readonly>
                    </div>
                    <div class="fields">
                        <label for="eventDesc"><span>Describe event and activities (please be specific):</span></label>
                        <textarea id="eventDesc" name="eventDesc" readonly><?php if(isset($eventDesc)){echo $eventDesc;} ?></textarea>
                    </div>
                    <div class="fields">
                        <label for="stake"><span>Stake</span></label> 
                        <input id="stake" name="stake" type="text" value="Hacienda Heights California Stake" <?php if(isset($stake)){echo "value='$stake'";} ?> readonly>
                    </div>
                    <div class="fields">
                        <label for="eventLeaderName"><span>Event or activity leader</span></label> 
                        <input id="eventLeaderName" name="eventLeaderName" type="text" <?php if(isset($eventLeaderName)){echo "value='$eventLeaderName'";} ?> readonly>
                    </div>
                    <div class="fields">
                        <label for="eventLeaderPhone"><span>Event or activity leader’s phone number</span></label> 
                        <input id="eventLeaderPhone" name="eventLeaderPhone" type="tel" <?php if(isset($eventLeaderPhone)){echo "value='$eventLeaderPhone'";} ?> readonly>
                    </div>
                    <div class="fields">
                        <label for="eventLeaderEmail"><span>Event or activity leader’s email</span></label> 
                        <input id="eventLeaderEmail" name="eventLeaderEmail" type="email" <?php if(isset($eventLeaderEmail)){echo "value='$eventLeaderEmail'";} ?> readonly>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Participant Information</legend>
                    <div class="fields">
                        <label for="participantName"><span>Participant</span><span class="field-tip">Required</span></label> 
                        <input id="participantName" name="participantName" type="text" <?php if(isset($participantName)){echo "value='$participantName'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="ward"><span>Ward</span><span class="field-tip">Required</span></label>
                        <select id="ward" name="ward" required>
                            <option value="" <?php if(!isset($ward)){echo "selected";} ?> disabled>Choose your ward</option>
                            <option value="cs" <?php if(isset($ward) && $ward=="cs"){echo "selected";} ?>>Creekside</option>
                            <option value="hh1" <?php if(isset($ward) && $ward=="hh1"){echo "selected";} ?>>Hacienda Heights 1st</option>
                            <option value="hh5" <?php if(isset($ward) && $ward=="hh5"){echo "selected";} ?>>Hacienda Heights 5th</option>
                            <option value="la" <?php if(isset($ward) && $ward=="la"){echo "selected";} ?>>Los Altos</option>
                            <option value="rh" <?php if(isset($ward) && $ward=="rh"){echo "selected";} ?>>Rowland Heights</option>
                            <option value="tc" <?php if(isset($ward) && $ward=="tc"){echo "selected";} ?>>Turnbull Canyon</option>
                            <option value="wv" <?php if(isset($ward) && $ward=="wv"){echo "selected";} ?>>Walnut Valley</option>
                            <option value="ws" <?php if(isset($ward) && $ward=="ws"){echo "selected";} ?>>Woodside</option>
                        </select>
                    </div>
                    <div class="fields">
                        <label for="participantDOB"><span>Date of birth (Must be turning <span id='turningAge'>12</span> this year or older.)</span><span class="field-tip">Required</span></label> 
                        <input id="participantDOB" name="participantDOB" type="date" max="2009-12-31" <?php if(isset($participantDOB)){echo "value='$participantDOB'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="participantAge"><span>Age</span></label> 
                        <input id="participantAge" name="participantAge" type="number" min="11" placeholder="Invalid Birthday" <?php if(isset($participantAge)){echo "value='$participantAge'";} ?> readonly>
                    </div>
                    <div class="fields">
                        <label for="email"><span>Email (If under 19, must be for legal parent or guardian)</span><span class="field-tip">Required</span></label> 
                        <input id="email" name="email" type="email" <?php if(isset($email)){echo "value='$email'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="primTel"><span>Primary telephone number</span><span class="field-tip">Required</span></label>
                        <input id="primTel" name="primTel" type="tel" <?php if(isset($primTel)){echo "value='$primTel'";} ?> required> 
                    </div>
                    <div class="fields-radio-alt">
                        <div class="inline-block">
                            <input id="primTelCell" name="primTelType" type="radio" value="cell" <?php if(isset($primTelType) && $primTelType=="cell"){echo "checked";} else {echo "checked";} ?> required>
                            <label for="primTelCell"><span>Cell</span></label>
                        </div>
                        <div class="inline-block">
                            <input id="primTelHome" name="primTelType" type="radio" value="home" <?php if(isset($primTelType) && $primTelType=="home"){echo "checked";} ?>>
                            <label for="primTelHome"><span>Home</span></label>
                        </div>
                        <div class="inline-block">
                            <input id="primTelWork" name="primTelType" type="radio" value="work" <?php if(isset($primTelType) && $primTelType=="work"){echo "checked";} ?>>
                            <label for="primTelWork"><span>Work</span></label>
                        </div>
                    </div>
                    <div class="fields">
                        <label for="secTel"><span>Secondary telephone number</span></label> 
                        <input id="secTel" name="secTel" type="tel" <?php if(isset($secTel)){echo "value='$secTel'";} ?>>
                    </div>
                    <div class="fields-radio-alt">
                        <div class="inline-block">
                            <input id="secTelCell" name="secTelType" type="radio" value="cell" <?php if(isset($secTelType) && $secTelType=="cell"){echo "checked";} else {echo "checked";} ?>>
                            <label for="secTelCell"><span>Cell</span></label>
                        </div>
                        <div class="inline-block">
                            <input id="secTelHome" name="secTelType" type="radio" value="home" <?php if(isset($secTelType) && $secTelType=="home"){echo "checked";} ?>>
                            <label for="secTelHome"><span>Home</span></label>
                        </div>
                        <div class="inline-block">
                            <input id="secTelWork" name="secTelType" type="radio" value="work" <?php if(isset($secTelType) && $secTelType=="work"){echo "checked";} ?>>
                            <label for="secTelWork"><span>Work</span></label>
                        </div>
                    </div>                
                    <div class="fields">
                        <label for="participantAddress"><span>Address</span><span class="field-tip">Required</span></label> 
                        <input id="participantAddress" name="participantAddress" type="text" <?php if(isset($participantAddress)){echo "value='$participantAddress'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="participantCity"><span>City</span><span class="field-tip">Required</span></label> 
                        <input id="participantCity" name="participantCity" type="text" <?php if(isset($participantCity)){echo "value='$participantCity'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="participantState"><span>State or province</span><span class="field-tip">Required</span></label> 
                        <input id="participantState" name="participantState" type="text" <?php if(isset($participantState)){echo "value='$participantState'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="emergencyContact"><span>Emergency contact (If under 19, must be legal parent or guardian)</span><span class="field-tip">Required</span></label> 
                        <input id="emergencyContact" name="emergencyContact" type="text" <?php if(isset($emergencyContact)){echo "value='$emergencyContact'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="emerPrimTel"><span>Primary telephone number</span><span class="field-tip">Required</span></label> 
                        <input id="emerPrimTel" name="emerPrimTel" type="tel" <?php if(isset($emerPrimTel)){echo "value='$emerPrimTel'";} ?> required>
                    </div>
                    <div class="fields-radio-alt">
                        <div class="inline-block">    
                            <input id="emerPrimTelCell" name="emerPrimTelType" type="radio" value="cell" <?php if(isset($emerPrimTelType) && $emerPrimTelType=="cell"){echo "checked";} else {echo "checked";} ?> required>
                            <label for="emerPrimTelCell"><span>Cell</span></label>
                        </div>
                        <div class="inline-block">
                            <input id="emerPrimTelHome" name="emerPrimTelType" type="radio" value="home" <?php if(isset($emerPrimTelType) && $emerPrimTelType=="home"){echo "checked";} ?>>
                            <label for="emerPrimTelHome"><span>Home</span></label>
                        </div>                    
                        <div class="inline-block">
                            <input id="emerPrimTelWork" name="emerPrimTelType" type="radio" value="work" <?php if(isset($emerPrimTelType) && $emerPrimTelType=="work"){echo "checked";} ?>>
                            <label for="emerPrimTelWork"><span>Work</span></label>
                        </div>
                    </div>
                    <div class="fields">
                        <label for="emerSecTel"><span>Secondary telephone number</span></label> 
                        <input id="emerSecTel" name="emerSecTel" type="tel" <?php if(isset($emerSecTel)){echo "value='$emerSecTel'";} ?>>
                    </div>
                    <div class="fields-radio-alt">
                        <div class="inline-block">    
                            <input id="emerSecTelCell" name="emerSecTelType" type="radio" value="cell" <?php if(isset($emerSecTelType) && $emerSecTelType=="cell"){echo "checked";} else {echo "checked";} ?>>
                            <label for="emerSecTelCell"><span>Cell</span></label>
                        </div>
                        <div class="inline-block">
                            <input id="emerSecTelHome" name="emerSecTelType" type="radio" value="home" <?php if(isset($emerSecTelType) && $emerSecTelType=="home"){echo "checked";} ?>>
                            <label for="emerSecTelHome"><span>Home</span></label>
                        </div>                    
                        <div class="inline-block">
                            <input id="emerSecTelWork" name="emerSecTelType" type="radio" value="work" <?php if(isset($emerSecTelType) && $emerSecTelType=="work"){echo "checked";} ?>>
                            <label for="emerSecTelWork"><span>Work</span></label>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Medical Information</legend>
                    <div class="fields-radio">
                        <div>
                            <div>Does the participant require a special diet?</div>
                            <div class="inline-block">
                                <input id="specialDietY" name="specialDiet" type="radio" value="y" <?php if(isset($specialDiet) && $specialDiet=="y"){echo "checked";} ?> required>
                                <label for="specialDietY"><span>Yes</span></label>
                            </div>
                            <div class="inline-block">
                                <input id="specialDietN" name="specialDiet" type="radio" value="n" <?php if(isset($specialDiet) && $specialDiet=="n"){echo "checked";} ?>>
                                <label for="specialDietN"><span>No</span></label>
                            </div>
                        </div>
                        <span class="field-tip">Required</span>
                    </div> 
                    <div class="fields">
                        <label for="specialDietTxt"><span>If yes, please explain the dietary restrictions:</span><?php if(isset($specialDiet) && $specialDiet=="y"){echo "<span class='field-tip'>Required</span>";} ?></label> 
                        <textarea id="specialDietTxt" name="specialDietTxt" <?php if(isset($specialDiet) && $specialDiet=="y"){echo "required";}?> ><?php if(isset($specialDietTxt)){echo $specialDietTxt;} ?></textarea>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <div>Does the participant have any allergies?</div>
                            <div class="inline-block">
                                <input id="allergiesY" name="allergies" type="radio" value="y" <?php if(isset($allergies) && $allergies=="y"){echo "checked";} ?> required>
                                <label for="allergiesY"><span>Yes</span></label>
                            </div>
                            <div class="inline-block">
                                <input id="allergiesN" name="allergies" type="radio" value="n" <?php if(isset($allergies) && $allergies=="n"){echo "checked";} ?>>
                                <label for="allergiesN"><span>No</span></label>
                            </div>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields">
                        <label for="allergiesTxt"><span>If yes, please list the allergies:</span><?php if(isset($allergies) && $allergies=="y"){echo "<span class='field-tip'>Required</span>";} ?></label> 
                        <textarea id="allergiesTxt" name="allergiesTxt" <?php if(isset($allergies) && $allergies=="y"){echo "required";} ?>><?php if(isset($allergiesTxt)){echo $allergiesTxt;} ?></textarea>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <div>Is the participant taking any medication or over-the-counter (OTC) drugs?</div>
                            <div class="inline-block">
                                <input id="medicationY" name="medication" type="radio" value="y" <?php if(isset($medication) && $medication=="y"){echo "checked";} ?> required>
                                <label for="medicationY"><span>Yes</span></label>
                            </div>
                            <div class="inline-block">
                                <input id="medicationN" name="medication" type="radio" value="n" <?php if(isset($medication) && $medication=="n"){echo "checked";} ?>>
                                <label for="medicationN"><span>No</span></label>
                            </div>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <div>If yes, can the participant self-administer his or her medication?</div>
                            <div class="inline-block">
                                <input id="selfMedicateY" name="selfMedicate" type="radio" value="y" <?php if(isset($selfMedicate) && $selfMedicate=="y"){echo "checked";} ?> <?php if(isset($medication) && $medication != "y"){echo "disabled";} elseif(!isset($medication)){echo "disabled";} ?> <?php if(isset($medication) && $medication=="y"){echo "required";} ?>>
                                <label for="selfMedicateY"><span>Yes</span></label>
                            </div>
                            <div class="inline-block">
                                <input id="selfMedicateN" name="selfMedicate" type="radio" value="n" <?php if(isset($selfMedicate) && $selfMedicate=="n"){echo "checked";} ?> <?php if(isset($medication) && $medication != "y"){echo "disabled";} elseif(!isset($medication)){echo "disabled";} ?>>
                                <label for="selfMedicateN"><span>No</span></label>
                            </div>
                            <span class="special-instructions">If no, please contact the event or activity leader directly.</span>
                        </div>
                        <?php if(isset($medication) && $medication=="y"){echo "<span class='field-tip'>Required</span>";} ?>                        
                    </div>
                    <div class="fields">
                        <label for="medicationList"><span>List all prescription or over-the-counter (OTC) medications the participant is taking:</span><?php if(isset($medication) && $medication=="y"){echo "<span class='field-tip'>Required</span>";} ?></label> 
                        <textarea id="medicationList" name="medicationList" <?php if(isset($medication) && $medication=="y"){echo "required";} ?>><?php if(isset($medicationList)){echo $medicationList;} ?></textarea>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Physical Conditions That Limit Activity</legend>
                    <div class="fields-radio">
                        <div>
                            <div>Does the participant have a chronic or recurring illness?</div>
                            <div class="inline-block">
                                <input id="chronicIllnessY" name="chronicIllness" type="radio" value="y" <?php if(isset($chronicIllness) && $chronicIllness=="y"){echo "checked";} ?> required>
                                <label for="chronicIllnessY"><span>Yes</span></label>
                            </div>
                            <div class="inline-block">
                                <input id="chronicIllnessN" name="chronicIllness" type="radio" value="n" <?php if(isset($chronicIllness) && $chronicIllness=="n"){echo "checked";} ?>>
                                <label for="chronicIllnessN"><span>No</span></label>
                            </div>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields">
                        <label for="chronicIllnessTxt"><span>If yes, please explain:</span><?php if(isset($chronicIllness) && $chronicIllness=="y"){echo "<span class='field-tip'>Required</span>";} ?></label> 
                        <textarea id="chronicIllnessTxt" name="chronicIllnessTxt" <?php if(isset($chronicIllness) && $chronicIllness=="y"){echo "required";} ?>><?php if(isset($chronicIllnessTxt)){echo $chronicIllnessTxt;} ?></textarea>
                    </div>
                    <div class="fields-radio">
                        <div>
                            <div>Has the participant had surgery or a serious illness in the past year?</div>
                            <div class="inline-block">
                                <input id="seriousY" name="serious" type="radio" value="y" <?php if(isset($serious) && $serious=="y"){echo "checked";} ?> required>
                                <label for="seriousY"><span>Yes</span></label>
                            </div>
                            <div class="inline-block">
                                <input id="seriousN" name="serious" type="radio" value="n" <?php if(isset($serious) && $serious=="n"){echo "checked";} ?>>
                                <label for="seriousN"><span>No</span></label>
                            </div>
                        </div>
                        <span class="field-tip">Required</span>
                    </div>
                    <div class="fields">
                        <label for="seriousTxt"><span>If yes, please explain:</span><?php if(isset($serious) && $serious=="y"){echo "<span class='field-tip'>Required</span>";} ?></label> 
                        <textarea id="seriousTxt" name="seriousTxt" <?php if(isset($serious) && $serious=="y"){echo "required";} ?>><?php if(isset($seriousTxt)){echo $seriousTxt;} ?></textarea>
                    </div>
                    <div class="fields">
                        <label for="limitations"><span>Identify any other limits, restrictions, or disabilities that could prevent the participant from fully participating in the event or activity:</span></label> 
                        <textarea id="limitations" name="limitations"><?php if(isset($limitations)){echo $limitations;} ?></textarea>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Other Accommodations or Special Needs</legend>
                    <div class="fields">
                        <label for="considerations"><span>Identify any other needs or considerations the participant has that the event or activity planner should be aware of:</span></label> 
                        <textarea id="considerations" name="considerations"><?php if(isset($considerations)){echo $considerations;} ?></textarea>
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
                            <label for="guardianSig"><span>Parent or guardian's signature</span><?php if(isset($participantAge) && $participantAge >=19){ echo "";} else {echo "<span class='field-tip'>Required</span>";} ?></label> 
                            <input id="guardianSig" name="guardianSig" type="text" <?php if(isset($participantAge) && $participantAge >= 19){echo "value='N/A - Adult Participant' readonly";} else { echo "required";} ?>>
                        </div>
                        <div class="fields">
                            <label for="guardianSigDate"><span>Date</span></label> 
                            <input id="guardianSigDate" name="guardianSigDate" type="date" value="<?php echo date('Y-m-d') ?>" readonly required>
                        </div>
                    </fieldset>
                    <p class="legal-sm"><a href="https://www.churchofjesuschrist.org/bc/content/shared/content/english/pdf/callings/young-men/parental-permission-medical-release.pdf" title="Permission and Medical Release Form" target="_blank" rel="noreferrer">Permission and Medical Release Form</a> © 2017, 2019 by Intellectual Reserve, Inc. All rights reserved. 5/19. PD60004035 000</p>
                </div>
                <div class="non-fields">
                        <button name="action" type="submit" value="confirm"><span>Next: Confirmation</span></button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <?php //var_dump($events); ?>
    <?php //echo $_SESSION['participantid']; ?>
    <?php
        var_dump($_SESSION);
        if (isset($_SESSION['participantid']) && isset($_SESSION['participant']) && isset($_SESSION['eventid']) && isset($_SESSION['eventname'])) {
            $setParticipant = "const participant = {'id': '$_SESSION[participantid]', 'p_name': '$_SESSION[participant]', 'event_id': '$_SESSION[eventid]', 'event_name': '$_SESSION[eventname]'};";
            unset($_SESSION['participantid']);
            unset($_SESSION['participant']);
            unset($_SESSION['eventid']);
            unset($_SESSION['eventname']);
        } else {
            $setParticipant = "const participant = null;";
        }
    ?>
    <script><?php echo $setParticipant; ?></script>
    <script type="module" src="/2021/js/registration.js"></script>
</body>
</html>
