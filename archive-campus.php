<?php get_header(); ?>
<?php 
pageBanner(array(
  'title'=>'All campus',
  'subtitle'=>'Come to the hood.'
));
?>
<div class="container container--narrow page-section">
    <div class="acf-map">
    <?php
    $campusList=new WP_Query(array(
        'posts_per_page'=>-1,
        'post_type'=>'campus'
    ));
    while($campusList->have_posts()) {
        $campusList->the_post(); ?>
            <?php 
            $mapLocation=get_field('map_location'); ?>
            <div 
                class="marker" 
                data-lat="<?php echo $mapLocation['lat'] ?>"
                data-lng="<?php echo $mapLocation['lng'] ?>"
            >
                <h3>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <br>
                    Address: <?php echo $mapLocation['address']; ?>
                </h3>
            </div>
    <?php } ?>
    </div>
    <?php print_r($mapLocation); ?>
</div>
<?php get_footer(); ?>