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
      <h3>Excerpt:</h3>
      <?php the_excerpt(); ?>
      <h3>Content:</h3>
      <?php the_content(); ?>
    </div>
  </div>

        <?php echo the_permalink(); ?>
    <?php }
?>
<?php get_footer(); ?>