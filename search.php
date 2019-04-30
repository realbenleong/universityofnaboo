<?php get_header(); ?>
<?php 
pageBanner(array(
  'title'=>'Search Results',
  'subtitle'=>'search results for &ldquo;'.esc_html(get_search_query()).'&ldquo;'
));
?>
<div class="container container--narrow page-section">
    <?php 
    if(have_posts()) {
        while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/content',get_post_type());
        }
    }else {
        echo '<h2>No results match that search.</h2>';
    }
    ?>

    <?php 
    echo paginate_links();
    ?>
</div>
<?php get_footer(); ?>