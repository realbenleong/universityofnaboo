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
            <img class="professor-card__image" src="<?php the_post_thumbnail_url(); ?>" alt="">
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
            $homepageEvents->the_post(); ?>
            <div class="event-summary">
              <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month"><?php 
                  $eventDate=new DateTime(get_field('event_date'));
                  echo $eventDate->format('M');
                ?></span>
                <span class="event-summary__day"><?php 
                  $eventDate=new DateTime(get_field('event_date'));
                  echo $eventDate->format('d');
                ?></span>  
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php if(has_excerpt()) {
                echo get_the_excerpt();
              }else {
                echo wp_trim_words(get_the_content(),18);
              } ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>
          <?php }
        ?>
  </div>
        <p><a href="<?php echo the_permalink(); ?>"><?php echo the_permalink(); ?></a></p>
    <?php }
?>
<?php get_footer(); ?>