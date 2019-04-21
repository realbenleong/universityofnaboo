<?php get_header(); ?>
<?php 
pageBanner(array(
  'title'=>get_the_archive_title(),
  'subtitle'=>get_the_archive_description()
));
?>
<div class="container container--narrow page-section">
  <h1><?php if(is_category()) {
            echo "Categoru: ";
            single_cat_title();
        } 
        if(is_author()) {
            echo "Autor: ";
            the_author();
        }
        ?></h1>
  <?php 
    while(have_posts()) {
      the_post(); ?>
      <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="metabox">
          <p>
          Posted by <?php the_author_posts_link(); ?> on <?php the_time('j M Y'); ?> in <?php echo get_the_category_list(', '); ?>
          </p>
        </div>
        <div class="generic-content">
          <?php the_excerpt(); ?>
          <p class="btn btn--blue"><a href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
        </div>
      </div>
    <?php }
  ?>
  <?php 
    echo paginate_links();
  ?>
</div>
<?php get_footer(); ?>