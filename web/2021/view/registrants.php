<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Registrants" ?>
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
        <h1><?php echo $page; ?></h1>
        <div class="total-registrants">
            <p>Total Youth Registered: <?php echo $youthCount; ?></p>
            <p>Total Adults Registered: <?php echo $adultCount; ?></p>
            <p>Total Participants Registered: <?php echo $registrantsCount; ?></p>        
            <?php echo $registrantsTable; ?>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <?php // var_dump($registrants); ?>
    <?php // var_dump($registrantsTable); ?>
</body>
</html>