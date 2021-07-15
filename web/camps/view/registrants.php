<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Registrants" ?>
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
        <section class="total-registrants">
            <h1><?php echo $page; ?></h1>
            <?php echo $registrantsTable; ?>
        </section>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/camps/common/footer.php'; ?>
    </footer>
    <?php // var_dump($registrants); ?>
    <?php // var_dump($registrantsTable); ?>
</body>
</html>