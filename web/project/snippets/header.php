<?php if ( isset($_SESSION['eowSession']['username']) ) { ?>
    <span><a href="?action=account" title="Echoes of Whimsy - My Account">My Account (<?php $_SESSION["user"] ?>)</a></span>    
<?php } else { ?>
    <span><a href="?action=getlogin" title="Echoes of Whimsy - Log In">Log In</a></span>
<?php } ?>    