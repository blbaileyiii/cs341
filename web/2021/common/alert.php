<?php
    $alert = "TREK Registration Available. YWCAMP and YMCAMP Registration Locked - Contact Camp Leaders as needed. Site Construction Ongoing.";
    if(isset($alert)){
        echo "<div class='site-alert'><span>$alert</span><a href='' title='close alert' class='close-alert'>✖</a></div><script src='/2021/js/alert.js'></script>";
    }
?>