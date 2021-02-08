<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Character Creation</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Character Creation">
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
        <h1>Character Creation</h1>

        <input type="text">
        <select value="" required>
        <option selected disabled>Choose a Race</option>
        <?php echo $playableOptions ?>
        </select>
        
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    <?php //var_dump($playableRaces) ?>
    </footer>
</body>
</html>