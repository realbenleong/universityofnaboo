<?php get_header(); ?>
<?php 
    while(have_posts()) {
        the_post(); 
        pageBanner();
        ?>
        
  <div class="container container--narrow page-section">
    <div class="generic-content">
        <div class="row group">
            <div class="one-third">
                <?php the_post_thumbnail('professorLandscape');  ?>
            </div>
            <div class="two-thirds">
                <?php the_content();  ?>
            </div>
        </div>
    </div>
    <?php
    $relatedPrograms=get_field('related_programs');
    if($relatedPrograms) {
    echo "<h2>Subjects Taught:</h2>";
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