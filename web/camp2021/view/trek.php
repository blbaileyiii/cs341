<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/camp2021/common/head.php'; ?>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camp2021/common/header-nav.php'; ?>
    </header>    
    <main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camp2021/common/countdown.php'; ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camp2021/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>