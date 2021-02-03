<?php if ( isset($_SESSION['eowSession']['username']) ) { ?>
    <div>
        <span><a href="https://sites.google.com/view/toylifegames/home" title="Toy Life Games LLC." target="_blank" rel="noreferrer">Toy Life Games</a></span>
    </div>
    <div>
        <span><a href="?action=account" title="Echoes of Whimsy - My Account">My Account (<?php echo $_SESSION['eowSession']['username'] ?>)</a></span>
        <span><a href="?action=logout" title="Echoes of Whimsy - Logout">Log out</a></span>
    </div>
<?php } else { ?>
    <span><a href="?action=getlogin" title="Echoes of Whimsy - Log In">Log In</a></span>
<?php } ?>    