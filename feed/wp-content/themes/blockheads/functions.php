<?php
// Set length of blog index except
function wpdocs_custom_excerpt_length( $length ) {
  return 18;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Add "" to end of excerpt
function change_excerpt_more() {
  function new_excerpt_more( $more ) {
    return '';
  }
  add_filter('excerpt_more', 'new_excerpt_more');
}
add_action('after_setup_theme', 'change_excerpt_more');

// Allow Featured Images
add_theme_support( 'post-thumbnails' );

// Don't resize Featured Images
function my_thumbnail_size() {
  set_post_thumbnail_size();
}
add_action('after_setup_theme', 'my_thumbnail_size', 11);

// I'll style the gallery myself, thank you....
add_filter( 'use_default_gallery_style', '__return_false' );

// Adds gallery shortcode default of size="full"
function my_gallery_atts( $out, $pairs, $atts ) {
  $atts = shortcode_atts( array(
    'size' => 'large',
  ), $atts );

  $out['size'] = $atts['size'];

  return $out;
}
add_filter( 'shortcode_atts_gallery', 'my_gallery_atts', 10, 3 );

// Output gallery code the way I want it
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
  global $post;

  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby'])
      unset($attr['orderby']);
    }

  extract(shortcode_atts(array(
    'order' => 'ASC',
    'orderby' => 'menu_order ID',
    'id' => $post->ID,
    'itemtag' => 'dl',
    'icontag' => 'dt',
    'captiontag' => 'dd',
    'columns' => 3,
    'size' => 'thumbnail',
    'include' => '',
    'exclude' => ''
  ), $attr));

  $id = intval($id);
  if ('RAND' == $order) $orderby = 'none';

  if (!empty($include)) {
    $include = preg_replace('/[^0-9,]+/', '', $include);
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  }

  if (empty($attachments)) return '';

  // Here's your actual output, you may customize it to your need
  $output = "<div class=\"gallery cf\">\n";
  
  // Now you loop through each attachment
  foreach ($attachments as $id => $attachment) {
    // Fetch the thumbnail (or full image, it's up to you)
    $img = wp_get_attachment_image_src($id, 'full');

    $output .= "<div class=\"gallery-item\" style=\"background-image: url({$img[0]});\";>\n";
    $output .= "<a href=\"{$img[0]}\" class=\"swipebox\"></a>\n";
    $output .= "</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}

// Wrap video embed code in DIV for responsive goodness
add_filter( 'embed_oembed_html', 'my_oembed_filter', 10, 4 ) ;
function my_oembed_filter($html, $url, $attr, $post_ID) {
  $return = '<div class="video">'.$html.'</div>';
  return $return;
}

/*
 * Add Featured Video option to admin
 */
// Add the Post Meta Box
function featured_video_add_custom_post_meta_box() {
  add_meta_box(
    'featured_video_meta_box', // $id
    'Featured Video', // $title 
    'featured_video_show_custom_post_meta_box', // $callback
    'post', // $post
    'normal', // $context
    'high'); // $priority
}
add_action('add_meta_boxes', 'featured_video_add_custom_post_meta_box');

// Field Array (Posts Meta)
$featured_video_post_meta_fields = array(
  array(
    'label' => 'Featured Video Embed Code',
    'desc' => 'Paste video URL here to show a video instead of a featured image. Example: <strong>https://www.youtube.com/watch?v=dQw4w9WgXcQ</strong> or <strong>https://vimeo.com/144892147</strong>',
    'id' => 'fv_video_embed',
    'placeholder' => 'Video URL'
  )
);

// The Callback for post meta box
function featured_video_show_custom_post_meta_box() {
  global $featured_video_post_meta_fields;
  featured_video_show_page_meta_box($featured_video_post_meta_fields);
}

// The Callback
function featured_video_show_page_meta_box($meta_fields) {
  global $post;
  // Use nonce for verification
  echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

  foreach ($meta_fields as $field) {
    // get value of this field if it exists for this post
    $meta = get_post_meta($post->ID, $field['id'], true);

    echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" placeholder="'.$field['placeholder'].'" style="width:100%"><br>
    <span class="description">' . $field['desc'] . '</span>';
  } // end foreach
}

// Save the Data
function featured_video_save_custom_meta($post_id) {
  global $featured_video_post_meta_fields;

  // verify nonce
  if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
    return $post_id;
  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;
  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id))
      return $post_id;
  } elseif (!current_user_can('edit_post', $post_id)) {
    return $post_id;
  }

  //either post or page fields we'll be working with
  $fields;

  // Check permissions (pages or posts)
  $fields = $featured_video_post_meta_fields;

  // loop through fields and save the data
  foreach ($fields as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
      update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $field['id'], $old);
    }
  } // end foreach
}
add_action('save_post', 'featured_video_save_custom_meta');

/*
 * Process Featured Video URL
 */
function FeedVideo($url) {
  if (strpos($url, 'youtu') > 0) {
    $pattern = "/(?:[?&]v=|\/embed\/|\/1\/|\/v\/|https:\/\/(?:www\.)?youtu\.be\/)([^&\n?#]+)/";
    preg_match($pattern, $url, $matches);
    $TheVideo = "https://www.youtube.com/embed/" . $matches[1] . "?autoplay=1&rel=0&showinfo=0";
    $TheImage = "https://img.youtube.com/vi/" . $matches[1] . "/maxresdefault.jpg";
  }

  if (strpos($url, 'vimeo') > 0) {
    $pattern = "/(http|https)?:\/\/(www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:|\/\?)/";
    preg_match($pattern, $url, $matches);
    $TheVideo = "https://player.vimeo.com/video/" . $matches[4] . "?autoplay=1&title=0&byline=0&portrait=0";
    $json = file_get_contents("https://vimeo.com/api/oembed.json?url=https://vimeo.com/" . $matches[4]);
    $obj = json_decode($json, true);
    $pieces = explode("_", $obj['thumbnail_url']);
    $TheImage = $pieces[0] . ".jpg";
  }

  return array($TheVideo, $TheImage);
}

/*
 * Check if post has Featured Video otherwise use Featured Image
 */
function VidOrImg() {
  $TheImage == "";

  if (get_post_meta(get_the_ID(), 'fv_video_embed', true)) :
    $fv = FeedVideo(get_post_meta(get_the_ID(), 'fv_video_embed', true));
    $TheImage = $fv[1];
  else :
    if (get_post_thumbnail_id() != "") $TheImage = wp_get_attachment_url(get_post_thumbnail_id());
  endif;

  return $TheImage;
}


add_action('admin_head', 'foresite_css');
function foresite_css() {
  echo '<style>
    #acf-language .label { display: none; }
  </style>';
}
?>