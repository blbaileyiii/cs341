<a class="anchor" id="faq"></a>
<section class="faq">
    <h2>F.A.Q.</h2>
    <ul>
        <li>
            <button type="button" class="collapsible-btn"><span class="faq-q">Open Collapsible</span><span class="expander">+</span></button>
            <div class="collapsible-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </li>
        <li>
            <button type="button" class="collapsible-btn"><span class="faq-q">Open Collapsible</span><span class="expander">+</span></button>
            <div class="collapsible-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </li>
    </ul>
    
</section>
<script>
    var coll = document.getElementsByClassName("collapsible-btn");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("faq-active");
        var content = this.nextElementSibling;
        var expander = this.querySelector(".expander");
        if (content.style.display === "block") {
        content.style.display = "none";
        } else {
        content.style.display = "block";
        }
        if (expander.innerHTML === "+") {
            expander.innerHTML = "X";
        } else {
            expander.innerHTML = "+";
        }
    });
    }
</script>