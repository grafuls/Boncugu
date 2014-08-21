<div id="main" class="clearfix" role="main">
<?php
echo '<h2>Latest pictures taken with ' .$lense .'</h2>';
?>
<div class="container">
    <div class="popular-brand-cameras">
        <div id="grid">
            <?php 
            foreach ($photos['photos']['photo'] as $photo) {
                echo '<a data-imagelightbox="b" href="';
                echo 'https://farm' .$photo['farm'] .'.staticflickr.com/' .$photo['server'] .'/' .$photo['id'] .'_' .$photo['secret'] .'_b.jpg';
                echo '" >';
                echo '<img src="';
                echo 'https://farm' .$photo['farm'] .'.staticflickr.com/' .$photo['server'] .'/' .$photo['id'] .'_' .$photo['secret'] .'.jpg';
                echo '" alt="' .$photo['title'] .'">';
                echo '</a>';
            }
            ?>
        </div>
	</div>
</div>
<br>
<div class="scroll-to-top">
<!-- <p>Scroll to top</p> *Use this as a text option, instead of the image icon.*-->
</div>