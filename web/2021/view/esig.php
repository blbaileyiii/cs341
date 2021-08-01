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
            // postESig(prepESig($_SERVER['DOCUMENT_ROOT'] . '/2021/images/gw2.jpg'))
            $esig = getESig(1);
            $esig = $esig[0]['img'];
            // $esig = pg_unescape_bytea($esig);
            var_dump($esig);

            ob_start(); // Let's start output buffering.
            fpassthru($esig); //This will normally output the image, but because of ob_start(), it won't.
            $contents = ob_get_contents(); //Instead, output above is saved to $contents
            ob_end_clean(); //End the output buffer.

            $dataUri = "data:image/jpg;base64," . base64_encode($contents);
            echo "<img src='$dataUri' />";
        ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
</body>
</html>