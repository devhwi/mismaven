<?php

class Avada_Compatibility {
	public $settings;
	public function __construct() {
		$this->settings = new Avada_Compatibility_Settings();
		
		require_once( 'class-avada-sanitize.php' );
	}
}

class Avada_Compatibility_Settings {
	public function get( $setting, $subsetting = false ) {
		$settings = get_option( 'Avada_options' );
		if ( isset( $settings[ $setting ] ) ) {
			if ( $subsetting ) {
				if ( isset( $settings[ $setting ][ $subsetting ] ) ) {
					return $settings[ $setting ][ $subsetting ];
				}
			} else {
				return $settings[ $setting ];
			}
		}
		return null;
	}
}

if ( ! function_exists( 'Avada' ) ) {
	function Avada() {
		$avada = new Avada_Compatibility();
		return $avada;
	}
	
	$avada = Avada();
}

/**
 * Contains all framework specific functions that are not part od a separate class
 *
 * @author      ThemeFusion
 * @package     FusionFramework
 * @since       Version 1.0
 */


if( ! function_exists( 'fusion_get_related_posts' ) ) {
	/**
	 * Get related posts by category
	 * @param  integer  $post_id       current post id
	 * @param  integer  $number_posts  number of posts to fetch
	 * @return object                  object with posts info
	 */
	function fusion_get_related_posts( $post_id, $number_posts = -1 ) {
		$query = new WP_Query();

		$args = '';

		if( $number_posts == 0 ) {
			return $query;
		}

		$args = wp_parse_args( $args, array(
			'category__in'          => wp_get_post_categories( $post_id ),
			'ignore_sticky_posts'   => 0,
			'posts_per_page'        => $number_posts,
			'post__not_in'          => array( $post_id ),
		));

		// If placeholder images are disabled, add the _thumbnail_id meta key to the query to only retrieve posts with featured images
		if ( ! Avada()->settings->get( 'featured_image_placeholder' ) ) {
			$args['meta_key'] = '_thumbnail_id';
		}

		$query = new WP_Query( $args );

		return $query;
	}
}

if( ! function_exists( 'fusion_get_related_projects' ) ) {
	/**
	 * Get related posts by portfolio_category taxonomy
	 * @param  integer  $post_id       current post id
	 * @param  integer  $number_posts  number of posts to fetch
	 * @return object                  object with posts info
	 */
	function fusion_get_related_projects( $post_id, $number_posts = 8 ) {
		$query = new WP_Query();

		$args = '';

		if( $number_posts == 0 ) {
			return $query;
		}

		$item_cats = get_the_terms( $post_id, 'portfolio_category' );

		$item_array = array();
		if( $item_cats ) {
			foreach( $item_cats as $item_cat ) {
				$item_array[] = $item_cat->term_id;
			}
		}

		if( ! empty( $item_array ) ) {
			$args = wp_parse_args( $args, array(
				'ignore_sticky_posts' => 0,
				'posts_per_page' => $number_posts,
				'post__not_in' => array( $post_id ),
				'post_type' => 'avada_portfolio',
				'tax_query' => array(
					array(
						'field' => 'id',
						'taxonomy' => 'portfolio_category',
						'terms' => $item_array,
					)
				)
			));

            // If placeholder images are disabled, add the _thumbnail_id meta key to the query to only retrieve posts with featured images
            if ( ! Avada()->settings->get( 'featured_image_placeholder' ) ) {
                $args['meta_key'] = '_thumbnail_id';
            }

			$query = new WP_Query( $args );
		}

		return $query;
	}
}

/**
 * Function to apply attributes to HTML tags.
 * Devs can override attr in a child theme by using the correct slug
 *
 *
 * @param  string $slug         Slug to refer to the HTML tag
 * @param  array  $attributes   Attributes for HTML tag
 * @return string               Attributes in attr='value' format
 */
if( ! function_exists( 'fusion_attr' ) ) {
	function fusion_attr( $slug, $attributes = array() ) {

		$out = '';
		$attr = apply_filters( "fusion_attr_{$slug}", $attributes );

		if ( empty( $attr ) ) {
			$attr['class'] = $slug;
		}

		foreach ( $attr as $name => $value ) {
			$out .= !empty( $value ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );
		}

		return trim( $out );

	}
}

if( ! function_exists( 'fusion_pagination' ) ) {
	/**
	 * Number based pagination
	 * @param  string  $pages         Maximum number of pages
	 * @param  integer $range
	 * @param  string  $current_query
	 * @return void
	 */
	function fusion_pagination( $pages = '', $range = 2, $current_query = '' ) {
		$showitems = ($range * 2)+1;

		if( $current_query == '' ) {
			global $paged;
			if( empty( $paged ) ) $paged = 1;
		} else {
			$paged = $current_query->query_vars['paged'];
		}

		if( $pages == '' ) {
			if( $current_query == '' ) {
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if(!$pages) {
					 $pages = 1;
				}
			} else {
				$pages = $current_query->max_num_pages;
			}
		}

		 if(1 != $pages)
		 {
			if ( ( Avada()->settings->get( 'blog_pagination_type' ) != 'Pagination' && ( is_home() || is_search() || ( get_post_type() == 'post' && ( is_author() || is_archive() ) ) ) ) ||
				 ( Avada()->settings->get( 'grid_pagination_type' ) != 'Pagination' && ( avada_is_portfolio_template() || is_post_type_archive( 'avada_portfolio' ) || is_tax( 'portfolio_category' ) || is_tax( 'portfolio_skills' )  || is_tax( 'portfolio_tags' ) ) )
			) {
				echo "<div class='pagination infinite-scroll clearfix'>";
			} else {
				echo "<div class='pagination clearfix'>";
			}
			 if ( $paged > 1 ) {
			 	echo "<a class='pagination-prev' href='".get_pagenum_link($paged - 1)."'><span class='page-prev'></span><span class='page-text'>".__('Previous', 'Avada')."</span></a>";
			 }

			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
					 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				 }
			 }

			 if ($paged < $pages) echo "<a class='pagination-next' href='".get_pagenum_link($paged + 1)."'><span class='page-text'>".__('Next', 'Avada')."</span><span class='page-next'></span></a>";
			 echo "</div>\n";
			 
			 // Needed for Theme check
			 ob_start();
			 posts_nav_link();
			 ob_get_clean();
		 }
	}
}

if( ! function_exists( 'fusion_breadcrumbs' ) ) {
	/**
	 * Render the breadcrumbs with help of class-breadcrumbs.php
	 *
	 * @return void
	 */
	function fusion_breadcrumbs() {
		$breadcrumbs = new Fusion_Breadcrumbs();
		$breadcrumbs->get_breadcrumbs();
	}
}

if( ! function_exists( 'fusion_strip_unit' ) ) {
	/**
	 * Strips the unit from a given value
	 * @param  string	$value The value with or without unit
	 * @param  string	$unit_to_strip The unit to be stripped
	 *
	 * @return string	the value without a unit
	 */
	function fusion_strip_unit( $value, $unit_to_strip = 'px' ) {
		$value_length = strlen( $value );
		$unit_length = strlen( $unit_to_strip );

		if ( $value_length > $unit_length &&
			 substr_compare( $value, $unit_to_strip, $unit_length * (-1), $unit_length ) === 0
		) {
			return substr( $value, 0, $value_length - $unit_length );
		} else {
			return $value;
		}
	}
}

add_filter( 'feed_link', 'fusion_feed_link', 1, 2 );
/**
 * Replace default WP RSS feed link with theme option RSS feed link
 * @param  string $output Feed link
 * @param  string $feed   Feed type
 * @return string         Return modified feed link
 */
if( ! function_exists( 'fusion_feed_link' ) ) {
	function fusion_feed_link( $output, $feed ) {
		if( Avada()->settings->get( 'rss_link' ) ) {
			$feed_url = Avada()->settings->get( 'rss_link' );

			$feed_array = array('rss' => $feed_url, 'rss2' => $feed_url, 'atom' => $feed_url, 'rdf' => $feed_url, 'comments_rss2' => '');
			$feed_array[ $feed ] = $feed_url;
			$output = $feed_array[ $feed ];
		}

		return $output;
	}
}

/**
 * Add paramater to current url
 * @param  string $url         URL to add param to
 * @param  string $param_name  Param name
 * @param  string $param_value Param value
 * @return array               params added to url data
 */
if( ! function_exists( 'fusion_add_url_parameter' ) ) {
	function fusion_add_url_parameter( $url, $param_name, $param_value ) {
		 $url_data = parse_url($url);
		 if(!isset($url_data["query"]))
			 $url_data["query"]="";

		 $params = array();
		 parse_str($url_data['query'], $params);

		 if( is_array( $param_value ) ) {
			$param_value = $param_value[0];
		 }

		 $params[$param_name] = $param_value;

		 if( $param_name == 'product_count' ) {
			$params['paged'] = '1';
		 }

		 $url_data['query'] = http_build_query($params);
		 return fusion_build_url($url_data);
	}
}

/**
 * Build final URL form $url_data returned from fusion_add_url_paramtere
 *
 * @param  array $url_data  url data with custom params
 * @return string           fully formed url with custom params
 */
if( ! function_exists( 'fusion_build_url' ) ) {
	function fusion_build_url( $url_data ) {
		$url = '';
		if( isset( $url_data['host'] ) ) {
			$url .= $url_data['scheme'] . '://';
			if( isset ( $url_data['user'] ) ) {
				$url .= $url_data['user'];
				if( isset( $url_data['pass'] ) ) {
					$url .= ':' . $url_data['pass'];
				}
				$url .= '@';
			}
			$url .= $url_data['host'];
			if( isset ( $url_data['port'] ) ) {
				$url .= ':' . $url_data['port'];
			}
		}

		if( isset( $url_data['path'] ) ) {
			$url .= $url_data['path'];
		}

		if( isset( $url_data['query'] ) ) {
			$url .= '?' . $url_data['query'];
		}

		if( isset( $url_data['fragment'] ) ) {
			$url .= '#' . $url_data['fragment'];
		}

		return $url;
	}
}

/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * @param str $hex Colour as hexadecimal (with or without hash);
 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * @return str Lightened/Darkend colour as hexadecimal (with hash);
 */
 if ( ! function_exists( 'fusion_color_luminance' ) ) {
	function fusion_color_luminance( $hex, $percent ) {
		// validate hex string

		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';

		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}

		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i*2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 );
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}

		return $new_hex;
	}
}

/**
 * Adjusts brightness of the $hex color.
 *
 * @var     string      The hex value of a color
 * @var     int         a value between -255 (darken) and 255 (lighten)
 * @return  string      returns hex color
 */
if( ! function_exists( 'fusion_adjust_brightness' ) ) {
	function fusion_adjust_brightness( $hex, $steps ) {

		$hex = str_replace( '#', '', $hex );

		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( -255, min( 255, $steps ) );
		// Adjust number of steps and keep it inside 0 to 255
		$red   = max( 0, min( 255, hexdec( substr( $hex, 0, 2 ) ) + $steps ) );
		$green = max( 0, min( 255, hexdec( substr( $hex, 2, 2 ) ) + $steps ) );
		$blue  = max( 0, min( 255, hexdec( substr( $hex, 4, 2 ) ) + $steps ) );

		$red_hex   = str_pad( dechex( $red ), 2, '0', STR_PAD_LEFT );
		$green_hex = str_pad( dechex( $green ), 2, '0', STR_PAD_LEFT );
		$blue_hex  = str_pad( dechex( $blue ), 2, '0', STR_PAD_LEFT );

		return Avada_Sanitize::color( $red_hex . $green_hex . $blue_hex );

	}
}

/**
 * Convert Calculate the brightness of a color
 * @param  string $color Color (Hex) Code
 * @return integer brightness level
 */
if( ! function_exists( 'fusion_calc_color_brightness' ) ) {
	function fusion_calc_color_brightness( $color ) {

		if( strtolower( $color ) == 'black' ||
			strtolower( $color ) == 'navy' ||
			strtolower( $color ) == 'purple' ||
			strtolower( $color ) == 'maroon' ||
			strtolower( $color ) == 'indigo' ||
			strtolower( $color ) == 'darkslategray' ||
			strtolower( $color ) == 'darkslateblue' ||
			strtolower( $color ) == 'darkolivegreen' ||
			strtolower( $color ) == 'darkgreen' ||
			strtolower( $color ) == 'darkblue'
		) {
			$brightness_level = 0;
		} elseif( strpos( $color, '#' ) === 0 ) {
			$color = fusion_hex2rgb( $color );

			$brightness_level = sqrt( pow( $color[0], 2) * 0.299 + pow( $color[1], 2) * 0.587 + pow( $color[2], 2) * 0.114 );
		} else {
			$brightness_level = 150;
		}

		return $brightness_level;
	}
}

/**
 * Convert Hex Code to RGB
 * @param  string $hex Color Hex Code
 * @return array       RGB values
 */
if( ! function_exists( 'fusion_hex2rgb' ) ) {
	function fusion_hex2rgb( $hex ) {
		if ( strpos( $hex,'rgb' ) !== FALSE ) {

			$rgb_part = strstr( $hex, '(' );
			$rgb_part = trim($rgb_part, '(' );
			$rgb_part = rtrim($rgb_part, ')' );
			$rgb_part = explode( ',', $rgb_part );

			$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);

		} elseif( $hex == 'transparent' ) {
			$rgb = array( '255', '255', '255', '0' );
		} else {

			$hex = str_replace( '#', '', $hex );

			if( strlen( $hex ) == 3 ) {
				$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
			} else {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			}
			$rgb = array( $r, $g, $b );
		}

		return $rgb; // returns an array with the rgb values
	}
}

/**
 * Convert RGB to HSL color model
 * @param  string $hex Color Hex Code of RGB color
 * @return array       HSL values
 */
if( ! function_exists( 'fusion_rgb2hsl' ) ) {
	function fusion_rgb2hsl( $hex_color ) {

		$hex_color  = str_replace( '#', '', $hex_color );

		if( strlen( $hex_color ) < 3 ) {
			str_pad( $hex_color, 3 - strlen( $hex_color ), '0' );
		}

		$add         = strlen( $hex_color ) == 6 ? 2 : 1;
		$aa       = 0;
		$add_on   = $add == 1 ? ( $aa = 16 - 1 ) + 1 : 1;

		$red         = round( ( hexdec( substr( $hex_color, 0, $add ) ) * $add_on + $aa ) / 255, 6 );
		$green     = round( ( hexdec( substr( $hex_color, $add, $add ) ) * $add_on + $aa ) / 255, 6 );
		$blue       = round( ( hexdec( substr( $hex_color, ( $add + $add ) , $add ) ) * $add_on + $aa ) / 255, 6 );

		$hsl_color  = array( 'hue' => 0, 'sat' => 0, 'lum' => 0 );

		$minimum     = min( $red, $green, $blue );
		$maximum     = max( $red, $green, $blue );

		$chroma   = $maximum - $minimum;

		$hsl_color['lum'] = ( $minimum + $maximum ) / 2;

		if( $chroma == 0 ) {
			$hsl_color['lum'] = round( $hsl_color['lum'] * 100, 0 );

			return $hsl_color;
		}

		$range = $chroma * 6;

		$hsl_color['sat'] = $hsl_color['lum'] <= 0.5 ? $chroma / ( $hsl_color['lum'] * 2 ) : $chroma / ( 2 - ( $hsl_color['lum'] * 2 ) );

		if( $red <= 0.004 ||
			$green <= 0.004 ||
			$blue <= 0.004
		) {
			$hsl_color['sat'] = 1;
		}

		if( $maximum == $red ) {
			$hsl_color['hue'] = round( ( $blue > $green ? 1 - ( abs( $green - $blue ) / $range ) : ( $green - $blue ) / $range ) * 255, 0 );
		} else if( $maximum == $green ) {
			$hsl_color['hue'] = round( ( $red > $blue ? abs( 1 - ( 4 / 3 ) + ( abs ( $blue - $red ) / $range ) ) : ( 1 / 3 ) + ( $blue - $red ) / $range ) * 255, 0 );
		} else {
			$hsl_color['hue'] = round( ( $green < $red ? 1 - 2 / 3 + abs( $red - $green ) / $range : 2 / 3 + ( $red - $green ) / $range ) * 255, 0 );
		}

		$hsl_color['sat'] = round( $hsl_color['sat'] * 100, 0 );
		$hsl_color['lum']  = round( $hsl_color['lum'] * 100, 0 );

		return $hsl_color;
	}
}

