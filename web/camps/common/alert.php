<?php
    $alert = "Registration Available During Site Construction.";
    if(isset($alert)){
        echo "<div class='site-alert'><span>$alert</span><a href='' title='close alert' class='close-alert'>✖</a></div><script src='/camps/js/alert.js'></script>";
    }
?>