<?php get_header(); ?>
<?php 
    pageBanner();
    //Becareful not to use while have posts here as it will mess up subsequent have posts code. 
?>
<div class="container container--narrow page-section">
    <div class="acf-map">
        <?php the_post(); ?>
        <?php 
        $mapLocation=get_field('map_location'); ?>
        <div 
            class="marker" 
            data-lat="<?php echo $mapLocation['lat'] ?>"
            data-lng="<?php echo $mapLocation['lng'] ?>"
        >
            <h3>
                <?php the_title(); ?>
                <br>
                Address: <?php echo $mapLocation['address']; ?>
            </h3>
        </div>
    </div>
    <h1>Programs available at this Campus:</h1>
    <?php
    $relProg=new WP_Query(array(
        'posts_per_page'=>-1,
        'post_type'=>'program',
        'orderby'=>'title',
        'order'=>'ASC',
        'meta_query'=>array(
        array(
            'key'=>'related_campus',
            'compare'=>'LIKE',
            'value'=>'"'.get_the_ID().'"'
        ))
    ));
    while($relProg->have_posts()) {
        $relProg->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
    <?php } ?>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>