<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
};

function arphabet_widgets_init() {
  register_sidebar( array(
    'name'          => 'Footer Widget #1',
    'id'            => 'footer_widget1',
    'before_widget' => '<div class="custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => 'Footer Widget #2',
    'id'            => 'footer_widget2',
    'before_widget' => '<div class="custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
    register_sidebar( array(
    'name'          => 'Footer Widget #3',
    'id'            => 'footer_widget3',
    'before_widget' => '<div class="custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
    register_sidebar( array(
    'name'          => 'Footer Widget #4',
    'id'            => 'footer_widget4',
    'before_widget' => '<div class="custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
    register_sidebar( array(
    'name'          => 'Footer Widget #5',
    'id'            => 'footer_widget5',
    'before_widget' => '<div class="custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

     register_sidebar( array(
    'name'          => 'Footer Widget #7',
    'id'            => 'footer_widget7',
    'before_widget' => '<div class="custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

        register_sidebar( array(
    'name'          => 'Blog Widget #6',
    'id'            => 'footer_widget6',
    'before_widget' => '<div class="blog-custom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="blog-widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/*-------------------- image size -------------------------------*/

if ( function_exists( 'add_image_size' ) ) { 
    add_image_size( 'host_image_thumb', 300, 300 ); //300 pixels wide (and unlimited height)
    add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
}

/*--------------------------- Testimonials section ---------------------------*/
add_action( 'init', 'testi_post');
function testi_post() {
  register_post_type('testimonials_review',
    array(
      'labels' => array(
      'name' => __('Testimonials Review'),
      'singular_name' => __('Testimonials Review')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'testimonials_review'),
    'public' => true,
    'supports' => array('title', 'editor', 'revisions', 'thumbnail', 'author', 'page-attributes', 'custom-fields'))
  );
}
add_shortcode('list-testimonials_review', 'rmcc_testimonials_review');
function rmcc_testimonials_review( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'testimonials_review',
    ) );
    if ( $query->have_posts() ) {   ?>
  <div class="carousel-inner">
   <?php $i=0;  while ( $query->have_posts() ) : $query->the_post();    ?>
    <div class="carousel-item <?php if ($i == 0) {?>active<?php } ?>">
      <h5><?php echo the_content(); ?></h5>
      <p><span><?php echo the_title(); ?></span><br><?php the_field('info'); ?></p>
    </div>
    <?php $i++;  endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
        return $myvariable;
        ?>
    </div>
    <?php 
    }
}

/*--------------------------- Join now Testimonials section ---------------------------*/
add_action( 'init', 'customer_testi1');
function customer_testi1() {
  register_post_type('customer_testi',
    array(
      'labels' => array(
      'name' => __('Customer Testimonials '),
      'singular_name' => __('Customer Testimonials')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'customer_testi'),
    'public' => true,
    'supports' => array('title', 'editor', 'revisions', 'thumbnail', 'author', 'page-attributes', 'custom-fields'))
  );
}
add_shortcode('list-customer_testi', 'rmcc_customer_testi');
function rmcc_customer_testi( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'customer_testi',
    ) );
    if ( $query->have_posts() ) {   ?>
  <div class="carousel-inner">
   <?php $i=0;  while ( $query->have_posts() ) : $query->the_post();    ?>
    <div class="carousel-item <?php if ($i == 0) {?>active<?php } ?>">
      <h5><?php echo the_content(); ?></h5>
      <p><span><?php echo the_title(); ?></span></p>
    </div>
    <?php $i++;  endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
        return $myvariable;
        ?>
    </div>
    <?php 
    }
}

/*------------------- Our Hosts ------------------------------*/

add_action( 'init', 'hosts_post');
function hosts_post() {
  register_post_type('our_hosts',
    array(
      'labels' => array(
      'name' => __('Our Hosts'),
      'singular_name' => __('Our Hosts')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'our_hosts'),
    'public' => true,
    'supports' => array('title', 'editor', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes', 'custom-fields'))
  );
}
add_shortcode('list-hosts', 'rmcc_our_hosts');
function rmcc_our_hosts( $atts ) {
  global $post, $wpdb, $sitepress;
  if (defined( 'ICL_LANGUAGE_CODE')) {
      $lang =  ICL_LANGUAGE_CODE;
  }
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'our_hosts',
        "posts_per_page" => -1,
        'suppress_filters' => false
    ) );
    if ( $query->have_posts() ) {   ?>
        <div class="row align-items-center">
            <?php $i=0;  while ( $query->have_posts() ) : $query->the_post();    ?>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="host-inner">
          <?php 
           
            $current_User= get_current_user_id();
            $result = $wpdb->get_results("SELECT status FROM {$wpdb->prefix}favorites  WHERE post_id =".get_the_ID()." AND customer_id =".$current_User); 
            $status = $result[0]->status;
             ?>
                                               
                        <div class="main-favorite-section">
                          <div class="custom-favorite featured-post-<?php echo get_the_ID(); ?>"><a href="javascript:void();" data-lang="<?php echo $lang; ?>" data-id="<?php echo get_the_ID(); ?>" data-user="<?php echo get_current_user_id(); ?>"> <i class="fa fa-star <?php if($status==1){echo 'yellow-color';} ?> " > </i></a></div>
                            <?php  if (has_post_thumbnail( $query->ID )){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id($query->ID ), 'single-post-thumbnail' ); ?>
                            <img src="<?php echo $image[0]; ?>" alt="img"/>
                          <?php  } else { ?>
                            <img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>
                          <?php } ?>
                        </div>
                          <a href="<?php the_permalink(); ?>"> 
                            <div class="pigeon">
                            <h5><?php echo the_title(); ?></h5>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php the_field('h_location'); ?></p>
                        </div>
                    </a>
        </div>
      </div>
            <?php $i++;  endwhile; wp_reset_postdata(); ?>
            <?php $myvariable = ob_get_clean(); return $myvariable; ?>
    </div>
    <?php 
    }
}

/**
 * Removes some menus by page.
 */
function wpdocs_remove_menus(){
   
  remove_menu_page( 'jetpack' );
  //remove_menu_page( 'themes.php' );
  //remove_menu_page( 'plugins.php' );
  //remove_menu_page( 'tools.php' );
  //remove_menu_page( 'options-general.php' );
  //remove_menu_page( 'edit-comments.php' );
  //remove_menu_page( 'upload.php' );
  //remove_menu_page( 'edit.php' );
   
}
add_action( 'admin_menu', 'wpdocs_remove_menus' );
/*-google-map-*/
function my_acf_google_map_api( $api ){  
    $api['key'] = '';   
    return $api;   
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
/*--- zipcode search code ---*/
// function to get  the address
function get_lat_long($address){
  $address = str_replace(" ", "+", $address);
  $address = str_replace(",", "+", $address);
  $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&language=nl&key=");
  $json = json_decode($json);

  if(!empty($json->{'results'})) {
    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    $address = $json->{'results'}[0]->formatted_address;

  } else {
    // did not find adress
    echo _e("Did not find address:", "Swiss ").$address;
    $lat = '';
    $long = '';
    $address = '';
  }
  if($json->{'status'} != 'OK') {
    echo $json->{'status'};
  }

  return array(
    'lat' => floatval($lat),
    'lng' => floatval($long),
    'address' => $address,
    'suppress_filters' => false
  );
}
// funtion for zipcode search
if( ! class_exists( 'WP_Query_Geo' ) ) {
  class WP_Query_Geo extends WP_Query
  {
    private $lat = NULL;
    private $lng = NULL;
    private $dist = NULL;

    function __construct($args = [])
    {
      if( !empty( $args['lat'] ) )
        $this->lat = $args['lat'];

      if( !empty( $args['lng'] ) )
        $this->lng = $args['lng'];

      if( !empty( $args['distance'] ) )
        $this->dist = $args['distance'];

      if( !empty( $args['lat'] ) ) {
        add_filter( 'posts_fields', [$this, 'posts_fields'], 10, 2 );
        add_filter( 'posts_join', [$this, 'posts_join'], 10, 2 );
        add_filter( 'posts_where', [$this, 'posts_where'], 10, 2 );
        add_filter( 'posts_orderby', [$this, 'posts_orderby'], 10, 2 );
      }

      unset( $args['lat'], $args['lng'], $args['distance'] );
      parent::query($args);

      # remove the filters again at the end (Resets for normal wp queries)
      $this->remove_filters();
    }

    /**
     * Selects the distance from a haversine formula
     */
    public function posts_fields($fields)
    {
      global $wpdb, $post;

      $fields .= sprintf(", ( 3959 * acos( 
                                cos( radians( %s ) ) * 
                                cos( radians( lat.meta_value ) ) * 
                                cos( radians( lng.meta_value ) - radians( %s ) ) + 
                                sin( radians( %s ) ) * 
                                sin( radians( lat.meta_value ) ) 
                                ) ) AS distance ", $this->lat, $this->lng, $this->lat);

      $fields .= ", lat.meta_value AS latitude ";
      $fields .= ", lng.meta_value AS longitude ";

      return $fields;

    } // END public function posts_join($join, $query)

    /**
     * Makes joins as necessary in order to select lat/long metadata
     */
    public function posts_join($join, $query)
    {
      global $wpdb, $post;

      $join .= " INNER JOIN {$wpdb->postmeta} AS lat ON {$wpdb->posts}.ID = lat.post_id ";
      $join .= " INNER JOIN {$wpdb->postmeta} AS lng ON {$wpdb->posts}.ID = lng.post_id ";
      return $join;
    } // END public function posts_join($join, $query)

    /**
     * Adds where clauses to compliment joins
     */
    public function posts_where($where)
    {
      $where .= ' AND lat.meta_key="x_location_lat" ';
      $where .= ' AND lng.meta_key="x_location_lng" ';
      $where .= " HAVING distance < {$this->dist}";
      return $where;

    } // END public function posts_where($where)

    /**
     * order posts by distance, then any other term
     * @param  string $orderby
     * @return string
     */
    public function posts_orderby($orderby)
    {
      $orderby = " distance ASC, " . $orderby;

      return $orderby;
    } // END public function posts_orderby($orderby)

    /**
     * remove the filters from the query (this ensures we can keep our other queries clean)
     * @return null
     */
    public function remove_filters()
    {
      remove_filter( 'posts_fields', [$this, 'posts_fields'], 10, 2 );
      remove_filter( 'posts_join', [$this, 'posts_join'], 10, 2 );
      remove_filter( 'posts_where', [$this, 'posts_where'], 10, 2 );
      remove_filter( 'posts_orderby', [$this, 'posts_orderby'], 10, 2 );
    }
  }
}
// END public function
// form to save the zipcode
/*----------Hostmap page-----------------*/
add_action( 'wp_enqueue_scripts', 'my_script_enqueuer' );

function my_script_enqueuer() {
   wp_register_script('my_search_script', get_stylesheet_directory_uri().'/js/seach.js', array('jquery'));
   wp_localize_script('my_search_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_search_script');
}

add_action("wp_ajax_my_search_script", "my_search_script");
add_action("wp_ajax_nopriv_my_search_script", "my_search_script");

function my_search_script() {
  global $post, $wpdb;
  $data = $_REQUEST['value'];
  $type = $_REQUEST['type'];
  //update_post_meta(2,'_wp_custom_data',$data);


  if($type=='HostNamesearch'){
  $args = array("post_type" => "our_hosts", "s" => $data, 'suppress_filters' => false);
  $query = get_posts($args);
    ob_start();
    $response="";
    $map="";
    $mark = 0;
    $home_url = home_url();
    $response.='<div class="row align-items-center">';
    foreach($query as $result){

      $response.='<div class="col-md-6 col-sm-6 col-12">';
      $response.='<div class="host-inner">';
      $response.='<a href="'.get_permalink($result->ID).'">';
      if (has_post_thumbnail( $result->ID )){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
        $response.='<img src="'.$image[0].'" alt="img"/>';
        } else {
        $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
        }
      $response.='<div class="pigeon">';
      $response.='<h5>'.$result->post_title.'</h5>';
      $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'location',true).'</p>';
      $response.='</div>';
      $response.='</a>';
      $response.='</div>';
      $response.='</div>';
      wp_reset_postdata();
      ob_get_clean();
    $mark++;}
    $response.='</div>'; 
    ob_start();
    foreach($query as $mapResult){
            // Load sub field values.
            //echo "<pre>"; print_r($result);
            $title = $mapResult->post_title;
            if (has_post_thumbnail( $mapResult->ID )){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id($mapResult->ID ), 'small' );
                    }
            $lat =  get_post_meta($mapResult->ID,'x_location_lat',true);
            $lng =  get_post_meta($mapResult->ID,'x_location_lng',true); 
            if($lat !=''&& $lng !='') {  
              $file = get_field('host_type_image', $mapResult->ID);     
              $map.='<div class="marker" data-lat="'.$lat.'" data-lng="'.$lng.'" data-icon="'.$file.'">';
              $map.='<a href="'.get_permalink($result->ID).'">';
              if($image[0]){
              $map.='<div class="marker-image"><img src="'.$image[0].'" alt="img"/></div>';
              }else {
              $map.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
              }
              $map.='<div class="marker-title"><h3>'.$title.'</h3></div>';
              $map.='</a>';
              $map.='</div>';
          }
    } 
    wp_reset_postdata();
    ob_get_clean();
    if(!empty($query)){
      $resultSet= array('hosts'=>$response,'mapMarker'=>$map, 'total'=>$mark);
      return wp_send_json($resultSet); die();
    } else {
      $resultSet = " ";
      return wp_send_json($resultSet); die();
    }
  }

  if($type=='Locationsearch') {
      $response="";
      $map="";
      $mark = 0;
      $address = get_lat_long($data);
      if(!empty($address)) {
        $host_args = array(
          'post_type' => 'our_hosts',
          'suppress_filters' => false,
          'posts_per_page' => -1,
          'lat' => $address['lat'],
          'lng' => $address['lng'],
          'distance' => 30
        );
        
        $host_query = new WP_Query_Geo($host_args); 
        if($host_query->have_posts()) {
        $foundaddress = $host_query->posts;
        //update_post_meta(2,'_wp_custom_data',$foundaddress);
        ob_start();
        $home_url = home_url();
        $response.='<div class="row align-items-center">';
        foreach($foundaddress as $result){
          $response.='<div class="col-md-6 col-sm-6 col-12">';
          $response.='<div class="host-inner">';
          $response.='<a href="'.get_permalink($result->ID).'">';
          if (has_post_thumbnail( $result->ID )){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
          $response.='<img src="'.$image[0].'" alt="img"/>';
          } else {
          $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
          }
          $response.='<div class="pigeon">';
          $response.='<h5>'.$result->post_title.'</h5>';
          $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'h_location',true).'</p>';
          $response.='</div>';
          $response.='</a>';
          $response.='</div>';
          $response.='</div>';
          wp_reset_postdata();
           ob_get_clean();
          $mark++;}
        $response.='</div>'; 

          ob_start();
            foreach($foundaddress as $mapResult){
            // Load sub field values.
            //echo "<pre>"; print_r($result);
              $title = $mapResult->post_title;
                if (has_post_thumbnail( $mapResult->ID )){
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id($mapResult->ID ), 'small' );
                        }
              $description = get_sub_field('description');
              $lat =  get_post_meta($mapResult->ID,'x_location_lat',true);
              $lng =  get_post_meta($mapResult->ID,'x_location_lng',true); 
              if($lat !=''&& $lng !='') {
                $file = get_field('host_type_image', $mapResult->ID );       
                $map.='<div class="marker" data-lat="'.$lat.'" data-lng="'.$lng.'" data-icon="'.$file.'">';
                $map.='<a href="'.get_permalink($result->ID).'">';
                if($image[0]) {
                $map.='<div class="marker-image"><img src="'.$image[0].'" alt="img"/></div>';
                }else {
                $map.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
                }
                $map.='<div class="marker-title"><h3>'.$title.'</h3></div>';
                $map.='</a>';
                $map.='</div>';
              }
            } 
        wp_reset_postdata();
        ob_get_clean();
          
        }
      }
    if(!empty($foundaddress)){
      $resultSet= array('hosts'=>$response,'mapMarker'=>$map, 'total'=>$mark);
      return wp_send_json($resultSet); die();

    } else {
      $resultSet = " ";
      return wp_send_json($resultSet); die();
    }

  }

}

/*----------Browse page-----------------*/
add_action( 'wp_enqueue_scripts', 'my_script_enqueuer_browse' );

function my_script_enqueuer_browse() {
   wp_register_script('my_browse_script', get_stylesheet_directory_uri().'/js/hostBrowse.js', array('jquery'));
   wp_localize_script('my_browse_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_browse_script');
}

add_action("wp_ajax_my_browse_script", "my_browse_script");
add_action("wp_ajax_nopriv_my_browse_script", "my_browse_script");

function my_browse_script() {
  global $post, $wpdb;
    $args = array("post_type" => "our_hosts", "posts_per_page" => -1, 'suppress_filters' => false);
    $query = get_posts($args);
    ob_start();
    $response="";
    $map="";
    $mark = 0;
    $home_url = home_url();
    $response.='<h3>'. _e("Our Hosts", "Swiss").'</h3>';
    $response.='<div class="row align-items-center">';
    foreach($query as $result){

      $response.='<div class="col-md-6 col-sm-6 col-12">';
      $response.='<div class="host-inner">';
      $response.='<a href="'.get_permalink($result->ID).'">';
      if (has_post_thumbnail( $result->ID )){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
        $response.='<img src="'.$image[0].'" alt="img"/>';
        } else {
        $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
        }
      $response.='<div class="pigeon">';
      $response.='<h5>'.$result->post_title.'</h5>';
      $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'location',true).'</p>';
      $response.='</div>';
      $response.='</a>';
      $response.='</div>';
      $response.='</div>';
      wp_reset_postdata();
      ob_get_clean();
    $mark++;}
    $response.='</div>'; 
    ob_start();
    foreach($query as $mapResult){
            // Load sub field values.
            //echo "<pre>"; print_r($result);
            $title = $mapResult->post_title;
            if (has_post_thumbnail( $mapResult->ID )){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id($mapResult->ID ), 'small' );
                    }
            $lat =  get_post_meta($mapResult->ID,'x_location_lat',true);
            $lng =  get_post_meta($mapResult->ID,'x_location_lng',true); 
            if($lat !=''&& $lng !='') {
              $file = get_field('host_type_image', $mapResult->ID );      
              $map.='<div class="marker" data-lat="'.$lat.'" data-lng="'.$lng.'" data-icon="'.$file.'">';
              $map.='<a href="'.get_permalink($result->ID).'">';
              if($image[0]){
              $map.='<div class="marker-image"><img src="'.$image[0].'" alt="img"/></div>';
              }else {
              $map.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
              }
              $map.='<div class="marker-title"><h3>'.$title.'</h3></div>';
              $map.='</a>';
              $map.='</div>';
          }
    } 
    wp_reset_postdata();
    ob_get_clean();

    $resultSet= array('hosts'=>$response,'mapMarker'=>$map, 'total'=>$mark);
    return wp_send_json($resultSet); die();
  }

/*--------------------------Account page ----------------------------*/

add_action( 'wp_enqueue_scripts', 'my_script_enqueuer_account' );

function my_script_enqueuer_account() {
   wp_register_script('my_account_search_script', get_stylesheet_directory_uri().'/js/account_search.js', array('jquery'));
   wp_localize_script('my_account_search_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_account_search_script');
}

add_action("wp_ajax_my_account_search_script", "my_account_search_script");
add_action("wp_ajax_nopriv_my_account_search_script", "my_account_search_script");

function my_account_search_script() {
  global $post, $wpdb;
  $data = $_REQUEST['value'];
  $type = $_REQUEST['cat'];
  $optionValue = $_REQUEST['catValue'];

    if($optionValue !='----'){

          global $post, $wpdb;
          //$data = $_REQUEST['value'];
          $response="";
          $map="";
          $mark = 0;
          //$address = get_lat_long($data);
            $host_args = array(
              'post_type' => 'our_hosts',
              'suppress_filters' => false,
              'posts_per_page' => -1,
              'meta_key'    => 'host_type',
              'meta_value'  => $optionValue
            );
            
        $host_query = new WP_Query_Geo($host_args); 
        if($host_query->have_posts()) {
        $foundaddress = $host_query->posts;
        //update_post_meta(2,'_wp_custom_data',$foundaddress);
        ob_start();
        $response.='<h3>Unsere Gastgeber</h3>';
        $response.='<div class="row align-items-center">';
        foreach($foundaddress as $result){
          $response.='<div class="col-md-3 col-sm-3 col-12">';
          $response.='<div class="host-inner">';
          $response.='<a href="'.get_permalink($result->ID).'">';
          if (has_post_thumbnail( $result->ID )){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
          $response.='<img src="'.$image[0].'" alt="img"/>';
          } else {
          $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
          }
          $response.='<div class="pigeon">';
          $response.='<h5>'.$result->post_title.'</h5>';
          $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'h_location',true).'</p>';
          $response.='</div>';
          $response.='</a>';
          $response.='</div>';
          $response.='</div>';
          wp_reset_postdata();
           ob_get_clean();
          $mark++;}
        $response.='</div>';
      }

      if(!empty($foundaddress)){
        $resultSet= array('hosts'=>$response);
        return wp_send_json($resultSet); die();
      } else{
        $response = "";
        return wp_send_json($response); die();
      }

    }

    elseif(!empty($data)) {
      $response="";
      $map="";
      $mark = 0;
      $address = get_lat_long($data);
      if(!empty($address)) {
        $host_args = array(
          'post_type' => 'our_hosts',
          'suppress_filters' => false,
          'posts_per_page' => -1,
          'lat' => $address['lat'],
          'lng' => $address['lng'],
          'distance' => 30
        );
        
        $host_query = new WP_Query_Geo($host_args); 
        if($host_query->have_posts()) {
        $foundaddress = $host_query->posts;
        //update_post_meta(2,'_wp_custom_data',$foundaddress);
        ob_start();
        $response.='<h3>Unsere Gastgeber</h3>';
        $response.='<div class="row align-items-center">';
        foreach($foundaddress as $result){
          $response.='<div class="col-md-3 col-sm-3 col-12">';
          $response.='<div class="host-inner">';
          $response.='<a href="'.get_permalink($result->ID).'">';
          if (has_post_thumbnail( $result->ID )){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
          $response.='<img src="'.$image[0].'" alt="img"/>';
          } else {
          $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
          }
          $response.='<div class="pigeon">';
          $response.='<h5>'.$result->post_title.'</h5>';
          $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'h_location',true).'</p>';
          $response.='</div>';
          $response.='</a>';
          $response.='</div>';
          $response.='</div>';
          wp_reset_postdata();
           ob_get_clean();
          $mark++;}
        $response.='</div>'; 
          
        }
      }

    $resultSet= array('hosts'=>$response);
    if(!empty($foundaddress)){
    return wp_send_json($resultSet); die();
    return false;
    } else {
    
  //}
  //update_post_meta(2,'_wp_custom_data',$data);
  
    
    //else if(!empty($data)){
    ob_start();
    $args = array("post_type" => "our_hosts", "s" => $data, 'suppress_filters' => false);
    $query = get_posts($args);
    $response="";
    $map="";
    $mark = 0;
    $response.='<h3>Unsere Gastgeber</h3>';
    $response.='<div class="row align-items-center">';
    foreach($query as $result){

      $response.='<div class="col-md-3 col-sm-3 col-12">';
      $response.='<div class="host-inner">';
      $response.='<a href="'.get_permalink($result->ID).'">';
      if (has_post_thumbnail( $result->ID )){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
        $response.='<img src="'.$image[0].'" alt="img"/>';
        } else {
        $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
        }
      $response.='<div class="pigeon">';
      $response.='<h5>'.$result->post_title.'</h5>';
      $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'h_location',true).'</p>';
      $response.='</div>';
      $response.='</a>';
      $response.='</div>';
      $response.='</div>';
      wp_reset_postdata();
      ob_get_clean();
    $mark++;}
    $response.='</div>'; 
    if(!empty($query)){
    $resultSet= array('hosts'=>$response);
    return wp_send_json($resultSet); die();
    } else{
       $response = "";
      return wp_send_json($response); die();
    }

  }
    


  }


}