/**
 * Get theme option value
 * @param  string $theme_option ID of theme option
 * @return string               Value of theme option
 */
if( ! function_exists( 'fusion_get_theme_option' ) ) {
	function fusion_get_theme_option( $theme_option ) {

		if( $theme_option && null !== Avada()->settings->get( $theme_option ) ) {
			return Avada()->settings->get( $theme_option );
		}

		return FALSE;
	}
}


/**
 * Get page option value
 * @param  string  $page_option ID of page option
 * @param  integer $post_id     Post/Page ID
 * @return string               Value of page option
 */
if( ! function_exists( 'fusion_get_page_option' ) ) {
	function fusion_get_page_option( $page_option, $post_id ) {
		if( $page_option &&
			$post_id
		) {
			return get_post_meta( $post_id, 'pyre_' . $page_option, true );
		}

		return FALSE;
	}
}

/**
 * Get theme option or page option
 * @param  string  $theme_option Theme option ID
 * @param  string  $page_option  Page option ID
 * @param  integer $post_id      Post/Page ID
 * @return string                Theme option or page option value
 */
if( ! function_exists( 'fusion_get_option' ) ) {
	function fusion_get_option( $theme_option, $page_option, $post_id ) {
		if ( $theme_option &&
			 $page_option &&
			 $post_id
		) {
			$page_option = strtolower( fusion_get_page_option( $page_option, $post_id ) );
			$theme_option = strtolower( fusion_get_theme_option( $theme_option ) );

			if ( $page_option != 'default' &&
				 ! empty ( $page_option )
			) {
				return $page_option;
			} else {
				return $theme_option;
			}
		}

		return FALSE;
	}
}

/**
 * Compress CSS
 * @param  string $minify CSS to compress
 * @return string         Compressed CSS
 */
if( ! function_exists( 'fusion_compress_css' ) ) {
	function fusion_compress_css( $minify ) {
		/* remove comments */
		$minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );

		/* remove tabs, spaces, newlines, etc. */
		$minify = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $minify );

		return $minify;
	}
}

if ( ! function_exists( 'fusion_get_post_content' ) ) {
	/**
	 * Return the post content, either excerpted or in full length
	 * @param  string	$page_id		The id of the current page or post
	 * @param  string 	$excerpt		Can be either 'blog' (for main blog page), 'portfolio' (for portfolio page template) or 'yes' (for shortcodes)
	 * @param  integer	$excerpt_length Length of the excerpts
	 * @param  boolean	$strip_html		Can be used by shortcodes for a custom strip html setting
	 *
	 * @return string Post content
	 **/
	function fusion_get_post_content( $page_id = '', $excerpt = 'blog', $excerpt_length = 55, $strip_html = FALSE ) {

		$content_excerpted = FALSE;

		// Main blog page
		if ( $excerpt == 'blog' ) {

			// Check if the content should be excerpted
			if ( strtolower( fusion_get_theme_option( 'content_length' ) ) == 'excerpt' ) {
				$content_excerpted = TRUE;

				// Get the excerpt length
				$excerpt_length = fusion_get_theme_option( 'excerpt_length_blog' );
			}

			// Check if HTML should be stripped from contant
			if ( fusion_get_theme_option( 'strip_html_excerpt' ) ) {
				$strip_html = TRUE;
			}

		// Portfolio page templates
		} elseif ( $excerpt == 'portfolio' ) {
			// Check if the content should be excerpted
			if ( fusion_get_option( 'portfolio_content_length', 'portfolio_content_length', $page_id ) == 'excerpt' ) {
				$content_excerpted = TRUE;

				// Determine the correct excerpt length
				if ( fusion_get_page_option( 'portfolio_excerpt', $page_id ) ) {
					$excerpt_length = fusion_get_page_option( 'portfolio_excerpt', $page_id );
				} else {
					$excerpt_length =  fusion_get_theme_option( 'excerpt_length_portfolio' );
				}
			} else if ( ! $page_id &&
						fusion_get_theme_option( 'portfolio_content_length' ) == 'Excerpt'
			) {
				$content_excerpted = TRUE;
				$excerpt_length =  fusion_get_theme_option( 'excerpt_length_portfolio' );
			}


			// Check if HTML should be stripped from contant
			if ( fusion_get_theme_option( 'portfolio_strip_html_excerpt' ) ) {
				$strip_html = TRUE;
			}
		// Shortcodes
		} elseif( $excerpt == 'yes' ) {
			$content_excerpted = TRUE;
		}

		// Sermon specific additional content
		if ( 'wpfc_sermon' == get_post_type( get_the_ID() ) ) {
			$sermon_content = '';
			$sermon_content .= avada_get_sermon_content( true );

			return $sermon_content;
		}

		// Return excerpted content
		if ( $content_excerpted ) {

			$stripped_content = fusion_get_post_content_excerpt( $excerpt_length, $strip_html );

			return $stripped_content;

		// Return full content
		} else {
			ob_start();
			the_content();

			return ob_get_clean();
		}
	}
}

if ( ! function_exists( 'fusion_get_post_content_excerpt' ) ) {
	/**
	 * Do the actual custom excerpting for of post/page content
	 * @param  string 	$limit 		Maximum number of words or chars to be displayed in excerpt
	 * @param  boolean 	$strip_html Set to TRUE to strip HTML tags from excerpt
	 *
	 * @return string 				The custom excerpt
	 **/
	function fusion_get_post_content_excerpt( $limit, $strip_html ) {
		global $more;

		$content = '';

		$limit = intval( $limit );

		// If excerpt length is set to 0, return empty
		if ( $limit === 0 ) {
			return $content;
		}

		// Set a default excerpt limit if none is set
		if ( ! $limit &&
			$limit != 0
		) {
			$limit = 285;
		}

		// Make sure $strip_html is a boolean
		if ( $strip_html == "true" ||
			$strip_html == TRUE
		) {
			$strip_html = TRUE;
		} else {
			$strip_html = FALSE;
		}

		$custom_excerpt = FALSE;

		$post = get_post( get_the_ID() );

		// Check if the more tag is used in the post
		$pos = strpos( $post->post_content, '<!--more-->' );

		// Check if the read more [...] should link to single post
		$read_more_text = apply_filters( 'avada_blog_read_more_excerpt', '&#91;...&#93;' );

		if ( Avada()->settings->get( 'link_read_more' ) ) {
			$read_more = sprintf( ' <a href="%s">%s</a>', get_permalink( get_the_ID() ), $read_more_text );
		} else {
			$read_more = ' ' . $read_more_text;
		}

		if ( Avada()->settings->get( 'disable_excerpts' ) ) {
			$read_more = '';
		}

		// HTML tags should be stripped
		if ( $strip_html ) {
			$more = 0;
			$raw_content = wp_strip_all_tags( get_the_content( '{{read_more_placeholder}}' ), '<p>' );

			// Strip out all attributes
			$raw_content = preg_replace('/<(\w+)[^>]*>/', '<$1>', $raw_content);

			$raw_content = str_replace( '{{read_more_placeholder}}', $read_more, $raw_content );

			if ( $post->post_excerpt ||
				$pos !== FALSE
			) {
				$more = 0;
				if ( ! $pos ) {
					$raw_content = wp_strip_all_tags( rtrim( get_the_excerpt(), '[&hellip;]' ), '<p>' ) . $read_more;
				}
				$custom_excerpt = TRUE;
			}
		// HTML tags remain in excerpt
		} else {
			$more = 0;
			$raw_content = get_the_content( $read_more );
			if ( $post->post_excerpt ||
				$pos !== FALSE
			) {
				$more = 0;
				if ( ! $pos ) {
					$raw_content = rtrim( get_the_excerpt(), '[&hellip;]' ) . $read_more;
				}
				$custom_excerpt = TRUE;
			}
		}

		// We have our raw post content and need to cut it down to the excerpt limit
		if ( ( $raw_content && $custom_excerpt == FALSE )
			 || $post->post_type == 'product'
		) {
			$pattern = get_shortcode_regex();
			$content = preg_replace_callback( "/$pattern/s", 'avada_extract_shortcode_contents', $raw_content );

			// Check if the excerpting should be char or word based
			if ( Avada()->settings->get( 'excerpt_base' ) == 'Characters' ) {
				$content = mb_substr($content, 0, $limit);
				if ( $limit != 0 &&
					! Avada()->settings->get( 'disable_excerpts' )
				) {
					$content .= $read_more;
				}
			// Excerpting is word based
			} else {
				$content = explode( ' ', $content, $limit + 1 );
				if ( count( $content ) > $limit ) {
					array_pop( $content );
					if ( Avada()->settings->get( 'disable_excerpts' ) ) {
						$content = implode( ' ', $content );
					} else {
						$content = implode( ' ', $content);
						if ( $limit != 0 ) {
							if ( Avada()->settings->get( 'link_read_more' ) ) {
								$content .= $read_more;
							} else {
								$content .= $read_more;
							}
						}
					}
				} else {
					$content = implode( ' ', $content );
				}
			}

			if ( $limit != 0 && ! $strip_html ) {
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
			} else {
				$content = sprintf( '<p>%s</p>', $content );
			}

			$content = do_shortcode( $content );

			return $content;
		}

		// If we have a custom excerpt, e.g. using the <!--more--> tag
		if ( $custom_excerpt == TRUE ) {
			$pattern = get_shortcode_regex();
			$content = preg_replace_callback( "/$pattern/s", 'avada_extract_shortcode_contents', $raw_content );
			if ( $strip_html == TRUE ) {
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$content = do_shortcode( $content );
			} else {
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
			}
		}

		// If the custom excerpt field is used, just use that contents
		if ( has_excerpt() && $post->post_type != 'product' ) {
			$content = '<p>' . do_shortcode( get_the_excerpt() ) . '</p>';
		}

		return $content;
	}
}

/**
 * Get attachment data by URL
 * @param  string 	$image_url 		The Image URL
 *
 * @return array 					Image Details
 **/
