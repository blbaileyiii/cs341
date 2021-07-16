<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
        $welcome = "<span>My Account: <a href='/camps/accounts/?action=admin' title='HHSCamps - My Account'>{$_SESSION['clientData']['clientAccount']}</a></span><span><a href='/camps/accounts/?action=Logout' title='HHSCamps - Logout'>Logout</a></span>";
    } else {        
        $welcome = "<span><a href='/camps/accounts/?action=login' title='HHSCamps - Login'>Login</a></span>";
    }
?>
<a href="/camps/" title="HHSCamps - Home"><img src="/camps/images/logo.png" alt="HHSCamps Logo"></a>
<?php echo $welcome;?>