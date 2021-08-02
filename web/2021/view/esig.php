<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "E-Signature" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Signature Pad</title>
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>E-Signature</h1>
                    <p>Sign in the canvas below and save your signature as an image!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <canvas id="sig-canvas" width="620" height="160">
                        Get a better browser, bro.
                    </canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
                    <button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <textarea id="sig-dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <img id="sig-image" src="" alt="Your signature will go here!"/>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <script src="js/esig.js"></script>
</body>
</html>