if( ! function_exists( 'fusion_get_attachment_data_by_url' ) ) {
	function fusion_get_attachment_data_by_url( $image_url, $logo_field = '' ) {
		global $wpdb;

		$attachment = $wpdb->get_col( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

		if( $attachment ) {
			return wp_get_attachment_metadata( $attachment[0] );
		} else { // import the image to media library
			$import_image = fusion_import_to_media_library( $image_url, $logo_field );
			if( $import_image ) {
				return wp_get_attachment_metadata( $import_image );
			} else {
				return false;
			}
		}
	}
}

if( ! function_exists( 'fusion_import_to_media_library' ) ) {
	function fusion_import_to_media_library( $url, $theme_option = '' ) {

		// gives us access to the download_url() and wp_handle_sideload() functions
		require_once(ABSPATH . 'wp-admin/includes/file.php');

		$timeout_seconds = 30;

		// download file to temp dir
		$temp_file = download_url( $url, $timeout_seconds );

		if( ! is_wp_error( $temp_file ) ) {
			// array based on $_FILE as seen in PHP file uploads
			$file = array(
				'name' => basename( $url ), // ex: wp-header-logo.png
				'type' => 'image/png',
				'tmp_name' => $temp_file,
				'error' => 0,
				'size' => filesize( $temp_file ),
			);

			$overrides = array(
				// tells WordPress to not look for the POST form
				// fields that would normally be present, default is true,
				// we downloaded the file from a remote server, so there
				// will be no form fields
				'test_form' => false,

				// setting this to false lets WordPress allow empty files, not recommended
				'test_size' => true,

				// A properly uploaded file will pass this test.
				// There should be no reason to override this one.
				'test_upload' => true,
			);

			// move the temporary file into the uploads directory
			$results = wp_handle_sideload( $file, $overrides );

			if ( ! empty( $results['error'] ) ) {
				return false;
			} else {
				$attachment = array(
					'guid'           => $results['url'],
					'post_mime_type' => $results['type'],
					'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $results['file'] ) ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);

				// Insert the attachment.
				$attach_id = wp_insert_attachment( $attachment, $results['file'] );

				// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
				require_once( ABSPATH . 'wp-admin/includes/image.php' );

				// Generate the metadata for the attachment, and update the database record.
				$attach_data = wp_generate_attachment_metadata( $attach_id, $results['file'] );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				if( $theme_option ) {
					Avada()->settings->set( $theme_option, $results['url'] );
				}

				return $attach_id;
			}
		} else {
			return false;
		}
	}
}
// Omit closing PHP tag to avoid "Headers already sent" issues.

/**
 * Contains all theme specific functions
 *
 * @author		ThemeFusion
 * @package		Avada
 * @since		Version 3.8
 */

// Do not allow directly accessing this file
if ( ! defined( 'ABSPATH' ) ) exit( 'Direct script access denied.' );

/**
 * Get the post (excerpt)
 *
 * @return void Content is directly echoed
 **/
if ( ! function_exists( 'avada_render_blog_post_content' ) ) {
	function avada_render_blog_post_content() {
		if ( is_search() && Avada()->settings->get( 'search_excerpt' ) ) {
			return;
		}
		echo fusion_get_post_content();
	}
}
add_action( 'avada_blog_post_content', 'avada_render_blog_post_content', 10 );

/**
 * Get the portfolio post (excerpt)
 *
 * @return void Content is directly echoed
 **/
if ( ! function_exists( 'avada_render_portfolio_post_content' ) ) {
	function avada_render_portfolio_post_content( $page_id ) {
		echo fusion_get_post_content( $page_id, 'portfolio' );
	}
}
add_action( 'avada_portfolio_post_content', 'avada_render_portfolio_post_content', 10 );

/**
 * Render the HTML for the date box for large/medium alternate blog layouts
 *
 * @return void directly echoed HTML markup to display the date box
 **/
if ( ! function_exists( 'avada_render_blog_post_date' ) ) {
	function avada_render_blog_post_date() { ?>
		<div class="fusion-date-box">
			<span class="fusion-date"><?php echo get_the_time( Avada()->settings->get( 'alternate_date_format_day' ) ); ?></span>
			<span class="fusion-month-year"><?php echo get_the_time( Avada()->settings->get( 'alternate_date_format_month_year' ) ); ?></span>
		</div>
		<?php
	}
}
add_action( 'avada_blog_post_date_and_format', 'avada_render_blog_post_date', 10 );

/**
 * Render the HTML for the format box for large/medium alternate blog layouts
 *
 * @return void directly echoed HTML markup to display the format box
 **/
if ( ! function_exists( 'avada_render_blog_post_format' ) ) {
	function avada_render_blog_post_format() {
		switch ( get_post_format() ) {
			case 'gallery':
				$format_class = 'images';
				break;
			case 'link':
				$format_class = 'link';
				break;
			case 'image':
				$format_class = 'image';
				break;
			case 'quote':
				$format_class = 'quotes-left';
				break;
			case 'video':
				$format_class = 'film';
				break;
			case 'audio':
				$format_class = 'headphones';
				break;
			case 'chat':
				$format_class = 'bubbles';
				break;
			default:
				$format_class = 'pen';
				break;
		}
		?>
		<div class="fusion-format-box">
			<i class="fusion-icon-<?php echo $format_class; ?>"></i>
		</div>
		<?php
	}
}
add_action( 'avada_blog_post_date_and_format', 'avada_render_blog_post_format', 15 );

/**
 * Output author information on the author archive page
 *
 * @return void directly echos the author info HTML markup
 **/
if ( ! function_exists( 'avada_render_author_info' ) ) {
	function avada_render_author_info() {
		global $social_icons;

		// Initialize needed variables
		$author             = get_user_by( 'id', get_query_var( 'author' ) );
		$author_id          = $author->ID;
		$author_name        = get_the_author_meta( 'display_name', $author_id );
		$author_avatar      = get_avatar( get_the_author_meta( 'email', $author_id ), '82' );
		$author_description = get_the_author_meta( 'description', $author_id );
		$author_custom      = get_the_author_meta( 'author_custom', $author_id );

		// If no description was added by user, add some default text and stats
		if ( empty( $author_description ) ) {
			$author_description  = __( 'This author has not yet filled in any details.', 'Avada' );
			$author_description .= '<br />' . sprintf( __( 'So far %s has created %s blog entries.', 'Avada' ), $author_name, count_user_posts( $author_id ) );
		}
		?>
		<div class="fusion-author">
			<div class="fusion-author-avatar">
				<?php echo $author_avatar; ?>
			</div>
			<div class="fusion-author-info">
				<?php // Check if rich snippets are allowed ?>
				<?php if ( ! Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) : ?>
					<h3 class="fusion-author-title vcard"><?php _e( 'About', 'Avada' ); ?> <span class="fn"><?php echo $author_name; ?> </span>
				<?php else : ?>
					<h3 class="fusion-author-title"><?php echo __( 'About', 'Avada' ) . ' ' . $author_name; ?>
				<?php endif; ?>

				<?php // If user can edit his profile, offer a link for it ?>
				<?php if ( current_user_can( 'edit_users' ) || get_current_user_id() == $author_id ) : ?>
					<span class="fusion-edit-profile">(<a href="<?php echo admin_url( 'profile.php?user_id=' . $author_id ); ?>"><?php _e( 'Edit profile', 'Avada' ); ?></a>)</span>
				<?php endif; ?>
				</h3>
				<?php echo $author_description; ?>
			</div>

			<div style="clear:both;"></div>

			<div class="fusion-author-social clearfix">
				<div class="fusion-author-tagline">
					<?php if ( $author_custom ) : ?>
						<?php echo $author_custom; ?>
					<?php endif; ?>
				</div>

				<?php

				// Get the social icons for the author set on his profile page
				$author_soical_icon_options = array (
					'authorpage'		=> 'yes',
					'author_id'			=> $author_id,
					'position'			=> 'author',
					'icon_colors' 		=> Avada()->settings->get( 'social_links_icon_color' ),
					'box_colors' 		=> Avada()->settings->get( 'social_links_box_color' ),
					'icon_boxed' 		=> Avada()->settings->get( 'social_links_boxed' ),
					'icon_boxed_radius' => Avada()->settings->get( 'social_links_boxed_radius' ),
					'tooltip_placement'	=> Avada()->settings->get( 'social_links_tooltip_placement' ),
					'linktarget'		=> Avada()->settings->get( 'social_icons_new' ),
				);

				echo $social_icons->render_social_icons( $author_soical_icon_options );

				?>
			</div>
		</div>
		<?php
	}
}
add_action( 'avada_author_info', 'avada_render_author_info', 10 );

/**
 * Output the footer copyright notice
 *
 * @return void directly echos the footer copyright notice HTML markup
 **/
if ( ! function_exists( 'avada_render_footer_copyright_notice' ) ) {
	function avada_render_footer_copyright_notice() { ?>
		<div class="fusion-copyright-notice">
			<div><?php echo do_shortcode( Avada()->settings->get( 'footer_text' ) ); ?></div>
		</div>
		<?php
	}
}
add_action( 'avada_footer_copyright_content', 'avada_render_footer_copyright_notice', 10 );

/**
 * Output the footer social icons
 *
 * @return void directly echos the footer footer social icons HTML markup
 **/
if ( ! function_exists( 'avada_render_footer_social_icons' ) ) {
	function avada_render_footer_social_icons() {
		global $social_icons;

		// Render the social icons
		if ( Avada()->settings->get( 'icons_footer' ) ) : ?>
			<div class="fusion-social-links-footer">
				<?php

				$footer_soical_icon_options = array (
					'position'          => 'footer',
					'icon_colors'       => Avada()->settings->get( 'footer_social_links_icon_color' ),
					'box_colors'        => Avada()->settings->get( 'footer_social_links_box_color' ),
					'icon_boxed'        => Avada()->settings->get( 'footer_social_links_boxed' ),
					'icon_boxed_radius' => Avada()->settings->get( 'footer_social_links_boxed_radius' ),
					'tooltip_placement' => Avada()->settings->get( 'footer_social_links_tooltip_placement' ),
					'linktarget'        => Avada()->settings->get( 'social_icons_new' ),
				);

				echo $social_icons->render_social_icons( $footer_soical_icon_options ); ?>
			</div>
		<?php endif;
	}
}
add_action( 'avada_footer_copyright_content', 'avada_render_footer_social_icons', 15 );

/**
 * Output the image rollover
 * @param  string 	$post_id 					ID of the current post
 * @param  string 	$permalink 					Permalink of current post
 * @param  boolean 	$display_woo_price 			Set to yes to show´woocommerce price tag for woo sliders
 * @param  boolean 	$display_woo_buttons		Set to yes to show the woocommerce "add to cart" and "show details" buttons
 * @param  string	$display_post_categories 	Controls if the post categories will be shown; "deafult": theme option setting; enable/disable otheriwse
 * @param  string	$display_post_title 		Controls if the post title will be shown; "deafult": theme option setting; enable/disable otheriwse
 * @param  string	$gallery_id 				ID of a special gallery the rollover "zoom" link should be connected to for lightbox
 *
 * @return void 	Directly echos the placeholder image HTML markup
 **/
if ( ! function_exists( 'avada_render_rollover' ) ) {
	function avada_render_rollover( $post_id, $post_permalink = '', $display_woo_price = false, $display_woo_buttons = false, $display_post_categories = 'default', $display_post_title = 'default', $gallery_id = '', $display_woo_rating = false ) {
		global $product, $woocommerce;

		// Retrieve the permalink if it is not set
		if ( ! $post_permalink ) {
			$post_permalink = get_permalink( $post_id );
		}

		// Check if theme options are used as base or if there is an override for post categories
		if ( 'enable' == $display_post_categories ) {
			$display_post_categories = true;
		} elseif ( 'disable' == $display_post_categories ) {
			$display_post_categories = false;
		} else {
			$display_post_categories = ! Avada()->settings->get( 'cats_image_rollover' );
		}

		// Check if theme options are used as base or if there is an override for post title
		if ( 'enable' == $display_post_title ) {
			$display_post_title = true;
		} elseif ( 'disable' == $display_post_title ) {
			$display_post_title = false;
		} else {
			$display_post_title = ! Avada()->settings->get( 'title_image_rollover' );
		}

		// Set the link on the link icon to a custom url if set in page options
		$icon_permalink = ( fusion_get_page_option( 'link_icon_url', $post_id ) != null ) ? fusion_get_page_option( 'link_icon_url', $post_id ) : $post_permalink;

		if ( '' == fusion_get_page_option( 'image_rollover_icons', $post_id ) || 'default' == fusion_get_page_option( 'image_rollover_icons', $post_id ) ) {
			if( ! Avada()->settings->get( 'link_image_rollover' ) && ! Avada()->settings->get( 'zoom_image_rollover' ) ) { // link + zoom
				$image_rollover_icons = 'linkzoom';
			} elseif( ! Avada()->settings->get( 'link_image_rollover' ) && Avada()->settings->get( 'zoom_image_rollover' ) ) { // link
				$image_rollover_icons = 'link';
			} elseif( Avada()->settings->get( 'link_image_rollover' ) && ! Avada()->settings->get( 'zoom_image_rollover' ) ) { // zoom
				$image_rollover_icons = 'zoom';
			} elseif( Avada()->settings->get( 'link_image_rollover' ) && Avada()->settings->get( 'zoom_image_rollover' ) ) { // link
				$image_rollover_icons = 'no';
			} else {
				$image_rollover_icons = 'linkzoom';
			}
		} else {
			$image_rollover_icons = fusion_get_page_option( 'image_rollover_icons', $post_id );
		}

		// Set the link target to blank if the option is set
		if ( 'yes' == fusion_get_page_option( 'link_icon_target', $post_id ) ||
			 'yes' == fusion_get_page_option( 'post_links_target', $post_id ) ||
			 ( 'avada_portfolio' == get_post_type() &&  Avada()->settings->get( 'portfolio_link_icon_target' ) && 'default' == fusion_get_page_option( 'link_icon_target', $post_id ) )
		) {
			$link_target = ' target="_blank"';
		} else {
			$link_target = '';
		}

		?>
		<div class="fusion-rollover">
			<div class="fusion-rollover-content">

				<?php if ( 'no' != $image_rollover_icons && 'product' != get_post_type( $post_id ) ) : // Check if rollover icons should be displayed ?>

					<?php if ( 'zoom' != $image_rollover_icons ) : // If set, render the rollover link icon ?>
						<a class="fusion-rollover-link" href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>>Permalink</a>
					<?php endif; ?>

					<?php if ( 'link' != $image_rollover_icons ) : // If set, render the rollover zoom icon ?>
						<?php

						// Get the image data
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

						if ( ! is_array( $full_image ) ) {
							$full_image = array();
							$full_image[0] = '';
						}

						// If a video url is set in the post options, use it inside the lightbox
						if ( fusion_get_page_option( 'video_url', $post_id ) ) {
							$full_image[0] = fusion_get_page_option( 'video_url', $post_id );
						}
						?>

						<?php if ( 'linkzoom' == $image_rollover_icons || '' === $image_rollover_icons ) : // If both icons will be shown, add a separator ?>
							<div class="fusion-rollover-sep"></div>
						<?php endif; ?>

						<?php if ( $full_image[0] ) : // Render the rollover zoom icon if we have an image ?>
							<?php
							// Only show images of the clicked post
							if ( 'individual' == Avada()->settings->get( 'lightbox_behavior' ) ) {
								$lightbox_content = avada_featured_images_lightbox( $post_id );
								$data_rel         = sprintf( 'iLightbox[gallery%s]', $post_id );
							// Show the first image of every post on the archive page
							} else {
								$lightbox_content = '';
								$data_rel         = sprintf( 'iLightbox[gallery%s]', $gallery_id );
							}
							?>
							<a class="fusion-rollover-gallery" href="<?php echo $full_image[0]; ?>" data-id="<?php echo $post_id; ?>" data-rel="<?php echo $data_rel; ?>" data-title="<?php echo get_post_field( 'post_title', get_post_thumbnail_id( $post_id ) ); ?>" data-caption="<?php echo get_post_field( 'post_excerpt', get_post_thumbnail_id( $post_id ) ); ?>">Gallery</a><?php echo $lightbox_content; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( $display_post_title ) : // Check if we should render the post title on the rollover ?>
					<h4 class="fusion-rollover-title"><a href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>><?php echo get_the_title( $post_id ); ?></a></h4>
				<?php endif; ?>

				<?php

				// Check if we should render the post categories on the rollover
				if ( $display_post_categories ) {

					// Determine the correct taxonomy
					$post_taxonomy = '';
					if ( 'post' == get_post_type( $post_id ) ) {
						$post_taxonomy = 'category';
					} elseif ( 'avada_portfolio' == get_post_type( $post_id ) ) {
						$post_taxonomy = 'portfolio_category';
					} elseif ( 'product' == get_post_type( $post_id ) ) {
						$post_taxonomy = 'product_cat';
					}

					echo get_the_term_list( $post_id, $post_taxonomy, '<div class="fusion-rollover-categories">', ', ', '</div>' );
				}
				?>

				<?php
				if( class_exists( 'WooCommerce' ) && $woocommerce->cart ) {
					$items_in_cart = array();
					if ( $woocommerce->cart->get_cart() && is_array( $woocommerce->cart->get_cart() ) ) {
						foreach ( $woocommerce->cart->get_cart() as $cart ) {
							$items_in_cart[] = $cart['product_id'];
						}
					}

					$id      = get_the_ID();
					$in_cart = in_array( $id, $items_in_cart );
					if ( $in_cart ) {
						echo '<span class="cart-loading">' . '<a href="' . $woocommerce->cart->get_cart_url() .'">' . '<i class="fusion-icon-check-square-o"></i><span class="view-cart">' . __( 'View Cart', 'Avada' ) .'</span></a></span>';
					} else {
						echo '<span class="cart-loading">' . '<a href="' . $woocommerce->cart->get_cart_url() .'">' . '<i class="fusion-icon-spinner"></i><span class="view-cart">' . __( 'View Cart', 'Avada' ) .'</span></a></span>';
					}
				}
				?>

				<?php if ( $display_woo_rating ) : // Check if we should render the woo product price ?>
					<?php woocommerce_get_template( 'loop/rating.php' ); ?>
				<?php endif; ?>

				<?php if ( $display_woo_price ) : // Check if we should render the woo product price ?>
					<?php woocommerce_get_template( 'loop/price.php' ); ?>
				<?php endif; ?>

				<?php if ( $display_woo_buttons ) : // Check if we should render the woo "add to cart" and "details" buttons ?>
					<div class="fusion-product-buttons">
						<?php
						/**
						 * avada_woocommerce_buttons_on_rollover hook.
						 *
						 * @hooked FusionTemplateWoo::avada_woocommerce_template_loop_add_to_cart - 10 (outputs add to cart button)
						 * @hooked FusionTemplateWoo::avada_woocommerce_rollover_buttons_linebreak - 15 (outputs line break for the buttons, needed for clean version)
						 * @hooked FusionTemplateWoo::show_details_button - 20 (outputs the show details button)
						 */					
						do_action( 'avada_woocommerce_buttons_on_rollover' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'avada_rollover', 'avada_render_rollover', 10, 8 );

/**
 * Action to output a placeholder image
 * @param  string $featured_image_size 	Size of the featured image that should be emulated
 *
 * @return void 						Directly echos the placeholder image HTML markup
 **/
if ( ! function_exists( 'avada_render_placeholder_image' ) ) {
	function avada_render_placeholder_image( $featured_image_size = 'full' ) {
		global $_wp_additional_image_sizes;

		if ( in_array( $featured_image_size, array( 'full', 'fixed' ) ) ) {
			$height = apply_filters( 'avada_set_placeholder_image_height', '150' );
			$width  = '1500px';
		} else {
			@$height = $_wp_additional_image_sizes[$featured_image_size]['height'];
			@$width  = $_wp_additional_image_sizes[$featured_image_size]['width'] . 'px';
		 }
		 ?>
		 <div class="fusion-placeholder-image" data-origheight="<?php echo $height; ?>" data-origwidth="<?php echo $width; ?>" style="height:<?php echo $height; ?>px;width:<?php echo $width; ?>;"></div>
		 <?php
	}
}
add_action( 'avada_placeholder_image', 'avada_render_placeholder_image', 10 );

if ( ! function_exists( 'avada_render_first_featured_image_markup' ) ) {
	/**
	 * Render the full markup of the first featured image, incl. image wrapper and rollover
	 * @param  string 	$post_id 					ID of the current post
	 * @param  string 	$post_featured_image_size 	Size of the featured image
	 * @param  string 	$post_permalink 			Permalink of current post
	 * @param  boolean	$display_post_title 		Set to yes to show post title on rollover
	 * @param  boolean	$display_post_categories 	Set to yes to show post categories on rollover
	 * @param  boolean	$display_post_categories 	Set to yes to show post categories on rollover
 	 * @param  string	$display_post_title 		Controls if the post title will be shown; "deafult": theme option setting; enable/disable otheriwse
 	 * @param  string	$type 						Type of element the featured image is for. "Related" for related posts is the only type in use so far
 	 * @param  string	$gallery_id 				ID of a special gallery the rollover "zoom" link should be connected to for lightbox
 	 * @param  string	$display_rollover 			yes|no|force_yes: no disables rollover; force_yes will force rollover even if the Theme Option is set to no
	 *
	 * @return string Full HTML markup of the first featured image
	 **/
	function avada_render_first_featured_image_markup( $post_id, $post_featured_image_size = '', $post_permalink = '', $display_placeholder_image = FALSE, $display_woo_price = FALSE, $display_woo_buttons = FALSE, $display_post_categories = 'default', $display_post_title = 'default', $type = '', $gallery_id = '', $display_rollover = 'yes', $display_woo_rating = FALSE ) {
		// Add a class for fixed image size, to restrict the image rollovers to the image width
		$image_size_class = '';
		if ( $post_featured_image_size != 'full' ) {
			$image_size_class = ' fusion-image-size-fixed';
		}
		if ( ( ! has_post_thumbnail( $post_id ) && get_post_meta( $post_id, 'pyre_video', true ) ) ||
			 ( is_home() && $post_featured_image_size == 'blog-large' )
		) {
			$image_size_class = '';
		}

		$html = '<div class="fusion-image-wrapper' . $image_size_class . '" aria-haspopup="true">';
			// Get the featured image
			ob_start();
			// If there is a featured image, display it
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, $post_featured_image_size );

			// Display a video if it is set
			} elseif ( get_post_meta( $post_id, 'pyre_video', true ) ) {
				?>
				<div class="full-video">
					<?php echo get_post_meta( $post_id, 'pyre_video', true ); ?>
				</div>
				<?php

			// If there is no featured image setup a placeholder
			} elseif ( $display_placeholder_image ) {
					/**
					 * avada_placeholder_image hook
					 *
					 * @hooked avada_render_placeholder_image - 10 (outputs the HTML for the placeholder image)
					 */
					do_action( 'avada_placeholder_image', $post_featured_image_size );
			}
			$featured_image = ob_get_clean();

			if ( $type == 'related' && $post_featured_image_size == 'fixed' && get_post_thumbnail_id( $post_id ) ) {
				$image = Fusion_Image_Resizer::image_resize( array(
					'width' => '500',
					'height' => '383',
					'url' =>  wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ),
					'path' => get_attached_file( get_post_thumbnail_id( $post_id ) )
				) );

				$featured_image = sprintf( '<img src="%s" width="%s" height="%s" alt="%s" />', $image['url'], $image['width'], $image['height'], get_the_title( $post_id ) );
			}

			// If rollovers are enabled, add one to the image container
			if ( ( Avada()->settings->get( 'image_rollover' ) && $display_rollover == 'yes' ) ||
				 $display_rollover == 'force_yes'
			) {
				$html .= $featured_image;

				ob_start();
				/**
				 * avada_rollover hook
				 *
				 * @hooked avada_render_rollover - 10 (outputs the HTML for the image rollover)
				 */
				do_action( 'avada_rollover', $post_id, $post_permalink, $display_woo_price, $display_woo_buttons, $display_post_categories, $display_post_title, $gallery_id, $display_woo_rating );
				$rollover = ob_get_clean();

				$html .= $rollover;

			// If rollovers are disabled, add post permalink to the featured image
			} else {
				$html .= sprintf( '<a href="%s">%s</a>', $post_permalink, $featured_image );
			}

		$html .= '</div>';

		return $html;
	}
}

if ( ! function_exists( 'avada_get_image_orientation_class' ) ) {
	/**
	 * Returns the image class according to aspect ratio
	 *
	 * @return string The image class
	 **/
	function avada_get_image_orientation_class( $attachment ) {

		$sixteen_to_nine_ratio = 1.77;
		$imgage_class = 'fusion-image-grid';

		if ( ! empty( $attachment[1] ) &&
			 ! empty( $attachment[2] )
		) {
			// Landscape
			if ( $attachment[1] / $attachment[2] > $sixteen_to_nine_ratio ) {
				$imgage_class = 'fusion-image-landscape';
			// Portrait
			} elseif ( $attachment[2] / $attachment[1] > $sixteen_to_nine_ratio ) {
				$imgage_class = 'fusion-image-portrait';
			}
		}

		return $imgage_class;
	}
}

if ( ! function_exists( 'avada_render_post_title' ) ) {
	/**
	 * Render the post title as linked h1 tag
	 *
	 * @return string The post title as linked h1 tag
	 **/
	function avada_render_post_title( $post_id = '', $linked = TRUE, $custom_title = '', $custom_size = '2' ) {

		$entry_title_class = '';

		// Add the entry title class if rich snippets are enabled
		if ( ! Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) {
			$entry_title_class = ' class="entry-title"';
		}

		// If we have a custom title, use it
		if ( $custom_title ) {
			$title = $custom_title;
		// Otherwise get post title
		} else {
			$title = get_the_title( $post_id );
		}

		// If the post title should be linked at the markup
		if ( $linked ) {
			$link_target = '';
			if( fusion_get_page_option( 'link_icon_target', $post_id ) == 'yes' ||
				fusion_get_page_option( 'post_links_target', $post_id ) == 'yes' ) {
				$link_target = ' target="_blank"';
			}

			$title = sprintf( '<a href="%s"%s>%s</a>', get_permalink( $post_id ), $link_target, $title );
		}

		// Setup the HTML markup of the post title
		$html = sprintf( '<h%s%s>%s</h%s>', $custom_size, $entry_title_class, $title, $custom_size );


		return $html;
	}
}

if ( ! function_exists( 'avada_get_portfolio_classes' ) ) {
	/**
	 * Determine the css classes need for portfolio page content container
	 *
	 * @return string The classes separated with space
	 **/
	function avada_get_portfolio_classes( $post_id = '' ) {

		$classes = 'fusion-portfolio';

		// Get the page template slug without .php suffix
		$page_template = str_replace( '.php', '', get_page_template_slug( $post_id ) );

		// Add the text class, if a text layout is used
		if ( strpos( $page_template, 'text' ) ||
			 strpos( $page_template, 'one' )
		) {
			$classes .= ' fusion-portfolio-text';
		}

		// If one column text layout is used, add special class
		if ( strpos( $page_template, 'one' ) &&
			 ! strpos( $page_template, 'text' )
		) {
			$classes .= ' fusion-portfolio-one-nontext';
		}

		// For text layouts add the class for boxed/unboxed
		if ( strpos( $page_template, 'text' ) ) {

			$classes .= sprintf( ' fusion-portfolio-%s ', fusion_get_option( 'portfolio_text_layout', 'portfolio_text_layout', $post_id  ) );
			$page_template = str_replace( '-text', '', $page_template );
		}

		// Add the column class
		$page_template = str_replace( '-column', '', $page_template );
		$classes .= ' fusion-' . $page_template;

		return $classes;
	}
}

if( ! function_exists( 'avada_is_portfolio_template' ) ) {
	function avada_is_portfolio_template() {
		if ( is_page_template( 'portfolio-one-column-text.php' ) ||
			is_page_template( 'portfolio-one-column.php' ) ||
			is_page_template( 'portfolio-two-column.php' ) ||
			is_page_template( 'portfolio-two-column-text.php' ) ||
			is_page_template( 'portfolio-three-column.php' ) ||
			is_page_template( 'portfolio-three-column-text.php' ) ||
			is_page_template( 'portfolio-four-column.php' ) ||
			is_page_template( 'portfolio-four-column-text.php' ) ||
			is_page_template( 'portfolio-five-column.php' ) ||
			is_page_template( 'portfolio-five-column-text.php' ) ||
			is_page_template( 'portfolio-six-column.php' ) ||
			is_page_template( 'portfolio-six-column-text.php' ) ||
			is_page_template( 'portfolio-grid.php' )
		) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'avada_get_image_size_dimensions' ) ) {
	function avada_get_image_size_dimensions( $image_size = 'full' ) {
		global $_wp_additional_image_sizes;

		if ( $image_size == 'full' ) {
			$image_dimension = array( 'height' => 'auto', 'width' => '100%' );
		} else {
			$image_dimension = array( 'height' => $_wp_additional_image_sizes[$image_size]['height'] . 'px', 'width' => $_wp_additional_image_sizes[$image_size]['width'] . 'px' );
		}

		return $image_dimension;
	}
}

if ( ! function_exists( 'avada_get_portfolio_image_size' ) ) {
	function avada_get_portfolio_image_size( $current_page_id ) {

		if(  is_page_template( 'portfolio-one-column-text.php' ) ) {
			$custom_image_size = 'portfolio-full';
		} else if ( is_page_template( 'portfolio-one-column.php' ) ) {
			$custom_image_size = 'portfolio-one';
		} else if ( is_page_template( 'portfolio-two-column.php' ) ||
				   is_page_template( 'portfolio-two-column-text.php' )
		) {
			$custom_image_size = 'portfolio-two';
		} else if ( is_page_template( 'portfolio-three-column.php' ) ||
				   is_page_template( 'portfolio-three-column-text.php' )
		) {
			$custom_image_size = 'portfolio-three';
		} else if ( is_page_template( 'portfolio-four-column.php' ) ||
				   is_page_template( 'portfolio-four-column-text.php' )
		) {
			$custom_image_size = 'portfolio-four';
		} else if ( is_page_template( 'portfolio-five-column.php' ) ||
				   is_page_template( 'portfolio-five-column-text.php' )
		) {
			$custom_image_size = 'portfolio-five';
		} else if ( is_page_template( 'portfolio-six-column.php' ) ||
				   is_page_template( 'portfolio-six-column-text.php' )
		) {
			$custom_image_size = 'portfolio-six';
		} else {
			$custom_image_size = 'full';
		}

		if ( get_post_meta( $current_page_id, 'pyre_portfolio_featured_image_size', true ) == 'default' ||
			! get_post_meta( $current_page_id, 'pyre_portfolio_featured_image_size', true )
		) {
			if ( 'full' == Avada()->settings->get( 'portfolio_featured_image_size' ) ) {
				$featured_image_size = 'full';
			} else {
				$featured_image_size = $custom_image_size;
			}
		} else if ( get_post_meta( $current_page_id, 'pyre_portfolio_featured_image_size', true ) == 'full' ) {
			$featured_image_size = 'full';
		} else {
			$featured_image_size = $custom_image_size;
		}

		if ( is_page_template( 'portfolio-grid.php' ) ) {
			$featured_image_size = 'full';
		}

		return $featured_image_size;
	}
}



if ( ! function_exists( 'avada_get_blog_layout' ) ) {
	/**
	 * Get the blog layout for the current page template
	 *
	 * @return string The correct layout name for the blog post class
	 **/
	function avada_get_blog_layout() {
		$theme_options_blog_var = '';

		if ( is_home() ) {
			$theme_options_blog_var = 'blog_layout';
		} elseif ( is_archive() || is_author() ) {
			$theme_options_blog_var = 'blog_archive_layout';
		} elseif ( is_search() ) {
			$theme_options_blog_var = 'search_layout';
		}

		$blog_layout = str_replace( ' ', '-', strtolower( Avada()->settings->get( $theme_options_blog_var ) ) );

		return $blog_layout;
	}
}

if ( ! function_exists( 'avada_render_post_metadata' ) ) {
	/**
	 * Render the full meta data for blog archive and single layouts
	 * @param 	string $layout 	The blog layout (either single, standard, alternate or grid_timeline)
	 *
	 * @return 	string 			HTML markup to display the date and post format box
	 **/
	function avada_render_post_metadata( $layout, $settings = array() ) {

		$html = $author = $date = $metadata = '';

		if ( ! $settings ) {
			$settings['post_meta']          = Avada()->settings->get( 'post_meta' );
			$settings['post_meta_author']   = Avada()->settings->get( 'post_meta_author' );
			$settings['post_meta_date']     = Avada()->settings->get( 'post_meta_date' );
			$settings['post_meta_cats']     = Avada()->settings->get( 'post_meta_cats' );
			$settings['post_meta_tags']     = Avada()->settings->get( 'post_meta_tags' );
			$settings['post_meta_comments'] = Avada()->settings->get( 'post_meta_comments' );
		}

		// Check if meta data is enabled
		if ( ( $settings['post_meta'] && get_post_meta( get_queried_object_id(), 'pyre_post_meta', TRUE ) != 'no' ) ||
			 ( ! $settings['post_meta'] && get_post_meta( get_queried_object_id(), 'pyre_post_meta', TRUE ) == 'yes' ) ) {

			// For alternate, grid and timeline layouts return empty single-line-meta if all meta data for that position is disabled
			if ( ( $layout == 'alternate' || $layout == 'grid_timeline' ) &&
				$settings['post_meta_author'] &&
				$settings['post_meta_date'] &&
				$settings['post_meta_cats'] &&
				$settings['post_meta_tags'] &&
				$settings['post_meta_comments']
			) {
				return $html;
			}

			// Render author meta data
			if ( ! $settings['post_meta_author'] ) {
				ob_start();
				the_author_posts_link();
				$author_post_link = ob_get_clean();

				// Check if rich snippets are enabled
				if ( Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) {
					$metadata .= sprintf( '%s <span>%s</span><span class="fusion-inline-sep">|</span>', __( 'By', 'Avada' ), $author_post_link );
				} else {
					$metadata .= sprintf( '%s <span class="vcard"><span class="fn">%s</span></span><span class="fusion-inline-sep">|</span>', __( 'By', 'Avada' ), $author_post_link );
				}
			// If author meta data won't be visible, render just the invisible author rich snippet
			} else {
				$author .= avada_render_rich_snippets_for_pages( FALSE, TRUE, FALSE );
			}

			// Render the updated meta data or at least the rich snippet if enabled
			if ( ! $settings['post_meta_date'] ) {
				$metadata .= avada_render_rich_snippets_for_pages( FALSE, FALSE, TRUE );
				$metadata .= sprintf( '<span>%s</span><span class="fusion-inline-sep">|</span>', get_the_time( Avada()->settings->get( 'date_format' ) ) );
			} else {
				$date .= avada_render_rich_snippets_for_pages( FALSE, FALSE, TRUE );
			}

			// Render rest of meta data
			// Render categories
			if ( ! $settings['post_meta_cats'] ) {
				ob_start();
				the_category( ', ' );
				$categories = ob_get_clean();

				if ( $categories ) {
					if ( ! $settings['post_meta_tags'] ) {
						$metadata .=  __( 'Categories:', 'Avada' ) . ' ';
					}

					$metadata .= sprintf( '%s<span class="fusion-inline-sep">|</span>', $categories );
				}
			}

			// Render tags
			if ( ! $settings['post_meta_tags'] ) {
				ob_start();
				the_tags( '' );
				$tags = ob_get_clean();

				if( $tags ) {
					$metadata .= sprintf( '<span class="meta-tags">%s %s</span><span class="fusion-inline-sep">|</span>', __( 'Tags:', 'Avada' ), $tags );
				}
			}

			// Render comments
			if ( ! $settings['post_meta_comments'] && $layout != 'grid_timeline' ) {
				ob_start();
				comments_popup_link( __( '0 Comments', 'Avada' ), __( '1 Comment', 'Avada' ), '% ' . __( 'Comments', 'Avada' ) );
				$comments = ob_get_clean();
				$metadata .= sprintf( '<span class="fusion-comments">%s</span>', $comments );
			}

			// Render the HTML wrappers for the different layouts
			if ( $metadata ) {
				$metadata = $author . $date . $metadata;

				if ( $layout == 'single' ) {
					$html .= sprintf ( '<div class="fusion-meta-info"><div class="fusion-meta-info-wrapper">%s</div></div>', $metadata );
				} elseif ( $layout == 'alternate' ||
					$layout == 'grid_timeline'
				) {
					$html .= sprintf( '<p class="fusion-single-line-meta">%s</p>', $metadata );
				} else {
					$html .= sprintf( '<div class="fusion-alignleft">%s</div>', $metadata );
				}
			} else {
				$html .= $author . $date;
			}
		// Render author and updated rich snippets for grid and timeline layouts
		} else {
			if ( ! Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) {
				$html .= avada_render_rich_snippets_for_pages( FALSE );
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'avada_render_social_sharing' ) ) {
	function avada_render_social_sharing( $post_type = 'post' ) {
		global $social_icons;

		 if ( $post_type == 'post' ) {
		 	$setting_name = 'social_sharing_box';
		 } else {
		 	$setting_name = $post_type . '_social_sharing_box';
		 }

		if ( ( Avada()->settings->get( $setting_name ) && get_post_meta( get_the_ID(), 'pyre_share_box', true) != 'no' ) ||
			 ( ! Avada()->settings->get( $setting_name ) && get_post_meta( get_the_ID(), 'pyre_share_box', true) == 'yes' )
		) {

			$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

			$sharingbox_soical_icon_options = array (
				'sharingbox'		=> 'yes',
				'icon_colors' 		=> Avada()->settings->get( 'sharing_social_links_icon_color' ),
				'box_colors' 		=> Avada()->settings->get( 'sharing_social_links_box_color' ),
				'icon_boxed' 		=> Avada()->settings->get( 'sharing_social_links_boxed' ),
				'icon_boxed_radius' => Avada()->settings->get( 'sharing_social_links_boxed_radius' ),
				'tooltip_placement'	=> Avada()->settings->get( 'sharing_social_links_tooltip_placement' ),
				'linktarget'        => Avada()->settings->get( 'social_icons_new' ),
				'title'				=> wp_strip_all_tags( get_the_title( get_the_ID() ), true ),
				'description'		=> Avada()->blog->get_content_stripped_and_excerpted( 55, get_the_content() ),
				'link'				=> get_permalink( get_the_ID() ),
				'pinterest_image'	=> ( $full_image ) ? $full_image[0] : '',
			);
			?>
			<div class="fusion-sharing-box fusion-single-sharing-box share-box">
				<h4><?php echo apply_filters( 'fusion_sharing_box_tagline', Avada()->settings->get( 'sharing_social_tagline' ) ); ?></h4>
				<?php echo $social_icons->render_social_icons( $sharingbox_soical_icon_options ); ?>
			</div>
			<?php
		}
	}
}

if( ! function_exists( 'avada_render_related_posts' ) ) {
	/**
	 * Render related posts carousel
	 * @param  string $post_type 		The post type to determine correct related posts and headings
	 *
	 * @return string 					HTML markup to display related posts
	 **/
	function avada_render_related_posts( $post_type = 'post' ) {

		$html = '';

		// Set the needed variables according to post type
		if ( $post_type == 'post' ) {
			$theme_option_name = 'related_posts';
			$main_heading =  __( 'Related Posts', 'Avada' );
		} elseif ( $post_type == 'avada_portfolio' ) {
			$theme_option_name = 'portfolio_related_posts';
			$main_heading =  __( 'Related Projects', 'Avada' );
		}

		// Check if related posts should be shown
		if ( fusion_get_option( $theme_option_name, 'related_posts', get_the_ID() ) == 'yes' ||
			 fusion_get_option( $theme_option_name, 'related_posts', get_the_ID() ) == '1'
		) {
			if ( $post_type == 'post' ) {
				$related_posts = fusion_get_related_posts( get_the_ID(), Avada()->settings->get( 'number_related_posts' ) );
			} elseif ( $post_type == 'avada_portfolio' ) {
				$related_posts = fusion_get_related_projects( get_the_ID(), Avada()->settings->get( 'number_related_posts' ) );
			}

			// If there are related posts, display them
			if ( $related_posts->have_posts() ) {
				$html .= '<div class="related-posts single-related-posts">';
					ob_start();
					echo Avada()->template->title_template( $main_heading, '3' );
					$html .= ob_get_clean();

					// Get the correct image size
					if ( 'cropped' == Avada()->settings->get( 'related_posts_image_size' ) ) {
						$featured_image_size = 'fixed';
						$data_image_size = 'fixed';
					} else {
						$featured_image_size = 'full';
						$data_image_size = 'auto';
					}

					// Set the meta content variable
					if ( 'title_on_rollover' == Avada()->settings->get( 'related_posts_layout' ) ) {
						$data_meta_content = 'no';
					} else {
						$data_meta_content = 'yes';
					}

					// Set the autoplay variable
					if ( Avada()->settings->get( 'related_posts_autoplay' ) ) {
						$data_autoplay = 'yes';
					} else {
						$data_autoplay = 'no';
					}

					// Set the touch scroll variable
					if ( Avada()->settings->get( 'related_posts_swipe' ) ) {
						$data_swipe = 'yes';
					} else {
						$data_swipe = 'no';
					}

					$carousel_item_css = '';
					if ( sizeof( $related_posts->posts ) < Avada()->settings->get( 'related_posts_columns' ) ) {
						$carousel_item_css = ' style="max-width: 300px;"';
					}

					$html .= sprintf( '<div class="fusion-carousel" data-imagesize="%s" data-metacontent="%s" data-autoplay="%s" data-touchscroll="%s" data-columns="%s" data-itemmargin="%s" data-itemwidth="180" data-touchscroll="yes" data-scrollitems="%s">',
									  $data_image_size, $data_meta_content, $data_autoplay, $data_swipe, Avada()->settings->get( 'related_posts_columns' ), Avada()->settings->get( 'related_posts_column_spacing' ), Avada()->settings->get( 'related_posts_swipe_items' ) );
						$html .= '<div class="fusion-carousel-positioner">';
							$html .= '<ul class="fusion-carousel-holder">';
								// Loop through related posts
								while( $related_posts->have_posts() ): $related_posts->the_post();
									$html .= sprintf( '<li class="fusion-carousel-item"%s>', $carousel_item_css );
										$html .= '<div class="fusion-carousel-item-wrapper">';
											// Title on rollover layout
											if ( 'title_on_rollover' == Avada()->settings->get( 'related_posts_layout' ) ) {
												$html .= avada_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, FALSE, 'disable', 'default', 'related' );
											// Title below image layout
											} else {
												$html .= avada_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, FALSE, 'disable', 'disable', 'related' );

												// Get the post title
												$html .= sprintf( '<h4 class="fusion-carousel-title"><a href="%s"%s>%s</a></h4>', get_permalink( get_the_ID() ), '_self', get_the_title() );

												$html .= '<div class="fusion-carousel-meta">';

													$html .= sprintf( '<span class="fusion-date">%s</span>', get_the_time( Avada()->settings->get( 'date_format' ), get_the_ID() ) );

													$html .= '<span class="fusion-inline-sep">|</span>';

													$comments = $comments_link = '';
													ob_start();
													comments_popup_link( __( '0 Comments', 'Avada' ), __( '1 Comment', 'Avada' ), '% ' . __( 'Comments', 'Avada' ) );
													$comments_link = ob_get_clean();

													$html .= sprintf( '<span>%s</span>', $comments_link );

												$html .= '</div>'; // fusion-carousel-meta
											}
										$html .= '</div>'; // fusion-carousel-item-wrapper
									$html .= '</li>';
								endwhile;
							$html .= '</ul>'; // fusion-carousel-holder
							// Add navigation if needed
							if ( Avada()->settings->get( 'related_posts_navigation' ) ) {
								$html .= '<div class="fusion-carousel-nav"><span class="fusion-nav-prev"></span><span class="fusion-nav-next"></span></div>';
							}
						$html .= '</div>'; // fusion-carousel-positioner
					$html .= '</div>'; // fusion-carousel
				$html .= '</div>'; // related-posts

				wp_reset_postdata();
			}
		}

		return $html;
	}
}


if( ! function_exists( 'avada_render_rich_snippets_for_pages' ) ) {
	/**
	 * Render the full meta data for blog archive and single layouts
	 * @param  boolean $title_tag 		Set to TRUE to render title rich snippet
	 * @param  boolean $author_tag 		Set to TRUE to render author rich snippet
	 * @param  boolean $updated_tag 	Set to TRUE to render updated rich snippet
	 *
	 * @return string 					HTML markup to display rich snippets
	 **/
	function avada_render_rich_snippets_for_pages( $title_tag = TRUE, $author_tag = TRUE, $updated_tag = TRUE ) {

		$html = '';

		if( ! Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) {

			if( $title_tag ) {
				$html = '<span class="entry-title" style="display: none;">' . get_the_title() . '</span>';
			}

			if( $author_tag ) {
				ob_start();
				the_author_posts_link();
				$author_post_link = ob_get_clean();
				$html .= '<span class="vcard" style="display: none;"><span class="fn">' . $author_post_link . '</span></span>';
			}

			if( $updated_tag ) {
				$html .= '<span class="updated" style="display:none;">' . get_the_modified_time( 'c' ) . '</span>';
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'avada_extract_shortcode_contents' ) ) {
	/**
	 * Extract text contents from all shortcodes for usage in excerpts
	 *
	 * @return string The shortcode contents
	 **/
	function avada_extract_shortcode_contents( $m ) {

		global $shortcode_tags;

		// Setup the array of all registered shortcodes
		$shortcodes = array_keys( $shortcode_tags );
		$no_space_shortcodes = array( 'dropcap' );
		$omitted_shortcodes = array( 'fusion_code', 'slide' );

		// Extract contents from all shortcodes recursively
		if ( in_array( $m[2], $shortcodes ) && ! in_array( $m[2], $omitted_shortcodes ) ) {
			$pattern = get_shortcode_regex();
			// Add space the excerpt by shortcode, except for those who should stick together, like dropcap
			$space = ' ' ;
			if ( in_array( $m[2], $no_space_shortcodes ) ) {
				$space = '' ;
			}
			$content = preg_replace_callback( "/$pattern/s", 'avada_extract_shortcode_contents', rtrim( $m[5] ) . $space );
			return $content;
		}

		// allow [[foo]] syntax for escaping a tag
		if ( $m[1] == '[' &&
			 $m[6] == ']'
		) {
			return substr($m[0], 1, -1);
		}

	   return $m[1] . $m[6];
	}
}

if ( ! function_exists( 'avada_page_title_bar' ) ) {
	/**
	 * Render the HTML markup of the page title bar
	 * @param  string $title 				Main title; page/post title or custom title set by user
	 * @param  string $subtitle 			Subtitle as custom user setting
	 * @param  string $secondary_content 	HTML markup of the secondary content; breadcrumbs or search field
	 *
	 * @return void 						Content is directly echoed
	 **/
	function avada_page_title_bar( $title, $subtitle, $secondary_content ) {
		$post_id = get_queried_object_id();

		// Check for the secondary content
		$content_type = 'none';
		if ( false !== strpos( $secondary_content, 'searchform' ) ) {
			$content_type = 'search';
		} elseif ( $secondary_content != '' ) {
			$content_type = 'breadcrumbs';
		}

		// Check the position of page title
		if ( metadata_exists( 'post', $post_id, 'pyre_page_title_text_alignment' ) && 'default' != get_post_meta( get_queried_object_id(), 'pyre_page_title_text_alignment', true ) ) {
			$alignment = get_post_meta( $post_id, 'pyre_page_title_text_alignment', true );
		} elseif ( Avada()->settings->get( 'page_title_alignment' ) ) {
			$alignment = Avada()->settings->get( 'page_title_alignment' );
		}

		/**
		 * Render the page title bar
		 */
		?>
		<div class="fusion-page-title-bar fusion-page-title-bar-<?php echo $content_type; ?> fusion-page-title-bar-<?php echo $alignment; ?>">
			<div class="fusion-page-title-row">
				<div class="fusion-page-title-wrapper">
					<div class="fusion-page-title-captions">
						<?php if ( $title ) : ?>
							<?php // Add entry-title for rich snippets ?>
							<?php $entry_title_class = ( ! Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) ? ' class="entry-title"' : ''; ?>
							<h1<?php echo $entry_title_class; ?>><?php echo $title; ?></h1>

							<?php if ( $subtitle ) : ?>
								<h3><?php echo $subtitle; ?></h3>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( 'center' == $alignment ) : // Render secondary content on center layout ?>
							<?php if ( 'none' != fusion_get_option( 'page_title_bar_bs', 'page_title_breadcrumbs_search_bar', $post_id ) ) : ?>
								<div class="fusion-page-title-secondary"><?php echo $secondary_content; ?></div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<?php if ( 'center' != $alignment ) : // Render secondary content on left/right layout ?>
						<?php if ( 'none' != fusion_get_option( 'page_title_bar_bs', 'page_title_breadcrumbs_search_bar', $post_id ) ) : ?>
							<div class="fusion-page-title-secondary"><?php echo $secondary_content; ?></div>
						<?php endif; ?>
					<?php endif;?>
				</div>
			</div>
		</div>
		<?php
	}
}

add_filter( 'wp_nav_menu_items', 'avada_add_login_box_to_nav', 10, 3 );
/**
 * Add woocommerce cart to main navigation or top navigation
 * @param  string HTML for the main menu items
 * @param  args   Arguments for the WP menu
 * @return string
 */
if( ! function_exists( 'avada_add_login_box_to_nav' ) ) {
	function avada_add_login_box_to_nav( $items, $args ) {

		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable woo cart on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false ) {
			if( $args->theme_location == 'main_navigation' || $args->theme_location == 'top_navigation' || $args->theme_location == 'sticky_navigation' ) {
				if( $args->theme_location == 'main_navigation' || $args->theme_location == 'sticky_navigation' ) {
					$is_enabled = fusion_get_theme_option( 'woocommerce_acc_link_main_nav' );
				} else if( $args->theme_location == 'top_navigation' ) {
					$is_enabled = fusion_get_theme_option( 'woocommerce_acc_link_top_nav' );
				}

				if( class_exists( 'WooCommerce' ) && $is_enabled ) {
					$woo_account_page_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					$logout_link = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );

					if ( $woo_account_page_link ) {
						$items .= '<li class="fusion-custom-menu-item fusion-menu-login-box">';
							// If chosen in Theme Options, display the caret icon, as the my account item alyways has a dropdown
							$caret_icon = '';
							if ( Avada()->settings->get( 'menu_display_dropdown_indicator' ) ) {
								$caret_icon = '<span class="fusion-caret"><i class="fusion-dropdown-indicator"></i></span>';
							}
							if ( 'Right' == Avada()->settings->get( 'header_position' ) ) {
								$my_account_link_contents = $caret_icon . __( 'My Account', 'Avada' );
							} else {
								$my_account_link_contents = __( 'My Account', 'Avada' ) . $caret_icon;
							}
							$items .= sprintf( '<a href="%s">%s</a>', $woo_account_page_link, $my_account_link_contents );
							if( ! is_user_logged_in() ) {
							$items .= '<div class="fusion-custom-menu-item-contents">';
								if( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) {
									$items .= sprintf( '<p class="fusion-menu-login-box-error">%s</p>', __( 'Login failed, please try again.', 'Avada' ) );
								}
								$items .= sprintf( '<form action="%s" name="loginform" method="post">', wp_login_url() );
									$items .= sprintf( '<p><input type="text" class="input-text" name="log" id="username" value="" placeholder="%s" /></p>', __( 'Username', 'Avada' ) );
									$items .= sprintf( '<p><input type="password" class="input-text" name="pwd" id="password" value="" placeholder="%s" /></p>', __( 'Password', 'Avada' ) );
									$items .= sprintf( '<p class="fusion-remember-checkbox"><label for="fusion-menu-login-box-rememberme"><input name="rememberme" type="checkbox" id="fusion-menu-login-box-rememberme" value="forever"> %s</label></p>', __( 'Remember Me', 'Avada' ) );
									$items .= '<input type="hidden" name="fusion_woo_login_box" value="true" />';
									$items .= sprintf( '<p class="fusion-login-box-submit">
															<input type="submit" name="wp-submit" id="wp-submit" class="button small default comment-submit" value="%s">
															<input type="hidden" name="redirect" value="%s">
														</p>', __( 'Log In', 'Avada' ), esc_url ( ( isset( $_SERVER['HTTP_REFERER'] ) ) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI'] ) );
								$items .= '</form>';
							$items .= '</div>';
							} else {
								$items .= '<ul class="sub-menu">';
									$items .= sprintf( '<li><a href="%s">%s</a></li>', $logout_link, __( 'Logout', 'Avada' ) );
								$items .= '</ul>';
							}
						$items .= '</li>';
					}
				}
			}
		}

		return $items;
	}
}

