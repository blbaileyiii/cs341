<section id="gallery" class="gallery">
    <div class="section-center">
        <h2>Gallery</h2>
        <div class='video'>
        <video class='responsive' controls>
            <source src="https://youtu.be/rLqL07Q_Fqk" type="video/mp4">
            Your browser does not support HTML video.
        </video>
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