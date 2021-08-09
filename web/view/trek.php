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
            <div class="owl-carousel owl-theme owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <div class="owl-item">Does</div>
                        <div class="owl-item">.It</div>
                        <div class="owl-item">Work</div>
                        <div class="owl-item">Or</div>
                        <div class="owl-item">Not</div>
                        <div class="owl-item">...</div>
                    </div>
                </div>
                <div class="owl-nav">
                    <div class="owl-prev">prev</div>
                    <div class="owl-next">next</div>
                </div>
                <div class="owl-dots">
                    <div class="owl-dot active"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                </div>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
        });
    </script>
</body>
</html>