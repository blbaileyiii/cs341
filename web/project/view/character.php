<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Template</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Template">
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
        <h1><?php echo $charname ?></h1>
        <?php echo $characterHTML ?>
    </main>
    <footer>
    <?php require $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>