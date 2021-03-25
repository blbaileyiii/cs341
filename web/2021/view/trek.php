<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/alert.php'; ?>
    </aside>    
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/nav-expd.php'; ?>
    </header>    
    <main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/countdown.php'; ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>