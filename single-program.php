<?php get_header(); ?>
<?php 
    while(have_posts()) {
        the_post();
        pageBanner();
?>

<h1>Professors:</h1>

<?php
$relProfs=new WP_Query(array(
    'posts_per_page'=>-1,
    'post_type'=>'professor',
    'orderby'=>'title',
    'order'=>'ASC',
    'meta_query'=>array(
      array(
          'key'=>'related_programs',
          'compare'=>'LIKE',
          'value'=>'"'.get_the_ID().'"'
      )
    )
  ));
  echo '<ul class="professor-cards">'; 
  while($relProfs->have_posts()) {
    $relProfs->the_post(); ?>
<li class="professor-card__list-item">
    <a class="professor-card" href="<?php the_permalink(); ?>">
        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorPortrait'); ?>" alt="">
        <span class="professor-card__name"><?php the_title(); ?></span>
    </a>
</li>
<?php }
    echo '</ul>';
    //Crucial to ensure that the next query can work. 
    wp_reset_postdata();

?>


<h1>Related Upcoming Events:</h1>
<?php 
          $today=date('Ymd');
          $homepageEvents=new WP_Query(array(
            'posts_per_page'=>-1,
            'post_type'=>'event',
            'meta_key'=>'event_date',
            'orderby'=>'meta_value_num',
            'order'=>'ASC',
            'meta_query'=>array(
              array(
                'key'=>'event_date',
                'compare'=>'>=',
                'value'=>$today,
                'type'=>'numeric'
              ),
              array(
                  'key'=>'related_programs',
                  'compare'=>'LIKE',
                  'value'=>'"'.get_the_ID().'"'
              )
            )
          ));
          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post();
            get_template_part('template-parts/content-event');
}
        ?>
</div>
<p><a href="<?php echo the_permalink(); ?>"><?php echo the_permalink(); ?></a></p>
<?php }
?>
<?php wp_reset_postdata(); ?>
<?php 
    $relCamps=get_field('related_campus');
    if($relCamps) {
        echo '<h2>'.get_the_title().' is avail at these campuses: </h2>';
        foreach($relCamps as $x) { ?>
          <li>
            <a href="<?php echo get_the_permalink($x); ?>">
              <?php echo get_the_title($x); ?>
            </a>
          </li>
        <?php }
    }
?>
<?php get_footer(); ?>