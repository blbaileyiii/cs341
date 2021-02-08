<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - News</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - News">
        <link rel="stylesheet" href="/project/css/theme.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/layout.css">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/header.php'; ?>
    </header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/nav.php'; ?>   
    <main>    
        <h1>News</h1>
        <?php echo $newsHTML; ?>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>