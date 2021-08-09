<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
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
        <div class="gallery">
            <div class="owl-carousel">
                <div> Does</div>
                <div> It </div>
                <div> Work </div>
                <div> Or </div>
                <div> Not </div>
            </div>
        </div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/faq.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/scripture.php'; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/contact.php'; ?>
        <div class="guidelines"></div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>

</body>
</html>