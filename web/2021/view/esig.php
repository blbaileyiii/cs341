<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "E-Signature" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Signature Pad</title>
    <script src="https://code.jquery.com/jquery-1.8.0.min.js" integrity="sha256-jFdOCgY5bfpwZLi0YODkqNXQdIxKpm6y5O/fy0baSzE=" crossorigin="anonymous"></script>
    <script type="text/javascript"> 
        $(document).ready(function () {
            /** Set Canvas Size **/
            var canvasWidth = 400;
            var canvasHeight = 100;

            /** IE SUPPORT **/
            var canvasDiv = document.getElementById('signaturePad');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', canvasWidth);
            canvas.setAttribute('height', canvasHeight);
            canvas.setAttribute('id', 'canvas');
            canvasDiv.appendChild(canvas);
            if (typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");

            var clickX = new Array();
            var clickY = new Array();
            var clickDrag = new Array();
            var paint;

            /** Redraw the Canvas **/
            function redraw() {
                canvas.width = canvas.width; // Clears the canvas

                context.strokeStyle = "#000000";
                context.lineJoin = "miter";
                context.lineWidth = 2;

                for (var i = 0; i < clickX.length; i++) {
                    context.beginPath();
                    if (clickDrag[i] && i) {
                        context.moveTo(clickX[i - 1], clickY[i - 1]);
                    } else {
                        context.moveTo(clickX[i] - 1, clickY[i]);
                    }
                    context.lineTo(clickX[i], clickY[i]);
                    context.closePath();
                    context.stroke();
                }
            }

            // /** Save Canvas **/
            // $("#saveSig").click(function saveSig() {
            //     var sigData = canvas.toDataURL("image/png");
            //     $("#imgData").html('Thank you! Your signature was saved');
            //     var ajax = new XMLHttpRequest();
            //     ajax.onreadystatechange = function() {
            //         if (this.readyState == 4 && this.status == 200) {
            //             // successful
            //             console.log(this.responseText);
            //         } else if (this.readyState == 4 && this.status == 404) {
            //             // unsuccessful
            //             console.log(this.responseText);
            //             /*
            //             let err404 = document.createElement("p");
            //             err404.className = "err404";
            //             err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."
            //             */
            //         } else {
            //             // very unsuccessful
            //             console.log(this.responseText);
            //             // console.log("failed");
            //         }
            //     }
            //     ajax.open("POST", '/2021/sig/');
            //     ajax.setRequestHeader('Content-Type', 'application/upload');
            //     ajax.send(sigData);
            // });

            /** Save Canvas **/
            $("#saveSig").click(function saveSig() {
                var sigURL = canvas.toDataURL("image/png");
                console.log(sigURL);
                $("#imgData").html('Thank you! Your signature was saved');

                let data = new FormData();
                data.append('sig', sigURL);
                console.log(data);

                var ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // successful
                        console.log(this.responseText);
                    } else if (this.readyState == 4 && this.status == 404) {
                        // unsuccessful
                        console.log(this.responseText);
                        /*
                        let err404 = document.createElement("p");
                        err404.className = "err404";
                        err404.textContent = "404: JSON file not found. Try again; perhaps using a valid file name this time."
                        */
                    } else {
                        // very unsuccessful
                        console.log(this.responseText);
                        // console.log("failed");
                    }
                }
                ajax.open("POST", '/2021/sig/');
                ajax.setRequestHeader('Content-Type', 'application/upload');
                ajax.send(data);
            });

            /** Clear Canvas **/
        $("#clearSig").click(function clearSig() {
        
                clickX = new Array();
                clickY = new Array();
                clickDrag = new Array();
                canvas.width = canvas.width;
                canvas.height = canvas.height;
        });
            /**Draw when moving over Canvas **/
            $('#signaturePad').mousemove(function (e) {
                if (paint) {
                    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                    redraw();
                }
            });

            /**Stop Drawing on Mouseup **/
            $('#signaturePad').mouseup(function (e) {
                paint = false;
            });

            /** Starting a Click **/
            function addClick(x, y, dragging) {
                clickX.push(x);
                clickY.push(y);
                clickDrag.push(dragging);
            }

            $('#signaturePad').mousedown(function (e) {
                var mouseX = e.pageX - this.offsetLeft;
                var mouseY = e.pageY - this.offsetTop;

                paint = true;
                addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
                redraw();
            });

        });
    </script>
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
        <fieldset style="width: 435px">
            <br/>
            <br/>
            <div id="signaturePad" style="border: 1px solid #00C; height: 100px; width: 400px;"></div>
            <br/>
            <button  id="clearSig" type="button">Clear Signature</button>&nbsp;
            <button id="saveSig" type="button">Save Signature</button>
            <div id="imgData"></div>
            <div id="imgData"></div>
            <br/>
            <br/>
        </fieldset>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
</body>
</html>