/*---------- Category page -----------------*/
add_action( 'wp_enqueue_scripts', 'my_script_enqueuer_category' );

function my_script_enqueuer_category() {
   wp_register_script('my_category_script', get_stylesheet_directory_uri().'/js/hostcat.js', array('jquery'));
   wp_localize_script('my_category_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_category_script');
}

add_action("wp_ajax_my_category_script", "my_category_script");
add_action("wp_ajax_nopriv_my_category_script", "my_category_script");

function my_category_script() {
      global $post, $wpdb;
      $data = $_REQUEST['value'];
      $response="";
      $map="";
      $mark = 0;
      //$address = get_lat_long($data);
        $host_args = array(
          'post_type' => 'our_hosts',
          'suppress_filters' => false,
          'posts_per_page' => -1,
          'meta_key'    => 'host_type',
          'meta_value'  => $data
        );
        
        $host_query = new WP_Query_Geo($host_args); 
        if($host_query->have_posts()) {
        $foundaddress = $host_query->posts;
        //update_post_meta(2,'_wp_custom_data',$foundaddress);
        ob_start();
        $home_url = home_url();
        $response.='<div class="row align-items-center">';
        foreach($foundaddress as $result){
          $response.='<div class="col-md-6 col-sm-6 col-12">';
          $response.='<div class="host-inner">';
          $response.='<a href="'.get_permalink($result->ID).'">';
          if (has_post_thumbnail( $result->ID )){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
          $response.='<img src="'.$image[0].'" alt="img"/>';
          } else {
          $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
          }
          $response.='<div class="pigeon">';
          $response.='<h5>'.$result->post_title.'</h5>';
          $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'h_location',true).'</p>';
          $response.='</div>';
          $response.='</a>';
          $response.='</div>';
          $response.='</div>';
          wp_reset_postdata();
           ob_get_clean();
          $mark++;}
        $response.='</div>'; 

          ob_start();
            foreach($foundaddress as $mapResult){
            // Load sub field values.
            //echo "<pre>"; print_r($result);
              $title = $mapResult->post_title;
                if (has_post_thumbnail( $mapResult->ID )){
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id($mapResult->ID ), 'small' );
                        }
              $description = get_sub_field('description');
              $lat =  get_post_meta($mapResult->ID,'x_location_lat',true);
              $lng =  get_post_meta($mapResult->ID,'x_location_lng',true); 
              if($lat !=''&& $lng !='') {
                $file = get_field('host_type_image', $mapResult->ID );       
                $map.='<div class="marker" data-lat="'.$lat.'" data-lng="'.$lng.'" data-icon="'.$file.'">';
                $map.='<a href="'.get_permalink($result->ID).'">';
                if($image[0]) {
                $map.='<div class="marker-image"><img src="'.$image[0].'" alt="img"/></div>';
                }else {
                $map.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
                }
                $map.='<div class="marker-title"><h3>'.$title.'</h3></div>';
                $map.='</a>';
                $map.='</div>';
              }
            } 
        wp_reset_postdata();
        ob_get_clean();
          
        }
    if(!empty($foundaddress)){
      $resultSet= array('hosts'=>$response,'mapMarker'=>$map, 'total'=>$mark);
      return wp_send_json($resultSet); die();

    } else {
      $resultSet = " ";
      return wp_send_json($resultSet); die();
    }

}

