<?php

function login() {
    //echo 'login called...';
    //var_dump($_POST);
    if(isset($_POST['login']['uname'])
    && isset($_POST['login']['password'])){
        $username = htmlspecialchars($_POST['login']['uname']);
        
        try {
            $db = eowConnect();

            $sql = 
            'SELECT userhashpass, userdisabled, usersuspended, useremailverified, userlevel
            FROM users
            WHERE username=:username';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $username));
            $accounts = $stmt->fetchAll();

            //echo '<br><br>';
            //var_dump($accounts);

            //There should only be 1 record.
            if(count($accounts) == 1){
                
                //If there is only 1 record 
                $account = $accounts[0];
                //echo '<br>Account retrieved.';
                //echo $account['userfname'];

                //
                //password_verify($input, $hashedpedindb);
                //gethostname();

                //Verify password and check for account "health" and proceed if good. If not address the issue with the "user".
                if( password_verify(htmlspecialchars($_POST['login']['password']), $account['userhashpass'])
                && !$account['userdisabled']
                && !$account['usersuspended']
                && $account['useremailverified']) {
                    //echo '<br>Account is good.';
                    unset($_POST['login']['password']);

                    //create the active user.
                    $sessionHash = password_hash($account['userhashpass'], PASSWORD_DEFAULT);
                    $hostname = gethostname();

                    //echo $hostname;

                    $sql = 
                    'UPDATE users
                    SET sessionhashpass = :sessionhashpass,
                        lastactive = now(),
                        userhost = :userhost
                    WHERE username=:username';

                    $stmt = $db->prepare($sql);
                    $stmt->execute(array(':username' => $username, ':sessionhashpass' => $sessionHash, ':userhost' => $hostname));
                    $accounts = $stmt->fetchAll();

                    //CLOSE CONNECTION
                    $stmt->closeCursor();
                    
                    //echo 'sql executed...';

                    //Sync session to active user.
                    $_SESSION['eowSession']['username'] = $username;
                    $_SESSION['eowSession']['userhashpass'] = $account['userhashpass'];

                    unset($_POST['login']);

                } else if ($account['userdisabled']) {
                    // [Perm] Account Disabled. Contact support for further information.
                    return "Account Disabled. Contact support for further information.";
                } else if ($account['usersuspended']) {
                    // [Temp] Account Suspended. Check again after Date: XYZ. Contact support for further information.
                    return "Account Suspended. Contact support for further information.";
                } else if (!$account['useremailverified']) {
                    // not verified, warn the user and make them fix it.
                    return 'Email Not Verified.';
                } else if (!password_verify(htmlspecialchars($_POST['login']['password']), $account['userhashpass']) ) {
                    // Login Credentials are invalid.
                    return 'Invalid User Name / Password.';
                } else {
                    //Unexpected error...
                    return 'Unexpected error. Contact Support.';
                }

            } else if(count($accounts) == 0) {
                // Login Credentials are invalid.
                return 'Invalid User Name / Password';
            } else {
                // if it is greater than 1 something really bad happened and we have duplicate accounts...
                return 'Something Unexpected Occurred. Contact Support';
                //var_dump($accounts);
            }

            header('Location: /project/index.php?action=account');
            exit;

        } catch(PDOException $ex) {
            return $sql . "<br>" . $ex->getMessage();
            //login err redirect back to login...
        }
    } 
    
    return "Login Failed. Please try again.";
}

function logout() {
    // CLEAR THE SESSION VAR.
    unset($_POST['login']);
    unset($_SESSION['eowSession']);

    //NEED TO UPDATE THE DB TOO!!!

    return "Logout Complete";

}

function register() {
    //var_dump($_POST);
    if(isset($_POST['register']['uname'])){
        $username = htmlspecialchars($_POST['register']['uname']);
        
        $db = eowConnect();

        $sql = 
        'SELECT username
        FROM users
        WHERE username=:username';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $accounts = $stmt->fetchAll();
        
        //echo count($accounts);

        if(count($accounts) == 0 
        && isset($_POST['register']['email'])
        && isset($_POST['register']['fname'])
        && isset($_POST['register']['lname'])
        && isset($_POST['register']['password']) ) {

            try {

                $email = htmlspecialchars($_POST['register']['email']);
                $fname = htmlspecialchars($_POST['register']['fname']);
                $lname = htmlspecialchars($_POST['register']['lname']);

                $hashedpass = password_hash(htmlspecialchars($_POST['register']['password']), PASSWORD_DEFAULT);
                unset($_POST['register']['password']);

                //echo '<br>' . $hashedpass;

                $sql = 
                'INSERT INTO public.users (username, userfname, userlname, useremail, userhashpass)
                VALUES (:username, :userfname, :userlname, :useremail, :userhashpass)';

                $stmt = $db->prepare($sql);
                $stmt->execute(array(':username' => $username, ':userfname' => $fname, ':userlname' => $lname, ':useremail' => $email, ':userhashpass' => $hashedpass ));

                $stmt->closeCursor();

                unset($_POST['register']);

                //echo "Account Created: Verify Email Before Logging In";
                header('Location: /project/index.php?action=verify-email');
                exit;

            } catch(PDOException $ex) {
                return $sql . "<br>" . $ex->getMessage();
            }

        } else {
            //count is greater than 0 ...username already exists...
            //also need to account for email being unique...
            return "Username is already in use";
        }

    }  
}

?>
