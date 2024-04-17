<?php
    include("connection.php");
    $carouselBanners="SELECT bannerImgPath FROM `teacher-bannerimg-table` ORDER BY rand() LIMIT 4";
    $carouselImgPath=mysqli_query($connection,$carouselBanners);
?>
<!-- this is the starting of  carousel section -->
<main class="mt-20  overflow-hidden">
    <wrapper class="bannerCarousel duration-500 flex">
        <?php
            while($path=mysqli_fetch_array($carouselImgPath))
            {
        ?>
        <img style="min-width: 100vw;" src="<?php echo $path[0];?>" alt="Banner Image">
        <?php } ?>
    </wrapper>
</main>
<!-- this is the ending of  carousel section -->