/*---------- Tag page -----------------*/
add_action( 'wp_enqueue_scripts', 'my_script_enqueuer_tag' );

function my_script_enqueuer_tag() {
   wp_register_script('my_tag_script', get_stylesheet_directory_uri().'/js/hostTag.js', array('jquery'));
   wp_localize_script('my_tag_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_tag_script');
}

add_action("wp_ajax_my_tag_script", "my_tag_script");
add_action("wp_ajax_nopriv_my_tag_script", "my_tag_script");

function my_tag_script() {
  
    $data = $_REQUEST['value'];
    $meta_query = array();
    $meta_query['relation'] = 'AND';
    foreach($data as $tag){

if(!empty($tag['name'])){
      $meta_query[] = array(
        'key'   => 'search_filter_'.$tag['index'].'_filter_name',
        'value'   => $tag['name'],
        'compare' => '=' );
      }
    }
      $response="";
      $map="";
      $mark = 0;
      //$address = get_lat_long($data);
     
        $host_args = array(
          'post_type' => 'our_hosts',
          'suppress_filters' => false,
          'posts_per_page' => -1,
          'meta_query'     => $meta_query
          
        );
        
        $host_query = new WP_Query_Geo($host_args); 

        //echo "<pre>"; print_r($host_query); echo "</pre>";
        if($host_query->have_posts()) {
        $foundaddress = $host_query->posts;
        //update_post_meta(2,'_wp_custom_data',$foundaddress);
        ob_start();
        $home_url = home_url();
        $response.='<div class="row align-items-center">';
        foreach($foundaddress as $result){
          $response.='<div class="col-md-6 col-sm-6 col-12">';
          $response.='<div class="host-inner">';
          $response.='<a href="'.get_permalink($result->ID).'">';
          if (has_post_thumbnail( $result->ID )){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID ), 'single-post-thumbnail' );
          $response.='<img src="'.$image[0].'" alt="img"/>';
          } else {
          $response.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
          }
          $response.='<div class="pigeon">';
          $response.='<h5>'.$result->post_title.'</h5>';
          $response.='<p><i class="fa fa-map-marker" aria-hidden="true"></i>'.get_post_meta($result->ID,'h_location',true).'</p>';
          $response.='</div>';
          $response.='</a>';
          $response.='</div>';
          $response.='</div>';
          wp_reset_postdata();
           ob_get_clean();
          $mark++;}
        $response.='</div>'; 

          ob_start();
            foreach($foundaddress as $mapResult){
            // Load sub field values.
            //echo "<pre>"; print_r($result);
              $title = $mapResult->post_title;
                if (has_post_thumbnail( $mapResult->ID )){
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id($mapResult->ID ), 'small' );
                        }
              $description = get_sub_field('description');
              $lat =  get_post_meta($mapResult->ID,'x_location_lat',true);
              $lng =  get_post_meta($mapResult->ID,'x_location_lng',true); 
              if($lat !=''&& $lng !='') {
                $file = get_field('host_type_image', $mapResult->ID );       
                $map.='<div class="marker" data-lat="'.$lat.'" data-lng="'.$lng.'" data-icon="'.$file.'">';
                $map.='<a href="'.get_permalink($result->ID).'">';
                if($image[0]) {
                $map.='<div class="marker-image"><img src="'.$image[0].'" alt="img"/></div>';
                }else {
                $map.='<img src="/wp-content/uploads/2021/06/dummy-image-300x214-2.jpg" alt="img"/>';
                }
                $map.='<div class="marker-title"><h3>'.$title.'</h3></div>';
                $map.='</a>';
                $map.='</div>';
              }
            } 
        wp_reset_postdata();
        ob_get_clean();
          
        }
    if(!empty($foundaddress)){
      $resultSet= array('hosts'=>$response,'mapMarker'=>$map, 'total'=>$mark);
      return wp_send_json($resultSet); die();

    } else {
      $resultSet = " ";
      return wp_send_json($resultSet); die();
    }

}

