<?php if ( isset($_SESSION["user"]) ) { ?>
    <span><a href="/project/accounts/index.php?action=account" title="Echoes of Whimsy - My Account">My Account (<?php $_SESSION["user"] ?>)</a></span>    
<?php } else { ?>
    <span><a href="/project/accounts/index.php?action=getlogin" title="Echoes of Whimsy - Log In">Log In</a></span>
<?php } ?>    