if( ! function_exists( 'avada_nav_woo_cart' ) ) {
	/**
	 * Woo Cart Dropdown for Main Nav or Top Nav
	 *
	 * @return string HTML of Dropdown
	 */
	function avada_nav_woo_cart( $position = 'main' ) {
		global $woocommerce;

		if( $position == 'main' ) {
			$is_enabled = fusion_get_theme_option( 'woocommerce_cart_link_main_nav' );
			$main_cart_class = 'fusion-main-menu-cart';
			$cart_link_active_class = 'fusion-main-menu-icon fusion-main-menu-icon-active';
			$cart_link_active_text = '';

			if( Avada()->settings->get( 'woocommerce_cart_counter') ) {
					$cart_link_active_text = '<span class="fusion-widget-cart-number">' . $woocommerce->cart->get_cart_contents_count() . '</span>';
					$main_cart_class .= ' fusion-widget-cart-counter';
			}

			if( ! Avada()->settings->get( 'woocommerce_cart_counter') && $woocommerce->cart->get_cart_contents_count() ) {
				$main_cart_class .= ' fusion-active-cart-icons';
			}

			$cart_link_inactive_class = 'fusion-main-menu-icon';
			$cart_link_inactive_text = '';
		} else if( $position ='secondary' ) {
			$is_enabled = fusion_get_theme_option( 'woocommerce_cart_link_top_nav' );
			$main_cart_class = 'fusion-secondary-menu-cart';
			$cart_link_active_class = 'fusion-secondary-menu-icon';
			$cart_link_active_text = sprintf('%s %s <span class="fusion-woo-cart-separator">-</span> %s', $woocommerce->cart->get_cart_contents_count(), __( 'Item(s)', 'Avada' ),wc_price( $woocommerce->cart->subtotal ) );
			$cart_link_inactive_class = $cart_link_active_class;
			$cart_link_inactive_text = __( 'Cart', 'Avada' );
		}

		if( class_exists( 'WooCommerce' ) && $is_enabled ) {
			$woo_cart_page_link = get_permalink( get_option( 'woocommerce_cart_page_id' ) );

			$items = sprintf( '<li class="fusion-custom-menu-item fusion-menu-cart %s">', $main_cart_class );
				if( $woocommerce->cart->get_cart_contents_count() ) {
					$checkout_link = get_permalink( get_option('woocommerce_checkout_page_id') );

					$items .= sprintf( '<a class="%s" href="%s">%s</a>', $cart_link_active_class, $woo_cart_page_link, $cart_link_active_text );

					$items .= '<div class="fusion-custom-menu-item-contents fusion-menu-cart-items">';
						foreach( $woocommerce->cart->cart_contents as $cart_item ) {
							$product_link = get_permalink( $cart_item['product_id'] );
							$thumbnail_id = ( $cart_item['variation_id'] && has_post_thumbnail( $cart_item['variation_id'] )  ) ? $cart_item['variation_id'] : $cart_item['product_id'];
							$items .= '<div class="fusion-menu-cart-item">';
								$items .= sprintf( '<a href="%s">', $product_link );
									$items .= get_the_post_thumbnail( $thumbnail_id, 'recent-works-thumbnail' );
									$items .= '<div class="fusion-menu-cart-item-details">';
										$items .= sprintf( '<span class="fusion-menu-cart-item-title">%s</span>', $cart_item['data']->post->post_title );
										$items .= sprintf( '<span class="fusion-menu-cart-item-quantity">%s x %s</span>', $cart_item['quantity'], $woocommerce->cart->get_product_subtotal( $cart_item['data'], 1 ) );
									$items .= '</div>';
								$items .= '</a>';
							$items .= '</div>';
						}
						$items .= '<div class="fusion-menu-cart-checkout">';
							$items .= sprintf( '<div class="fusion-menu-cart-link"><a href="%s">%s</a></div>', $woo_cart_page_link, __('View Cart', 'Avada') );
							$items .= sprintf( '<div class="fusion-menu-cart-checkout-link"><a href="%s">%s</a></div>', $checkout_link, __('Checkout', 'Avada') );
						$items .= '</div>';
					$items .= '</div>';
				} else {
					$items .= sprintf( '<a class="%s" href="%s">%s</a>', $cart_link_inactive_class, $woo_cart_page_link, $cart_link_inactive_text );
				}
			$items .= '</li>';

			return $items;
		}
	}
}

