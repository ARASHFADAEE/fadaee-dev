<?php get_header()?>

<?php

//content date
$post_id=get_the_ID();
$title=get_the_title($post_id);
$post_thumbnail=get_the_post_thumbnail_url($post_id, 'full');
$date=get_the_date('Y-m-d', $post_id);
$expert=get_the_excerpt($post_id);
$content=get_the_content($post_id);





?>

        <main class="flex-auto py-5">
            <!-- container -->
            <div class="max-w-7xl space-y-14 px-4 mx-auto">
                <div class="flex md:flex-nowrap flex-wrap items-start gap-5">
                    <div class="md:w-8/12 w-full">
                        <div class="relative">
                            <!-- article:thumbnail -->
                            <div class="relative z-10">
                                <img src="<?php echo $post_thumbnail;?>" class="max-w-full rounded-3xl" alt="<?php echo $title?>" />
                            </div>

                            <div class="-mt-12 pt-12">
                                <div
                                    class="bg-gradient-to-b from-background to-secondary rounded-b-3xl space-y-2 p-5 mx-5">
                                    <!-- article:title -->
                                    <h1 class="font-bold text-xl text-foreground"><?php echo $title?></h1>

                                    <!-- article:excerpt -->
                                    <p class="text-sm text-muted">
                                        <?php echo $expert?>

                                    </p>
                                </div>
                                <div class="space-y-10 py-5">
                                    <!-- article:description -->
                                    <?php get_template_part('partials/single-blog/content','content', array('content'=>$content));?>
                                    <!-- end article:description -->

                                    <!-- article:comments:container -->
                                    <?php get_template_part('partials/single-blog/comments');?>
                                    <!-- end article:comments:container -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- sidebar section -->
                    <?php get_template_part('partials/single-blog/sidebar');?>
                </div>
            </div>
            <!-- end container -->
        </main>




<?php get_footer()?>
