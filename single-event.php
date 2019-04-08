<?php get_header(); ?>
<?php 
    while(have_posts()) {
        the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( "/images/ocean.jpg" ) ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p><?php echo get_bloginfo('description'); ?></p>
      </div>
    </div>  
  </div>
  <div class="container container--narrow page-section">
    <div class="generic-content">
            <div class="event-summary">
              <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month">Mar</span>
                <span class="event-summary__day">25</span>  
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo wp_trim_words(get_the_content(),18); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>
    </div>
    <?php 
    $relatedPrograms=get_field('related_programs');
    if($relatedPrograms) {

    
    echo "<h2>Related programs:</h2>";
    echo '<ul class="link-list min-list">';
    foreach($relatedPrograms as $x) { ?>
      <li><a href="<?php echo get_the_permalink($x); ?>"><?php echo get_the_title($x); ?></a></li>
    <?php }
    echo '</ul>';
    }
    ?>
  </div>
        <p><a href="<?php echo the_permalink(); ?>"><?php echo the_permalink(); ?></a></p>
    <?php }
?>
<?php get_footer(); ?>