if( ! function_exists( 'fusion_add_woo_cart_to_widget_html' ) ) {
	function fusion_add_woo_cart_to_widget_html() {
		global $woocommerce;

		if( class_exists( 'WooCommerce') ) {
			$counter = '';
			$class = '';
			$items = '';

			if( Avada()->settings->get( 'woocommerce_cart_counter') ) {
					$counter = '<span class="fusion-widget-cart-number">' . $woocommerce->cart->get_cart_contents_count() . '</span>';
					$class = 'fusion-widget-cart-counter';
			}

			if( ! Avada()->settings->get( 'woocommerce_cart_counter') && $woocommerce->cart->get_cart_contents_count() ) {
				$class .= ' fusion-active-cart-icon';
			}

			$items .= '<li class="fusion-widget-cart ' . $class .'">
			<a href="' . get_permalink( get_option( 'woocommerce_cart_page_id' ) ) . '" class="">
				<span class="fusion-widget-cart-icon"></span>
				' . $counter . '
			</a>
			</li>';
		}

		return $items;
	}
}

if( class_exists( 'WooCommerce' ) ) {
	add_filter( 'wp_nav_menu_items', 'avada_add_woo_cart_to_nav', 10, 3 );
}
/**
 * Add woocommerce cart to main navigation or top navigation
 * @param  string HTML for the main menu items
 * @param  args   Arguments for the WP menu
 * @return string
 */
