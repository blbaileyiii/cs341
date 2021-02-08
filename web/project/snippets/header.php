<div>
        <span><a class="header-lnk" href="https://sites.google.com/view/toylifegames/home" title="Toy Life Games" target="_blank" rel="noreferrer">Toy Life Games</a></span>
</div>
<?php if ( isset($_SESSION['eowSession']['username']) ) { ?>
    <div>
        <span><a class="header-lnk" href="/project/account/index.php?action=account" title="Echoes of Whimsy - My Account">My Account (<?php echo $_SESSION['eowSession']['username'] ?>)</a></span>
        <span><a class="header-lnk" href="/project/account/index.php?action=logout" title="Echoes of Whimsy - Logout">Log out</a></span>
    </div>
<?php } else { ?>
    <div>
        <span><a class="header-lnk" href="?action=logon" title="Echoes of Whimsy - Log In">Log In</a></span><span> / </span><span><a class="header-lnk" href="?action=register" title="Echoes of Whimsy - Register">Register</a></span>
    <div>
<?php } ?>    