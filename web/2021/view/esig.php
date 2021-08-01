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
            $file_name = "/2021/images/gw2.jpg";
            $img = fopen($file_name, 'r') or die("Cannot read image.");
            $data = fread($img, filesize($file_name));
            $es_data = pg_escape_bytea($data);
            fclose($img);
            postESig($es_data);
        ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
</body>
</html>