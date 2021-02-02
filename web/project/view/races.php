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

        $races = array_column($race, 'txracename');
        var_dump($races);
        foreach ($races as $race) {
            var_dump($race);
        }
        ?>
        
    </main>
    <footer>
    <?php require $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>