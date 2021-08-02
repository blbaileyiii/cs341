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
  
    var participantCanvas = document.getElementById("participantCanvas");
    var ctx = participantCanvas.getContext("2d");
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 4;
  
    var drawing = false;
    var mousePos = {
      x: 0,
      y: 0
    };
    var lastPos = mousePos;
  
    participantCanvas.addEventListener("mousedown", function(e) {
      drawing = true;
      lastPos = getMousePos(participantCanvas, e);
    }, false);
  
    participantCanvas.addEventListener("mouseup", function(e) {
      drawing = false;
    }, false);
  
    participantCanvas.addEventListener("mousemove", function(e) {
      mousePos = getMousePos(participantCanvas, e);
    }, false);
  
    // Add touch event support for mobile
    participantCanvas.addEventListener("touchstart", function(e) {
  
    }, false);
  
    participantCanvas.addEventListener("touchmove", function(e) {
      var touch = e.touches[0];
      var me = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      participantCanvas.dispatchEvent(me);
    }, false);
  
    participantCanvas.addEventListener("touchstart", function(e) {
      mousePos = getTouchPos(participantCanvas, e);
      var touch = e.touches[0];
      var me = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      participantCanvas.dispatchEvent(me);
    }, false);
  
    participantCanvas.addEventListener("touchend", function(e) {
      var me = new MouseEvent("mouseup", {});
      participantCanvas.dispatchEvent(me);
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
      if (e.target == participantCanvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchend", function(e) {
      if (e.target == participantCanvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
      if (e.target == participantCanvas) {
        e.preventDefault();
      }
    }, false);
  
    (function drawLoop() {
      requestAnimFrame(drawLoop);
      renderCanvas();
    })();
  
    function clearCanvas() {
      participantCanvas.width = participantCanvas.width;
    }
  
    // Set up the UI
    var sigText = document.getElementById("participant-dataUrl");
    var sigImage = document.getElementById("participant-image");
    var clearBtn = document.getElementById("participant-clearBtn");
    var submitBtn = document.getElementById("participant-submitBtn");
    clearBtn.addEventListener("click", function(e) {
      clearCanvas();
      sigText.innerHTML = "Data URL for your signature will go here!";
      sigImage.setAttribute("src", "");
    }, false);
    submitBtn.addEventListener("click", function(e) {
      var dataUrl = participantCanvas.toDataURL();
      sigText.innerHTML = dataUrl;
      sigImage.setAttribute("src", dataUrl);
    }, false);
  
  })();