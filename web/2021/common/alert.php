<?php
    $alert = "TREK Registration UNavailable. Should be available by 08/04/2021. Site Construction Ongoing.";
    if(isset($alert)){
        echo "<div class='site-alert'><span>$alert</span><a href='' title='close alert' class='close-alert'>✖</a></div><script src='/2021/js/alert.js'></script>";
    }
?>