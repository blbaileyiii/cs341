(function() {
    window.requestAnimFrame = (function(callback) {
      return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimaitonFrame ||
        function(callback) {
          window.setTimeout(callback, 1000 / 60);
        };
    })();
  
    var canvas1 = document.getElementById("sig-canvas1");
    var ctx = canvas1.getContext("2d");
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 4;
  
    var drawing = false;
    var mousePos = {
      x: 0,
      y: 0
    };
    var lastPos = mousePos;
  
    canvas1.addEventListener("mousedown", function(e) {
      drawing = true;
      lastPos = getMousePos(canvas1, e);
    }, false);
  
    canvas1.addEventListener("mouseup", function(e) {
      drawing = false;
    }, false);
  
    canvas1.addEventListener("mousemove", function(e) {
      mousePos = getMousePos(canvas1, e);
    }, false);
  
    // Add touch event support for mobile
    canvas1.addEventListener("touchstart", function(e) {
  
    }, false);
  
    canvas1.addEventListener("touchmove", function(e) {
      var touch = e.touches[0];
      var me = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas1.dispatchEvent(me);
    }, false);
  
    canvas1.addEventListener("touchstart", function(e) {
      mousePos = getTouchPos(canvas1, e);
      var touch = e.touches[0];
      var me = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas1.dispatchEvent(me);
    }, false);
  
    canvas1.addEventListener("touchend", function(e) {
      var me = new MouseEvent("mouseup", {});
      canvas1.dispatchEvent(me);
    }, false);
  
    function getMousePos(canvasDom, mouseEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
      }
    }
  
    function getTouchPos(canvasDom, touchEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
      }
    }
  
    function renderCanvas() {
      if (drawing) {
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
        lastPos = mousePos;
      }
    }
  
    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
      if (e.target == canvas1) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchend", function(e) {
      if (e.target == canvas1) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
      if (e.target == canvas1) {
        e.preventDefault();
      }
    }, false);
  
    (function drawLoop() {
      requestAnimFrame(drawLoop);
      renderCanvas();
    })();
  
    function clearCanvas() {
      canvas1.width = canvas1.width;
    }
  
    // Set up the UI
    var sigText = document.getElementById("sig-dataUrl1");
    var sigImage = document.getElementById("sig-image1");
    var clearBtn = document.getElementById("sig-clearBtn1");
    var submitBtn = document.getElementById("sig-submitBtn1");
    clearBtn.addEventListener("click", function(e) {
      clearCanvas();
      sigText.innerHTML = "Data URL for your signature will go here!";
      sigImage.setAttribute("src", "");
    }, false);
    submitBtn.addEventListener("click", function(e) {
      var dataUrl = canvas1.toDataURL();
      sigText.innerHTML = dataUrl;
      sigImage.setAttribute("src", dataUrl);
    }, false);
  
  })();