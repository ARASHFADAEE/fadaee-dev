<?php get_header() ?>
<main class="flex-auto py-5">
    <div class="space-y-14">
        <!-- container -->
        <div class="max-w-7xl space-y-14 px-4 mx-auto">
            <!-- intro -->
            <?php get_template_part('partials/home/intro','intro'); ?>
            <!-- end intro -->

            <!-- features -->
            <?php get_template_part('partials/home/features','features'); ?>

            <!-- end features -->


            <!-- section:latest-product -->

            <?php get_template_part('partials/home/latest-products','latest-products'); ?>

            <!-- section:latest-courses -->
            <?php// get_template_part('partials/home/latest-courses','latest-courses'); ?>
            <!-- end section:latest-courses -->
        </div>
        <!-- end container -->

        <!-- feedback -->
        <?php get_template_part('partials/home/feedback','feedback'); ?>

        <!-- end feedback -->

        <!-- container -->
            <!-- articles -->
            <?php get_template_part('partials/home/articles','articles'); ?>
            <!-- end articles -->

        <!-- end container -->
    </div>
</main>
<?php get_footer(); ?>



