<?php get_header(); ?>
<?php 
pageBanner(array(
  'title'=>'Hello there this is the title.',
  'subtitle'=>'Hi dood',
  'photo'=>'https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png'
));
?>
<div class="container container--narrow page-section">
  <?php 
    while(have_posts()) {
      the_post();
      get_template_part('template-parts/content-event');
    }
  ?>
  <?php 
    echo paginate_links();
  ?>
</div>
<?php get_footer(); ?>