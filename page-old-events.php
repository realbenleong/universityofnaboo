<?php get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( "/images/ocean.jpg" ) ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Old Events</h1>
      <div class="page-banner__intro">
        <p><?php the_archive_title(); ?></p>
        <p><?php the_archive_description(); ?></p>
      </div>
    </div>  
  </div>
<div class="container container--narrow page-section">
  <?php 
    $today=date('Ymd');
    $pastEvents=new WP_Query(array(
        'paged'=>get_query_var('paged',1),
        'post_type'=>'event',
        'meta_key'=>'event_date',
        'orderby'=>'meta_value_num',
        'order'=>'ASC',
        'meta_query'=>array(
          array(
            'key'=>'event_date',
            'compare'=>'<',
            'value'=>$today,
            'type'=>'numeric'
          )
        )
      ));
    while($pastEvents->have_posts()) {
        $pastEvents->the_post(); ?>
      <div class="post-item">
      <span class="event-summary__month"><?php 
        $eventDate=new DateTime(get_field('event_date'));
        echo $eventDate->format('M');
      ?></span>
      <span class="event-summary__day"><?php 
        $eventDate=new DateTime(get_field('event_date'));
        echo $eventDate->format('d');
      ?></span>  
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
    echo paginate_links(array(
        'total'=>$pastEvents->max_num_pages
    ));
  ?>
</div>
<?php get_footer(); ?>