if( ! function_exists( 'avada_add_woo_cart_to_nav' ) ) {
	function avada_add_woo_cart_to_nav( $items, $args ) {
		global $woocommerce;

		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable woo cart on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false && $args->theme_location == 'main_navigation' || $args->theme_location == 'sticky_navigation' ) {
			$items .= avada_nav_woo_cart( 'main' );
		} else if( $ubermenu == false && $args->theme_location == 'top_navigation' ) {
			$items .= avada_nav_woo_cart( 'secondary' );
		}

		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'avada_add_search_to_main_nav', 20, 4 );
/**
 * Add search to the main navigation
 * @param  string HTML for the main menu items
 * @param  args   Arguments for the WP menu
 * @return string
 */
if( ! function_exists( 'avada_add_search_to_main_nav' ) ) {
	function avada_add_search_to_main_nav( $items, $args ) {
		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable woo cart on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false ) {
			if( $args->theme_location == 'main_navigation'  || $args->theme_location == 'sticky_navigation' ) {
				if( fusion_get_theme_option( 'main_nav_search_icon' ) ) {
					$items .= '<li class="fusion-custom-menu-item fusion-main-menu-search">';
						$items .= '<a class="fusion-main-menu-icon"></a>';
						$items .= '<div class="fusion-custom-menu-item-contents">';
							$items .= get_search_form( false );
						$items .= '</div>';
					$items .= '</li>';
				}
			}
		}

		return $items;
	}
}

if( ! function_exists( 'avada_update_featured_content_for_split_terms' ) ) {
	function avada_update_featured_content_for_split_terms( $old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy ) {
		if( 'portfolio_category' == $taxonomy ) {
			$pages = get_pages();

			if( $pages ) {
				foreach( $pages as $page ) {
					$page_id = $page->ID;
					$categories = get_post_meta( $page_id, 'pyre_portfolio_category', true );
					$new_categories = array();
					if( $categories ) {
						foreach( $categories as $category ) {
							if( $category != '0' ) {
								if ( isset( $category ) && $old_term_id == $category ) {
									$new_categories[] = $new_term_id;
								} else {
									$new_categories[] = $category;
								}
							} else {
								$new_categories[] = '0';
							}
						}

						update_post_meta( $page_id, 'pyre_portfolio_category', $new_categories );
					}
				}
			}
		}
	}

	add_action( 'split_shared_term', 'avada_update_featured_content_for_split_terms', 10, 4 );
}

// Omit closing PHP tag to avoid "Headers already sent" issues.

add_action( 'wp_head', 'avada_set_post_views' );
if ( ! function_exists( 'avada_set_post_views' ) ) {
	function avada_set_post_views() {
		global $post;
		if ( 'post' == get_post_type() && is_single() ) {
			$postID = $post->ID;
			if ( ! empty( $postID ) ) {
				$count_key = 'avada_post_views_count';
				$count     = get_post_meta( $postID, $count_key, true );
				if ( '' == $count ) {
					$count = 0;
					delete_post_meta( $postID, $count_key );
					add_post_meta( $postID, $count_key, '0' );
				} else {
					$count++;
					update_post_meta( $postID, $count_key, $count );
				}
			}
		}
	}
}

if ( ! function_exists( 'avada_get_slider' ) ) {
	function avada_get_slider( $post_id, $type ) {
		$type = Avada_Helper::slider_name( $type );
		return ( $type ) ?get_post_meta( $post_id, 'pyre_' . $type, true ) : false;
	}
}

if ( ! function_exists( 'avada_slider' ) ) {
	function avada_slider( $post_id ) {
		$slider_type = avada_get_slider_type( $post_id );
		$slider      = avada_get_slider( $post_id, $slider_type );

		if ( $slider ) {
			$slider_name = Avada_Helper::slider_name( $slider_type );
			$slider_name = ( 'slider' == $slider_name ) ? 'layerslider' : $slider_name;

			$function = 'avada_' . $slider_name;

			$function( $slider );
		}
	}
}

if ( ! function_exists( 'avada_revslider' ) ) {
	function avada_revslider( $name ) {
		if ( function_exists('putRevSlider') ) {
			putRevSlider( $name );
		}
	}
}

if ( ! function_exists( 'avada_layerslider' ) ) {
	function avada_layerslider( $id ) {
		global $wpdb;

		// Get slider
		$ls_table_name = $wpdb->prefix . "layerslider";
		$ls_slider     = $wpdb->get_row( "SELECT * FROM $ls_table_name WHERE id = " . (int) $id . " ORDER BY date_c DESC LIMIT 1" , ARRAY_A );
		$ls_slider     = json_decode( $ls_slider['data'], true );
		?>
		<style type="text/css">
			#layerslider-container{max-width:<?php echo $ls_slider['properties']['width'] ?>;}
		</style>
		<div id="layerslider-container">
			<div id="layerslider-wrapper">
				<?php if ( 'avada' == $ls_slider['properties']['skin'] ) : ?>
					<div class="ls-shadow-top"></div>
				<?php endif; ?>
				<?php echo do_shortcode( '[layerslider id="' . $id . '"]' ); ?>
				<?php if( 'avada' == $ls_slider['properties']['skin'] ) : ?>
					<div class="ls-shadow-bottom"></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'avada_elasticslider' ) ) {
	function avada_elasticslider( $term ) {

		if ( ! Avada()->settings->get( 'status_eslider' ) ) {
			$args				= array(
				'post_type'        => 'themefusion_elastic',
				'posts_per_page'   => -1,
				'suppress_filters' => 0
			);
			$args['tax_query'][] = array(
				'taxonomy' => 'themefusion_es_groups',
				'field'    => 'slug',
				'terms'    => $term
			);
			$query = new WP_Query( $args );
			$count = 1;
			?>

			<?php if ( $query->have_posts() ) : ?>
				<div id="ei-slider" class="ei-slider">
					<div class="fusion-slider-loading"><?php _e( 'Loading...', 'Avada' ); ?></div>
					<ul class="ei-slider-large">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<li style="<?php echo ( $count > 0 ) ? 'opacity: 0;' : ''; ?>">
								<?php the_post_thumbnail( 'full', array( 'title' => '', 'alt' => get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) ); ?>
								<div class="ei-title">
									<?php if ( get_post_meta( get_the_ID(), 'pyre_caption_1', true ) ): ?>
										<h2><?php echo get_post_meta( get_the_ID(), 'pyre_caption_1', true ); ?></h2>
									<?php endif; ?>
									<?php if ( get_post_meta( get_the_ID(), 'pyre_caption_2', true ) ): ?>
										<h3><?php echo get_post_meta( get_the_ID(), 'pyre_caption_2', true ); ?></h3>
									<?php endif; ?>
								</div>
							</li>
							<?php $count ++; ?>
						<?php endwhile; ?>
					</ul>
					<ul class="ei-slider-thumbs" style="display: none;">
						<li class="ei-slider-element">Current</li>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<li>
								<a href="#"><?php the_title(); ?></a>
								<?php the_post_thumbnail( 'full', array( 'title' => '', 'alt' => get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) ); ?>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			<?php wp_reset_query();
		}
	}
}

