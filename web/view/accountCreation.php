<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Account Creation" ?>
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
            <h1><?php echo $page; ?></h1>
            <?php
                if (isset($_SESSION['message'])) { 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                }
            ?>
            <form class="form login" action="/account/" method="post">
                <fieldset>
                    <legend>Account Information</legend>
                    <div class="fields">
                        <label for="email"><span>Email (If under 19, must be for legal parent or guardian)</span><span class="field-tip">Required</span></label> 
                        <input id="email" name="email" type="email" <?php if(isset($email)){echo "value='$email'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="password"><span>Password</span><span class="field-tip">Required</span></label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required>                    
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Personal Information</legend>
                    <div class="fields">
                        <label for="f_name"><span>First Name</span><span class="field-tip">Required</span></label> 
                        <input id="f_name" name="f_name" type="text" <?php if(isset($f_name)){echo "value='$f_name'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="m_name"><span>Middle Name</span><span class="field-tip">Required</span></label> 
                        <input id="m_name" name="m_name" type="text" <?php if(isset($m_name)){echo "value='$m_name'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="l_name"><span>Last Name(s)</span><span class="field-tip">Required</span></label> 
                        <input id="l_name" name="l_name" type="text" <?php if(isset($l_name)){echo "value='$l_name'";} ?> required>
                    </div>
                    <?php
                        $date = date_create(date('Y-m-d'));
                        echo $date;
                        // date_sub($date, date_interval_create_from_date_string('12 years'));
                        // echo date_format($date, 'Y-m-d');
                    ?>
                    <div class="fields">
                        <label for="dOB"><span>Date of birth (Must be turning <span id='turningAge'>12</span> this year or older)</span><span class="field-tip">Required</span></label> 
                        <input id="dOB" name="dOB" type="date" max="2009-12-31" <?php if(isset($dOB)){echo "value='$dOB'";} ?> required>
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
                        <label for="address"><span>Address</span><span class="field-tip">Required</span></label> 
                        <input id="address" name="address" type="text" <?php if(isset($address)){echo "value='$address'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="city"><span>City</span><span class="field-tip">Required</span></label> 
                        <input id="city" name="city" type="text" <?php if(isset($city)){echo "value='$city'";} ?> required>
                    </div>
                    <div class="fields">
                        <label for="state"><span>State or province</span><span class="field-tip">Required</span></label> 
                        <input id="state" name="state" type="text" <?php if(isset($state)){echo "value='$state'";} ?> required>
                    </div>
                </fieldset>
                <div class="non-fields">
                    <button id="action" name="action" value="CreateAccount" type="submit">Create Account</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
    </footer>
</body>
</html>