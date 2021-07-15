<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "YM Camp 2021" ?>
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
        <div class="about"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/schedule-ym.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/pillars.php'; ?>
        <div class="gallery"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/faq.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/scripture.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/contact.php'; ?>
        <div class="guidelines"></div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>