if ( ! function_exists( 'avada_wooslider' ) ) {
	function avada_wooslider( $term ) {

		if ( ! Avada()->settings->get( 'status_fusion_slider' ) ) {
			$term_details = get_term_by( 'slug', $term, 'slide-page' );

			if ( is_object( $term_details ) ) {
				$slider_settings = get_option( 'taxonomy_' . $term_details->term_id );
			}

			if ( ! isset( $slider_settings['typo_sensitivity'] ) ) {
				$slider_settings['typo_sensitivity'] = '0.6';
			}

			if ( ! isset( $slider_settings['typo_factor'] ) ) {
				$slider_settings['typo_factor'] = '1.5';
			}


			if ( ! isset( $slider_settings['slider_width'] ) || '' == $slider_settings['slider_width'] ) {
				$slider_settings['slider_width'] = '100%';
			}

			if ( ! isset( $slider_settings['slider_height'] ) || '' == $slider_settings['slider_height'] ) {
				$slider_settings['slider_height'] = '500px';
			}

			if ( ! isset( $slider_settings['full_screen'] ) ) {
				$slider_settings['full_screen'] = false;
			}

			if ( ! isset( $slider_settings['animation'] ) ) {
				$slider_settings['animation'] = true;
			}

			if ( ! isset( $slider_settings['nav_box_width'] ) ) {
				$slider_settings['nav_box_width'] = '63px';
			}

			if ( ! isset( $slider_settings['nav_box_height'] ) ) {
				$slider_settings['nav_box_height'] = '63px';
			}

			if ( ! isset( $slider_settings['nav_arrow_size'] ) ) {
				$slider_settings['nav_arrow_size'] = '25px';
			}

			if( $slider_settings['nav_box_height'] ) {
				$nav_box_height_half = intval( $slider_settings['nav_box_height'] ) / 2;
			}

			$slider_data = '';

			if ( $slider_settings ) {
				foreach( $slider_settings as $slider_setting => $slider_setting_value ) {
					$slider_data .= 'data-' . $slider_setting . '="' . $slider_setting_value . '" ';
				}
			}

			$slider_class = '';

			if ( '100%' == $slider_settings['slider_width'] && ! $slider_settings['full_screen'] ) {
				$slider_class .= ' full-width-slider';
			} elseif ( '100%' != $slider_settings['slider_width'] && ! $slider_settings['full_screen'] ) {
				$slider_class .= ' fixed-width-slider';
			}

			if ( isset( $slider_settings['slider_content_width'] ) && '' != $slider_settings['slider_content_width'] ) {
				$content_max_width = 'max-width:' . $slider_settings['slider_content_width'];
			} else {
				$content_max_width = '';
			}

			$args = array(
				'post_type'        => 'slide',
				'posts_per_page'   => -1,
				'suppress_filters' => 0
			);
			$args['tax_query'][] = array(
				'taxonomy' => 'slide-page',
				'field'    => 'slug',
				'terms'    => $term
			);

			$query = new WP_Query( $args );
			?>

			<?php if ( $query->have_posts() ) : ?>

				<?php $max_width = ( 'fade' == $slider_settings['animation'] ) ? 'max-width:' . $slider_settings['slider_width'] : ''; ?>

				<div class="fusion-slider-container fusion-slider-<?php the_ID(); ?> <?php echo $slider_class; ?>-container" style="height:<?php echo $slider_settings['slider_height']; ?>;max-width:<?php echo $slider_settings['slider_width']; ?>;">
					<style type="text/css" scoped="scoped">
					.fusion-slider-<?php the_ID(); ?> .flex-direction-nav a {
						<?php
						if( $slider_settings['nav_box_width'] ) {
							echo 'width:' . $slider_settings['nav_box_width'] . ';';
						}
						if( $slider_settings['nav_box_height'] ) {
							echo 'height:' . $slider_settings['nav_box_height'] . ';';
							echo 'line-height:' . $slider_settings['nav_box_height'] . ';';
							echo 'margin-top:-' . $nav_box_height_half . 'px;';
						}
						if( $slider_settings['nav_arrow_size'] ) {
							echo 'font-size:' . $slider_settings['nav_arrow_size'] . ';';
						}
						?>
					}
                    </style>
					<div class="fusion-slider-loading"><?php _e( 'Loading...', 'Avada' ); ?></div>
					<div class="tfs-slider flexslider main-flex<?php echo $slider_class; ?>" style="max-width:<?php echo $slider_settings['slider_width']; ?>;" <?php echo $slider_data; ?>>
						<ul class="slides" style="<?php echo $max_width ?>;">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<?php
								$metadata = get_metadata( 'post', get_the_ID() );
								$background_image = '';
								$background_class = '';

								$img_width = '';
								$image_url = array( '', '' );

								if ( isset( $metadata['pyre_type'][0] ) && 'image' == $metadata['pyre_type'][0] && has_post_thumbnail() ) {
									$image_id         = get_post_thumbnail_id();
									$image_url        = wp_get_attachment_image_src( $image_id, 'full', true );
									$background_image = 'background-image: url(' . $image_url[0] . ');';
									$background_class = 'background-image';
									$img_width        = $image_url[1];
								}							

								$aspect_ratio 		= '16:9';
								$video_attributes   = '';
								$youtube_attributes = '';
								$vimeo_attributes   = '';
								$data_mute          = 'no';
								$data_loop          = 'no';
								$data_autoplay      = 'no';

								if ( isset( $metadata['pyre_aspect_ratio'][0] ) && $metadata['pyre_aspect_ratio'][0] ) {
									$aspect_ratio = $metadata['pyre_aspect_ratio'][0];
								}

								if ( isset( $metadata['pyre_mute_video'][0] ) && 'yes' == $metadata['pyre_mute_video'][0] ) {
									$video_attributes = 'muted';
									$data_mute        = 'yes';
								}

								// Do not set the &auoplay=1 attributes, as this is done in js to make sure the page is fully loaded before the video begins to play
								if ( isset( $metadata['pyre_autoplay_video'][0] ) && 'yes' == $metadata['pyre_autoplay_video'][0] ) {
									$video_attributes   .= ' autoplay';
									$data_autoplay       = 'yes';
								}

								if ( isset( $metadata['pyre_loop_video'][0] ) && 'yes' == $metadata['pyre_loop_video'][0] ) {
									$video_attributes   .= ' loop';
									$youtube_attributes .= '&amp;loop=1&amp;playlist=' . $metadata['pyre_youtube_id'][0];
									$vimeo_attributes   .= '&amp;loop=1';
									$data_loop           = 'yes';
								}

								if ( isset( $metadata['pyre_hide_video_controls'][0] ) && 'no' == $metadata['pyre_hide_video_controls'][0] ) {
									$video_attributes   .= ' controls';
									$youtube_attributes .= '&amp;controls=1';
									$video_zindex        = 'z-index: 1;';
								} else {
									$youtube_attributes .= '&amp;controls=0';
									$video_zindex        = 'z-index: -99;';
								}

								$heading_color = '';

								if ( isset( $metadata['pyre_heading_color'][0] ) && $metadata['pyre_heading_color'][0] ) {
									$heading_color = 'color:' . $metadata['pyre_heading_color'][0] . ';';
								}

								$heading_bg = '';

								if ( isset( $metadata['pyre_heading_bg'][0] ) && 'yes' == $metadata['pyre_heading_bg'][0] ) {
									$heading_bg = 'background-color: rgba(0,0,0, 0.4);';
									if ( isset( $metadata['pyre_heading_bg_color'][0] ) && '' != $metadata['pyre_heading_bg_color'][0] ) {
										$rgb        = fusion_hex2rgb( $metadata['pyre_heading_bg_color'][0] );
										$heading_bg = sprintf( 'background-color: rgba(%s,%s,%s,%s);', $rgb[0], $rgb[1], $rgb[2], 0.4 );
									}
								}

								$caption_color = '';

								if ( isset( $metadata['pyre_caption_color'][0] ) && $metadata['pyre_caption_color'][0] ) {
									$caption_color = 'color:' . $metadata['pyre_caption_color'][0] . ';';
								}

								$caption_bg = '';

								if ( isset( $metadata['pyre_caption_bg'][0] ) && 'yes' == $metadata['pyre_caption_bg'][0] ) {
									$caption_bg = 'background-color: rgba(0, 0, 0, 0.4);';

									if ( isset( $metadata['pyre_caption_bg_color'][0] ) && '' != $metadata['pyre_caption_bg_color'][0] ) {
										$rgb        = fusion_hex2rgb( $metadata['pyre_caption_bg_color'][0] );
										$caption_bg = sprintf( 'background-color: rgba(%s,%s,%s,%s);', $rgb[0], $rgb[1], $rgb[2], 0.4 );
									}
								}

								$video_bg_color = '';

								if ( isset( $metadata['pyre_video_bg_color'][0] ) && $metadata['pyre_video_bg_color'][0] ) {
									$video_bg_color_hex = fusion_hex2rgb( $metadata['pyre_video_bg_color'][0]  );
									$video_bg_color     = 'background-color: rgba(' . $video_bg_color_hex[0] . ', ' . $video_bg_color_hex[1] . ', ' . $video_bg_color_hex[2] . ', 0.4);';
								}

								$video = false;

								if ( isset( $metadata['pyre_type'][0] ) ) {
									if ( isset( $metadata['pyre_type'][0] ) && in_array( $metadata['pyre_type'][0], array( 'self-hosted-video', 'youtube', 'vimeo' ) ) ) {
										$video = true;
									}
								}

								if ( isset( $metadata['pyre_type'][0] ) &&  $metadata['pyre_type'][0] == 'self-hosted-video' ) {
									$background_class = 'self-hosted-video-bg';
								}

								$heading_font_size = 'font-size:60px;line-height:80px;';
								if ( isset( $metadata['pyre_heading_font_size'][0] ) && $metadata['pyre_heading_font_size'][0] ) {
									$line_height       = $metadata['pyre_heading_font_size'][0] * 1.2;
									$heading_font_size = 'font-size:' . $metadata['pyre_heading_font_size'][0] . 'px;line-height:' . $line_height . 'px;';
								}

								$caption_font_size = 'font-size: 24px;line-height:38px;';
								if ( isset( $metadata['pyre_caption_font_size'][0] ) && $metadata['pyre_caption_font_size'][0] ) {
									$line_height       = $metadata['pyre_caption_font_size'][0] * 1.2;
									$caption_font_size = 'font-size:' . $metadata['pyre_caption_font_size'][0] . 'px;line-height:' . $line_height . 'px;';
								}
								
								$heading_styles = $heading_color . $heading_font_size;
								$caption_styles = $caption_color . $caption_font_size;
								$heading_title_sc_wrapper_class = '';
								$caption_title_sc_wrapper_class = '';
								
								if ( ! isset( $metadata['pyre_heading_separator'][0] ) ) {
									$metadata['pyre_heading_separator'][0] = 'none';
								}
								
								if ( ! isset( $metadata['pyre_caption_separator'][0] ) ) {
									$metadata['pyre_caption_separator'][0] = 'none';
								}									
								
								if ( $metadata['pyre_content_alignment'][0] != 'center' ) {
									$metadata['pyre_heading_separator'][0] = 'none';
									$metadata['pyre_caption_separator'][0] = 'none';								
								}
								
								if ( $metadata['pyre_content_alignment'][0] == 'center' ) {
									if ( $metadata['pyre_heading_separator'][0] != 'none' ) {
										$heading_title_sc_wrapper_class = ' fusion-block-element';
									}
									
									if ( $metadata['pyre_caption_separator'][0] != 'none' ) {
										$caption_title_sc_wrapper_class = ' fusion-block-element';
									}
								}
								?>
								<li data-mute="<?php echo $data_mute; ?>" data-loop="<?php echo $data_loop; ?>" data-autoplay="<?php echo $data_autoplay; ?>">
									<div class="slide-content-container slide-content-<?php if ( isset( $metadata['pyre_content_alignment'][0] ) && $metadata['pyre_content_alignment'][0] ) { echo $metadata['pyre_content_alignment'][0]; } ?>" style="display: none;">
										<div class="slide-content" style="<?php echo $content_max_width; ?>">
											<?php if ( isset( $metadata['pyre_heading'][0] ) && $metadata['pyre_heading'][0] ) : ?>
												<div class="heading <?php echo ( $heading_bg ) ? 'with-bg' : ''; ?>">
													<div class="fusion-title-sc-wrapper<?php echo $heading_title_sc_wrapper_class; ?>" style="<?php echo $heading_bg; ?>">
														<?php echo do_shortcode( sprintf( '[title size="2" content_align="%s" sep_color="%s" margin_top="0px" margin_bottom="0px" style_type="%s" style_tag="%s"]%s[/title]',  $metadata['pyre_content_alignment'][0], $metadata['pyre_heading_color'][0], $metadata['pyre_heading_separator'][0], $heading_styles, do_shortcode( $metadata['pyre_heading'][0] ) ) ); ?>
													</div>
												</div>
											<?php endif; ?>
											<?php if ( isset( $metadata['pyre_caption'][0] ) && $metadata['pyre_caption'][0] ) : ?>
												<div class="caption <?php echo ( $caption_bg ) ? 'with-bg' : ''; ?>">
													<div class="fusion-title-sc-wrapper<?php echo $caption_title_sc_wrapper_class; ?>" style="<?php echo $caption_bg; ?>">
														<?php echo do_shortcode( sprintf( '[title size="3" content_align="%s" sep_color="%s" margin_top="0px" margin_bottom="0px" style_type="%s" style_tag="%s"]%s[/title]',  $metadata['pyre_content_alignment'][0], $metadata['pyre_caption_color'][0], $metadata['pyre_caption_separator'][0], $caption_styles, do_shortcode( $metadata['pyre_caption'][0] ) ) ); ?>
													</div>
												</div>
											<?php endif; ?>
											<?php if ( isset( $metadata['pyre_link_type'][0] ) && 'button' == $metadata['pyre_link_type'][0] ) : ?>
												<div class="buttons" >
													<?php if ( isset( $metadata['pyre_button_1'][0] ) && $metadata['pyre_button_1'][0] ) : ?>
														<div class="tfs-button-1"><?php echo do_shortcode( $metadata['pyre_button_1'][0] ); ?></div>
													<?php endif; ?>
													<?php if ( isset( $metadata['pyre_button_2'][0] ) && $metadata['pyre_button_2'][0] ) : ?>
														<div class="tfs-button-2"><?php echo do_shortcode( $metadata['pyre_button_2'][0] ); ?></div>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
									<?php if ( isset( $metadata['pyre_link_type'][0] ) && 'full' == $metadata['pyre_link_type'][0] && isset( $metadata['pyre_slide_link'][0] ) && $metadata['pyre_slide_link'][0] ) : ?>
										<a href="<?php echo $metadata['pyre_slide_link'][0]; ?>" class="overlay-link" <?php echo ( isset( $metadata['pyre_slide_target'][0] ) && 'yes' == $metadata['pyre_slide_target'][0] ) ? 'target="_blank"' : ''; ?>></a>
									<?php endif; ?>
									<?php if ( isset( $metadata['pyre_preview_image'][0] ) && $metadata['pyre_preview_image'][0] && isset( $metadata['pyre_type'][0] ) && 'self-hosted-video' == $metadata['pyre_type'][0] ) : ?>
										<div class="mobile_video_image" style="background-image: url(<?php echo Avada_Sanitize::css_asset_url( $metadata['pyre_preview_image'][0] ); ?>);"></div>
									<?php elseif ( isset( $metadata['pyre_type'][0] ) && 'self-hosted-video' == $metadata['pyre_type'][0] ) : ?>
										<div class="mobile_video_image" style="background-image: url(<?php echo Avada_Sanitize::css_asset_url( get_template_directory_uri() . '/assets/images/video_preview.jpg' ); ?>);"></div>
									<?php endif; ?>
									<?php if ( $video_bg_color && true == $video ) : ?>
										<div class="overlay" style="<?php echo $video_bg_color; ?>"></div>
									<?php endif; ?>
									<div class="background <?php echo $background_class; ?>" style="<?php echo $background_image; ?>max-width:<?php echo $slider_settings['slider_width']; ?>;height:<?php echo $slider_settings['slider_height']; ?>;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image_url[0]; ?>', sizingMethod='scale');-ms-filter:'progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image_url[0]; ?>', sizingMethod='scale')';" data-imgwidth="<?php echo $img_width; ?>">
										<?php if ( isset( $metadata['pyre_type'][0] ) ) : ?>
											<?php if ( 'self-hosted-video' == $metadata['pyre_type'][0] && ( $metadata['pyre_webm'][0] || $metadata['pyre_mp4'][0] || $metadata['pyre_ogg'][0] ) ) : ?>
												<video width="1800" height="700" <?php echo $video_attributes; ?> preload="auto">
													<?php if ( array_key_exists( 'pyre_mp4', $metadata ) && $metadata['pyre_mp4'][0] ) : ?>
														<source src="<?php echo $metadata['pyre_mp4'][0]; ?>" type="video/mp4">
													<?php endif; ?>
													<?php if ( array_key_exists( 'pyre_ogg', $metadata ) && $metadata['pyre_ogg'][0] ) : ?>
														<source src="<?php echo $metadata['pyre_ogg'][0]; ?>" type="video/ogg">
													<?php endif; ?>
													<?php if( array_key_exists( 'pyre_webm', $metadata ) && $metadata['pyre_webm'][0] ) : ?>
														<source src="<?php echo $metadata['pyre_webm'][0]; ?>" type="video/webm">
													<?php endif; ?>
												</video>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ( isset( $metadata['pyre_type'][0] ) && isset( $metadata['pyre_youtube_id'][0] ) && 'youtube' == $metadata['pyre_type'][0] && $metadata['pyre_youtube_id'][0] ) : ?>
											<div style="position: absolute; top: 0; left: 0; <?php echo $video_zindex; ?> width: 100%; height: 100%" data-youtube-video-id="<?php echo $metadata['pyre_youtube_id'][0]; ?>" data-video-aspect-ratio="<?php echo $aspect_ratio; ?>">
												<div id="video-<?php echo $metadata['pyre_youtube_id'][0]; ?>-inner">
													<iframe frameborder="0" height="100%" width="100%" src="https://www.youtube.com/embed/<?php echo $metadata['pyre_youtube_id'][0]; ?>?wmode=transparent&amp;modestbranding=1&amp;showinfo=0&amp;autohide=1&amp;enablejsapi=1&amp;rel=0&amp;vq=hd720&amp;<?php echo $youtube_attributes; ?>"></iframe>
												</div>
											</div>
										<?php endif; ?>
										<?php if ( isset( $metadata['pyre_type'][0] ) && isset( $metadata['pyre_vimeo_id'][0] ) &&  'vimeo' == $metadata['pyre_type'][0] && $metadata['pyre_vimeo_id'][0] ) : ?>
											<div style="position: absolute; top: 0; left: 0; <?php echo $video_zindex; ?> width: 100%; height: 100%" data-mute="<?php echo $data_mute; ?>" data-vimeo-video-id="<?php echo $metadata['pyre_vimeo_id'][0]; ?>" data-video-aspect-ratio="<?php echo $aspect_ratio; ?>">
												<iframe src="https://player.vimeo.com/video/<?php echo $metadata['pyre_vimeo_id'][0]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;badge=0&amp;title=0<?php echo $vimeo_attributes; ?>" height="100%" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
											</div>
										<?php endif; ?>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
			<?php wp_reset_query();
		}
	}
}

