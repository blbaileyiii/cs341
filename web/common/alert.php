<?php
    $alert = "TREK Registration Available. Site Construction Ongoing.";
    if(isset($alert)){
        echo "<div class='site-alert'><span>$alert</span><a href='' title='close alert' class='close-alert'>✖</a></div><script src='/js/alert.js'></script>";
    }
?>