/*------------------------------- current language -------------------------------*/
global $sitepress;
if (defined( 'ICL_LANGUAGE_CODE')) {
  $Clang =  ICL_LANGUAGE_CODE;
}

/*-------------------- end --------------------------*/ 
/*------------- Expert on blog page -----------------------*/

function is_blog () {
  global  $post;
  $posttype = get_post_type($post );
  return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}
/*-------------------------------------*/

/* funtion to save lat,log vale in db*/
function rhm_update_latlon($post_id, $post, $update) {

  $map = get_post_meta($post_id, 'parking_information_google_map', true);

  if (!empty($map)) {
      update_post_meta( $post_id, 'x_location_lat', $map['lat'] );
      update_post_meta( $post_id, 'x_location_lng', $map['lng'] );
      update_post_meta( $post_id, 'x_hosts_lang', $Clang);
      
  }

}
add_action('save_post', 'rhm_update_latlon', 90, 3);

/*---- adding login logout link to menu -------------*/
add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'primary') {

        global $sitepress;
        if (defined( 'ICL_LANGUAGE_CODE')) {
          $lang =  ICL_LANGUAGE_CODE;
        }
        if($lang =='de') { 
          $link1= get_page_link('49');
          $link2= '/mitgliedskonto/mitgliedschafts-checkout/?level=3';
        } elseif($lang =='en'){ 
         $link1= get_page_link('5985') ;
         $link2= '/member-account/membership-checkout/?lang=en&level=3';
        }
        elseif($lang =='it'){ 
         $link1= get_page_link('6643') ;
         $link2= '/conto-del-membro/controllo-delliscrizione/?lang=it&level=3';
        }
        elseif($lang =='fr'){ 
         $link1= get_page_link('8964') ;
         $link2= '/compte-membre/verification-de-ladhesion/?lang=fr&level=3';
        }


      if (is_user_logged_in()) {
         $items .= '<li class="mobile-right"><a href="'.$link1.'">'. __("Hallo, swiss", "Swiss") .$current_user->user_nicename.'</a></li><li class="right"><a href="'. wp_logout_url() .'">'. __("Ausloggen", "Swiss") .'</a></li>';
      } else {
         $items .= '<li class="mobile-right"><a href="'.$link2.'">'. __("Join Now", "Swiss") .'</a></li><li class="right"><a href="'. wp_login_url() .'">'. __("Einloggen", "Swiss") .'</a></li>';
      }
   }
   return $items;
}

