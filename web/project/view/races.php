<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Races and Creatures</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Races and Creatures">
        <link rel="stylesheet" href="/project/css/layout.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/theme.css">
</head>

<body>
    <header>
        <?php require $currRoot . '/project/snippets/header.php'; ?>
    </header>
    <nav>
        <?php require $currRoot . '/project/snippets/nav.php'; ?>
    </nav>    
    <main>    
        <h1>The Races and Creatures of Whimsy</h1>        
        
        <?php
        $currRace = "";
        $currFamily = "";
        foreach ($races as $race) {
            if ($currRace != $race['txracename']){
        ?>
                <?php if($currRace !="") {?>
                    </div>
                <?php } ?>

                <div>
                <?php $currRace = $race['txracename'];?>
            <?php }?>
            <h2><?php echo $race['txracename'];?></h2>
            <?php var_dump($race); ?>

            <?php echo '<br><br>'; ?>
        <?php } ?>
    </main>
    <footer>
    <?php require $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>