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
        <form class="form" method='post'>
            <span class='warning'>WARNING: Character deletion is permanent!
            <br>To permanently delete this character enter the characters name below.</span>
            <input name='charid' value='<?php echo $charid ?>' type='hidden'>
            <div class='fields'>
                <input name='delete-char' type="text" placeholder='<?php echo $charname ?>' pattern='<?php echo $charname ?>'></input>
            </div>
            <div class='non-fields'>
                <button type='submit'>Delete <?php echo $charname ?></button>
            </div>
        </form>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>