/* comment rating code */
add_action( 'comment_form_logged_in_after', 'ci_comment_rating_rating_field' );
add_action( 'comment_form_after_fields', 'ci_comment_rating_rating_field' );
function ci_comment_rating_rating_field () {
?>
<!-- <label for="rating">Rating<span class="required">*</span></label> -->
<label for="rating"><?php _e('Rating', 'swiss' );?><span></span></label>
<fieldset class="comments-rating">
<span class="rating-container">
<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
<input type="radio" id="rating-<?php echo esc_attr( $i ); ?>" name="rating" value="<?php echo esc_attr( $i ); ?>" /><label for="rating-<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></label>
<?php endfor; ?>
<input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0">0</label>
</span>
</fieldset>
<?php
}

//Save the rating submitted by the user.
add_action( 'comment_post', 'ci_comment_rating_save_comment_rating' );
function ci_comment_rating_save_comment_rating( $comment_id ) {
 global $sitepress;
if (defined( 'ICL_LANGUAGE_CODE')) {
  $Clang =  ICL_LANGUAGE_CODE;
}
if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) )
$rating = intval( $_POST['rating'] );
add_comment_meta( $comment_id, 'rating', $rating );
add_comment_meta( $comment_id, 'comment_lang', $Clang);
}

//Make the rating required.
//add_filter( 'preprocess_comment', 'ci_comment_rating_require_rating' );
function ci_comment_rating_require_rating( $commentdata ) {
if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( $_POST['rating'] ) ) )
wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
return $commentdata;
}

//Display the rating on a submitted comment.
add_filter( 'comment_text', 'ci_comment_rating_display_rating');
function ci_comment_rating_display_rating( $comment_text ){

if ( $rating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
$stars = '<p class="stars">';
for ( $i = 1; $i <= $rating; $i++ ) {
$stars .= '<span class="dashicons dashicons-star-filled"></span>';
}
$stars .= '</p>';
$comment_text = $comment_text . $stars;
return $comment_text;
} else {
return $comment_text;
}
}

//Get the average rating of a post.
function ci_comment_rating_get_average_ratings( $id ) {
$comments = get_approved_comments( $id );

if ( $comments ) {
$i = 0;
$total = 0;
foreach( $comments as $comment ){
$rate = get_comment_meta( $comment->comment_ID, 'rating', true );
if( isset( $rate ) && '' !== $rate ) {
$i++;
$total += $rate;
}
}

if ( 0 === $i ) {
return false;
} else {
return round( $total / $i, 1 );
}
} else {
return false;
}
}

