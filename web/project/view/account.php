<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Account" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/head.php'; ?>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/header.php'; ?>
    </header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/nav.php'; ?>
    <main>    
        <h1><?php echo $page ?></h1>
        <div class="grid-tiles">
            <section class="option-tile"><h2><a href='#' title='Account Details'>Account Details</a></h2></section>
            <section class="option-tile"><h2><a href='/project/character/' title='Character Management'>Character Management</a></h2></section>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>