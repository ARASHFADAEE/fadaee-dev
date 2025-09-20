<?php
// Extract variables from $args
$author_name = isset($args['author_name']) ? $args['author_name'] : '';
$author_avatar = isset($args['author_avatar']) ? $args['author_avatar'] : '';
$author_url = isset($args['author_url']) ? $args['author_url'] : '';
$author_description = isset($args['author_description']) ? $args['author_description'] : '';
?>
<div class="md:w-4/12 w-full md:sticky md:top-24 space-y-8">
    <div class="space-y-5">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-sm text-foreground">نویسنده:</div>
        </div>
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                    <img src="<?php echo $author_avatar; ?>" class="w-full h-full object-cover"
                        alt="..." />
                </div>
                <div class="flex flex-col items-start space-y-1">
                    <a href="<?php echo $author_url; ?>"
                        class="line-clamp-1 font-bold text-sm text-foreground hover:text-primary"><?php echo $author_name; ?></a>
                    <a href="<?php echo $author_url; ?>" class="line-clamp-1 font-semibold text-xs text-primary">دیدن
                        رزومه</a>
                </div>
            </div>
            <div class="bg-secondary rounded-tl-3xl rounded-b-3xl text-sm text-muted p-5">

                <?php echo $author_description; ?>
            </div>
        </div>
    </div>
</div>