//Display the average rating above the content.
//add_filter( 'the_content', 'ci_comment_rating_display_average_rating' );
function ci_comment_rating_display_average_rating( $content ) {

global $post;

if ( false === ci_comment_rating_get_average_ratings( $post->ID ) ) {
return $content;
}

$stars   = '';
$average = ci_comment_rating_get_average_ratings( $post->ID );

for ( $i = 1; $i <= $average + 1; $i++ ) {

$width = intval( $i - $average > 0 ? 20 - ( ( $i - $average ) * 20 ) : 20 );

if ( 0 === $width ) {
continue;
}

$stars .= '<span style="overflow:hidden; width:' . $width . 'px" class="dashicons dashicons-star-filled"></span>';

if ( $i - $average > 0 ) {
$stars .= '<span style="overflow:hidden; position:relative; left:-' . $width .'px;" class="dashicons dashicons-star-empty"></span>';
}
}

$custom_content  = '<p class="average-rating">This post\'s average rating is: ' . $average .' ' . $stars .'</p>';
$custom_content .= $content;
return $custom_content;
}
/* end */

add_action( 'wp_enqueue_scripts', 'comments_js' );
function comments_js() {
   wp_register_script('my_comment_script', get_stylesheet_directory_uri().'/js/comments.js', array('jquery'));
   wp_localize_script('my_comment_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_comment_script');
}


add_action('wp_ajax_my_comment_script', 'comments_loadmore_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_my_comment_script', 'comments_loadmore_handler'); // wp_ajax_nopriv_{action}
 
function comments_loadmore_handler(){
global $post, $wpdb;
$row = $_REQUEST['cpage'];
$postId = $_REQUEST['post_id'];
$rowperpage = 1;
$query = "SELECT * FROM $wpdb->comments";
$query .= " JOIN $wpdb->posts ON ID = comment_post_ID";
$query .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
$query .= " AND ID='{$postId}' ";
$query .= " ORDER BY comment_date DESC LIMIT ".$row.", ".$rowperpage;
$comments = $wpdb->get_results($query);

$commentt='';
ob_start();
foreach ( $comments as $comment ) { 
$commentt.='<div class="reviews">';
if($comment->comment_post_ID == $_REQUEST['post_id']){
$user_image_url = get_user_meta( $comment->user_id,'_user_image', $single=true);
if(!empty($user_image_url)){
$commentt.='<img src="'.$user_image_url.'" alt="img">';
} else {
$commentt.='<img src="'.get_stylesheet_directory_uri().'"/images/profile.png" alt="img">';
}
$commentt.='<div class="reviews-text">';
if ( $rating = get_comment_meta( $comment->comment_ID , 'rating', true ) ) {
$commentt.='<ul>';
for ( $i = 1; $i <= $rating; $i++ ) {
$commentt.='<li><i class="fa fa-star" aria-hidden="true"></i></li>';
}
$commentt.='</ul>';
}
$commentt.='<h6>'.$comment->comment_author.'</h6>';
$commentt.='<p>'.date('d/m/y',strtotime($comment->comment_date)).'</p><p>';
$image_id = get_comment_meta( $comment->comment_ID , 'attachment_id', true );
if((array)$image_id) {
foreach ( (array) $image_id as $attach_id ) {
wp_get_attachment_image( $attach_id, array('300', '300'), "", array("class" => "img-responsive custom-comment-image"));
}
} else {
wp_get_attachment_image( $image_id, array('300', '300'), "", array("class" => "img-responsive custom-comment-image"));
}
$commentt.='</p>';
$commentt.='<p>'.$comment->comment_content.'</p>';
$commentt.='</div>';
}
$commentt.='</div>';
$j++;}

wp_reset_postdata();
ob_get_clean();  
return wp_send_json($commentt); die();
}

//add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Modifies Paid Memberships Pro to include more profile fields.
 *
 */
function mytheme_add_fields_to_signup(){
  //don't break if Register Helper is not loaded
  if(!function_exists( 'pmprorh_add_registration_field' )) {
    return false;
  }

global $sitepress;
if (defined( 'ICL_LANGUAGE_CODE')) {
  $Clang =  ICL_LANGUAGE_CODE;
}

if($Clang == 'en') {

  $link_data = "<a href='/agb/?lang=en'>I agree to the Terms and Conditions.</a>"; 
  $link_label = 'Yes, I would like to receive the newsletter for important member information.';

}elseif($Clang == 'it'){

  $link_data = "<a href='/agb/?lang=it'>Accetto Termini e Condizioni.</a>"; 
  $link_label = 'Sì, desidero ricevere la newsletter per informazioni importanti sui membri.';

}elseif($Clang == 'fr'){

  $link_data = "<a href='/cgv/?lang=fr'>J'accepte les termes et conditions.</a>"; 
  $link_label = 'Oui, je souhaite recevoir la newsletter pour des informations importantes sur les membres.';

}else{

  $link_data = "<a href='/agb/'>Ich stimme den AGB's zu.</a>"; 
  $link_label = 'Ja, ich möchte den Newsletter für wichtige Mitgliederinformationen erhalten.';

}

  
  
  $fields = array();

  $fields[] = new PMProRH_Field(
    'mytheme_phone',// input name, will also be used as meta key
    'checkbox', // type of field
    array(
      'label'   => $link_data,// custom field label
      'size'    => 20,// input size
      'profile' => true,// show in user profile
      'required'  => true, // make this field require
      'location' => 'before_submit_button',
    )
  );

  $fields[] = new PMProRH_Field(
    'mytheme_chk', // input name, will also be used as meta key
    'checkbox', // type of field
      array(
      'label'   => $link_label,// custom field label
      'size'    => 20,// input size
      'profile' => true,// show in user profile
      'required'  => false, // make this field require
      'location' => 'before_submit_button',
    )
  );

//add the fields to default forms
  foreach($fields as $field){
    pmprorh_add_registration_field(
      $field->location,// location on checkout page
      $field// PMProRH_Field object
    );
  }
}
add_action( 'init', 'mytheme_add_fields_to_signup' );

// add_action('wp_logout','auto_redirect_external_after_logout');
// function auto_redirect_external_after_logout(){
//   wp_redirect( 'https://www.swiss-hosts.ch/einloggen/' );
//   exit();
// }

add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
    global $sitepress;
    if (defined( 'ICL_LANGUAGE_CODE')) {
      $lang =  ICL_LANGUAGE_CODE;
    }
  if($lang =='de') { 
    wp_safe_redirect('/einloggen/');
  } elseif($lang =='en'){ 
    wp_safe_redirect('/log-in/?lang=en');
  }
  elseif($lang =='it'){ 
    wp_safe_redirect('/entrare/?lang=it');
  }
  elseif($lang =='fr'){ 
    wp_safe_redirect('/connectez-vous/?lang=fr');
  }
  exit;
}

