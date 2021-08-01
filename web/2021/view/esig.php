<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Signature Pad" ?>
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
        <?php
            postESig(prepESig($_SERVER['DOCUMENT_ROOT'] . '/2021/images/gw2.jpg'));
            // $esig = getESig(1);
            // $esig = $esig[0]['img'];
            // echo $esig;
            // var_dump($esig);
            // echo "<img src='data:image/*;charset=utf8;base64,base64_encode($esig)'>";
            
        ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
</body>
</html>