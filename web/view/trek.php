<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/alert.php'; ?>
    </aside>    
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/nav.php'; ?>
    </header>    
    <main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/countdown.php'; ?>
        <div class="about"></div>
        <div class="schedule"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/pillars.php'; ?>
        <div class="gallery"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/faq.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/scripture.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/contact.php'; ?>
        <div class="guidelines"></div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
    <script src="jquery.min.js"></script>
    <script src="tools/owlcarousel/owl.carousel.min.js"></script>
</body>
</html>