function custom_login_redirect( $redirect_to, $request, $user ) {
  global $sitepress;
    if (defined( 'ICL_LANGUAGE_CODE')) {
      $lang =  ICL_LANGUAGE_CODE;
    }
if ( isset( $user->roles ) && is_array( $user->roles ) ) {
if ( in_array( 'administrator', $user->roles )) {
$redirect_to = admin_url();
} else {
  if($lang =='de') { 
    $redirect_to = '/mitgliedskonto/';
  } elseif($lang =='en'){
   $redirect_to = '/member-account/?lang=en'; 
  }
  elseif($lang =='it'){
   $redirect_to = '/conto-del-membro/?lang=it'; 
  }
  elseif($lang =='fr'){
   $redirect_to = '/compte-membre/?lang=fr'; 
  }
}
}
return $redirect_to;
}
add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );

/*--------------------------favrites ----------------------------*/

add_action( 'wp_enqueue_scripts', 'my_script_enqueuer_favorite' );

function my_script_enqueuer_favorite() {
   wp_register_script('my_favorite_script', get_stylesheet_directory_uri().'/js/favorite-post.js', array('jquery'));
   wp_localize_script('my_favorite_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php')));        
   wp_enqueue_script('jquery');
   wp_enqueue_script('my_favorite_script');
}

add_action("wp_ajax_my_favorite_script", "my_favorite_script");
add_action("wp_ajax_nopriv_my_favorite_script", "my_favorite_script");

function my_favorite_script() {
  global $post, $wpdb;
  $postID = $_REQUEST['post'];
  $userID = $_REQUEST['user'];
  $userLang = $_REQUEST['lang'];

$result = $wpdb->get_results("SELECT post_id FROM {$wpdb->prefix}favorites  WHERE post_id =".$postID." AND customer_id =".$userID." AND customer_lang = '$userLang'");

$fav = $result[0]->post_id;

if($fav == $postID){

$sql = "delete from {$wpdb->prefix}favorites  WHERE post_id=".$postID." AND customer_id=".$userID." AND customer_lang= '$userLang'";
$wpdb->query($sql);
$action = 0; 

} else {

$sql = "INSERT INTO {$wpdb->prefix}favorites (post_id, customer_id, customer_lang, status, startDate) VALUES ('$postID', '$userID', '$userLang', 1, CURRENT_TIMESTAMP)";
$wpdb->query($sql); 
$action = 1; 

}
$resultSet= array('action'=>$action, 'postId'=>$postID);
return wp_send_json($resultSet); die();


}

/*------------------------------- Gift card functionality-------------------------------*/

add_filter( 'woocommerce_email_attachments', 'webroom_attach_to_wc_emails', 10, 3);
function webroom_attach_to_wc_emails ($attachments, $email_id, $order) {
  global $wpdb; 
  // Avoiding errors and problems
   if( $email_id != 'customer_completed_order' ){
        return $attachments;
    }

  /*----------------- PMPro -------------------------*/
  $gift = '3';
  //create new gift code
  $code = "G" . pmpro_getDiscountCode();
  $starts = date("Y-m-d", strtotime("-1 day"));
  $expires = date("Y-m-d", strtotime("+1 year"));
  $gift_code_settings = apply_filters( 'pmprogl_gift_code_settings', array('code' => $code, 'starts' => $starts, 'expires' => $expires, 'uses' => 1 ) );
  // Set variables and escape them right before the SQL query.
  $gcode = esc_sql( $gift_code_settings['code'] );
  $gstarts = esc_sql( $gift_code_settings['starts'] );
  $gexpires = esc_sql( $gift_code_settings['expires'] );
  $guses = esc_sql( $gift_code_settings['uses'] );
      
  $sqlQuery = "INSERT INTO $wpdb->pmpro_discount_codes (code, starts, expires, uses) VALUES('" . esc_sql($gcode) . "', '" . $gstarts . "', '" . $gexpires . "', '$guses')";
  
  if($wpdb->query($sqlQuery) !== false)
  {
      //get id of new code
      $code_id = $wpdb->insert_id;
      //add code to level
      $sqlQuery = "INSERT INTO $wpdb->pmpro_discount_codes_levels (code_id, level_id, initial_payment, billing_amount, cycle_number, cycle_period, billing_limit, trial_amount, trial_limit, expiration_number, expiration_period) VALUES('" . esc_sql($code_id) . "',
                             '" . esc_sql(3) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(0) . "',
                             '" . esc_sql(1) . "',
                             '" . esc_sql('Year') . "')";
      $wpdb->query($sqlQuery);
      //get existing gift codes
      $code = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_discount_codes WHERE id = '" . intval($code_id) . "' LIMIT 1"); 
  }

  if($code->code){
        require_once(dirname(__FILE__).'/TCPDF/tcpdf.php');
        // Extend the TCPDF class to create custom Header and Footer
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //$pdf->SetMargins(5,5,5);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        // remove default footer
        $pdf->setPrintFooter(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetMargins(5, 5, 5, true);
        $pdf->AddPage('L');
        // Print a text
        $html = '<div class="main-img-inner" style="text-align:center; vertical-align:middle;">
              <div class="swiss-pdf">
                <img src="'.K_PATH_IMAGES.'/logo.png" alt="img" style="width:260px; height:50px; margin-bottom: 8px;">
                <h1 style="font-size: 36px; color: #ffffff; font-family: "BegumSans-Regular" line-height:18px;
    color: #ffffff;text-transform: uppercase;margin-bottom: 9px;">GUTSCHEIN</h1>
            <h4 style="font-size: 19px; color: #ffffff; font-family: "BegumSans-Medium"; font-weight:100">Mit Swiss-Hosts entdeckst du tolle<br>Übernachtungsplätze bei unseren Gastgebern<br> in der Schweiz.</h4>
            <h4 style="font-size: 19px; color: #ffffff; font-family: "BegumSans-Medium";">GENUSS, IDYLLE & CAMPING</h4>
            <div class="swiss-pdf-inner" style="margin-top:70px;">
              <h3 style="font-size: 21px;color: #ffffff; font-family: "BegumSans-Medium";">DEIN PERSÖNLICHER GUTSCHEINCODE:</h3>
              <h3 style="font-size: 28px;color: #ffffff; font-family: "BegumSans-Medium";">'.$code->code.'</h3>
              <img src="'.K_PATH_IMAGES.'/bus.png" alt="img" style="width:80px; height:60px;">
              <p style="margin-top:18px; font-size:18px; color: #ffffff; letter-spacing:5px; font-family:"BegumSans-Medium";">Gutschein für eine Jahresmitgliedschaft<br>
              www.swiss-hosts.ch </p>       
            </div>
          </div>
        </div>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $upload_dir = wp_upload_dir();
        $pdfdoc =  $pdf->Output($upload_dir['basedir'].'/pdf/'.$code->code.'.pdf', 'F'); 
        $user_dirname = $upload_dir['basedir'].'/pdf/'.$code->code.'.pdf';
  }
      
  /*------------------- end ------------------------------*/
  $attachments[] = $user_dirname;
  return $attachments;

}

/* Remove Categories from Single Products */
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta', 40 );
add_action('template_redirect', 'remove_shop_breadcrumbs' );
function remove_shop_breadcrumbs(){
    if (is_shop())
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

/*------------------------- single product page------------------------------*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );

/*----------------------- cart button name --------------------*/
// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Gutschein kaufen', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Gutschein kaufen', 'woocommerce' );
}

