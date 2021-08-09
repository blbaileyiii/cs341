<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Print Registrants" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
</head>

<body>  
    <main>
        <section class="print-registrants">
            <?php echo $permissionSlipsHTML; ?>
        </section>
        <?php // var_dump($registrants); ?>
    </main>
</body>
</html>