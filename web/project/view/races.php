<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Races and Creatures</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Races and Creatures">
        <link rel="stylesheet" href="/project/css/theme.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/layout.css">
</head>

<body>
    <header>
        <?php require $currRoot . '/project/snippets/header.php'; ?>
    </header>
    <?php require $currRoot . '/project/snippets/nav.php'; ?>   
    <main>    
        <h1>The Races and Creatures of Whimsy</h1>        

        <?php echo $racesHTML?>
        
    </main>
    <footer>
    <?php require $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>