/*----------------------- shop page redirect --------------------*/
function wpc_shop_url_redirect() {
    if( is_shop() ){
        wp_redirect(home_url('/produkt/gutschein/'));
        exit();
    }
}
add_action( 'template_redirect', 'wpc_shop_url_redirect' );
/*----------------------- Remove billing fields --------------------*/
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
unset($fields['billing']['billing_state']);
return $fields;
}

/*---------------------- Checkbox for physical delivery of vauchor ------------------------*/


// Add the fields to the checkout
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );
function my_custom_checkout_field( $checkout ) {
    echo '<div class="cw_custom_class">';
   $voucher_order =
    woocommerce_form_field( 'voucher_list', array(
        'type'          => 'checkbox',
        'label'         => __("Ja, Geschenkgutschein an die angegebene Adresse schicken", "woocommerce"),
        'required'  => false,
    ), $checkout->get_value( 'voucher_list' ) );

    echo '</div>';
}

// Update the order meta with fields values
add_action( 'woocommerce_checkout_create_order', 'custom_checkout_field_create_order', 10, 2 );
function custom_checkout_field_create_order( $order, $data ) {

    if ( isset($_POST['voucher_list']) ) {
        $order->update_meta_data( '_voucher_order', 'ja' );
    }
}

// Add the fields to order email
add_action('woocommerce_email_order_details', 'action_after_email_order_details', 25, 4 );
function action_after_email_order_details( $order, $sent_to_admin, $plain_text, $email ) {

    if( $voucher_order = $order->get_meta('_voucher_order') ) {
        // The data 1
        $label2 = __('Zustellung des Gutscheins    per Post');
        $value2 = $voucher_order;
    }

    if(isset($value2) ){
        // The HTML Structure
        $html_output = '<h2>' . __('Zustellung des Gutscheins') . '</h2>
        <div class="discount-info"><table cellspacing="0" cellpadding="6">';
        if( isset($value2) ){
            $html_output .= '<tr><th>' . $label2 . '</th><td>' . $value2 . '</td></tr>';
        }
        $html_output .= '</tr></tbody></table></div><br>';

        // The CSS styling
        $styles = '<style>
            .discount-info table{width: 100%; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;
                color: #737373; border: 2px solid #e4e4e4; margin-bottom:8px;}
            .discount-info table th, table.tracking-info td{ text-align: left; color: #737373; border: none; padding: 12px;}
            .discount-info table td{ text-align: left; color: #737373; border: none; padding: 12px; }
        </style>';

        // The Output CSS + HTML
        echo $styles . $html_output;
    }
}
// Display field value on the order edit page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta( $order ) {
    $voucher_order = $order->get_meta('_voucher_order');
    $value = $voucher_order === 'ja' ? 'ja' : 'No';
    echo '<p><strong>'.__('Zustellung des Gutscheins an diese Lieferadresse').'</strong> ' . $value . '</p>';
}

/*------------------------------- Admin email for phycial delivery-------------------------------*/

add_filter( 'woocommerce_email_attachments', 'admin_attach_to_wc_emails', 10, 3);
function admin_attach_to_wc_emails ($attachments, $email_id, $order) {
  global $wpdb;
  // $voucher_order = $order->get_meta('_voucher_order');
  // if( $voucher_order != 'Yes' ){
  //       return $attachments;
  //   }
  // Avoiding errors and problems
   if( $email_id != 'new_order' ){
        return $attachments;
    }

    $code_id = $wpdb->insert_id;
    $code = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_discount_codes ORDER BY id DESC LIMIT 1"); 
    if($code->code){
        require_once(dirname(__FILE__).'/TCPDF/tcpdf.php');
        // Extend the TCPDF class to create custom Header and Footer
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //$pdf->SetMargins(5,5,5);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        // remove default footer
        $pdf->setPrintFooter(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetMargins(5, 5, 5, true);
        $pdf->AddPage('L');
        // Print a text
        $html = '<div class="main-img-inner" style="text-align:center; vertical-align:middle;">
              <div class="swiss-pdf">
                <img src="'.K_PATH_IMAGES.'/logo.png" alt="img" style="width:260px; height:50px; margin-bottom: 8px;">
                <h1 style="font-size: 36px; color: #ffffff; font-family: "BegumSans-Regular" line-height:18px;
    color: #ffffff;text-transform: uppercase;margin-bottom: 9px;">GUTSCHEIN</h1>
            <h4 style="font-size: 19px; color: #ffffff; font-family: "BegumSans-Medium"; font-weight:100">Mit Swiss-Hosts entdeckst du tolle<br>Übernachtungsplätze bei unseren Gastgebern<br> in der Schweiz.</h4>
            <h4 style="font-size: 19px; color: #ffffff; font-family: "BegumSans-Medium";">GENUSS, IDYLLE & CAMPING</h4>
            <div class="swiss-pdf-inner" style="margin-top:70px;">
              <h3 style="font-size: 21px;color: #ffffff; font-family: "BegumSans-Medium";">DEIN PERSÖNLICHER GUTSCHEINCODE:</h3>
              <h3 style="font-size: 28px;color: #ffffff; font-family: "BegumSans-Medium";">'.$code->code.'</h3>
              <img src="'.K_PATH_IMAGES.'/bus.png" alt="img" style="width:80px; height:60px;">
              <p style="margin-top:18px; font-size:18px; color: #ffffff; letter-spacing:5px; font-family:"BegumSans-Medium";">Gutschein für eine Jahresmitgliedschaft<br>
              www.swiss-hosts.ch </p>       
            </div>
          </div>
        </div>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $upload_dir = wp_upload_dir();
        $pdfdoc =  $pdf->Output($upload_dir['basedir'].'/pdf/'.$code->code.'.pdf', 'F'); 
        $user_dirname = $upload_dir['basedir'].'/pdf/'.$code->code.'.pdf';
  }
      
  /*------------------- end ------------------------------*/
  $attachments[] = $user_dirname;
  return $attachments;

}

/*------------------- change country name ---------------------*/

/**
* Rename a country
*/
add_filter( 'woocommerce_countries', 'rename_Schweiz' );
function rename_Schweiz( $countries ) {
$countries['CH'] = 'Schweiz';
return $countries;
}
//add_filter('use_block_editor_for_post', '__return_false', 10);

/*----------------- Redirect to thankyou page --------------------*/

// function my_pmpro_confirmation_redirect()
// {
//   $confirmation_pages = array(3 => 2);  //change this use your membership level ids and page ids
  
//   global $pmpro_pages;
  
//   if(is_page($pmpro_pages['confirmation']))
//   {
//     foreach($confirmation_pages as $clevel => $cpage)
//     {
//       if(pmpro_hasMembershipLevel($clevel))
//       {       
//         wp_redirect(get_permalink($cpage));
//         exit;
//       }
//     }
//   }
// }
//add_action("wp", "my_pmpro_confirmation_redirect");

// function my_pmpro_confirmation_url($rurl, $user_id, $pmpro_level)
// {
//   if(pmpro_hasMembershipLevel(3))
//     $rurl = "https://www.swiss-hosts.ch/?page_id=13992";
//   //elseif(pmpro_hasMembershipLevel(2))
//     //$rurl = "http://example.com/page_2";
//   //elseif(pmpro_hasMembershipLevel(3))
//     $//rurl = "http://example.com/page_3";
//   return $rurl;
// }
//add_filter('pmpro_confirmation_url', 'my_pmpro_confirmation_url', 10, 3);
