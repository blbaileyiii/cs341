<span><a href="index.php" title="Echoes of Whimsy - News"><img src="/project/imgs/eow_logo.webp" alt="Echoes of Whimsy Logo"></a></span><span></span>
<?php if ( isset($_SESSION['eowSession']['username']) ) { ?>
    <div>
        <span><a href="?action=account" title="Echoes of Whimsy - My Account">My Account (<?php echo $_SESSION['eowSession']['username'] ?>)</a></span>
        <span><a href="?action=logout" title="Echoes of Whimsy - Logout">Log out</a></span>
    </div>
<?php } else { ?>
    <span><a href="?action=getlogin" title="Echoes of Whimsy - Log In">Log In</a></span>
<?php } ?>    