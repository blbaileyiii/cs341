<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Characters" ?>
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
            <?php echo $charactersHTML?>
        </div>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    <?php echo $characters?>
    </footer>
    <script src="/project/js/character.js"></script>
</body>
</html>