<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Character Deletion</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Character Deletion">
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
        <h1><?php echo $charname ?></h1>
        <form method='post'>
            <span class='warning'>WARNING: Character deletion is permanent!</span>
            To permanently delete this character enter the characters name below.
            <input name='delete-char' type="text" placeholder='<?php echo $charname ?>' pattern='<?php echo $charname ?>'></input>
            <button type='submit'>Delete <?php echo $charname ?></button>
        </form>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>