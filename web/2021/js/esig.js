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
    var guardianCanvas = document.getElementById("guardianCanvas");
    var pctx = participantCanvas.getContext("2d");
    pctx.strokeStyle = "#222222";
    pctx.lineWidth = 4;
    var gctx = guardianCanvas.getContext("2d");
    gctx.strokeStyle = "#222222";
    gctx.lineWidth = 4;
  
    var pDrawing = false;
    var gDrawing = false;
    var mousePos = {
      x: 0,
      y: 0
    };
    var lastPos = mousePos;
  
    participantCanvas.addEventListener("mousedown", function(e) {
      pDrawing = true;
      lastPos = getMousePos(participantCanvas, e);
    }, false);
  
    participantCanvas.addEventListener("mouseup", function(e) {
      pDrawing = false;
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

    //
    guardianCanvas.addEventListener("mousedown", function(e) {
        gDrawing = true;
        lastPos = getMousePos(guardianCanvas, e);
      }, false);
    
      guardianCanvas.addEventListener("mouseup", function(e) {
        gDrawing = false;
      }, false);
    
      guardianCanvas.addEventListener("mousemove", function(e) {
        mousePos = getMousePos(guardianCanvas, e);
      }, false);
    
      // Add touch event support for mobile
      guardianCanvas.addEventListener("touchstart", function(e) {
    
      }, false);
    
      guardianCanvas.addEventListener("touchmove", function(e) {
        var touch = e.touches[0];
        var me = new MouseEvent("mousemove", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
        guardianCanvas.dispatchEvent(me);
      }, false);
    
      guardianCanvas.addEventListener("touchstart", function(e) {
        mousePos = getTouchPos(guardianCanvas, e);
        var touch = e.touches[0];
        var me = new MouseEvent("mousedown", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
        guardianCanvas.dispatchEvent(me);
      }, false);
    
      guardianCanvas.addEventListener("touchend", function(e) {
        var me = new MouseEvent("mouseup", {});
        guardianCanvas.dispatchEvent(me);
      }, false);
    //
  
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
      if (pDrawing) {
        pctx.moveTo(lastPos.x, lastPos.y);
        pctx.lineTo(mousePos.x, mousePos.y);
        pctx.stroke();
        lastPos = mousePos;
      } else if (gDrawing) {
        gctx.moveTo(lastPos.x, lastPos.y);
        gctx.lineTo(mousePos.x, mousePos.y);
        gctx.stroke();
        lastPos = mousePos;
      }
    }
  
    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
      if (e.target == participantCanvas || e.target == guardianCanvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchend", function(e) {
      if (e.target == participantCanvas || e.target == guardianCanvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
        if (e.target == participantCanvas || e.target == guardianCanvas) {
        e.preventDefault();
      }
    }, false);
  
    (function drawLoop() {
      requestAnimFrame(drawLoop);
      renderCanvas();
    })();
  
    function clearCanvas(canvas) {
      canvas.width = canvas.width;
    }
  
    // Set up the UI
    var pSigText = document.getElementById("participant-dataUrl");
    var pSigImage = document.getElementById("participant-image");
    var pClearBtn = document.getElementById("participant-clearBtn");
    var pSubmitBtn = document.getElementById("participant-submitBtn");

    var gSigText = document.getElementById("guardian-dataUrl");
    var gSigImage = document.getElementById("guardian-image");
    var gClearBtn = document.getElementById("guardian-clearBtn");
    var gSubmitBtn = document.getElementById("guardian-submitBtn");

    pClearBtn.addEventListener("click", function(e) {
        clearCanvas(participantCanvas);
        pSigText.innerHTML = "Data URL for your signature will go here!";
        pSigImage.setAttribute("src", "");
    }, false);

    pSubmitBtn.addEventListener("click", function(e) {
        var dataUrl = participantCanvas.toDataURL();
        pSigText.innerHTML = dataUrl;
        pSigImage.setAttribute("src", dataUrl);
    }, false);

    gClearBtn.addEventListener("click", function(e) {
        clearCanvas(guardianCanvas);
        gSigText.innerHTML = "Data URL for your signature will go here!";
        gSigImage.setAttribute("src", "");
    }, false);

    gSubmitBtn.addEventListener("click", function(e) {
        var dataUrl = guardianCanvas.toDataURL();
        gSigText.innerHTML = dataUrl;
        gSigImage.setAttribute("src", dataUrl);
    }, false);
  
  })();