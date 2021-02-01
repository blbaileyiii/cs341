<?php
    <hr>
    <p>
        <?php 
        $currYear = new DateTime('NOW');
        echo '&copy;' . $currYear->format("Y") . ' | Bernard L. Bailey III | California | All rights reserved.' ?>
        <br><?php echo "Last Updated: " . date("j F, Y", getlastmod());?>
    </p>
?>