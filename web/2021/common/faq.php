<section id="faq" class="faq">
    <div class="section-center">
        <h2>F.A.Q.</h2>
        <ul>
            <li>
                <button type="button" class="collapsible-btn"><span class="faq-q">If I have special needs is camp for me?</span><span class="expander">✚</span></button>
                <div class="collapsible-content">
                <p>Yes. Camp is for you. The purpose of youth camps are to help youth interact with others and have fun. By nature, camp has been designed to be as inclusive as possible but certain considerations may require special attention and adaptation. If you have specific concerns, address them as early as possible with the camp director(s) of your specific event. Also, be sure to mention any considerations while registering. We want to help all youth have an enjoyable experience and participate.</p>
                </div>
            </li>
            <li>
                <button type="button" class="collapsible-btn"><span class="faq-q">Open Collapsible</span><span class="expander">✚</span></button>
                <div class="collapsible-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </li>
        </ul>
    </div>
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
        if (expander.innerHTML === "✚") {
            expander.innerHTML = "✖";
        } else {
            expander.innerHTML = "✚";
        }
    });
    }
</script>