<section id="gallery" class="gallery">
    <div class="section-center">
        <h2>Gallery</h2>
        <div class='video'>
        <iframe width="420" height="315"
            src="https://www.youtube.com/embed/rLqL07Q_Fqk">
        </iframe>
        </div>
        <div class='gallery-container'>
            <!-- Full-width images with number text -->
            <?php echo $galleryHTML; ?>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!-- Image text -->
            <div class="caption-container hidden">
                <p id="caption"></p>
            </div>

            <!-- Thumbnail images -->
            <?php echo $galleryThumbsHTML; ?>
        </div>

    </div>
    <script src='/js/gallery.js'></script>
</section>