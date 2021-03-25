<?php
    $alert = "Site Under Construction";
    if(isset($alert)){
        echo "<div class='site-alert'><span>$alert</span><span id='close-alert'>✖</span></div><script src='/2021/js/alert.js'></script>";
    }
?>