if( ! function_exists( 'avada_get_page_title_bar_contents' ) ) {
	function avada_get_page_title_bar_contents( $post_id, $get_secondary_content = TRUE ) {

		if ( $get_secondary_content ) {
			ob_start();
			if ( fusion_get_option( 'page_title_bar_bs', 'page_title_breadcrumbs_search_bar', $post_id ) != 'none' ) {
				if ( ( 'Breadcrumbs' == Avada()->settings->get( 'page_title_bar_bs' ) && in_array( get_post_meta( $post_id, 'pyre_page_title_breadcrumbs_search_bar', true ), array( 'breadcrumbs', 'default', '' ) ) ) || 'breadcrumbs' == get_post_meta( $post_id, 'pyre_page_title_breadcrumbs_search_bar', true ) ) {
					fusion_breadcrumbs();
				} elseif ( ( 'Search Box' == Avada()->settings->get( 'page_title_bar_bs' ) && in_array( get_post_meta( $post_id, 'pyre_page_title_breadcrumbs_search_bar', true ), array( 'searchbar', 'default', '' ) ) ) || 'searchbar' == get_post_meta( $post_id, 'pyre_page_title_breadcrumbs_search_bar', true ) ) {
					get_search_form();
				}
			}
			$secondary_content = ob_get_contents();
			ob_get_clean();
		} else {
			$secondary_content = '';
		}

		$title    = '';
		$subtitle = '';

		if ( '' != get_post_meta( $post_id, 'pyre_page_title_custom_text', true ) ) {
			$title = get_post_meta( $post_id, 'pyre_page_title_custom_text', true );
		}

		if ( '' != get_post_meta( $post_id, 'pyre_page_title_custom_subheader', true ) ) {
			$subtitle = get_post_meta( $post_id, 'pyre_page_title_custom_subheader', true );
		}

		if ( '' == get_post_meta( $post_id, 'pyre_page_title_text', true ) || 'default' == get_post_meta( $post_id, 'pyre_page_title_text', true ) ) {
			$page_title_text = Avada()->settings->get( 'page_title_bar_text' );
		} else {
			$page_title_text = get_post_meta( $post_id, 'pyre_page_title_text', true );
		}

		if ( is_search() ) {
			$title = sprintf( __( 'Search results for: %s', 'Avada' ), get_search_query() );
			$subtitle = '';
		}

		if ( ! $title ) {
			$title = get_the_title( $post_id );

			// Only assing blog title theme option to default blog page and not posts page
			if ( is_home() && get_option( 'show_on_front' ) != 'page' ) {
				$title = Avada()->settings->get( 'blog_title' );
			}

			if ( is_404() ) {
				$title = __( 'Error 404 Page', 'Avada' );
			}

			if ( class_exists( 'Tribe__Events__Main' ) && ( ( tribe_is_event() && ! is_single() && ! is_home() ) || is_events_archive() || ( is_events_archive() && is_404() ) ) ) {
				$title = tribe_get_events_title();
			} elseif ( is_archive() && ! is_bbpress() && ! is_search() ) {
				if ( is_day() ) {
					$title = sprintf( __( 'Daily Archives: %s', 'Avada' ), '<span>' . get_the_date() . '</span>' );
				} else if ( is_month() ) {
					$title = sprintf( __( 'Monthly Archives: %s', 'Avada' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Avada' ) ) . '</span>' );
				} elseif ( is_year() ) {
					$title = sprintf( __( 'Yearly Archives: %s', 'Avada' ), '<span> ' . get_the_date( _x( 'Y', 'yearly archives date format', 'Avada' ) ) . '</span>' );
				} elseif ( is_author() ) {
					$curauth = get_user_by( 'id', get_query_var( 'author' ) );
					$title   = $curauth->nickname;
				} elseif ( is_post_type_archive() ) {
					$title = post_type_archive_title( '', false );

					$sermon_settings = get_option( 'wpfc_options' );
					if ( is_array( $sermon_settings ) ) {
						$title = $sermon_settings['archive_title'];
					}

				} else {
					$title = single_cat_title( '', false );
				}
			}

			if ( class_exists( 'WooCommerce' ) && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
				if ( ! is_product() ) {
					$title = woocommerce_page_title( false );
				}
			}
		}

		// Only assing blog subtitle theme option to default blog page and not posts page
		if ( ! $subtitle && is_home() && get_option( 'show_on_front' ) != 'page' ) {
			$subtitle = Avada()->settings->get( 'blog_subtitle' );
		}

		if ( ! is_archive() && ! is_search() && ! ( is_home() && ! is_front_page() ) ) {
			if ( 'no' == $page_title_text && ( 'yes' == get_post_meta( $post_id, 'pyre_page_title', true ) || 'yes_without_bar' == get_post_meta( $post_id, 'pyre_page_title', true ) || ( 'hide' != Avada()->settings->get( 'page_title_bar' ) && 'no' != get_post_meta( $post_id, 'pyre_page_title', true ) ) ) ) {
				$title    = '';
				$subtitle = '';
			}
		} else {
			if ( 'hide' != Avada()->settings->get( 'page_title_bar' ) && 'no' == $page_title_text ) {
				$title    = '';
				$subtitle = '';
			}
		}

		return array( $title, $subtitle, $secondary_content );
	}

}

if ( ! function_exists( 'avada_current_page_title_bar' ) ) {
	function avada_current_page_title_bar( $post_id  ) {
		$page_title_bar_contents = avada_get_page_title_bar_contents( $post_id );

		if ( ( ! is_archive() || class_exists( 'WooCommerce' ) && is_shop() ) && 
			 ! is_search() 
		) {
			if ( 'yes' == get_post_meta( $post_id, 'pyre_page_title', true ) || 'yes_without_bar' == get_post_meta( $post_id, 'pyre_page_title', true ) || ( 'hide' != Avada()->settings->get( 'page_title_bar' ) && 'no' != get_post_meta( $post_id, 'pyre_page_title', true ) ) ) {
				if ( is_home() && is_front_page() && ! Avada()->settings->get( 'blog_show_page_title_bar' ) ) {
					// do nothing
				} else {
					if( is_home() && get_post_meta( $post_id, 'pyre_page_title', true ) == 'default' && ! Avada()->settings->get( 'blog_show_page_title_bar' ) ) {
						return;
					}
					avada_page_title_bar( $page_title_bar_contents[0], $page_title_bar_contents[1], $page_title_bar_contents[2] );
				}
			}
		} else {
			if ( is_home() && Avada()->settings->get( 'blog_show_page_title_bar' ) ) {
				avada_page_title_bar( $page_title_bar_contents[0], $page_title_bar_contents[1], $page_title_bar_contents[2] );
			} else {
				if( 'hide' != Avada()->settings->get( 'page_title_bar' ) ) {
					avada_page_title_bar( $page_title_bar_contents[0], $page_title_bar_contents[1], $page_title_bar_contents[2] );
				}
			}
		}
	}
}

if ( ! function_exists( 'avada_backend_check_new_bbpress_post' ) ) {
	function avada_backend_check_new_bbpress_post() {
		global $pagenow, $post_type;
		return ( 'post-new.php' == $pagenow && in_array( $post_type, array( 'forum', 'topic', 'reply' ) ) ) ? true : false;
	}
}

if ( ! function_exists( 'avada_featured_images_for_pages' ) ) {
	function avada_featured_images_for_pages() {
		if ( ! post_password_required( get_the_ID() ) ) {

			$html = $video = $featured_images = '';

			if( ! Avada()->settings->get( 'featured_images_pages' ) ) {
				if ( 0 < avada_number_of_featured_images() || get_post_meta( get_the_ID(), 'pyre_video', true ) ) {
					if ( get_post_meta( get_the_ID(), 'pyre_video', true ) ) {
						$video = '<li><div class="full-video">' . get_post_meta( get_the_ID(), 'pyre_video', true ) . '</div></li>';
					}

					if ( has_post_thumbnail() && 'yes' != get_post_meta( get_the_ID(), 'pyre_show_first_featured_image', true ) ) {
						$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$full_image       = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$attachment_data  = wp_get_attachment_metadata( get_post_thumbnail_id() );

						$featured_images .= sprintf(
							'<li><a href="%s" rel="prettyPhoto[gallery%s]" data-title="%s" data-caption="%s"><img src="%s" alt="%s" /></a></li>',
							$full_image[0],
							get_the_ID(),
							get_post_field( 'post_title', get_post_thumbnail_id() ),
							get_post_field( 'post_excerpt', get_post_thumbnail_id() ),
							$attachment_image[0],
							get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true )
						);
					}

					$i = 2;
					while ( $i <= Avada()->settings->get( 'posts_slideshow_number' ) ) :

						$attachment_new_id = kd_mfi_get_featured_image_id( 'featured-image-'.$i, 'page' );

						if ( $attachment_new_id ) {

							$attachment_image = wp_get_attachment_image_src( $attachment_new_id, 'full' );
							$full_image       = wp_get_attachment_image_src( $attachment_new_id, 'full' );
							$attachment_data  = wp_get_attachment_metadata( $attachment_new_id );

							$featured_images .= sprintf(
								'<li><a href="%s" rel="iLightbox[gallery%s]" data-title="%s" data-caption="%s"><img src="%s" alt="%s" /></a></li>',
								$full_image[0],
								get_the_ID(),
								get_post_field( 'post_title', $attachment_new_id ),
								get_post_field( 'post_excerpt', $attachment_new_id ),
								$attachment_image[0],
								get_post_meta( $attachment_new_id, '_wp_attachment_image_alt', true )
							);
						}
						$i++;
					endwhile;

					$html .= sprintf(
						'<div class="fusion-flexslider flexslider post-slideshow"><ul class="slides">%s%s</ul></div>',
						$video,
						$featured_images
					);
				}
			}
		}
		return $html;
	}
}

if ( ! function_exists( 'avada_featured_images_lightbox' ) ) {
	function avada_featured_images_lightbox( $post_id ) {
		$html = $video = $featured_images = '';

		if ( get_post_meta( $post_id, 'pyre_video_url', true ) ) {
			$video = sprintf( '<a href="%s" class="iLightbox[gallery%s]"></a>', get_post_meta( $post_id, 'pyre_video_url', true ), $post_id );
		}

		$i = 2;

		while ( $i <= Avada()->settings->get( 'posts_slideshow_number' ) ) :

			$attachment_new_id = kd_mfi_get_featured_image_id( 'featured-image-'.$i, get_post_type( $post_id ) );
			if ( $attachment_new_id ) {
				$attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full' );
				$full_image       = wp_get_attachment_image_src($attachment_new_id, 'full' );
				$attachment_data  = wp_get_attachment_metadata($attachment_new_id );
				$featured_images .= sprintf(
					'<a href="%s" data-rel="iLightbox[gallery%s]" title="%s" data-title="%s" data-caption="%s"></a>',
					$full_image[0],
					$post_id,
					get_post_field( 'post_title', $attachment_new_id ),
					get_post_field( 'post_title', $attachment_new_id ),
					get_post_field( 'post_excerpt', $attachment_new_id )
				);
			}
			$i++;

		endwhile;

		$html .= sprintf( '<div class="fusion-portfolio-gallery-hidden">%s%s</div>', $video, $featured_images );

		return $html;
	}

}

if( ! function_exists( 'avada_display_sidenav' ) ) {
	function avada_display_sidenav( $post_id ) {

		if( is_page_template( 'side-navigation.php' ) ) {
			$html = '<ul class="side-nav">';

			$post_ancestors = get_ancestors( $post_id, 'page' );
			$post_parent    = end( $post_ancestors );

			$html .= ( is_page( $post_parent ) ) ? '<li class="current_page_item">' : '<li>';

			if ( $post_parent ) {
				$html .= sprintf( '<a href="%s" title="%s">%s</a></li>', get_permalink( $post_parent ), __( 'Back to Parent Page', 'Avada' ), get_the_title( $post_parent ) );
				$children = wp_list_pages( sprintf( 'title_li=&child_of=%s&echo=0', $post_parent ) );
			} else {
				$html .= sprintf( '<a href="%s" title="%s">%s</a></li>', get_permalink( $post_id ), __( 'Back to Parent Page', 'Avada' ), get_the_title( $post_id ) );
				$children = wp_list_pages( sprintf( 'title_li=&child_of=%s&echo=0', $post_id ) );
			}

			if ( $children ) {
				$html .= $children;
			}

			$html .= '</ul>';

			return $html;
		}
	}
}

if ( ! function_exists( 'avada_link_pages' ) ) {
	function avada_link_pages() {
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Avada' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>'
		) );
	}
}

if ( ! function_exists( 'avada_number_of_featured_images' ) ) {
	function avada_number_of_featured_images() {
		global $post;
		$number_of_images = 0;

		if ( has_post_thumbnail() && 'yes' != get_post_meta( $post->ID, 'pyre_show_first_featured_image', true ) ) {
			$number_of_images++;
		}

		for ( $i = 2; $i <= Avada()->settings->get( 'posts_slideshow_number' ); $i++ ) {
			$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, $post->post_type );

			if ( $attachment_new_id ) {
				$number_of_images++;
			}
		}
		return $number_of_images;
	}
}

// Omit closing PHP tag to avoid "Headers already sent" issues.