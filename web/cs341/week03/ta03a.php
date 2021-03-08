<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSE341 - Profile: Bernard Bailey</title>
    <meta name="CSE341"
        content="My Profile">      
</head>
<body>
    <form id="student" action="ta03b.php" method="post">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" placeholder="Name" required>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="Email" required>
        <?php

        $majors = array();
        $majors["cs"] = "Computer Science";
        $majors["wdd"] = "Web Design and Development";
        $majors["cit"] = "Computer Information Technology";
        $majors["ce"] = "Computer Engineering";

        foreach($majors as $key=>$value){
            echo "<input id='major-{$key}' name='major' type='radio' value='{$key}'>";
            echo "<label for='major-{$key}'>{$value}</label>";
        }

        ?>
        
        <label for="comments">Comments</label>
        <textarea id="comments" name="comments" rows="4" cols="50" placeholder="comments"></textarea>        
        <input id="continent-na" name="continent-na" type="checkbox" value="North America">
        <label for="continent-na">North America</label>
        <input id="continent-sa" name="continent-sa" type="checkbox" value="South America">
        <label for="continent-sa">South America</label>
        <input id="continent-eu" name="continent-eu" type="checkbox" value="Europe">
        <label for="continent-eu">Europe</label>
        <input id="continent-as" name="continent-as" type="checkbox" value="Asia">
        <label for="continent-as">Asia</label>
        <input id="continent-au" name="continent-au" type="checkbox" value="Australia">
        <label for="continent-au">Australia</label>
        <input id="continent-af" name="continent-af" type="checkbox" value="Afric">
        <label for="continent-af">Africa</label>
        <input id="continent-an" name="continent-an" type="checkbox" value="Antarctica">
        <label for="continent-an">Antarctica</label>
        <button type="submit" value="submit">Submit</button>
    </form>
</body>
</html>