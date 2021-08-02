<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Youth Camps 2021" ?>
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
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/about.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/schedule-all.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/pillars.php'; ?>
        <?php // require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/gallery.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/faq.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/scripture.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/contact.php'; ?>
        <?php // require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/guidelines.php'; ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
        <img src="https://www.hhscamps.com/2021/query/?action=getSig-show&id=224&type=p">
        <img src="https://www.hhscamps.com/2021/query/?action=getSig-show&id=224&type=g">
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>