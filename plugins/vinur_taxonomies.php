<?php


/**
 * function create_custom_taxonomies
 * 
 * Create custom taxonomies for use when registering post types
 *
 * @param taxonomy name
 * @param object_type which post type this new taxonomy refers to
 * @param args array of properties describing the new taxonomy
 *
 * @return void
 * @author Rich Holman
 *
 **/

function create_custom_taxonomies()
{

  // Region taxonomy
  register_taxonomy('region', array(), array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x( 'Region', 'taxonomy general name' ),
      'singular_name' => _x( 'Region', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Region' ),
      'popular_items' => __( 'Popular Region' ),
      'all_items' => __( 'All region' ),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __( 'Edit Region' ),
      'update_item' => __( 'Update Region' ),
      'add_new_item' => __( 'Add New Region' ),
      'new_item_name' => __( 'New Region Name' ),
      'separate_items_with_commas' => __( 'Separate Region with commas' ),
      'add_or_remove_items' => __( 'Add or remove Region' ),
      'choose_from_most_used' => __( 'Choose from the most used Region'),
    ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'region' ),
  ));
  
 }

/**
 * register_existing_posts_types_with_taxonomies
 *
 * Let us apply taxonomies to blog posts
 * Adding these direct
 *
 * @return void
 * @author Rich Holman
 **/

function register_existing_posts_types_with_taxonomies()
  {
    register_taxonomy_for_object_type('region', 'post');
  }


/**
 * register_new_post_types_with_taxonomies
 *
 * Because bfc_taxonomies is loaded later than bfc_post_types,
 * registering these taxonomies in the role definition won't work.
 * Calling them here lets us use the same action hook, and keeps the registration
 * of taxonomies in a single file.
 * 
 * @return true
 * @author Chris Adams
 **/
function register_new_post_types_with_taxonomies()
{
  $post_types = array('post', 'casestudy');
  $taxonomies = array('region');

  foreach ($post_types as $content_type) {
    foreach($taxonomies as $tax) {
	if(!register_taxonomy_for_object_type($tax, $content_type)) {
		return new WP_Error('taxonomy registration error', "Trouble registering taxonomy $tax on $content_type", array($taxonomies, $post_types));      
	}
    }

  }

}

/**
 *  Add Wordpress' default taxonomies to custom posts.
 *  For reasons best know to wordpress, we have to use the 'init' hook
 *  for adding them.
 *
 *  http://www.deluxeblogtips.com/2010/07/custom-post-type-with-categories-post.html
 *
 * @return true,
 * @author Chris Adams
 * 
 * added study here (it activitates categories and tags
 * @author Nicholas Alexander
 **/
function register_default_taxonomies_with_new_post_types()
{
  $post_types = array('casestudy', 'lead_article');
  $taxonomies = array('post_tag', 'category');

  foreach ($post_types as $content_type) {
    foreach($taxonomies as $tax)
    {
      if(!register_taxonomy_for_object_type($tax, $content_type)) {
        return new WP_Error('taxonomy registration error', "Trouble registering taxonomy $tax on $content_type", array($taxonomies, $post_types));
      };
    }
  }

}


/**
 * function prepopulate_region_taxonomy_with_countries
 *
 * see prepopulate_taxonomy_with_countries() below
 *
 * @return void
 * @author Chris Adams
 **/
function prepopulate_region_taxonomy_with_countries()
{
	prepopulate_taxonomy_with_countries('region');
}

/**
 *
 * allow country lists to be used to populate wp_insert_term with func=insert
 * or for other select lists with func=build, returns array for select lists
 *
 * To avoid having to manually add a load of countries, we query a third party source
 * that provides this in a format that's easily readable.
 * In our case we're querying the WorldBank API for a list of
 * countries, as there aren't many update sources that readily
 * convert to a format we can use here.
 *
 * This function
 * a) fetches an xml list from the World Bank's API
 * b) creates a wp taxonomy term for each country in the list, in the 'region' taxonomy
 *
 * @return void (default)
 * @return array (if func=build)
 * @author Chris Adams 
 * @author Nicholas Alexander
 */
function prepopulate_taxonomy_with_countries($fieldname='region',$func='insert')
{
  // create a new DOM object to do all the heavy lifting
  $odoc = new DOMDocument('1.0', 'utf-8');

  // DOMDocument can do HTTP transactions, so lets use it.
  $odoc->load('http://api.worldbank.org/country?per_page=300&region=WLD');

  // create a new object to perform our xpath queries
  $xpath = new DOMXpath($odoc);
  // pull out a collection of countries from the xml doc
  $countries = $xpath->query('//wb:country');

  $country_list = array();
  // iterate through list, creating a term with name and country ISO ID
  // for each country
  for ($i = 0; $i < $countries->length ; $i++) {
    $country = $countries->item($i) ;
    // add ISO code
    $id = $country->attributes->getNamedItem('id')->nodeValue;
    // add country name
    $name = $xpath->query('wb:name', $country)->item(0)->nodeValue;

    // add the taxonomy terms
    if ( $func == 'insert' ) {
      wp_insert_term($name, $fieldname, 
        array(
          'slug' => $id,
          'description' => $id
        ) 
      );
    } else if ( $func == 'build' ) {
      $country_list[$id] = $name;
    }
  }
  if ( $func == 'build' ) {
	asort($country_list);
	return $country_list;
  }
}

// Call them as early as possible
add_action( 'after_setup_theme', 'create_custom_taxonomies', 5);
add_action( 'init', 'register_default_taxonomies_with_new_post_types', 5);

add_action( 'after_setup_theme', 'register_new_post_types_with_taxonomies', 10);
add_action( 'after_setup_theme', 'register_existing_posts_types_with_taxonomies', 10 );

// TODO make this an option in the backend to reset
// add_action('init', 'prepopulate_region_taxonomy_with_countries');

?>