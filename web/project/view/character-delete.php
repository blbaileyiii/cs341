<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Character Deletion" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/head.php'; ?>
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
            <input name='charid' value='<?php echo $charid ?>' type='hidden'>
            <input name='delete-char' type="text" placeholder='<?php echo $charname ?>' pattern='<?php echo $charname ?>'></input>
            <button type='submit'>Delete <?php echo $charname ?></button>
        </form>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>