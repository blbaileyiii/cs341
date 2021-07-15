<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Youth Camps 2021" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/head.php'; ?>
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/alert.php'; ?>
    </aside>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/nav-expd.php'; ?>
    </header>
    <main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/countdown.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/about.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/schedule-all.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/pillars.php'; ?>
        <?php // require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/gallery.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/faq.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/scripture.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/contact.php'; ?>
        <?php // require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/guidelines.php'; ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>