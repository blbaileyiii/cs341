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
        <div class="about"></div>
        <div class="schedule"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/pillars.php'; ?>
        <div class="gallery"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/faq.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/scripture.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/contact.php'; ?>
        <div class="guidelines"></div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>