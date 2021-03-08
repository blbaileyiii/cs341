/*
function chgColor(){
    let div1 = document.getElementById("div1")
    let color = document.getElementById("color").value;
    div1.style.background = color;
}
*/

$("#clickMe").click(function(){
    alert("Clicked!");
});

$("#chgColor").click(function(){
    $(".div1").css("background-color", $("#color").val());
});

$("#togVis").click(function(){
    $(".div3").fadeToggle("slow");
});